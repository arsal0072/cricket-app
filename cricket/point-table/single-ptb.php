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

        $mUrls = $data["url"];
        $mValue = $data["count"];
        
        $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
            )
        );

        $pointstable = file_get_html($mUrls, false, $context);

        $singleArray = array();
        $count = $mValue;

        $ptvListHtml = $pointstable->find('tbody', $count);

        foreach ($ptvListHtml->find('tr') as $value) {

            $teamNames = $value->find('.cb-srs-pnts-name a', 0);
            $teamName = $teamNames->innertext;

            $mats = $value->find('.cb-srs-pnts-td', 0);
            $mat = $mats->innertext;

            $wons = $value->find('.cb-srs-pnts-td', 1);
            $won = $wons->innertext;

            $losts = $value->find('.cb-srs-pnts-td', 2);
            $lost = $losts->innertext;

            $tieds = $value->find('.cb-srs-pnts-td', 3);
            $tied = $tieds->innertext;

            $nrs = $value->find('.cb-srs-pnts-td', 4);
            $nr = $nrs->innertext;

            $ptss = $value->find('.cb-srs-pnts-td', 5);
            $pts = $ptss->innertext;

            $nnrs = $value->find('.cb-srs-pnts-td', 6);
            $nnr = $nnrs->innertext;

            if ($teamName != "") {
                $singleArray[] = array('teamName' => $teamName, 'mat' => $mat, 'won' => $won, 'lost' => $lost, 'tied' => $tied, 'nr' => $nr, 'pts' => $pts, 'nnr' => $nnr);
            }

        }

        $object = array('single'=>$singleArray);
        echo json_encode($object);

    }

?>

