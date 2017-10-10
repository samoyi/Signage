<?php

class Signage{

    private $mySQLiController;
    private $dbr;
    function __construct(){
        require_once('MySQLiController.class.php');
        $this->mySQLiController = new MySQLiController( $dbr );
        $this->dbr = $dbr;
    }


    public function getSignageInfo(){
        $result = $this->mySQLiController->getAll(TABLE);
        $aSignage = array();
        while( $row = $result->fetch_array() ){
            $aSignage[] = $row;
        }
        $this->dbr->close();
        return $aSignage ;
    }

    public function getBrands(){
        $result = $this->mySQLiController->getTypes(TABLE, 'brand');
        $aBrand = array();
        while( $row = $result->fetch_array() ){
            $aBrand[] = $row[0];
        }
        file_put_contents('br.txt', json_encode($aBrand));
        $this->dbr->close();
        return $aBrand;
    }

}






?>
