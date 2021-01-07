//****************************************************************************************
// BingMaps&BmapQuery
//****************************************************************************************
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

    //----------------------------------------------------
    //3. Add Infobox
    // infobox(lat, lon, "title", "description");
    //----------------------------------------------------
    map.infobox(43.03401614599289, 141.3648905204878, "Title", '<a href="">詳細</a>');
    
}



//地図表示
let map;
function GetMap() {
    //1. Instance
    map = new Bmap("#myMap");

    //マップの初期位置設定
    map.startMap(37.67229496806523, 137.88838989062504, "load", 16);

    //3. Geocode(2 patterns)
    // getGeocode("searchQuery",callback);
    let lat;
    let lon;

    map.onGeocode("click", function (data2) {
    lat = data2.location.latitude; //Get latitude
    lon = data2.location.longitude; //Get longitude
    document.querySelector("#geocode").innerHTML = lat + ',' + lon;

    // ＝＝＝＝＝＝ぐるなびAPI＝＝＝＝＝＝
    const data = {
        // keyid: $("#key").val(), //必須myid
        keyid: "0179de033232897f5f8b17b418fd8098",
        latitude: lat,
        longitude: lon,
        range: 2, //範囲
        wifi: 1,
        hit_per_page: 5,
    };

    //Ajax（非同期通信）
    axios.get('https://api.gnavi.co.jp/RestSearchAPI/v3/', {
        params: data
    })
        .then(function (response) {
        //データ受信成功！！showData関数にデータを渡す
        showData(response.data);
    }).catch(function (error) {
        console.log(error); //通信Error
    }).then(function () {
        //console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });

    //物件表示
    function showData(data) {
        //データ確認用
        // console.log(data2.rest);
        console.log("ここのdetaは？" + data.rest[0]);
        console.log(data.rest[0]);

        //データを繰り返し処理で取得
        const len = data.rest.length; //データ数を取得
        console.log("データの個数" + len);
        //for文 データ取得     
        const options = [];
        for (let i = 0; i < len; i++) {
            $("#table").append(
                '<tr><td>' + [i] + 
                '</td><td>' + data.rest[i].name +
                '</td><td>' + data.rest[i].opentime +
                '</td></tr>');
            // map.pinText(data.rest[i].latitude, data.rest[i].longitude, data.rest[i].name);
            // map.infobox(data.rest[i].latitude, data.rest[i].longitude, '【' + [i] + '】' + data
            //     .rest[i].name, data.rest[0].image_url);
            console.log(options);
            options[i] = {
                "lat": data.rest[i].latitude,
                "lon": data.rest[i].longitude,
                "title": data.rest[i].name,
                "pinColor": "#ff0000",
                "height": 600,
                "width": 600,
                "description": "<div><img src='"+data.rest[i].image_url+"'></div>",
                "show": false
            };
        };
        map.infoboxLayers(options, true);
    };


});
}


