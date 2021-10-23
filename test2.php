<?php
//classの引数のテスト
$tc=new	testClass();

print "引数を与えなかった場合\r\n";
$tc->go();

print "引数を一つだけ与えた場合(hoge)\r\n";
$tc->go("hoge");

print "引数を二つ与えた場合(gebo,gebobo)\r\n";
$tc->go("gebo","gebobo");


class	testClass{
	public	$inputArray;
	public	$tableName;
	function	go($inputArray="あれい",$tableName="unknown"){
		print $inputArray.",";
		print $tableName."\r\n";
	}
}
?>
