<!DOCTYPE html>
<html lang="en">
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    
  <head>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script src="tweetLinkIt.js"></script>
    
    <script>
        $('.tweet').tweetLinkify();
        
        function pageComplete(){
        $('.tweet').tweetLinkify();
         }

    </script>
  
  
</head>
   
<style>
    .border {
      border-bottom: dotted 1px black;
      padding-bottom: 10px;
      clear: both;
    }
    
    .float-left {
      float: left;
    }
    
    .bold {
      font-weight: 700;
    }
    
  a {
   text-decoration: none;
   color: #488C03;
    }
    
    .handle {
      color: gray;
      font-size: 11px;
    }
    
    .twitter-pic {
      padding-right: 10px;
    }
    
    .name {
      
    }
    
    .font-small {
      font-size: 11px;
    }
    
    .tweet-div {
      clear: both;
      padding: 8px;
      border-bottom: 1px dotted #488C03;
    }
    
    .twitpic {
      clear: both;
    }
  </style>
    
 
    

<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "",
    'oauth_access_token_secret' => "",
    'consumer_key' => "7DupEseAPvT0aGaA9zwuKA",
    'consumer_secret' => "9Va802Pnpfd5nkz23ZIsqkQJjz2ZqLUxuAxzXQSI"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$requestMethod = 'GET';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'usernameToBlock', 
    'skip_status' => '1'
);

/** Perform a POST request and echo the response 
$twitter = new TwitterAPIExchange($settings);
echo $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();
**/
/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23medicalmarijuana';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);

/** echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

             
**/

$tweetData = json_decode($twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest(), $assoc = TRUE);


//echo $tweetData;

  foreach($tweetData['statuses'] as $items)
      {
        
        $userArray = $items['user'];
        $mediaArray = $items['media'];
        $date = new DateTime( $tweet->created_at );
        
        
        echo "<div class='tweet-div'><div class='float-left twitpic'><a target='_blank' href='http://www.twitter.com/" . $userArray['screen_name'] . "'><img class='twitter-pic' target='_blank' src='" . $userArray['profile_image_url'] . "'></a></div>";
        echo "<a target='_blank' href='http://www.twitter.com/" . $userArray['screen_name'] . "'><span class='name bold'>" . $userArray['name'] . "</span>   <span class='handle'>@" . $userArray['screen_name'] . "</span></a>  <span class='font-small'>&sdot; ";
        echo $date->format( 'M jS' ) . "</span></br>";
       echo "<div class='tweet'>" . $items['text'] . "</div></br></br>";
        //echo "At: " . $items['created_at'] . "</br>";
        //echo "<img target='_blank' src='http://" . $mediaArray['media_url'] . "'></br></br>";
        //echo $mediaArray['media_url'] . "";
        echo "<span class='border'></span></div>";
      }
      
      echo "<script>pageComplete();</script>;"
?>



