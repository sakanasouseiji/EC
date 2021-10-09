<?php
class	nya{
	public	$me=1;
}
$nya=	new nya();
$mongon="これは".$nya->me."回目です。\r\n";
$firstNo=1;
$nextNo=1;

$testOB=	new testOB();
$testOB->mongon=$mongon;
$testOB->firstNo=$firstNo;
$testOB->nextNo=$nextNo;
$testOB->nya=$nya;
$result=$testOB->go();

class	testOB{
	public	$mongon;
	public	$firstNo;
	public	$nextNo;
	public	$nya;
		function	go(){
			//$this->mongon->nya->me=$this->firstNo;
			$this->nya->me=$this->firstNo;
			$this->mongon->j=$this->nya->me;
			$array=array(1,2,3,4,5);
			
			foreach($array	as	$i){
				print "<pre>";
				print_r($this);
				print "<pre>";
				print $this->mongon;
				$this->nya->me=$this->nya->me+$this->nextNo;
			}
		}
}
?>
