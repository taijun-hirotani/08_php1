<?php

$taijun="SAIKO,TENSAI,NICE,GOOD";
//第1＝ターゲット、第2＝元の文字列
$tj=explode(",",$taijun);


//配列値を確認するにはvar_dump関数が良いです
var_dump($tj,"<br>");
echo $tj[1],"<br>";
echo $tj[2],"<br>";
?>

<?php
$MAYUMI="KAWAII KETSUAGO OMOSIROI";
$SYUSA=explode(" ",$MAYUMI);
echo $SYUSA[1];
echo $SYUSA[0];
?>

<?php
$hitomi="hentai/eroero/sexy";
$ootani=explode("/",$hitomi);
echo $ootani[0];
?>