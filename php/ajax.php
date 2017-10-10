<?php

    header('Access-Control-Allow-Origin: *');

    require_once('Signage.class.php');
    $signage = new Signage();


    if( isset($_GET['act']) && $_GET['act']==='info' ){
            $aSignage = $signage->getSignageInfo();
            // file_put_contents('sht.txt', json_encode($aSignage));
            echo json_encode($aSignage);
    }

    if( isset($_GET['act']) && $_GET['act']==='brands' ){
            $aBrands = $signage->getBrands();
            echo json_encode($aBrands);
    }

?>
