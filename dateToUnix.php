<?php
$host = 'localhost'; //Database host
$user = ''; //User
$pass = ''; //Password
$dbname = ''; //Database name
$table_name = 'revo_site_tmplvar_contentvalues'; //Table name
$tmplvarid = '6'; // Required value for tmplvarid

function date_converter($a) {
	$a = str_replace(
						array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'),
						array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
						$a
					);
	$b = strtotime($a);
	return $b;
	}

$connect = mysqli_connect($host, $user, $pass);

mysqli_set_charset($connect, "utf8");
$q = "SELECT * FROM " . $dbname . "." . $table_name . " WHERE tmplvarid=" . $tmplvarid;
$result = mysqli_query($connect, $q);
$q_i = array();
$q_i_pub = array();
$i = 1;
$i_pub = 1;
while ($row = mysqli_fetch_assoc($result)) {
	if (preg_match("#^\d{1,2} .* \d{4}#",$row['value'])) {
		$q_i[$i] = "UPDATE " . $dbname . "." .$table_name. " SET value=" .date_converter($row['value']). " WHERE id=" .$row['id'] ;
		mysqli_query($connect, $q_i[$i]);
		$i++;
	}
}
mysqli_close($connect);
print_r($q_i);
?>
