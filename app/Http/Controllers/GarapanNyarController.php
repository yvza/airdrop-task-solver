<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Tasks;
use App\Models\Garapan;
use App\Models\TaskResults;
use App\Models\TwitterToken;
use Illuminate\Http\Request;
use League\OAuth1\Client\Server\Twitter;
use Coderjerk\BirdElephant\BirdElephant;
use Symfony\Component\Console\Input\Input;

class GarapanNyarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('GarapanNyar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return Inertia::render('GarapanNyar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'airdrop_name' => ['required'],
            'project_url' => ['required'],
            'distribution_date' => ['required'],
            'task_name' => ['required'],
            'target_url' => ['required']
        ]);

        // validate input
        if (!$validated) {
            return redirect('/');
        }

        // check when airdrop_name exist
        $nameExist = Garapan::where('airdrop_name', '=', $request->airdrop_name)->first();
        if ($nameExist) {
            // get id
            $garapan_id = $nameExist->id;

            // TODO: make validation before create new Tasks
            // next, save to tasks
            $tasks = Tasks::create([
                'garapan_id' => $garapan_id,
                'task_name_list_id' => $request->task_name,
            ]);

            // decoded url, get tweet username
            $decoded_target_username = array_filter(explode("/", parse_url($request->target_url)['path']))[1];
            if (!$decoded_target_username) {
                return redirect('/');
            }
            
            // authorization bearer
            $twitter_authorization_bearer = env('TWITTER_AUTHORIZATION_BEARER');
            
            // some config
            $twitter_api_key = env('TWITTER_API_KEY');
            $twitter_api_key_secret = env('TWITTER_API_KEY_SECRET');
            
            // https://developer.twitter.com/en/docs/tutorials/authenticating-with-twitter-api-for-enterprise/oauth1-0a-and-user-access-tokens
            // https://developer.twitter.com/en/docs/authentication/oauth-1-0a/obtaining-user-access-tokens
            // follwo action
            $twitter_token = TwitterToken::all()->toArray();
            if (empty($twitter_token)) {
                return redirect()->back()->with('twitter_token', 'Akses dulu http://airdrop-task-solver.test/twitter-token untuk dapetin tokennya 😋');
            }
            $credentials = array(
                'bearer_token' => $twitter_authorization_bearer, // OAuth 2.0 Bearer Token requests
                'consumer_key' => $twitter_api_key, // identifies your app, always needed
                'consumer_secret' => $twitter_api_key_secret, // app secret, always needed
                'token_identifier' => $twitter_token[0]['oauth_token'], // OAuth 1.0a User Context requests
                'token_secret' => $twitter_token[0]['oauth_token_secret'], // OAuth 1.0a User Context requests
            );
            
            $twitter = new BirdElephant($credentials);
            $user = $twitter->user(env('TWITTER_USERNAME'));
            $follow = $user->follow($decoded_target_username);
            if ($follow->data->following) return redirect()->back()->with('success_message', 'Berhasil Difollow! 😄');

            // next, do the task, end then save the result
            // $task_result = new TaskResults;
            // $task_result->tasks_id = $tasks['id'];
            // $task_result->task_type_id = $request->type;
            // $task_result->status = $request->type;
            // $task_result->save();
        } else {
            // save
            $garapan = Garapan::create([
                'project_url' => $request->project_url, 
                'distribution_date' => $request->distribution_date, 
                'airdrop_name' => $request->airdrop_name, 
            ]);

            dd($garapan);
        }

        // return redirect('/');
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
