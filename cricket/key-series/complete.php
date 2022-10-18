<?php
    include_once 'rex_tools.php';
    
    header('content-type: application/json');
    $request = $_SERVER['REQUEST_METHOD'];



    switch ($request) {
        case 'POST':
                $data=json_decode(file_get_contents('php://input'), true);
                if($data["api_key"] == "7f581f7766bb683c1e785253fc75395a4245fe94f003f5318665b73c8d021424"){
                    postRequestCapture($data);
                } else {
                    echo '{"Error":"Somthing is worng1?"}';
                }
            break;
        default:
                echo '{"Error":"Somthing is worng2?"}';
            break;
    }
    
    function postRequestCapture($data){
        
        $url = $data["url"];
        $html = file_get_html($url);

        $liveMatchs = $html->find('.matches-table');
        
        $score_array = array();
        $t1ScoreArray = array();
        $t2ScoreArray = array();
        $odds_array = array();

        $t1Img = "";
        $t2Img = "";

        $m1Scr = "";
        $m1Over = "";
        $m2Scr = "";
        $m2Over = "";
        
        foreach($liveMatchs as $article) {

            if ($article->find('.odds')) {
                $oddsObject = $article->find('.bet-fixture');
            }

            foreach ($article->find('.match-row') as $value) {
        
                $link2 = $value->href;
                $link = "https://www.cricketworld.com".$link2;
        
                $status = $value->find('.status', 0)->innertext;
                $seriesName = $value->find('.title', 1)->innertext;
                $match = $value->find('.subtitle', 0)->innertext;
                $series = $seriesName.', '.$match;
                $timestamp = $value->find('.time', 1)->innertext;
                $vanue = $value->find('.title', 0)->innertext;
        
                //team One
                $image1 = $value->find('.teamLogo', 0)->innertext;
                if ($image1 != "") {
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image1, $image421);
                    $t1Img = $image421['src'];
                } else {
                    $t1Img = "https://www.cricbuzz.com/a/img/v1/72x54/i1/c174284/defult.jpg";
                }
        
                $t1Name = $value->find('.teamName', 0)->innertext;
                $t1Scrs = $value->find('.teamScore', 0)->innertext;

                if(strpos($t1Scrs, "&") !== false){
                    $t1Score = substr($t1Scrs, strpos($t1Scrs, "&") + 1);
                    $m1Scr = trim(strtok($t1Score, "("));
                    $m1Over = trim(substr($t1Score, strpos($t1Score, '(')), "()");
                } else{
                     $t1Score = $t1Scrs;
                     $m1Scr = trim(strtok($t1Score, "("));
                     $m1Over = trim(substr($t1Score, strpos($t1Score, '(')), "()");
                }
        
                //Team Two
                $image2 = $value->find('.teamLogo', 1)->innertext;
                if ($image2 != "") {
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image2, $image422);
                    $t2Img = $image422['src'];
                } else {
                    $t2Img = "https://www.cricbuzz.com/a/img/v1/72x54/i1/c174284/defult.jpg";
                }
        
                $t2Name = $value->find('.teamName', 1)->innertext;
                $t2Scrss = $value->find('.teamScore', 1)->innertext;
                if(strpos($t2Scrss, "&") !== false){
                    $t2Score = substr($t2Scrss, strpos($t2Scrss, "&") + 1);
                    $m2Scr = trim(strtok($t2Score, "("));
                    $m2Over = trim(substr($t2Score, strpos($t2Score, '(')), "()");
                } else{
                     $t2Score = $t2Scrss;
                     $m2Scr = trim(strtok($t2Score, "("));
                     $m2Over = trim(substr($t2Score, strpos($t2Score, '(')), "()");
                }

                $status_note = $value->find('.status_note', 1)->innertext;

                $t1ScrArray = array('t1Name' => hpt($t1Name), 't1Img' => $t1Img, 'score' => hpt($m1Scr), 'over' => hpt($m1Over));
                $t2ScrArray = array('t2Name' => hpt($t2Name), 't2Img' => $t2Img, 'score' => hpt($m2Scr), 'over' => hpt($m2Over));

                if (hpt($status) == "Completed" || hpt($status) == "Cancelled" || hpt($status) == "Postponed") {

                    $score_array[] = array('series' => hpt($series), 'match-id' => $link, 'timestamp' => $timestamp, 'status' => hpt($status), 'vanue' => hpt($vanue), 'note' => hpt($status_note), 't1scr' => $t1ScrArray, 't2scr' => $t2ScrArray);

                }

            }
    
        }
    
         $response = array('score'=>$score_array);
         echo json_encode($response);
        
    }
    
    function hpt($str){
        $str = str_replace('&nbsp;', '', $str);
        $str = str_replace('amp;', '', $str);
        $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
        $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
        $str = html_entity_decode($str);
        $str = htmlspecialchars_decode($str);
        $str = strip_tags($str);
        return $str;
    }

?>

