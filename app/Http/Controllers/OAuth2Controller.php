<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OAuth2Controller extends Controller
{

    /*
     * If the state is valid, we continue the flow. We use the Authorization
     * Code sent by Geekie to get an Access Token.
     */
    public function getAuthorizationCode(Request $request)
    {
        if (!$this->hasValidState($request)) {
            return view('error', ['message' => 'Authorization Code: state is not valid']);
        }

        if ($request->has('error')) {
            $message = 'Authorization Code: ' . $request->input('error');
            return view('error', ['message' => $message]);
        }

        $code = $request->input('code');

        return $this->getAccessToken($request, $code);
    }

    /*
     * Although not necessary, the state protects us against CSRF. Here we
     * verify that the state is the one we sent to Geekie.
     */
    private function hasValidState(Request $request)
    {
        $state = $request->cookie(config('constants.cookie_state'));
        return $request->has('state') && $request->input('state') == $state;
    }

    /*
     * Here we exchange the Authorization Code for an Access Token and then
     * redirect the user to the home.
     */
    private function getAccessToken($request, $code)
    {
        $client = new Client(['base_uri' => config('constants.geekie_uri.base')]);
        $response = $client->request('POST', config('constants.geekie_uri.token'), [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'client_id' => config('constants.client_id')
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $json = json_decode($response->getBody(), true);
            $request->session()->put(config('constants.session_token'), $json['access_token']);
            return redirect('/');
        }

        $message = 'Access Token: ' . $json['error'];
        return view('error', ['message' => $message]);
    }
}
