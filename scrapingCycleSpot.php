<?php

require_once("./lib/scraping.php");
//スクレイピングの実行サンプル。例としてサイクルスポットを使う
//備忘録
//サイトurlを指定してスクレイピング
//その中から正規表現を使ってアウトラインパターンから一度抜き出し、
//さらにその中からディティールパターンでもう一回抜き出す
//


//サンプル、サイクルスポット電動自転車安いもの順
//
$ECsiteList=array(
	"CycleSpot"=>array(		//サイクルスポット
		"Name"=>"CycleSpot",	//サイト名
		"Url"=>"https://cyclespot.jp/store/CategoryList.aspx?ccd=F1000518&wkcd=F1000510&SKEY=price&SORDER=0&page=",	//スクレイピングするurl
		"baseUrl"=>"https://cyclespot.jp",	//ベースurl,取得したurlに足す。必要ない場合はfalseもしくはnull
		"startPageNo"=>"0",	//最初のページナンバー
		"FileName"=>"CycleSpot.html",	//吐き出すファイル名
		"outlinePattern"=>"/並び順.[\s\S]*?pagination/iu",	//アウトラインパターン

		"detailsPattern"=>	//ディティールパターン	
		"/(lis_mk.[\s\S]*?sclistanc)|".
		"(lis_nm\">.[\s\S]*?<\/span>)|".
		"(priceB2\'>\n?<span\s?class=\"priceNumeric\">[0-9]{2,3}\,[0-9]{3}<\/span>)/iu",

		//index置き換えパターン
		"changeIndexSarch"=>array(
			"/^.[\s\S]*?("."href".")(.[\s\S]*?$)/iu",
			"/("."lis_nm".")(.[\s\S]*?$)/iu",
			"/("."price".")(.[\s\S]*?$)/iu"
		),	
		"changeIndexName"=>"$1",
		//トリムパターン
		"replacePattern"=>array(
			"/(^.[\s\S]*?href=\')(.[\s\S]*?)(\'\sonclick.[\s\S]*?$)/iu",
			"/(lis_nm\">)(.[\s\S]*?)(<\/span>)/iu",
			"/(^.[\s\S]*?)([0-9]{1,3},[0-9]{3})(.[\s\S]*?$)/iu"
		),
		"replacement"=>"$2"
	)
);

$scraping=new scraping();
$documentExtraction=new DocumentExtraction();
$result=array();


//サイト別
foreach($ECsiteList as $EC){

	//一覧ページ(アウトラインもしくはディティールでfalseが出たらページ終了と判断して終わり)
	do{
		print $EC["Url"].$EC["startPageNo"];
		$scraping->url=$EC["Url"].$EC["startPageNo"];
		$documentExtraction->subject=$scraping->go();
		$documentExtraction->outlinePattern=$EC["outlinePattern"];
		$documentExtraction->detailsPattern=$EC["detailsPattern"];
		$documentExtraction->changeIndexSarch=$EC["changeIndexSarch"];
		$documentExtraction->changeIndexName=$EC["changeIndexName"];
		$documentExtraction->replacePattern=$EC["replacePattern"];
		$documentExtraction->replacement=$EC["replacement"];
		$subject=$documentExtraction->get();
		$pageResult=$subject;
		print "<pre>";
		//print_r($pageResult);

		print "</pre>";
		++$EC["startPageNo"];
		if(	$pageResult!==false	){
			$result=array_merge($result,$pageResult);
		}
	}while(	$subject!==false	);
	file_put_contents($EC["Name"]."Result.txt",var_export($result,true)	);
/*
	//詳細データ取得
	$itiran=$result;	//
	$shousai=array();	//詳細
	$baseUrl=$EC["baseUrl"];	//$EC["baseUrl"]はここで初利用
	foreach($itiran as $no => $kobetu){
		if(	$EC["baseUrl"]!==false	){
			$kobetu["href"]=$EC["baseUrl"].$kobetu["href"]
			$scraping->url=$kobetu["basdeUrl"];


		}
	}
 */
}
?>
