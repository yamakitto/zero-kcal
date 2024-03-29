<?php 
include('function.php');
session_start();
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$pdo = dbConnect();

$db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
$db['dbname'] = ltrim($db['path'], '/');
$dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
$sql = "INSERT INTO `food_descriptions`(`food_description`) VALUES (:name)";
$stmt = $pdo->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
$params = array(':name' => $name); // 挿入する値を配列に格納する
$stmt->execute($params); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>結果画面</title>
</head>

<body>
    <h1>「<?php echo $name?>」を登録しました</h1>
    <button type=“button” onclick="location.href='insert.html'">もう一度入力する</button>
    <button type=“button” onclick="location.href='index.html'">ホームに戻る</button>
</body>

</html>