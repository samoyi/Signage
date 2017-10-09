<?php

class Signage{

    private $mySQLiController;
    private $dbr;
    function __construct(){
        require_once('MySQLiController.class.php');
        $this->mySQLiController = new MySQLiController( $dbr );
        $this->dbr = $dbr;
    }


    public function getSignageInfo($sBrand){
        $where = 'brand="' .$sBrand. '"';
        $result = $this->mySQLiController->getRow(TABLE, $where );

        $aSignage = array();
        while( $row = $result->fetch_array() ){
            $aSignage[] = $row;
        }
        return $aSignage ;

        $this->dbr->close();
    }
}






?>
