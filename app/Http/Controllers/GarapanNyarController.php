<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Tasks;
use App\Models\Garapan;
use App\Models\TaskResults;
use App\Models\ListKataKata;
use App\Models\TwitterToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Coderjerk\BirdElephant\BirdElephant;
use Coderjerk\BirdElephant\Compose\Tweet;
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
            // validate if choosen task already done
            $taskAlreadyDone = DB::table('tasks')
            ->join('garapan', function ($join) use ($nameExist) {
                $join->on('tasks.garapan_id', '=', 'garapan.id')
                ->where('garapan.airdrop_name', '=', $nameExist->airdrop_name); //automatic check from exiting
            })
            ->join('task_results', function ($join) use ($request) {
                $join->on('tasks.id', '=', 'tasks_id')
                ->where('task_results.task_type_id', '=', $request->type) //depends on task type, eg: follow = 1
                ->where('task_results.status', '=', 1); //querying success result
            })
            ->where('task_name_list_id', '=', 1) //depends on task, eg: twitter = 1
            ->count();

            if ($taskAlreadyDone > 0) {
                // return with quote tweet id when already done, only for quote tweet task
                if ((int)$request->type === 4) {
                    $returnUrl = DB::table('tasks')
                    ->join('garapan', function ($join) use ($nameExist) {
                        $join->on('tasks.garapan_id', '=', 'garapan.id')
                        ->where('garapan.airdrop_name', '=', $nameExist->airdrop_name); //automatic check from exiting
                    })
                    ->join('task_results', function ($join) use ($request) {
                        $join->on('tasks.id', '=', 'tasks_id')
                        ->where('task_results.task_type_id', '=', $request->type) //depends on task type, eg: follow = 1
                        ->where('task_results.status', '=', 1); //querying success result
                    })
                    ->where('task_name_list_id', '=', 1) //depends on task, eg: twitter = 1
                    ->get();

                    $url_result = 'https://twitter.com/'.env('TWITTER_USERNAME').'/status/'.$returnUrl[0]->additional_message;

                    return redirect()->back()->with('error_message', 'Already Done! 😃😄 '.$url_result);
                }

                return redirect()->back()->with('error_message', 'Already Done! 😃😄');
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

            // get id
            $garapan_id = $nameExist->id;
            // decoded url
            $decoded_url = array_filter(explode("/", parse_url($request->target_url)['path']));
            // twitter instace
            $twitter = new BirdElephant($credentials);
            $weDo = $twitter->user(env('TWITTER_USERNAME'));

            switch ($request->type) {
                case '1':
                    # follow
                    // decoded url, get tweet username
                    $target_username = $decoded_url[1];
                    if (!$target_username) {
                        return redirect('/');
                    }

                    // next, do the task, end then save the result
                    $follow = $weDo->follow($target_username);

                    if ($follow->data->following) {
                        // next, save to tasks
                        $tasks = Tasks::create([
                            'garapan_id' => $garapan_id,
                            'task_name_list_id' => $request->task_name,
                        ]);

                        $task_result = new TaskResults;
                        $task_result->tasks_id = $tasks['id'];
                        $task_result->task_type_id = $request->type;
                        $task_result->status = 1;
                        $task_result->save();

                        return redirect()->back()->with('success_message', 'Berhasil Difollow! 😄');
                    }
                    break;
                case '2':
                    # love
                    // decoded url, get tweet id
                    $target_url = $decoded_url[3];
                    if (!$target_url) {
                        return redirect('/');
                    }

                    // next, do the task, end then save the result
                    $like = $weDo->like($target_url);
                    if ($like->data->liked) {
                        // next, save to tasks
                        $tasks = Tasks::create([
                            'garapan_id' => $garapan_id,
                            'task_name_list_id' => $request->task_name,
                        ]);

                        $task_result = new TaskResults;
                        $task_result->tasks_id = $tasks['id'];
                        $task_result->task_type_id = $request->type;
                        $task_result->status = 1;
                        $task_result->save();

                        return redirect()->back()->with('success_message', 'Berhasil Like! 😄');
                    }
                    break;
                case '3':
                    # retweet
                    // decoded url, get tweet id
                    $target_url = $decoded_url[3];
                    if (!$target_url) {
                        return redirect('/');
                    }

                    // next, do the task, end then save the result
                    $retweet = $weDo->retweet($target_url);
                    if ($retweet->data->retweeted) {
                        // next, save to tasks
                        $tasks = Tasks::create([
                            'garapan_id' => $garapan_id,
                            'task_name_list_id' => $request->task_name,
                        ]);

                        $task_result = new TaskResults;
                        $task_result->tasks_id = $tasks['id'];
                        $task_result->task_type_id = $request->type;
                        $task_result->status = 1;
                        $task_result->save();

                        return redirect()->back()->with('success_message', 'Berhasil Retweett! 😄');
                    }
                    break;
                case '4':
                    # quote tweet
                    // decoded url, get tweet id
                    $target_url = $decoded_url[3];
                    if (!$target_url) {
                        return redirect('/');
                    }

                    // pick random kata kata
                    $kata_kata = ListKataKata::inRandomOrder()->first();
                    // next, do the task, end then save the result
                    $tweet = (new Tweet)->text($kata_kata->message)->quoteTweetId($target_url);
                    $quote_tweet = $twitter->tweets()->tweet($tweet);
                    if ($quote_tweet->data->id) {
                        // next, save to tasks
                        $tasks = Tasks::create([
                            'garapan_id' => $garapan_id,
                            'task_name_list_id' => $request->task_name,
                        ]);

                        $task_result = new TaskResults;
                        $task_result->tasks_id = $tasks['id'];
                        $task_result->task_type_id = $request->type;
                        $task_result->status = 1;
                        $task_result->additional_message = $quote_tweet->data->id; //saving id tweet from callback
                        $task_result->save();

                        $url_result = 'https://twitter.com/'.env('TWITTER_USERNAME').'/status/'.$quote_tweet->data->id;

                        return redirect()->back()->with('success_message', 'Berhasil Quote Retweett! 😄 '.$url_result);
                    }
                    break;
            }
        } else {
            // save
            $garapan = Garapan::create([
                'project_url' => $request->project_url, 
                'distribution_date' => $request->distribution_date, 
                'airdrop_name' => $request->airdrop_name, 
            ]);

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

            // decoded url
            $decoded_url = array_filter(explode("/", parse_url($request->target_url)['path']));
            // twitter instace
            $twitter = new BirdElephant($credentials);
            $weDo = $twitter->user(env('TWITTER_USERNAME'));

            switch ($request->type) {
                case '1':
                    # follow
                    // decoded url, get tweet username
                    $target_username = $decoded_url[1];
                    if (!$target_username) {
                        return redirect('/');
                    }

                    // next, do the task, end then save the result
                    $follow = $weDo->follow($target_username);

                    if ($follow->data->following) {
                        // next, save to tasks
                        $tasks = Tasks::create([
                            'garapan_id' => $garapan->id,
                            'task_name_list_id' => $request->task_name,
                        ]);

                        $task_result = new TaskResults;
                        $task_result->tasks_id = $tasks['id'];
                        $task_result->task_type_id = $request->type;
                        $task_result->status = 1;
                        $task_result->save();

                        return redirect()->back()->with('success_message', 'Berhasil Difollow! 😄');
                    }
                    break;
                case '2':
                    # love
                    // decoded url, get tweet id
                    $target_url = $decoded_url[3];
                    if (!$target_url) {
                        return redirect('/');
                    }

                    // next, do the task, end then save the result
                    $like = $weDo->like($target_url);
                    if ($like->data->liked) {
                        // next, save to tasks
                        $tasks = Tasks::create([
                            'garapan_id' => $garapan->id,
                            'task_name_list_id' => $request->task_name,
                        ]);

                        $task_result = new TaskResults;
                        $task_result->tasks_id = $tasks['id'];
                        $task_result->task_type_id = $request->type;
                        $task_result->status = 1;
                        $task_result->save();

                        return redirect()->back()->with('success_message', 'Berhasil Like! 😄');
                    }
                    break;
                case '3':
                    # retweet
                    // decoded url, get tweet id
                    $target_url = $decoded_url[3];
                    if (!$target_url) {
                        return redirect('/');
                    }

                    // next, do the task, end then save the result
                    $retweet = $weDo->retweet($target_url);
                    if ($retweet->data->retweeted) {
                        // next, save to tasks
                        $tasks = Tasks::create([
                            'garapan_id' => $garapan->id,
                            'task_name_list_id' => $request->task_name,
                        ]);

                        $task_result = new TaskResults;
                        $task_result->tasks_id = $tasks['id'];
                        $task_result->task_type_id = $request->type;
                        $task_result->status = 1;
                        $task_result->save();

                        return redirect()->back()->with('success_message', 'Berhasil Retweett! 😄');
                    }
                    break;
                case '4':
                    # quote tweet
                    // decoded url, get tweet id
                    $target_url = $decoded_url[3];
                    if (!$target_url) {
                        return redirect('/');
                    }

                    // pick random kata kata
                    $kata_kata = ListKataKata::inRandomOrder()->first();
                    // next, do the task, end then save the result
                    $tweet = (new Tweet)->text($kata_kata->message)->quoteTweetId($target_url);
                    $quote_tweet = $twitter->tweets()->tweet($tweet);
                    if ($quote_tweet->data->id) {
                        // next, save to tasks
                        $tasks = Tasks::create([
                            'garapan_id' => $garapan->id,
                            'task_name_list_id' => $request->task_name,
                        ]);

                        $task_result = new TaskResults;
                        $task_result->tasks_id = $tasks['id'];
                        $task_result->task_type_id = $request->type;
                        $task_result->status = 1;
                        $task_result->additional_message = $quote_tweet->data->id; //saving id tweet from callback
                        $task_result->save();

                        $url_result = 'https://twitter.com/'.env('TWITTER_USERNAME').'/status/'.$quote_tweet->data->id;

                        return redirect()->back()->with('success_message', 'Berhasil Quote Retweett! 😄 '.$url_result);
                    }
                    break;
            }
        }
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
