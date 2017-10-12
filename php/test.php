<meta charset="utf-8">

<pre><?php


require_once('MySQLiController.class.php');
$mySQLiController = new MySQLiController( $dbr );
$where = 'table_id=18';
$result = $mySQLiController->getAll('adshow' );
print_r($result);




?></pre>
