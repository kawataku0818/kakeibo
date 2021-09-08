<html>
<head><title>PHP TEST</title></head>
<body>

<?php

$conn = "host=localhost port=5432 dbname=kakeibo user=postgres password=aaa";
$link = pg_connect($conn);
if (!$link) {
    die('接続失敗です。'.pg_last_error());
}

print('接続に成功しました。<br>');

pg_set_client_encoding("sjis");

$result = pg_query('SELECT * FROM kakeibo');
if(!$result){
	die('クエリーが失敗しました。'.pg_last_error());
}

for($i = 0 ; $i < pg_num_rows($result) ; $i++){
	$rows = pg_fetch_array($result, NULL, PGSQL_ASSOC);
	print('price='.$rows['price'].'<br>');
}

$close_flag = pg_close($link);

if ($close_flag){
    print('切断に成功しました。<br>');
}

?>
</body>
</html>