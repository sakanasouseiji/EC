<?php
//配列の追加のテスト
print "<pre>";
$array="hoge\r\n";
$array2=array("a"=>"アッポー","b"=>"ボムバー","c"=>"クラス","d"=>"ダイナマイト");
$result=testParameter($array1,$array2);

function testParameter($array1=null,$array2=null,$flag=true){
	if(	is_array($array1)	){
		print_r($array1);
	}else{
		print "not array!\r\n";
	}

	if(	is_array($array2)	){
		print_r($array2);
	}else{
		print "not array!\r\n";
	}
	print (	is_bool($flag)	)?"bool!!\r\n":"not bool!!!\r\n";
	return false;
}
?>
