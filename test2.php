<?php
//配列の追加のテスト
print "<pre>";
$array=array("a"=>"アッポー","b"=>"ボムバー","c"=>"クラス","d"=>"ダイナマイト");
var_dump($array);

$array+=array("c"=>"チェイサー");
var_dump($array);


$array+=array("d"=>"ドラゴン");
var_dump($array);
print "</pre>";
?>
