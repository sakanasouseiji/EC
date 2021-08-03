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
	public	$subjectName			//subject名	
	public	$inputArray				//入力配列
	public	$cycleNameList			//車種名リスト

	
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

?>
