<?php

//データをcsv形式で吐き出す。デバグ用のクラス
//classにしているのはrequire_onceで先頭に並べたいだけ
class	putCsv{
	public	$filename;
	public	$array;
	function go($outputData=""){
		$filename=$this->filename;
		$array=$this->array;
		//見出し行
		//$outputData="no,href,mongon,price\n";

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
//データをprint_rでtxt形式で吐き出す。上に同じデバグ用のクラス。
class	putPrintR{
	public	$filename;
	public	$array;
	function	go(){
		$array=$this->array;
		$filename=$this->filename;

		//本体ここから
		$txt=print_r($array,true);
		file_put_contents($filename,$txt);
		//ここまで

		return;
	}
}



//車種確定()
class	shashuKakutei{
	public	$inputArray;
	public	$indexArrayKeyColum;
	public	$result;
	public	$shashuIndexTableName;
	public	$shashuIndex;
	public	$modificationPatternKey;
	public	$db;

	//事前準備
	function	__construct($db){
		$this->db=$db;
		$openFlag=$this->db->open();
		if(	!isset($openFlag)	){
			print "dbオープン失敗、終了します。\r\n";
			exit();
		}
	}


	function	go(){
		$tableName=$this->shashuIndexTableName;
		//車種インデックス読み込み
		$this->shashuIndex=$this->db->readAll($tableName);
		$shashuIndex=$this->shashuIndex;

		//スクレイピング結果と車種インデックスの連携その1(テスト)php上で変数で行なう

		
		$inputArray=$this->inputArray;
		$indexArrayKeyColum=$this->indexArrayKeyColum;

		$modificationPatternKey=$ithis->modificationPatternKey;

		//preg_match用パターン作成
		$pattern="/";
		foreach(	$modificationPatternKey	as	$keyBit	){
			$pattern=$pattern."(".$keyBit;

		}



		foreach(	$inputArray	as	$ob	){
			foreach(	$shashuIndex	as	$pa	){
				$subject=$ob[$indexArrayKeyColum];
				$pattern=





		
			//スクレイピング結果と車種インデックスの連携その2(テスト)mysql上で行なう

		}
	}
}
/*
//resultを受け取ってdocumentExtractionクラス(抜き出し、置き換え)でできない修正をする
//(要は細かいつじつま合わせ)
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
 */

//db取扱
class	db{
	public	$db;
	public	$host;
	public	$dbName;
	public	$dbUser;
	public	$dbPass;
	public	$PDO;
	public	$dbParameter;

	//db基本情報読み込み
	function	__construct(){
		$this->dbParameter=new dbParameter();
		$this->db=$this->dbParameter->db;
		$this->host=$this->dbParameter->host;
		$this->dbName=$this->dbParameter->dbName;
		$this->dbUser=$this->dbParameter->dbUser;
		$this->dbPass=$this->dbParameter->dbPass;
	}
	
	//dbオープン
	function	open(){

		$db=$this->db;
		$host=$this->host;
		$dbName=$this->dbName;
		$dbUser=$this->dbUser;
		$dbPass=$this->dbPass;
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
	//読込、指定テーブル名のfetchAllを結果として吐き出す。
	//そもそもfetchAllを大分忘れているのでおためし用
	function	readAll($tableName){
		$query='SELECT * FROM '.$tableName;
		$stmt=$this->PDO->query($query);
		$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}



	//dbクローズ
	function	close(){
		print "db close\r\n";
		$this->PDO=null;
	}
}

?>
