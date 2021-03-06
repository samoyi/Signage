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
            echo json_encode($aSignage);
    }

    // 修改一个水牌
    if( isset($_POST['act']) && $_POST['act']==='modify' && isset($_POST['info']) ){
        $info = json_decode( $_POST['info'], true );
        $user_key = $info['user_key'];
        unset($info['user_key']);
        // $table_id = $info['table_id'];
        // unset($info['table_id']);
        // unset($info['modifyTime']);
        $result = $signage->modifySignage($user_key, $info);
        echo json_encode($result);
    }

    // 删除一个水牌
    if( isset($_POST['act']) && $_POST['act']==='remove' && isset($_POST['user_key']) ){
        $result = $signage->removeSignage($_POST['user_key']);
        echo json_encode($result);
    }

    // 添加一个水牌
    if( isset($_POST['act']) && $_POST['act']==='add' && isset($_POST['info']) ){
        $result = $signage->addSignage(json_decode(urldecode($_POST['info'])));
        if( $result === false ){
            echo 'false';
        }
        else{
            echo json_encode($result);
        }
    }

?>
