<?php

require_once("./lib/scraping.php");
require_once("./lib/function.php");
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
		"Name"=>"cyclespot",	//サイト名,吐き出すファイル名にもなる
		//"Url"=>"https://cyclespot.jp/store/CategoryList.aspx?ccd=F1000518&wkcd=F1000510&SKEY=price&SORDER=0&page=",	//スクレイピングするurl(電動自転車全体)
		"Url"=>"https://cyclespot.jp/store/CategoryList.aspx?ccd=F1000544&wkcd=F1000510-F1000518&SKEY=price&SORDER=0&page=",	//スクレイピングするurl(子乗せ電動自転車)
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
		"changeIndexName"=>array(
			"url",
			"mongon",
			"$1"
		),
		//トリミングパターン
		"replacePattern"=>array(
			"/(^.[\s\S]*?href=\')(.[\s\S]*?)(\'\sonclick.[\s\S]*?$)/iu",
			"/(lis_nm\">)(.[\s\S]*?)(<\/span>)/iu",
			"/(^.[\s\S]*?)([0-9]{1,4})\,([0-9]{3})(.[\s\S]*?$)/iu"
		),
		//"replacement"=>"$2",
		"replacement"=>array(
			"https://cyclespot.jp"."$2",
			"$2",
			"$2$3"
		),


		//特殊修正
		//一律で置き換え、トリムできないパターンはこちらで処理する。
		//車種確定用
		"modifi"=>array(
			"subjectName"=>"mongon"		//車種確定時の正規表現対象index、subject名
		)
	)
);

$scraping=new scraping();
$documentExtraction=new DocumentExtraction();
$putKakaku=new putKakaku();
$result=array();
$modification=new modification();


//サイト別
foreach($ECsiteList as $EC){

	//一覧ページ(アウトラインもしくはディティールでfalseが出たらページ終了と判断して終わり)
	do{
		print $EC["Url"].$EC["startPageNo"]."\n";
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
		/*
		print "<pre>";
		//print_r($pageResult);

		print "</pre>";
		 */
		++$EC["startPageNo"];
		if(	$pageResult!==false	){
			$result=array_merge($result,$pageResult);
		}
	}while(	$subject!==false	);

	//urlの補完(単純に追加しているだけ)	車種確定部分に作り直し予定
	/*
	$modification->baseUrl=$EC["baseUrl"];
	$modification->inputArray=$result;
	$result=$modification->baseUrlAdd();
	 */
	//csv形式での出力
	$putKakaku->filename=$EC["Name"]."Result.csv";
	$putKakaku->array=$result;
	$result=$putKakaku->go();
	
}
?>
