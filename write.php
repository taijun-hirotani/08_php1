<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>


<?php
    //データの共有
    session_start();
    $_SESSION["address"]=$_POST["address"];

    //エスケープ処理 関数化
    function h($val){
        return htmlspecialchars($val,ENT_QUOTES);
    }
    
    //文字作成 ※文字数？時々エラー発生

    $name       = $_POST["name"];
    $address    = $_POST["address"];
    $lat        = $_POST["lat"];
    $lng        = $_POST["lng"];

    $room       = h($name).",".h($address).",".h($lat).",".h($lng);

    //File書き込み
    $file = fopen("data/data.txt","a");	// ファイル読み込み
    fwrite($file, $room."\n");//\n改行コード
    fclose($file);

    //物件表示
    


?>


<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>File書き込み</title>
    </head>


    <body>

        <h1>書き込みしました。</h1>
        <h2>./data/data.txt を確認しましょう！</h2>

        <ul>
            <li><a href="post.php">戻る</a></li>
            <li><a href="read.php">表示結果</a></li>
        </ul>
    </body>
</html>