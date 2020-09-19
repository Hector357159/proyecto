<?php
session_start();
if (file_exists('/home/irvincabezas/public_html/production/app/system/config.php')) {
		require_once('/home/irvincabezas/public_html/production/app/system/config.php');
	}else{
		header("Location: http://imagine-studio-solutions.com/production/app/500.html");
	}
require_once(DIR_DATABASE . 'db.php');
$connection = db_connect();
$id_customer = 1;
$query = "SELECT COUNT(dw.id_daily_workgroup) as grupos from daily_workgroup as dw where DAY(dw.date_created) = DAY(NOW()) AND MONTH(dw.date_created) = MONTH(NOW()) and YEAR(dw.date_created) = YEAR(NOW()) and dw.f_user_owner = (SELECT u.id_user
FROM users as u, users_type as ut,supervisor_customer as sc
WHERE u.f_User_Type = ut.id_users_type and sc.f_supervisor_user = u.id_user and ut.id_users_type = 2 and f_customer = $id_customer ORDER BY sc.date_assigned DESC LIMIT 1);";
$result = mysqli_query($connection, $query) or trigger_error("Query Failed! SQL: $query- Error: ". mysqli_error($connection), E_USER_ERROR);
$res = mysqli_fetch_assoc($result);
echo $res["grupos"];

?>