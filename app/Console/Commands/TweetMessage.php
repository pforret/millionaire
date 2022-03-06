<?php

namespace App\Console\Commands;

use Abraham\TwitterOAuth\TwitterOAuth;
use Coderjerk\BirdElephant\BirdElephant;
use Coderjerk\BirdElephant\Compose\Tweet;
use DG\Twitter\Twitter;
use Illuminate\Console\Command;

class TweetMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'million:tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tweet a message to Twitter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \DG\Twitter\Exception
     */
    public function handle()
    {
        $BEARER_TOKEN = env("TWITTER_API_BEARER");
        $CONSUMER_KEY = env("TWITTER_API_KEY");
        $CONSUMER_SECRET = env("TWITTER_API_SECRET");
        $TWITTER_ACCESS_TOKEN = env("TWITTER_ACCESS_TOKEN");
        $TWITTER_ACCESS_SECRET = env("TWITTER_ACCESS_SECRET");
        // using https://twitteroauth.com/
        // $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $TWITTER_ACCESS_TOKEN, $TWITTER_ACCESS_SECRET);
        // $connection->setApiVersion(2);
        $credentials = array(
            'bearer_token' => $BEARER_TOKEN, // OAuth 2.0 Bearer Token requests
            'consumer_key' => $CONSUMER_KEY, // identifies your app, always needed
            'consumer_secret' => $CONSUMER_SECRET, // app secret, always needed
            'token_identifier' => $TWITTER_ACCESS_TOKEN, // OAuth 1.0a User Context requests
            'token_secret' => $TWITTER_ACCESS_SECRET, // OAuth 1.0a User Context requests
        );

        $twitter = new BirdElephant($credentials);
        $tweets = $twitter->tweets();
        $followers = $twitter->user('coderjerk')->followers();

        print_r($followers);
        $tweet = (new Tweet)->text('more people need to be talking about this')
            ->quoteTweetId('1456978214837006343');

        $twitter->tweets()->tweet($tweet);


        $tweet = (new Tweet)->text("Testing BirdElephant.");

        //$tweets->tweet($tweet);

    }
}
