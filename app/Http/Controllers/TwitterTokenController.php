<?php

namespace App\Http\Controllers;

use App\Models\TwitterToken;
use ReflectionClass;
use Illuminate\Http\Request;
use League\OAuth1\Client\Server\Twitter;

class TwitterTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $server = new Twitter([
            'identifier' => env('TWITTER_API_KEY'),
            'secret' => env('TWITTER_API_KEY_SECRET'),
            'callback_uri' => env('OAUTH_CALLBACK').'twitter-token',
        ]);

        session_start();

        function accessProtected($obj, $prop) {
            $reflection = new ReflectionClass($obj);
            $property = $reflection->getProperty($prop);
            $property->setAccessible(true);
            return $property->getValue($obj);
        }

        // if (isset($_GET['user'])) {

        //     // Check somebody hasn't manually entered this URL in,
        //     // by checking that we have the token credentials in
        //     // the session.
        //     if ( ! isset($_SESSION['token_credentials'])) {
        //         echo 'No token credentials.';
        //         exit(1);
        //     }
        
        //     // Retrieve our token credentials. From here, it's play time!
        //     $tokenCredentials = unserialize($_SESSION['token_credentials']);
        
        //     // // Below is an example of retrieving the identifier & secret
        //     // // (formally known as access token key & secret in earlier
        //     // // OAuth 1.0 specs).
        //     // $identifier = $tokenCredentials->getIdentifier();
        //     // $secret = $tokenCredentials->getSecret();
        
        //     // Some OAuth clients try to act as an API wrapper for
        //     // the server and it's API. We don't. This is what you
        //     // get - the ability to access basic information. If
        //     // you want to get fancy, you should be grabbing a
        //     // package for interacting with the APIs, by using
        //     // the identifier & secret that this package was
        //     // designed to retrieve for you. But, for fun,
        //     // here's basic user information.
        //     $user = $server->getUserDetails($tokenCredentials);
        
        // // Step 3
        // } 
        if (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier'])) {
        
            // Retrieve the temporary credentials from step 2
            $temporaryCredentials = unserialize($_SESSION['temporary_credentials']);
            
            // Third and final part to OAuth 1.0 authentication is to retrieve token
            // credentials (formally known as access tokens in earlier OAuth 1.0
            // specs).
            $tokenCredentials = $server->getTokenCredentials($temporaryCredentials, $_GET['oauth_token'], $_GET['oauth_verifier']);
            // var_dump($tokenCredentials->identifier);exit;
            $result = [
                'oauth_token' => accessProtected($tokenCredentials, 'identifier'),
                'oauth_token_secret' => accessProtected($tokenCredentials, 'secret')
            ];

            // cek first if token exist or nah
            $checkIfExist = TwitterToken::count();
            if ($checkIfExist > 0) {
                // delete all first
                TwitterToken::truncate();
                
                // and then save the new one
                $twitter_token_save = new TwitterToken();
                $twitter_token_save->oauth_token = $result['oauth_token'];
                $twitter_token_save->oauth_token_secret = $result['oauth_token_secret'];
                $twitter_token_save->save();
            } else {
                $twitter_token_save = new TwitterToken();
                $twitter_token_save->oauth_token = $result['oauth_token'];
                $twitter_token_save->oauth_token_secret = $result['oauth_token_secret'];
                $twitter_token_save->save();
            }

            return redirect('/');

            // Now, we'll store the token credentials and discard the temporary
            // ones - they're irrelevant at this stage.
            // unset($_SESSION['temporary_credentials']);
            // $_SESSION['token_credentials'] = serialize($tokenCredentials);
            // session_write_close();
            
            // Redirect to the user page
            // header("Location: http://{$_SERVER['HTTP_HOST']}/?user=user");
            // var_dump($_SESSION['token_credentials']);exit;
        
        // Step 2.5 - denied request to authorize client
        } elseif (isset($_GET['denied'])) {
            echo 'Hey! You denied the client access to your Twitter account! If you did this by mistake, you should <a href="?go=go">try again</a>.';
        
        // Step 2
        } else {
        
            // First part of OAuth 1.0 authentication is retrieving temporary credentials.
            // These identify you as a client to the server.
            $temporaryCredentials = $server->getTemporaryCredentials();
        
            // Store the credentials in the session.
            $_SESSION['temporary_credentials'] = serialize($temporaryCredentials);
            session_write_close();
        
            // Second part of OAuth 1.0 authentication is to redirect the
            // resource owner to the login screen on the server.
            $server->authorize($temporaryCredentials);
        
        // Step 1
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
