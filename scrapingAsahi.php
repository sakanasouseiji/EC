<?php

require_once("./lib/scraping.php");
require_once("./lib/function.php");

//dbパラメーター
require_once($_SERVER["DOCUMENT_ROOT"]."dbPath/scrapingDBParameter.php");
//スクレイピングの実行サンプル。例としてサイクルベースあさひを使う
//備忘録
//サイトurlを指定してスクレイピング
//その中から正規表現を使ってアウトラインパターンから一度抜き出し、
//さらにその中からディティールパターンでもう一回抜き出す
//




//サンプル、サイクルベースあさひ子乗せ電動自転車安いもの順
$i="";
$ECsiteList=array(
	"CycleBaseAsahi"=>array(		//サイクルベースあさひ
		"Name"=>"CycleBaseAsahi",	//サイト名,吐き出すファイル名にもなる
		"startPageNo"=>"0",	//最初のページナンバー
		"nextPageNo"=>"36",	//次のページナンバー
		"Url"=>"https://ec.cb-asahi.co.jp/category/cat2/%E9%9B%BB%E5%8B%95%E8%87%AA%E8%BB%A2%E8%BB%8A/%E3%83%81%E3%83%A3%E3%82%A4%E3%83%AB%E3%83%89%E3%82%B7%E3%83%BC%E3%83%88%E4%BB%98|/?isort=price",	//スクレイピングするurl(子乗せ電動自転車)ページナンバーは"|"で記述すること
		"startPageNo"=>"0",	//最初のページナンバー
		"nextPageNo"=>"36",	//次のページナンバー
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
			"tableName"=>"shashuIndex",	//車種確定用のテーブル名
			"subjectName"=>"mongon",		//車種確定時の正規表現対象subject名
			"addColum"=>"index_no",		//車種確定時の追加コラム名
			"patternKey"=>array("seikihyougen_name","seikihyougen_year")	//同じく車種確定時のパターンキー。複数ある場合foreachで回して先行先読みでAND化
		),
		
	)
);
$outputData="no,href,mongon,price\n";

$siteGet=new siteGet();
$putCsv=new putCsv();
$putPrintR=new putPrintR();
$db=new db();
$shashuKakutei=new shashuKakutei($db);	//センス無いネーミング

//サイトごとに取得、出力
foreach($ECsiteList as $EC){
	$siteGet->EC=$EC;
	$result=$siteGet->go();

	//車種確定(入力配列に)
	$shashuKakutei->inputArray=$result;		//スクレイピング配列
	$shashuKakutei->inputArrayKeyColum=$EC["modifi"]["subjectName"];	//正規表現対象カラム名(mongon)
	$shashuKakutei->db=$db;		//db
	$shashuKakutei->shashuIndexTableName=$EC["modifi"]["tableName"];	//車種インデックステーブル名
	$shashuKakutei->modificationPatternKey=$EC["modifi"]["patternKey"];	//車種インデックスで利用するキー
	$shashuKakutei->addColum=$EC["modifi"]["addColum"];	//車種インデックスで紐付けするカラム
	$result=$shashuKakutei->go();
	$index=$shashuKakutei->shashuIndex;	//車種インデックス出力(デバグ用)



	//test
	$putPrintR->array=$index;
	$putPrintR->filename="shashuIndex.txt";
	$putPrintR->go();

	$putPrintR->array=$result;
	$putPrintR->filename=$EC["Name"]."Result.txt";
	$putPrintR->go();

//csv形式での出力
	$putCsv->filename=$EC["Name"]."Result.csv";
	$putCsv->array=$result;
	$result=$putCsv->go($outputData);
}
?>
