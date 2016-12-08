<?php
$str = '

';
$array = explode("\n", $str);
$var = json_encode($array);
print_r($var);
file_put_contents("adjectives_saved.json",$var);
?>
