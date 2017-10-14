<meta charset="utf-8">

<pre><?php


require_once('MySQLiController.class.php');
$mySQLiController = new MySQLiController( $dbr );
$where = 'id=19310997';
$result = $mySQLiController->getRow('adshow', $where);
print_r(sizeof($result));




?></pre>
