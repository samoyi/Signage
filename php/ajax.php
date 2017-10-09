<?php

    header('Access-Control-Allow-Origin: *');

    require_once('Signage.class.php');
    $signage = new Signage();


    if( isset($_GET['act']) && $_GET['act']==='info' && isset($_GET['brand']) ){
        $sBrand = $_GET['brand'];
        if( !empty($sBrand) ){
            $aSignage = $signage->getSignageInfo($sBrand);
            // file_put_contents('err.txt', json_encode($aSignage));
            echo json_encode($aSignage);
        }
    }

?>
