<?php
    include_once 'rex_scraping.php';
    
    header('content-type: application/json');
    $request = $_SERVER['REQUEST_METHOD'];

    switch ($request) {
        case 'POST':
                $data=json_decode(file_get_contents('php://input'), true);
			    if($data["api_key"] == "7f581f7766bb683c1e785253fc75395a4245fe94f003f5318665b73c8d021424"){
                    postmethod($data);
                } else {
                    echo '{"Error":"Somthing is worng?"}';
                }
            break;
        default:
                echo '{"Error":"Somthing is worng?"}';
            break;
    }

    function postmethod($data){

        $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
            )
        );

        $url = $data["url"];
        $html = file_get_html($url, false, $context);

        $dtls_array = array();
        $htmlfindValue= "";
        $bigImg= "";
        
        $bigImage = $html->find('.horizontal-img-container');
        foreach($bigImage as $imageShow) {
            $images = $imageShow->find('img', 0);
            $image = $images->src;
            $bigImg = "https://www.cricbuzz.com".$image;
        }
        $detsils_news = $html->find('.cb-nws-dtl-itms');
        if (count($detsils_news) > 1){
            $htmlfindValue = $detsils_news;
        }else{
            $detsils_news2 = $html->find('.cb-spt-news-dtl-itms');
            $htmlfindValue = $detsils_news2;
        }
        foreach($htmlfindValue as $article) {
            foreach($article->find('p') as $p){
                $mamun = $p . '<p>';
                $dtls_array[] = array('desc' => hpt(trim($mamun)));
            }
        }
        
        $object = array('big-image'=>$bigImg,'details'=>$dtls_array);
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

