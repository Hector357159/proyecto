<?php 

$return_arr = array();
if (file_exists('/home/irvincabezas/public_html/production/app/system/config.php')) {
		require_once('/home/irvincabezas/public_html/production/app/system/config.php');
	}else{
		header("Location: http://imagine-studio-solutions.com/production/app/500.html");
	}
	require_once(DIR_DATABASE . 'db.php');
	$connection = db_connect();
	$QUERYGetAllUsers="Select CONCAT(user_name, ' ',user_last_name, ' (',user_email,')') as name,id_user,user_email from users;";
$result1 = mysqli_query($connection, $QUERYGetAllUsers) or trigger_error("Query Failed! SQL: $QUERYGetAllUsers - Error: ". mysqli_error($connection), E_USER_ERROR);
while ($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
    $row_array['team'] = utf8_encode($row['name']);
    $row_array['id'] = $row['id_user'];
    array_push($return_arr,$row_array);
}
echo json_encode($return_arr);

$fp = fopen('/home/irvincabezas/public_html/production/plugins/bower_components/typeahead.js-master/nfl.json', 'w');
fwrite($fp, json_encode($return_arr));
fclose($fp);

/*returns a string like so:
[{"id":"1","col1":"col1_value","col2":"col2_value"},{"id":"2","col1":"col1_value","col2":"col2_value"}]
*/
?>