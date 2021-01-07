<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Infobox</title>
<style>html,body{height:100%;}body{padding:0;margin:0;}h1{padding:0;margin:0;font-size:50%;}</style>
</head>


<!-- PHP[START] -->
<?php
session_start();
echo $_SESSION["address"];//登録した住所表示
?>
<!-- php[END] -->

<body>
<!-- 緯度経度表示 -->
<div id="map"></div>
<p><input type="text" id="from" value="ここに住所を入力"> <button id="get">検索</button></p>
<!-- MAP[START] -->
<h1>Infobox</h1>
<div id="myMap" style='width:100%;height:97%;'></div>
<!-- MAP[END] -->

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=Ai8ub6eCQc-L_eywD8q6V2Os5sWionIWn52nhhSl3S44LL5kAfjIpAn_dl2KGeIC' async defer></script>
<script src="js/BmapQuery.js"></script>

<!--  <script src="js/geolocation.js"></script>
<script src="js/map.js"></script> -->

<script>

let searchManager;   //SearchObject用


//****************************************************************************************
// map
//****************************************************************************************

function mapsInit(position) {
    //lat=緯度、lon=経度 を取得
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;
    //$("#map").html("緯度"+lat+",  "+"経度"+lon);
    const map = new Bmap("#myMap");
    map.startMap(lat, lon, "load", 18);

    let info = map.infobox(lat,lon, "たいじゅん", "俺の家");
    let info2 = map.infobox(lat,lon, "たいじゅん", "俺の家");
    let info3 = map.infobox(lat,lon, "たいじゅん", "俺の家");

};


//2． 位置情報の取得に失敗した場合の処理
function mapsError(error) {
    let e = "";
        if (error.code == 1) { //1＝位置情報取得が許可されてない（ブラウザの設定）
        e = "位置情報が許可されてません";
    }
  if (error.code == 2) { //2＝現在地を特定できない
    e = "現在位置を特定できません";
    }
  if (error.code == 3) { //3＝位置情報を取得する前にタイムアウトになった場合
    e = "位置情報を取得する前にタイムアウトになりました";
    }
    alert("エラー：" + e);
};

//3.位置情報取得オプション
const set ={
  enableHighAccuracy: true, //より高精度な位置を求める
  maximumAge: 20000,        //最後の現在地情報取得が20秒以内であればその情報を再利用する設定
  timeout: 10000            //10秒以内に現在地情報を取得できなければ、処理を終了
};
//Main:位置情報を取得する処理
//getCurrentPosition 現在地を一度だけ取得☆覚える
//getCurrentPosition デバイス位置が変わるたびに随時実行☆覚える
//getCurrentPosition :or: watchPosition

function GetMap(){//現在地取得後に地図取得
navigator.geolocation.getCurrentPosition(mapsInit, mapsError, set);

}
</script>


</body>
</html>