<?php
$allMongon=array(
	"ブリヂストン 電動自転車 子供乗せ アシスタC STD ブリジストン BRIDGESTONE 20インチ 12.3Ah 3段変速 オートライト CC0C31",
	"パナソニック 電動自転車 子供乗せ ギュット アニーズ DX Panasonic 20インチ 16.0Ah 3段変速 BE-ELAD032",
	"パナソニック 電動自転車 子供乗せ ギュット クルームR DX Panasonic 16Ah 3段変速 オートライト BE-ELRD03"
);




$shashuIndex=array(
	array("seikihyougen_year"=>"(20(20|21)|ELAD032)","seikihyougen_name"=>"ギュット[\s]?アニーズ[\s]?dx"),
	array("seikihyougen_year"=>"(20(20|21)|ELRD03)","seikihyougen_name"=>"ギュット[\s]?クルームR[\s]?dx"),
	array("seikihyougen_year"=>"(2021|CC0C31)","seikihyougen_name"=>"アシスタ[\s]?(c)[\s]?(STD|スタンダード)"),
);



foreach($allMongon	as	$subject){
	
		foreach(	$shashuIndex	as	$jitensha	){	
			
			//preg_match用パターン作成
			$pattern="/";
			foreach(	$jitensha	as	$i	){
				$pattern=$pattern."(?=.*".$i.")";
			};
			$pattern=$pattern."/ius";

	
			if(	preg_match($pattern,$subject,$match)	){
				print $pattern."\r\n";	
				print $subject."\r\n";
				break;
			}
		}
}


?>
