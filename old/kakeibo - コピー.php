<?php


switch($btn){
case "aaa":
	printAddressBook();
	break;
}
exit();

function connectDb() {
	$dbHandle = pg_connect("host=localhost port=5432 dbname=kakeibo user=postgres password=aaa");
	if($dbHandle == FALSE) {
		die('接続失敗です。'.pg_last_error());
	}
	return $dbHandle;
}

function disconnectDb($dbHandle) {
	$result = pg_close($dbHandle);
	if($result == TRUE) {
	    print('切断に成功しました。<br>');
	}
	return $result;
}


function execSql($dbHandle, $sql) {
	$resultSet = pg_exec($dbHandle,$sql);
	if($resultSet == FALSE) {
	    die('クエリーが失敗しました。'.pg_last_error());
	}
	return $resultSet;
}

function printAddressBook() {
	$dbHandle = connectDb();
	$sql = 'SELECT * FROM kakeibo';
	$resultSet = execSql($dbHandle,$sql);
	disconnectDb($dbHandle);
	$resultNum = pg_numrows($resultSet);
	$i = 0;
	print('<table border=1>');
	while($i < $resultNum) {
		#$rec = pg_fetch_object($resultSet,$i);
	    $rec = pg_fetch_array($resultSet, NULL, PGSQL_ASSOC);
		print('<tr>');
		print('<td>'.$rec['price'].'</td>');
		print('</tr>');
		$i++;
	}
	print('</table>');
}

?>
