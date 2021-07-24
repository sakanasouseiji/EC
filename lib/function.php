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

//resultを受け取ってdocumentExtractionクラス(抜き出し、置き換え)でできない修正をする(要は細かいつじつま合わせ)
class	smallModification{
	public	$baseUrl;	//baseUrl
	//urlの修正
	function	baseUrlMod(){
		$baseUrl=$this->baseUrl;
		if(	!is_array($baseUrl)	&&	!isset($baseUrl[0])	&&	!isset($baseUrl[1])	){	//配列かつ要素がじゃなかったらfalse返して終了
			return	false;
		}
		$changeUrlNamme=$baseUrl[0];	
		$addUrl=$baseUrl[1];
	
}

?>
