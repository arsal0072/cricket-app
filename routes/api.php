<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FixureApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::Group(['middleware' => 'check_api_key'], function() {
	Route::post('/v1/live_matches/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@live_matches');
	Route::post('/v1/highlights/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@highlights');
	Route::post('/v1/live_matches_by_type/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@live_matches_by_type');
	Route::post('/v1/streaming_sources/{app_unique_id}/{match_id}', 'App\Http\Controllers\Api\v1\ApiController@streaming_sources');
	Route::post('/v1/settings/{app_unique_id}/{platform?}', 'App\Http\Controllers\Api\v1\ApiController@settings');
	Route::post('/v1/promotions/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@promotions');
	Route::post('/v1/popular_series/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@popular_series');
	Route::post('/v1/support', 'App\Http\Controllers\Api\v1\ApiController@support');
	Route::post('/v1/sports/type', 'App\Http\Controllers\Api\v1\ApiController@sports_type');
	Route::post('/v01/live_matches/count/{app_unique_id}', 'App\Http\Controllers\Api\v1\ApiController@live_matches_count');
	
	//--------v2 Apis--------
	Route::post('/v2/settings', 'App\Http\Controllers\Api\v1\ApiController@settings_v2');
	Route::post('/v2/live_matches', 'App\Http\Controllers\Api\v1\ApiController@live_matches_v2');
	Route::post('/v2/streaming_sources', 'App\Http\Controllers\Api\v1\ApiController@streaming_sources_v2');
	Route::post('/v2/live_matches_by_type', 'App\Http\Controllers\Api\v1\ApiController@live_matches_by_type_v2');
  
	//-------------------------------------------//
  	//-------------Live Streaming App--------------// 
	Route::post('/v01/bing/sport/matches', 'App\Http\Controllers\Api\v1\FootballApiController@bingsport_matches');
	Route::post('/v01/bing/sport/m3u8', 'App\Http\Controllers\Api\v1\FootballApiController@bingsport_m3u8');
	Route::post('/v01/bing/sport/news', 'App\Http\Controllers\Api\v1\FootballApiController@bingsport_news');
	//-------------Football App Api--------------// 
	//-------------------------------------------//
	Route::post('/v1/football/schedules', 'App\Http\Controllers\Api\v1\FootballApiController@match_schedules');
	Route::post('/v1/football/liveFT/match', 'App\Http\Controllers\Api\v1\FootballApiController@liveAndFtMatch');
  	Route::post('/v1/football/preview', 'App\Http\Controllers\Api\v1\FootballApiController@match_preview');
	Route::post('/v1/football/header', 'App\Http\Controllers\Api\v1\FootballApiController@header');
  	Route::post('/v1/football/lineups', 'App\Http\Controllers\Api\v1\FootballApiController@lineups');
  	Route::post('/v1/football/commentary', 'App\Http\Controllers\Api\v1\FootballApiController@commentary');
  	Route::post('/v1/football/statistics', 'App\Http\Controllers\Api\v1\FootballApiController@statistics');
	Route::post('/v1/football/standing/league', 'App\Http\Controllers\Api\v1\FootballApiController@standingLeague');
	Route::post('/v1/football/standing/year', 'App\Http\Controllers\Api\v1\FootballApiController@standingYear');
	Route::post('/v1/football/standing/details', 'App\Http\Controllers\Api\v1\FootballApiController@standingDetails');
	Route::post('/v1/football/news', 'App\Http\Controllers\Api\v1\FootballApiController@news');
	Route::post('/v1/football/news_details', 'App\Http\Controllers\Api\v1\FootballApiController@newsDetails');
	
	Route::post('/v2/football/liveFT/match', 'App\Http\Controllers\Api\v1\FootballApiController@liveAndFtMatch2');
	
	//--------v2 Apis--------
	Route::post('/v2/football/news', 'App\Http\Controllers\Api\v1\FootballApiController@news_v2');
	
	//-------------------------------------------//
	//-------Cricket App Api upcomingMatch-------//
	//-------------------------------------------//
	Route::post('/v1/cricket/live-match', 'App\Http\Controllers\Api\v1\CricketApiController@liveMatch');
	Route::post('/v1/cricket/today/match', 'App\Http\Controllers\Api\v1\CricketApiController@todayMatch'); //(v02-Api)
	Route::post('/v1/cricket/match/schedule', 'App\Http\Controllers\Api\v1\CricketApiController@upcomin_v2Match'); //(v02-Api)
	Route::post('/v1/cricket/upcoming/match', 'App\Http\Controllers\Api\v1\CricketApiController@upcomingMatch');
	Route::post('/v1/cricket/recent/match', 'App\Http\Controllers\Api\v1\CricketApiController@recentMatch');
	//-------News
	Route::post('/v1/cricket/home-news', 'App\Http\Controllers\Api\v1\CricketApiController@homeNews');
	Route::post('/v1/cricket/all-news', 'App\Http\Controllers\Api\v1\CricketApiController@allNews');
	//-------Point Table
	Route::post('/v1/cricket/point-table', 'App\Http\Controllers\Api\v1\CricketApiController@pointTableList');
	Route::post('/v1/cricket/point-table/details', 'App\Http\Controllers\Api\v1\CricketApiController@pointTableDetails');
	//-------Ai Predictions
	Route::post('/v1/cricket/ai/predictions', 'App\Http\Controllers\Api\v1\CricketApiController@aiPredictions');
	
	//-------New Api-------
	Route::post('/v2/cricket/upcoming/match', 'App\Http\Controllers\Api\v1\CricketApiController@v2UpcomingMatch');
	Route::post('/v2/cricket/live/match', 'App\Http\Controllers\Api\v1\CricketApiController@v2LiveMatch');
	Route::post('/v2/cricket/details/match', 'App\Http\Controllers\Api\v1\CricketApiController@v2MatchDetails');
	
	
	//fixures api
	Route::post('fixtures', 'App\Http\Controllers\Api\v1\ApiController@fixtures');
	Route::post('fixures_by_type', 'App\Http\Controllers\Api\v1\ApiController@fixures_by_type');
	
	//promotion by type
	Route::post('/v2/promotion_by_type', 'App\Http\Controllers\Api\v1\ApiController@promotion_by_type');
});

Route::post('/v1/cricket/today/match/demo', 'App\Http\Controllers\Api\v1\CricketApiController@todayMatch');
Route::post('/v1/cricket/match/schedule/demo', 'App\Http\Controllers\Api\v1\CricketApiController@upcomin_v2Match');

Route::post('/v1/app/user/ip', 'App\Http\Controllers\Api\v1\CricketApiController@userIp');
//Test Apis
Route::post('/v1/cricket/manage/app1', 'App\Http\Controllers\Api\v1\CricketApiController@rexApp01');
