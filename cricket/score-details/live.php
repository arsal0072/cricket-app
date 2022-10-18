<?php

    include('rex_tools.php');

    header('content-type: application/json');
    $request = $_SERVER['REQUEST_METHOD'];

    switch ($request) {
        case 'POST':
                $data=json_decode(file_get_contents('php://input'), true);
                if($data["api_key"] == "7f581f7766bb683c1e785253fc75395a4245fe94f003f5318665b73c8d021424"){
                   postmethod($data);
                } else {
                    echo '{"Error":"Somthing is worng?2"}';
                }
            break;
        default:
                echo '{"Error":"Somthing is worng?1"}';
            break;
    }

    function postmethod($data){

        $url = $data["url"];

        $html = file_get_html($url);

        $livescores = $html->find('.container');
        $battings = $html->find('.battings');
        $bowlings = $html->find('.bowlings');
        $recent = $html->find('.live-info4');
        $commentaries = $html->find('.commentaries');

        $match_info = array();
        $rexImage1 = "";
        $rexImage2 = "";

        $batting_info = array();
        $bowlings_info = array();
        $basic_info = array();
        $recent_info = array();
        $commentaries_info = array();
        $matchDtls_info = array();

        foreach($livescores as $article) {

            foreach ($article->find('.match-header') as $value) {

                $titles = $value->find('.title', 0);
                $title = $titles->innertext;

                $statuss = $value->find('.status', 0);
                $status = $statuss->innertext;
                
                $seriesNames = $value->find('a', 0);
                $seriesName = $seriesNames->innertext;
                
                //team One
                $images = $value->find('.teamLogo', 0);
                $image1 = $images->innertext;
                if ($image1 != "") {
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image1, $image421);
                    $rexImage1 = $image421['src'];
                } else {
                    $rexImage1 = "Not Image";
                }

                $teamNames = $value->find('.teamName', 0);
                $teamName1 = $teamNames->innertext;

                $teamAbbrs = $value->find('.teamAbbr', 0);
                $shortName1 = $teamAbbrs->innertext;

                $teamScores = $value->find('.teamScore', 0);
                $teamScore1 = $teamScores->innertext;

                //Team Two
                $imagesg = $value->find('.teamLogo', 1);
                $image2 = $imagesg->innertext;
                    if ($image2 != "") {
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image2, $image422);
                    $rexImage2 = $image422['src'];
                } else {
                    $rexImage2 = "Not Image";
                }

                $teamNamess = $value->find('.teamName', 1);
                $teamName2 = $teamNamess->innertext;

                $teamAbbrss = $value->find('.teamAbbr', 1);
                $shortName2 = $teamAbbrss->innertext;

                $teamScoress = $value->find('.teamScore', 1);
                $teamScore2 = $teamScoress->innertext;

                $status_notes = $value->find('.status_note', 0);
                $status_note = $status_notes->innertext;


                $match_info = array('title' => hpt($title),'status' => hpt($status), 'seriesName' => hpt($seriesName), 'image1' => $rexImage1, 'teamName1' => hpt($teamName1), 'shortName1' => hpt($shortName1), 'teamScore1' => hpt($teamScore1), 'image2' => $rexImage2, 'teamName2' => hpt($teamName2), 'shortName2' => hpt($shortName2), 'teamScore2' => hpt($teamScore2), 'status_note' => hpt($status_note));

            }

        }
            
        //===========Batting Data============
        foreach($battings as $articleBtn) {

            foreach ($articleBtn->find('._row') as $value) {
                
                $playerNames = $value->find('.col-player', 0);
                $playerName = $playerNames->innertext;

                $runs = $value->find('.col-runs', 0);
                $run = $runs->innertext;

                $ballsFaceds = $value->find('.col-balls_faced', 0);
                $ballsFaced = $ballsFaceds->innertext;

                $fours = $value->find('.col-fours', 0);
                $four = $fours->innertext;

                $sixes = $value->find('.col-sixes', 0);
                $sixe = $sixes->innertext;

                $strike_rates = $value->find('.col-strike_rate', 0);
                $strikerate = $strike_rates->innertext;

                $batting_info[] = array('batsmen' => hpt($playerName),'r' => $run, 'b' => $ballsFaced, '4s' => $four, '6s' => $sixe, 'sr' => $strikerate);
                
            }

        }


               //===========Batting Data============
            foreach($bowlings as $articleBtns) {

                foreach ($articleBtns->find('tr') as $value) {

                    $playerNames = $value->find('td', 0);
                    $playerName = $playerNames->innertext;

                    $overss = $value->find('td', 1);
                    $overs = $overss->innertext;

                    $maidens = $value->find('td', 2);
                    $maiden = $maidens->innertext;

                    $runss = $value->find('td', 3);
                    $runs = $runss->innertext;

                    $wicketss = $value->find('td', 4);
                    $wickets = $wicketss->innertext;

                    $strikerates = $value->find('td', 5);
                    $strikerate = $strikerates->innertext;


                    if ($playerName != "") {
                        $bowlings_info[] = array('bowlerName'  => hpt($playerName), 'o' => $overs, 'm' => $maiden, 'r' => $runs, 'w' => $wickets, 'econ' => $strikerate);
                    }
                    
                }

            }

            $current_ptnrships = $html->find('.live-info3', 0);
            $current_ptnrship = $current_ptnrships->innertext;
            $crrss = $html->find('.live-info3', 1);
            $crrs = $crrss->innertext;
            
            $basic_info = array('current_partnership'  => $current_ptnrship, 'crr' => $crrs);


            foreach($recent as $articleRecent) {

                foreach ($articleRecent->find('span') as $value) {

                    $recent = $value->innertext;

                    $recent_info[] = array('rcnt' => $recent);
                    
                }

            }

            foreach($commentaries as $articCommentaries) {

                foreach ($articCommentaries->find('.comment-ball') as $value) {

                    $scores = $value->find('.floatleft', 0);
                    $score = $scores->innertext;

                    $ovbs = $value->find('.ovb', 0);
                    $ovb = $ovbs->innertext;

                    $texts = $value->find('.text', 0);
                    $text = $texts->innertext;
                    
                    $commentaries_info[] = array('score'  => $score, 'ovb' => $ovb, 'text' => $text);
                    
                }

            }

            $venues = $html->find('.venue', 0);
            $venue = $venues->innertext;
            $tosss = $html->find('.toss', 0);
            $toss = $tosss->innertext;

            $matchDtls_info = array('venue' => $venue, 'toss' => $toss);

        $object = array('scorecard'=>$match_info, 'batting'=>$batting_info, 'bowlerling'=>$bowlings_info, 'basic_info'=>$basic_info, 'recent_info'=>$recent_info, 'commentaries_info'=>$commentaries_info, 'matchDtls_info'=>$matchDtls_info);
        echo json_encode($object);
        
    }
    
    function hpt($str){
        $str = str_replace('&nbsp;', ' ', $str);
        $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
        $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
        $str = html_entity_decode($str);
        $str = htmlspecialchars_decode($str);
        $str = strip_tags($str);
        return $str;
    }

?>