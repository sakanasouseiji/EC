<?php

if(
	preg_match("/(?=.*(ふらっか〜ず|ふらっかーず|フラッカーズ)[\s]?ココッティ[\s]?アシスト)(?=.*2021)/ius","丸石サイクル 電動自転車 子供乗せ 2021 ふらっかーずココッティアシスト マルイシ maruishi 20インチ 10.4Ah 3段変速 オートライト  ASFRR203Y",$match)	){
	print "true!";
}
print_r($match[0]);
print_r($match);

if(
	preg_match("/(?=.*pas.*?kiss[\s]?mini[\s]?un)(?=.*2021)/ius","ヤマハ 電動自転車 2021年 パス キッス ミニ アン YAMAHA 20インチ 12.3Ah 3段変速 PAS Kiss mini un PA20FGXK1J",$match)	){
	print "true!";
}

print_r($match[0]);
print_r($match);

if(	
	preg_match("/(?=.*アシスタ[\s]?(c|C)[\s]?(STD|ＳＴＤ|スタンダード))(?=.*CC0C31|2021)/ius","ブリヂストン 電動自転車 子供乗せ アシスタC STD ブリジストン BRIDGESTONE 20インチ 12.3Ah 3段変速 オートライト CC0C31",$match)	){
	//preg_match("/(アシスタ[\s]?(c|C)[\s]?(STD|ＳＴＤ|スタンダード))(CC0C31|2021)/ius","ブリヂストン 電動自転車 子供乗せ アシスタC STD ブリジストン BRIDGESTONE 20インチ 12.3Ah 3段変速 オートライト CC0C31",$match)	){
	print "true!";
}
//print_r($match[0]);
print_r($match);

if(	
	preg_match("/(?=.*pas.*babby[\s]?un)(?=.*20(20|21))/ius","ヤマハ 電動自転車 2021年 パス バビー アン スーパー YAMAHA 20インチ 15.4Ah 3段変速 PAS Babby un SP PA20FGSB1J",$match)	){
	print "true";
}
print_r($match[0]);
print_r($match);

if(
	preg_match("/(?=.*ギュット[\s]?クルーム[\s]?dx)(?=.*2020|2021|ELFD032A)/ius","パナソニック 電動自転車 2021年 ギュット クルーム DX Panasonic 20インチ 	16Ah 3段変速 オートライト BE-ELFD032A",$match)	){
	print "true!";
}
print_r($match[0]);
print_r($match);

if(
	preg_match("/(?=.*pas.*?kiss[\s]?mini[\s]?un[\s]?(sp|スーパー))(?=.*2021)/ius","ヤマハ 電動自転車 2021年 パス キス ミニ アン スーパー YAMAHA 20インチ 	15.4Ah 3段変速 PAS Kiss mini un SP PA20FGSK1J",$match)	){
	print "true";
}
print_r($match[0]);
print_r($match);

if(	
	preg_match("/(?=.*pas[\s]?Crew)(?=.*2021)/ius","ヤマハ 電動自転車 2021年 パス クルー YAMAHA 24インチ 15.4Ah 3段変速 PAS Crew PA24CGC1J",$match)	){
	print "true!";
}
print_r($match[0]);
print_r($match);

if(
	preg_match("/(?=.*ギュット[\s]?クルーム[\s]?ex)(?=.*2020|2021|ELFE033)/ius","パナソニック 電動自転車 2021年 ギュット クルーム EX Panasonic 20インチ 	16Ah 3段変速 オートライト BE-ELFE032A",$match)	){
	print "true!";
}
print_r($match[0]);
print_r($match);


?>
