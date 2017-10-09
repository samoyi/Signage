<pre><?php

require_once('MySQLiController.class.php');
$MySQLiController = new MySQLiController( $dbr );

$tableName = 'adshow';
$where = 'brand="haoyunlai"';


$result = $MySQLiController->getRow($tableName, $where );

$aURL = array();
while( $row = $result->fetch_array() ){
    $aURL[] = $row['video_url'];
}
print_r( $aURL );

$dbr->close();


?></pre>
