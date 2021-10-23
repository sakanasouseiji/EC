<?php

//変数名取得のサンプル(qitaから拝借)
$array=array(3,5,6,34,21,3,4);
print "<pre>";
print_r($GLOBALS);
print "</pre>";
print get_var_name($array)."\r\n";

function get_var_name(&$var) {
	$tmp = $var;
	$var = openssl_random_pseudo_bytes(100);
	$name = null;
	foreach ($GLOBALS as $k => $v) {
		if ($v === $var) {
			$name = $k;
			break;
		}
	}
	$var = $tmp;
	return $name;
}


?>
