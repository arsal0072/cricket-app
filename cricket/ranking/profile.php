<?php
    include_once 'rex_tools.php';
    
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
        
        $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
            )
        );
        
        $html = file_get_html($url, false, $context);

        $personalInfo_array = array();
        $icc_array = array();
        $profile_array = array();
        $bat_car_array = array();
        $bow_car_array = array();

        $mHtml = $html->find('.cb-hm-rght');

        $battingCareer = $html->getElementsByTagName('tbody', 0);
        $bowlingCareer = $html->getElementsByTagName('tbody', 1);

        foreach($mHtml as $article) {

            //========= Personal Infromaton =========
            if ($article->find('.cb-col-60', 0)) {
                $born = $article->find('.cb-col-60', 0)->innertext;
            } else {
                $born = "";
            }

            if ($article->find('.cb-col-60', 1)) {
                $birth_place = $article->find('.cb-col-60', 1)->innertext;
            } else {
                $birth_place = "";
            }

            if ($article->find('.cb-col-60', 2)) {
                $height = $article->find('.cb-col-60', 2)->innertext;
            } else {
                $height = "";
            }

            if ($article->find('.cb-col-60', 3)) {
                $role = $article->find('.cb-col-60', 3)->innertext;
            } else {
                $role = "";
            }

            if ($article->find('.cb-col-60', 4)) {
                $batting_style = $article->find('.cb-col-60', 4)->innertext;
            } else {
                $batting_style = "";
            }

            if ($article->find('.cb-col-60', 5)) {
                $bow_style = $article->find('.cb-col-60', 5)->innertext;
            } else {
                $bow_style = "";
            }

            if ($article->find('.cb-col-60', 6)) {
                $team = $article->find('.cb-col-60', 6)->innertext;
            } else {
                $team = "";
            }

            if ($born != '' && $batting_style != '') {

                if (strlen($bow_style) <= 24) {
                    $bowing_style = $bow_style;
                } else {
                    $bowing_style = "--";
                    if ($team == "") {
                        $team = $bow_style;
                    }
                }

                $personalInfo_array[] = array('born'=>$born, 'birth_place'=>$birth_place, 'height'=>$height, 'role'=>$role, 'batting_style'=>$batting_style, 'bowing_style'=>$bowing_style, 'team'=>$team);
            }

            //============= ICC Ranking =============//
            $icc_bat_rank_tests = $article->find('.cb-plyr-rank', 4);
            $icc_bat_rank_test = $icc_bat_rank_tests->innertext;

            $icc_bat_rank_odis = $article->find('.cb-plyr-rank', 5);
            $icc_bat_rank_odi = $icc_bat_rank_odis->innertext;

            $icc_bat_rank_t20s = $article->find('.cb-plyr-rank', 6);
            $icc_bat_rank_t20 = $icc_bat_rank_t20s->innertext;

            $icc_bow_rank_tests = $article->find('.cb-plyr-rank', 8);
            $icc_bow_rank_test = $icc_bow_rank_tests->innertext;

            $icc_bow_rank_odis = $article->find('.cb-plyr-rank', 9);
            $icc_bow_rank_odi = $icc_bow_rank_odis->innertext;

            $icc_bow_rank_t20s = $article->find('.cb-plyr-rank', 10);
            $icc_bow_rank_t20 = $icc_bow_rank_t20s->innertext;

            $type = 'Test, ODI, T20';

            if ($icc_bat_rank_tests != '') {
                $icc_array[] = array('rank_type'=>$type, 'icc_bat_rank_test'=>$icc_bat_rank_test, 'icc_bat_rank_odi'=>$icc_bat_rank_odi, 'icc_bat_rank_t20'=>$icc_bat_rank_t20, 'icc_bow_rank_test'=>$icc_bow_rank_test, 'icc_bow_rank_odi'=>$icc_bow_rank_odi, 'icc_bow_rank_t20'=>$icc_bow_rank_t20);
            }

            //============= Full Profile =============//
            $full_profiles = $article->find('.cb-player-bio', 0);
            $full_profile = $full_profiles->innertext;
            if ($full_profile != '') {
                $profile_array[] = array('full_profile'=>hpt($full_profile));
            }

        }

        if ($battingCareer != '') {
            foreach($battingCareer->find('tr') as $batCar) {
                $types = $batCar->find('td strong', 0);
                $type = $types->innertext;

                $ms = $batCar->find('td', 1);
                $m = $ms->innertext;

                $inns = $batCar->find('td', 2);
                $inn = $inns->innertext;

                $nos = $batCar->find('td', 3);
                $no = $nos->innertext;

                $runss = $batCar->find('td', 4);
                $runs = $runss->innertext;

                $hss = $batCar->find('td', 5);
                $hs = $hss->innertext;

                $avgs = $batCar->find('td', 6);
                $avg = $avgs->innertext;

                $bfs = $batCar->find('td', 7);
                $bf = $bfs->innertext;

                $srs = $batCar->find('td', 8);
                $sr = $srs->innertext;

                $hundreds = $batCar->find('td', 9);
                $hundred = $hundreds->innertext;

                $twoHundreds = $batCar->find('td', 10);
                $twoHundred = $twoHundreds->innertext;

                $fivteens = $batCar->find('td', 11);
                $fivteen = $fivteens->innertext;

                $fours = $batCar->find('td', 12);
                $four = $fours->innertext;

                $sixs = $batCar->find('td', 13);
                $six = $sixs->innertext;

                if ($type != '') {
                    $bat_car_array[] = array('type'=>$type, 'M'=>$m, 'Inn'=>$inn, 'NO'=>$no, 'Runs'=>$runs, 'HS'=>$hs, 
                        'Avg'=>$avg, 'BF'=>$bf, 'SR'=>$sr, '100'=>$hundred, '200'=>$twoHundred, '50'=>$fivteen, '4s'=>$four, '6s'=>$six);
                }

            }
        }


       if ($bowlingCareer != '') {
        foreach($bowlingCareer->find('tr') as $bowCar) {
            $types = $bowCar->find('td strong', 0);
            $type = $types->innertext;

            $ms = $bowCar->find('td', 1);
            $m = $ms->innertext;

            $inns = $bowCar->find('td', 2);
            $inn = $inns->innertext;

            $bs = $bowCar->find('td', 3);
            $b = $bs->innertext;

            $runss = $bowCar->find('td', 4);
            $runs = $runss->innertext;

            $wktss = $bowCar->find('td', 5);
            $wkts = $wktss->innertext;

            $bbis = $bowCar->find('td', 6);
            $bbi = $bbis->innertext;

            $bbms = $bowCar->find('td', 7);
            $bbm = $bbms->innertext;

            $econs = $bowCar->find('td', 8);
            $econ = $econs->innertext;

            $avgs = $bowCar->find('td', 9);
            $avg = $avgs->innertext;

            $srs = $bowCar->find('td', 10);
            $sr = $srs->innertext;

            $fiveWs = $bowCar->find('td', 11);
            $fiveW = $fiveWs->innertext;

            $tenWs = $bowCar->find('td', 12);
            $tenW = $tenWs->innertext;

            if ($type != '') {
                $bow_car_array[] = array('type'=>$type, 'M'=>$m, 'Inn'=>$inn, 'B'=>$b, 'Runs'=>$runs, 'Wkts'=>$wkts, 
                    'BBI'=>$bbi, 'BBM'=>$bbm, 'Econ'=>$econ, 'Avg'=>$avg, 'SR'=>$sr, '5W'=>$fiveW, '10W'=>$tenW);
            }

         }
       }


        $object = array('personal-info'=>$personalInfo_array, 'icc-rank'=>$icc_array, 'full-profile'=>$profile_array, 'bat-career'=>$bat_car_array, 'bow-career'=>$bow_car_array);
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

