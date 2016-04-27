# geekieid-connect-example-laravel

This is a Laravel example of an OAuth 2.0 integration with GeekieID Connect.

## Relevant files:

- **app/Http/routes.php:** Routes definitions.
- **app/Http/Controllers/HomeController.php:** Controller that handles requests related to the first page of the app. Uses *logged* or *notlogged* views depending if the user is logged in or not. If the user is logged in, also fetches the name of the user (accessing the Geekie API using an Access Token) in order to populate the *logged* view.
- **app/Http/Controllers/OAuth2Controller.php:** Controller that handles requests related to the OAuth2 flow. Contains the callback that Geekie redirects to. The callback gets the Authorization Code sent by Geekie and a request is issued to Geekie in order to exchange the Authorization Code for an Access Token. If everything goes well, the Access Token is saved and the user is redirected to the first page.
- **app/config/constants.php:** Contains some constants such as the **client_id** registered with Geekie.
- **resources/views/logged.blade.php** and **resources/views/logged.blade.php:** The views.

## Running the example:

1) Request a local development **client_id** (you'll have to specify the exact **redirect_uri** for local development, including the port - see step 4).
2) Edit **app/config/constants.php** (set your **client_id**).
3) Run `php composer.phar install` to install the dependencies.
4) Run: `php artisan serve --port=3000`. In this case, the value of **redirect_uri** should be `http://localhost:3000/oauth2callback`.
