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
    public function modifySignage($table_id, $info){
        $aLocValueCol = array();
        $aNewValue = array();
        foreach($info as $key=>$val ){
            $aLocValueCol[] = $key;
            $aNewValue[] = $val;
        }

        $where = 'table_id="' . $table_id . '"';
        $result = $this->mySQLiController->updateData(TABLE, $aLocValueCol, $aNewValue, $where);
        $this->dbr->close();
        return $result;
    }


    // 删除一个水牌
    public function removeSignage($table_id){
        $where = 'table_id="' . $table_id . '"';
        $result = $this->mySQLiController->deleteRow(TABLE, $where);
        $this->dbr->close();
        return $result;
    }


    // 添加一个水牌
    public function addSignage($info){
        // Whether this id is being used
        $where = 'id="' .$info->id. '"';
        $result = $this->mySQLiController->getRow(TABLE, $where );
        if( sizeof($result) !== 0 ){
            return false;
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
