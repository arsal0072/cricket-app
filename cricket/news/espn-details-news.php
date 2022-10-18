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

        $url = $data["url"];
        $html = file_get_html($url);

        $mHtml1 = $html->find('.page-story-content');
		$mHtml2 = $html->find('.match-story-content');
		
        $json_array = array();
		$title = '';

        if ($html->find('.page-story-content')) {
			
			foreach($mHtml1 as $article) { 

                $title = $article->find('.article-header h1', 0)->innertext ?? '';

                foreach($article->find('.article-body p') as $p){
                    $mamun = $p->innertext . '<br>' ?? '';
                    $json_array[] = array('desc' => trim(hpt($mamun)));
                }
            }

            $object = array('title'=>hpt($title), 'details'=>$json_array);
            echo json_encode($object);
			
		} else if ($html->find('.match-story-content')) {
			foreach($mHtml2 as $article) { 

                $title = $article->find('.article-header h1', 0)->innertext ?? '';

                foreach($article->find('.article-body p') as $p){
                    $mamun = $p->innertext . '<br>' ?? '';
                    $json_array[] = array('desc' => trim(hpt($mamun)));
                }
            }

            $object = array('title'=>hpt($title), 'details'=>$json_array);
            echo json_encode($object);
		}
		
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