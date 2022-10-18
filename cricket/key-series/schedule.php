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
                    echo '{"Error":"Somthing is worng?"}';
                }
            break;
        default:
                echo '{"Error":"Somthing is worng?"}';
            break;
    }
    
    function postRequestCapture($data){
        
        $url = $data["url"];
        $html = file_get_html($url);
    
        $liveMatchs = $html->find('.col-sm-24');
    
        $test_array = array();
        $rexImage1 = "";
        $rexImage2 = "";
    
        foreach($liveMatchs as $article) {
    
            foreach ($article->find('.match-row') as $value) {
                
                $statuse = $value->find('.status', 0);
                $status = $statuse->innertext;
        
                $days = $value->find('.day', 0);
                $day = $days->innertext;
        
                $vanues = $value->find('.title', 0);
                $vanue = $vanues->innertext;
        
                $subtitles = $value->find('.subtitle', 0);
                $subtitle = $subtitles->innertext;
        
                $titles = $value->find('.title', 1);
                $title = $titles->innertext;
        
                $times = $value->find('.time', 0);
                $time = $times->innertext;
        
                $localTimes = $value->find('.localTime', 0);
                $localTime = $localTimes->innertext;
        
                $startAts = $value->find('.time', 1);
                $startat = $startAts->innertext;
        
                if(($value->find('.teamLogo', 0))) {
                    $images = $value->find('.teamLogo', 0);
                    $image1 = $images->innertext;
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image1, $image421);
                    $testRexUrl1 = $image421['src'];
                    $rexImage1 = $testRexUrl1;
                } else{
                    $rexImage1 = "isEmpty";
                }
        
                $teamNames = $value->find('.teamName', 0);
                $teamName1 = $teamNames->innertext;
                
                if(($value->find('.teamLogo', 1))) {
                    $imagesg = $value->find('.teamLogo', 1);
                    $image2 = $imagesg->innertext;
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $image2, $image422);
                    $testRexUrl2 = $image422['src'];
                    $rexImage2 = $testRexUrl2;
                } else{
                    $rexImage2 = "isEmpty";
                }
                
                $teamNamess = $value->find('.teamName', 1);
                $teamName2 = $teamNamess->innertext;
        
                $status_notes = $value->find('.status_note', 1);
                $status_note = $status_notes->innertext;
        
                if (hpt($status) == "Scheduled" || hpt($status) == "Live") {
					if ($teamName1 != "TBA") {
						$test_array[] = array('status' => $status, 'day' => $day, 'vanue' => hpt($vanue), 'subtitle' => $subtitle, 'series_name' => hpt($title), 'time' => $time, 'localTime' => $localTime, 'startat' => $startat, 'image1' => $rexImage1, 'teamName1' => hpt($teamName1), 'image2' => $rexImage2, 'teamName2' => hpt($teamName2));
					}
                }
        
              }
    
        }
          
        $object = array('upcoming'=>$test_array);
        echo json_encode($object);
        
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

