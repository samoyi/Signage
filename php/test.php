<meta charset="utf-8">

<pre><?php


require_once('Signage.class.php');
$signage = new Signage();
$aSignage = $signage->getSignageInfo();

print_r($aSignage);





?></pre>
