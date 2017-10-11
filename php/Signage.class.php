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
        $result = $this->mySQLiController->getAll(TABLE, 'brand');
        $this->dbr->close();
        return $result;
    }

    public function getBrands(){
        $result = $this->mySQLiController->getTypes(TABLE, 'brand');
        $this->dbr->close();
        $aBrand = array();
        foreach($result as $brand){
            $aBrand[] = $brand[0];
        }
        return $aBrand;
    }

}






?>
