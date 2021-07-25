<?php

//スクレイピング価格データをcsv形式で吐き出す
//classにしているのはrequire_onceで先頭に並べたいだけ
class	putKakaku{
	public	$filename;
	public	$array;
	function go(){
		$filename=$this->filename;
		$array=$this->array;
		//見出し行
		$outputData="no,href,name,price\n";

		//本文
		foreach($array	as	$no	=>	$kobetu){
			$outputData=$outputData.$no;
			foreach($kobetu	as $key => $i){
				$outputData=$outputData.",".$i;
			}
			$outputData=$outputData."\n";
		}
	$result=file_put_contents($filename,var_export($outputData,true)	);
	print $outputData;
	return $result;
	}
}

//resultを受け取ってdocumentExtractionクラス(抜き出し、置き換え)でできない修正をする
//(要は細かいつじつま合わせ)
class	modification{
	public	$baseUrl;	//baseUrl
	public	$inputArray;	//documentExtraction後の結果

	//urlの修正
	function	baseUrlAdd(){
		$baseUrl=$this->baseUrl;
		$inputArray=$this->inputArray;

		//baseUfrlのチェック。配列かつ要素空がじゃなければfalse返して終了
		if(	!is_array($baseUrl)	&&	!isset($baseUrl[0])	&&	!isset($baseUrl[1])	){
			print "baseUrl not found!! false!!";
			return	false;
		}

		$changeUrlName=$baseUrl[0];	
		$addUrl=$baseUrl[1];
		$result=array();

		foreach($inputArray	as	$kobetu){
			if(	isset($kobetu[$changeUrlName])	){
				$kobetu[$changeUrlName]=$addUrl.$kobetu[$changeUrlName];
				$result[]=$kobetu;
			}
		}

		return $result;
	}

	
	//商品名(車名)の確定
	function	productNameDiscrimination(){
		$cycleNameList=$this->cycleNameList;
		$inputArray=$this->inputArray;


		$result=array();

		foreach($inputArray	as	$kobetu){




		}

		return $result;
	}
}

?>
