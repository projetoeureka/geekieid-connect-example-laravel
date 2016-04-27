<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /*
     * If the user is logged in, we show his name and a link to log out.
     * Otherwise, only a link to log in.
     * The user's name is returned by the Geekie API. The request to the Geekie
     * API is made using an Access Token.
     */
    public function showHome(Request $request)
    {
        $session_token = config('constants.session_token');
        if ($request->session()->has($session_token)) {
            return $this->showLogged($request->session()->get($session_token));
        }

        return $this->showNotLogged();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    private function showLogged($token)
    {
        return view('logged', [ 'name' => $this->getName($token) ]);
    }

    /*
     * We can consume user data from Geekie using an Access Token. In this
     * particular case, we are only interested in the user's name.
     */
    private function getName($token)
    {
        $client = new Client(['base_uri' => config('constants.geekie_uri.base')]);
        $authorization_header = 'Bearer ' . $token;
        $response = $client->request('GET', config('constants.geekie_uri.user'), [
            'headers' => [
                'Authorization' => $authorization_header
            ]
        ]);

        $json = json_decode($response->getBody(), true);
        return $json['_embedded']['membership']['full_name'];
    }

    private function showNotLogged()
    {
        $state = str_random(40);
        $login_url = sprintf(
            '%s/%s?response_type=code&client_id=%s&state=%s',
            config('constants.geekie_uri.base'),
            config('constants.geekie_uri.code'),
            config('constants.client_id'),
            $state
        );

        return response()
            ->view('notlogged', [ 'login_url' => $login_url ])
            ->cookie(config('constants.cookie_state'), $state);
    }
}
