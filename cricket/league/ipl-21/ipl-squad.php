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
        
        $mUrl = $data["url"];

        $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
            )
        );

        $iplNews = file_get_html($mUrl, false, $context);

        $img2 = "";
        $retained = "";
        $base_url = "https://www.cricbuzz.com";
        $team_squard_array = array();
        $mHtml = $iplNews->find('.cb-schdl');
        
        foreach($mHtml as $article) {
    
            foreach ($article->find('.cb-schdl') as $value) {

                $images = $value->find('img', 0);
                $image = $images->src;
                $img2=$image;
                if ($image=='') {
                    $images1 = $value->find('img', 0);
                    $image1 = $images1->source;
                    $img2=$image1;
                }
    
                $player_name = trim($value->find('.cb-font-18', 0)->innertext);
                $player_country = trim($value->find('.cb-font-12', 0)->innertext);

                if ($value->find('.bg-rtm')) {
                    $retained = trim($value->find('.bg-rtm', 0)->innertext);
                } else {
                    $retained = "";
                }

                $best_price = trim($value->find('.cb-col-20', 1)->innertext);
                $final_price = trim($value->find('.cb-col-20', 2)->innertext);


    
                $team_squard_array[] = array('image' => $base_url.$img2, 'p_name' => hpt($player_name), 'p_country' => hpt($player_country), 'retained' => $retained, 'best_price' => hpt($best_price), 'final_price' => hpt($final_price)); 
                
            }
        }
    
        $response['squard'] = $team_squard_array;
        echo json_encode($response);

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

