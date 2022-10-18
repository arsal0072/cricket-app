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

        $teamOneHeading = $html->find('.inning-heading', 0);
        $battingHtml1 = $html->getElementsByTagName('tbody', 0);
        $bowlingHtml1 = $html->getElementsByTagName('tbody', 1);

        $teamTwoHeading = $html->find('.inning-heading', 1);
        $battingHtml2 = $html->getElementsByTagName('tbody', 2);
        $bowlingHtml2 = $html->getElementsByTagName('tbody', 3);

        $header_t1 = array();
        $batting_t1 = array();
        $extra_t1 = array();
        $bowling_t1 = array();

        $header_t2 = array();
        $batting_t2 = array();
        $extra_t2 = array();
        $bowling_t2 = array();

        $teamOneFullName = "";
        $teamOneShortName = "";
        $teamOneScore = "";

        $teamTwoFullName = "";
        $teamTwoShortName = "";
        $teamTwoScore = "";

        $fallofwktsTwo = "";

        if ($teamOneHeading != "") {
            //========Team One Heading========
            if ($teamOneHeading->find('.hide-mobile', 0) != "") {
                 $fNames1 = $teamOneHeading->find('.hide-mobile', 0);
                 $teamOneFullName = $fNames1->innertext;
            }
           
            if ($teamOneHeading->find('.hide-desktop', 0) != "") {
                $sNames1 = $teamOneHeading->find('.hide-desktop', 0);
                $teamOneShortName = $sNames1->innertext;
            }

            if ($teamOneHeading->find('.scores_full', 0) != "") {
                $scoreFulls1 = $teamOneHeading->find('.scores_full', 0);
                $teamOneScore = $scoreFulls1->innertext;
            }

            foreach($battingHtml1->find('.row-batsman') as $article) {

                $players = $article->find('td', 0);
                $playerName = $players->innertext;

                $how_outs = $article->find('td', 1);
                $how_out = $how_outs->innertext;

                $runs = $article->find('td', 2);
                $run = $runs->innertext;

                $balls = $article->find('td', 3);
                $ball = $balls->innertext;

                $fourS = $article->find('td', 4);
                $four = $fourS->innertext;

                $sixS = $article->find('td', 5);
                $six = $sixS->innertext;

                $srs = $article->find('td', 6);
                $sr = $srs->innertext;

                $batting_t1[] = array('playerName' => strip_tags($playerName), 'how_out' => $how_out, 'r' => $run, 'b' => $ball, '4s' => $four, '6s' => $six, 'sr' => $sr);
                
            }

            foreach($battingHtml1->find('._row') as $articles) {

                $namesext = $articles->find('td', 0);
                $nameext = $namesext->innertext;

                $taotals = $articles->find('td', 1);
                $totals = $taotals->innertext;

                $extra_t1[] = array($nameext => $totals);
                
            }

            foreach($bowlingHtml1->find('._row') as $articlef) {

                $players = $articlef->find('td', 0);
                $playerName = $players->innertext;

                $overs = $articlef->find('td', 1);
                $over = $overs->innertext;

                $mats = $articlef->find('td', 2);
                $mat = $mats->innertext;

                $runs = $articlef->find('td', 3);
                $run = $runs->innertext;

                $wekts = $articlef->find('td', 4);
                $wekt = $wekts->innertext;

                $econs = $articlef->find('td', 5);
                $econ = $econs->innertext;

                $bowling_t1[] = array('playerName' => strip_tags($playerName), 'o' => $over, 'm' => $mat, 'r' => $run, 'w' => $wekt, 'econ' => $econ);
                
            }

            if ($html->find('.fows', 0) != "") {
                $fallOfWkt1 = $html->find('.fows', 0);
                $fallofwktsOne = $fallOfWkt1->innertext;
            }

        }

        if ($teamTwoHeading != "") {
            //========Team Two Heading========
            
            if ($teamTwoHeading->find('.hide-mobile', 0) != "") {
                $fullNames2 = $teamTwoHeading->find('.hide-mobile', 0);
                $teamTwoFullName = $fullNames2->innertext;
            }
           
            if ($teamTwoHeading->find('.hide-desktop', 0) != "") {
                $sNames2 = $teamTwoHeading->find('.hide-desktop', 0);
                $teamTwoShortName = $sNames2->innertext;
            }

            if ($teamTwoHeading->find('.scores_full', 0) != "") {
                $scoreFulls2 = $teamTwoHeading->find('.scores_full', 0);
                $teamTwoScore = $scoreFulls2->innertext;
            }

            foreach($battingHtml2->find('.row-batsman') as $article) {

                $players = $article->find('td', 0);
                $playerName = $players->innertext;

                $how_outs = $article->find('td', 1);
                $how_out = $how_outs->innertext;

                $runs = $article->find('td', 2);
                $run = $runs->innertext;

                $balls = $article->find('td', 3);
                $ball = $balls->innertext;

                $fourS = $article->find('td', 4);
                $four = $fourS->innertext;

                $sixS = $article->find('td', 5);
                $six = $sixS->innertext;

                $srs = $article->find('td', 6);
                $sr = $srs->innertext;

                $batting_t2[] = array('playerName' => strip_tags($playerName), 'how_out' => $how_out, 'r' => $run, 'b' => $ball, '4s' => $four, '6s' => $six, 'sr' => $sr);
                
            }

            foreach($battingHtml2->find('._row') as $articlesk) {

                $namesext = $articlesk->find('td', 0);
                $nameexts = $namesext->innertext;

                $taotals = $articlesk->find('td', 1);
                $totalss = $taotals->innertext;

                $extra_t2[] = array($nameexts => $totalss);
                
            }

            foreach($bowlingHtml2->find('._row') as $articlefs) {

                $players = $articlefs->find('td', 0);
                $playerName = $players->innertext;

                $overs = $articlefs->find('td', 1);
                $over = $overs->innertext;

                $mats = $articlefs->find('td', 2);
                $mat = $mats->innertext;

                $runs = $articlefs->find('td', 3);
                $run = $runs->innertext;

                $wekts = $articlefs->find('td', 4);
                $wekt = $wekts->innertext;

                $econs = $articlefs->find('td', 5);
                $econ = $econs->innertext;

                $bowling_t2[] = array('playerName' => strip_tags($playerName), 'o' => $over, 'm' => $mat, 'r' => $run, 'w' => $wekt, 'econ' => $econ);
                
            }

            if ($html->find('.fows', 1) != "") {
                $fallOfWkt2 = $html->find('.fows', 1);
                $fallofwktsTwo = $fallOfWkt2->innertext;
            }

        }

        $object = array('team_one_fn'=>$teamOneFullName, 'team_one_sn'=>$teamOneShortName, 'team_one_score'=>$teamOneScore, 'batting_t1'=>$batting_t1, 'extra_t1'=>$extra_t1, 'bowling_t1'=>$bowling_t1, 'Fall-of-wickets-1'=>strip_tags($fallofwktsOne), 'team_two_fn'=>$teamTwoFullName, 'team_two_sn'=>$teamTwoShortName, 'team_two_score'=>$teamTwoScore, 'batting_t2'=>$batting_t2, 'extra_t2'=>$extra_t2, 'bowling_t2'=>$bowling_t2, 'fallofwktsTwo'=>strip_tags($fallofwktsTwo));
        echo json_encode($object);

    }
          
?>








