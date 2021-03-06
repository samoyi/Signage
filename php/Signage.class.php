<?php

class Signage{

    private $mySQLiController;
    private $dbr;
    function __construct(){
        require_once('MySQLiController.class.php');
        $this->mySQLiController = new MySQLiController( $dbr );
        $this->dbr = $dbr;
    }

    // 获得所有品牌
    public function getBrands(){
        $result = $this->mySQLiController->getTypes(TABLE, 'brand');
        $this->dbr->close();
        $aBrand = array();
        foreach($result as $brand){
            $aBrand[] = $brand['brand'];
        }
        return $aBrand;
    }

    // 获得所有水牌信息
    public function getSignageInfo(){
        $result = $this->mySQLiController->getAll(TABLE);
        $this->dbr->close();
        return $result;
    }

    // 修改一个水牌
    public function modifySignage($user_key, $info){
        $aLocValueCol = array();
        $aNewValue = array();
        foreach($info as $key=>$val ){
            $aLocValueCol[] = $key;
            $aNewValue[] = $val;
        }

        $where = 'user_key="' . $user_key . '"';
        $result = $this->mySQLiController->updateData(TABLE, $aLocValueCol, $aNewValue, $where);
        $this->dbr->close();
        return $result;
    }


    // 删除一个水牌
    public function removeSignage($user_key){
        $where = 'user_key="' . $user_key . '"';
        $result = $this->mySQLiController->deleteRow(TABLE, $where);
        $this->dbr->close();
        return $result;
    }


    // 添加一个水牌
    public function addSignage($info){
        // Whether this id is being used
        if( $info->id !==0 ){ // 0 is default
            $where = 'id="' .$info->id. '"';
            $result = $this->mySQLiController->getRow(TABLE, $where );
            if( sizeof($result) !== 0 ){
                return false;
            }
        }

        $aCol = array();
        $aValue = array();
        foreach($info as $key=>$val){
            $aCol[] = $key;
            $aValue[] = $val;
        }
        $result = $this->mySQLiController->insertRow(TABLE, $aCol, $aValue);
        $this->dbr->close();
        return $result;
    }

}






?>
