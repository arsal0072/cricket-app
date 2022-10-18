<?php

    include_once 'rex_tools.php';

    $request = $_SERVER['REQUEST_METHOD'];
    switch ($request) {
        case 'GET':
                if (urldecode($_GET["url"]) != "") {
                    $urls = urldecode($_GET["url"]);
                    postRequestCapture($urls);
                } else {
                    echo '{"Error":"Somthing is worng?"}';
                }
            break;
        default:
                echo '{"Error":"Somthing is worng?"}';
            break;
    }
    
   function postRequestCapture($urls){

        $html = file_get_html($urls);
        $json_array = array();

        foreach($html->find('.site-content') as $article) {
            foreach($article->find('.content-editor') as $p){
                $response = '<head><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>' . $p;
				$response2 = str_replace("<p>", "<p style='text-align: justify; color:#12002C; font-size: 14px;'>", $response);
                echo str_replace("<h2>", "<h4 style='text-align: center;'>", $response2);
            }
        }
        
   }

?>