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
		$outputData="no,href,mongon,price\n";

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
//車種確定もここ
class	modification{
	public	$subjectName;			//subject名	
	public	$inputArray;			//入力配列
	public	$cycleNameList;			//車種名リスト

	
	//商品名(車名)の確定
	function	productNameDiscrimination(){
		$cycleNameList=$this->cycleNameList;
		$inputArray=$this->inputArray;
		$subject=$this->productNameSubject;

		$result=array();

		foreach($inputArray	as	$kobetu){




		}

		return $result;
	}
}

//db取扱
class	db{
	public	$db;
	public	$host;
	public	$dbName;
	public	$dbUser;
	public	$dbPass;
	public	$PDO;

	//dbオープン
	function	open(){

		//エラーチェック
		if(	!isset($db)	){
			print "empty db	false!\r\n";
			return false;
		}
		if(	!isset($host)	){
			print "empty host	false!\r\n";
			return false;
		}
		if(	!isset($dbName)	){
			print "empty dbName	false!\r\n";
			return false;
		}
		if(	!isset($dbUser)	){
			print "empty dbUser	false!\r\n";
			return false;
		}
		if(	!isset($dbPass)	){
			print "empty dbPass	false!\r\n";
			return false;
		}
		try{
			$this->PDO=new PDO($db.":host=".$host.";dbname=".$dbName,$dbUser,$dbPass);
		}catch(PDOException $error){
			print "connect false!\r\n";
			print $error->getMessage();
			return false;
		}
		print "connect complete\r\n";
		return true;
	}
	//dbクローズ
	function	close(){
		print "db close\r\n";
		$this->PDO=null;
	}
}

?>
