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
 
        $html = file_get_html('https://www.cricbuzz.com/cricket-stats/icc-rankings/women/teams', false, $context);
        $test_array = array();
        $index_array = array();
        $img2="";
        $index = 1;
        $mHtml = $html->find('.cb-plyr-tbody');
        foreach($mHtml as $article) {
            foreach ($article->find('.cb-brdr-thin-btm') as $value) {
                $ids = $value->find('.cb-lst-itm-sm', 0);
                $id = $ids->innertext;

                $teamss = $value->find('.cb-lst-itm-sm', 1);
                $team = $teamss->innertext;

                $ratings = $value->find('.cb-lst-itm-sm', 2);
                $rating = $ratings->innertext;

                $points = $value->find('.cb-lst-itm-sm', 3);
                $point = $points->innertext;

                $m_index2 = (string) $index;
                if ($id=='1') {
                    $index_array[] = array('id'=>$id, 'serial_id'=>$m_index2);
                }
                $test_array[] = array('serial_id' => $m_index2, 'id' => $id, 'team' => $team, 'rating' => $rating, 'point' => $point);
                $index++;
            }
        }
        $object = array('index'=>$index_array, 'teams'=>$test_array);
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

