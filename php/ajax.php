<?php

    header('Access-Control-Allow-Origin: *');

    require_once('Signage.class.php');
    $signage = new Signage();


    // 获得所有品牌
    if( isset($_GET['act']) && $_GET['act']==='brands' ){
        $aBrands = $signage->getBrands();
        echo json_encode($aBrands);
    }


    // 获得所有水牌信息
    if( isset($_GET['act']) && $_GET['act']==='signage' ){
            $aSignage = $signage->getSignageInfo();
            // file_put_contents('sht.txt', json_encode($aSignage));
            echo json_encode($aSignage);
    }

    // 修改一个水牌
    if( isset($_POST['act']) && $_POST['act']==='modify' && isset($_POST['info']) ){
        $info = json_decode( $_POST['info'], true );
        file_put_contents('inf.json', json_encode($info));
        $table_id = $info['table_id'];
        unset($info['table_id']);
        unset($info['modifyTime']);
        $result = $signage->modifySignage($table_id, $info);
        echo json_encode($result);
    }

    // 删除一个水牌
    if( isset($_POST['act']) && $_POST['act']==='remove' && isset($_POST['table_id']) ){
        $result = $signage->removeSignage($_POST['table_id']);
        echo json_encode($result);
    }


?>
