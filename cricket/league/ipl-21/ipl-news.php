<?php

    include_once 'rex_tools.php';

    header('content-type: application/json');
    $request = $_SERVER['REQUEST_METHOD'];

    switch ($request) {
        case 'POST':
        $data=json_decode(file_get_contents('php://input'), true);
        if($data["api_key"] == "7f581f7766bb683c1e785253fc75395a4245fe94f003f5318665b73c8d021424"){
            postRequestCapture();
        } else {
            echo '{"Error":"Somthing is worng?"}';
        }
        break;
        default:
        echo '{"Error":"Somthing is worng?"}';
        break;
    }

    function postRequestCapture(){
        
        $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
            )
        );

        $iplNews = file_get_html("https://www.cricbuzz.com/cricket-series/3472/indian-premier-league-2021/news", false, $context);

        $imgs="";
        $team_news_array = array();
    
        $mHtml = $iplNews->find('div[id="series-news-list"]');
        
        foreach($mHtml as $article) {
    
            foreach ($article->find('.cb-lst-itm') as $value) {
    
                $images = $value->find('img', 0);
                $image = $images->src;
                $imgs=$image;
                if ($image=='') {
                  $images1 = $value->find('img', 0);
                  $image1 = $images1->source;
                  $imgs=$image1;
                }
    
                $titles = $value->find('h2 a', 0);
                $title = $titles->innertext;
    
                $links = $value->find('h2 a', 0);
                $link = $links->href;
    
                $descs = $value->find('.cb-nws-intr', 0);
                $desc = $descs->innertext;
    
                $times = $value->find('.cb-nws-time', 0);
                $time = $times->innertext;
				
				$coverImg = str_replace("205x152", "400x260", $imgs);
    
                $team_news_array[] = array('image' => "https://www.cricbuzz.com".$coverImg, 'title' => $title, 'link' => "https://www.cricbuzz.com".$link, 'desc' => $desc, 'time' => $time); 
                
            }
        }
    
        $response['News'] = $team_news_array;
        echo json_encode($response);

    }

?>

