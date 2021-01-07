<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>不動産の物件を地図</title>

    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/style.css">

</head>

    <body>
        <!-- タイトル -->
        <div class=header>
            <h1 id="title" class=title>不動産の物件を地図表示</h1>
            <div id="geocode" class=geocode>geocode:data</div>
        </div>
        <a href=""></a>


        <!-- bingmap api -->
        <script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=Ai8ub6eCQc-L_eywD8q6V2Os5sWionIWn52nhhSl3S44LL5kAfjIpAn_dl2KGeIC' async defer></script>
        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="js/BmapQuery.js"></script><!-- B-MAP -->
        <!--<script src="js/map.js"></script> B-MAP -->
        
        
        <!-- 地図表示 -->
        <div class=maparea>
            <div id="myMap" class=myMap></div>
        </div>
        
        <!-------------------登録情報/表示箇所-------------------->
        <div class=data>
            <table border='2'>
                <tr class=room>
                    <td>物件名</td>
                    <td>住所</td>
                    <td>経度</td>
                    <td>緯度</td>
                </tr>

                <!--PHP/csv読込-->
                <?php
                        if( ($fp = fopen("data/data.txt","r"))=== false ){
                            die("CSVファイル読み込みエラー");
                        }

                        while (($array = fgetcsv($fp)) !== FALSE) {
                        //空行を取り除く
                        if(!array_diff($array, array(''))){
                            continue;
                        }
                        echo "<tr class=room_item>";
                        for($i = 0; $i < count($array); ++$i ){
                            $elem = nl2br(mb_convert_encoding($array[$i], 'UTF-8'));
                            $elem = $elem === "" ?  "&nbsp;" : $elem;
                            echo("<td class=room_item>".$elem."</td>");
                        }
                        echo "</tr>";
                        
                        }
                        fclose($fp);
                ?>
                <!--PHP/csv読込-->
            </table>
        </div>
        <script>
        //****************************************************************************************
        // BingMaps&BmapQuery
        //****************************************************************************************
        var obj = JSON.parse($fp);
        console.log(obj);
        //Init
        function GetMap(){
        //------------------------------------------------------------------------
        //1. Instance
        //------------------------------------------------------------------------
        const map = new Bmap("#myMap");
        
        //------------------------------------------------------------------------
        //2. Display Map
        //------------------------------------------------------------------------
        map.startMap(37.67229496806523, 137.88838989062504, "load", 5); //The place is Bellevue.
        
        //3. Geocode(2 patterns)
        // getGeocode("searchQuery",callback);
        let lat;
        let lon;

        map.onGeocode("click", function (data2) {
        lat = data2.location.latitude; //Get latitude
        lon = data2.location.longitude; //Get longitude
        document.querySelector("#geocode").innerHTML = lat + ',' + lon;
        });


        //----------------------------------------------------
        //3. Add Infobox
        // infobox(lat, lon, "title", "description");
        //----------------------------------------------------
        map.infobox(43.03401614599289, 141.3648905204878, "Title", '<a href="">詳細</a>');
    
    
    
}


        </script>
        
    </body>
</html>

