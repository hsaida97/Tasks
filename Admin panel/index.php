<?php
// require_once './app/Models/User.php';


// $user = (new User())->find(15);
// print_r($user);
// print_r($_SERVER);
// echo basename(__DIR__);


$a = [3362145,3379606,3379621,3379803,3379838,3388212,3388243,3388257,3388279,3388362,3388387,3388450,3388474,3388653,3388664,3389173,3389215,3389222,3389258,3389333,3389365,3389727,3393133,3393140,3393154,3393211,3393212,3393214,3393309,3393347,3393403,3393449,3393462,3393479,3393504,3393536,3393560,3393602,3393613,3393729,3393814,3393818,3393819,3393826,3393832,3393844,3393867,3393870,3393896,3393897,3401184,3401227,3401274,3401301,3401373,3401466,3401505,3401545,3401574,3401575,3401582,3401594,3401598,3401612,3401637,3401640,3401649,3401656,3401670,3401692,3401717,3401748,3401761,3401798,3401807,3401829,3401891,3403038,3403360,3403381,3403551,3403835,3403836,3403845,3403847,3403869,3403881,3403885,3403896,3403908,3403911,3403943,3403954,3403967,3403981,3403993,3403998,3404001,3404066,3404068];

$b = [3388212,3388232,3388257,3388279,3388387,3388450,3388653,3388664,3389173,3389215,3389222,3389365,3389727,3393007,3393140,3393165,3393212,3393214,3393309,3393449,3393462,3393479,3393602,3393613,3393729,3393776,3393783,3393819,3393826,3393832,3393844,3393896,3393897,3401184,3401227,3401274,3401373,3401505,3401545,3401574,3401575,3401582,3401598,3401612,3401640,3401692,3401717,3401798,3401807,3403038,3403360,3403381,3403835,3403836,3403845,3403847,3403896,3403908,3403943,3403954,3403967,3403998,3388362,3388474,3393154,3393211,3393332,3393536,3393814,3393818,3393867,3393870,3401301,3401594,3401649,3401656,3401670,3401748,3401761,3401829,3401891,3403869,3403981,3404068];

$d =[];
foreach($b as $kk){
    if(!in_array($kk,$a)){
        $d[]=$kk;
    }
}


print_r($d);
