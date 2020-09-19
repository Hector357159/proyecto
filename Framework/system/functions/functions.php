<?php
	
// Function to get the client ip address
function get_client_ip_server() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}
function create_next_dailyworkgroup_name($num_groups,$id_customer){
	$next_group_name="";
	switch($num_groups){
		case 0:  $next_group_name = "GPROD-" . date("m.d.y") . '-' . $id_customer . "-A";
				break;
		case 1:  $next_group_name = "GPROD-" . date("m.d.y") . '-' . $id_customer . "-B";
				break;
		case 2:  $next_group_name = "GPROD-" . date("m.d.y") . '-' . $id_customer . "-C";
				break;
		case 3:  $next_group_name = "GPROD-" . date("m.d.y") . '-' . $id_customer . "-D";
				break;
		case 4:  $next_group_name = "GPROD-" . date("m.d.y") . '-' . $id_customer . "-E";
				break;
		case 5:  $next_group_name = "GPROD-" . date("m.d.y") . '-' . $id_customer . "-F";
				break;
		case 6:  $next_group_name = "GPROD-" . date("m.d.y") . '-' . $id_customer . "-G";
				break;
		case 7:  $next_group_name = "GPROD-" . date("m.d.y") . '-' . $id_customer . "-H";
				break;
		case 8:  $next_group_name = "GPROD-" . date("m.d.y") . '-' . $id_customer . "-I";
				break;
		case 9:  $next_group_name = "GPROD-" . date("m.d.y") . '-' . $id_customer . "-J";
				break;
		case 10:  $next_group_name = "GPROD-" . date("m.d.y") . '-' . $id_customer . "-K";
				break;
	}
	return $next_group_name;
}
function strcut( $str, $char, $pos ) {
    $i = 1;
    $a = explode( $char, $str );
    $r = array();
    foreach ( $a as $b ) {
        if( $pos < $i  ) {
            $r[] = $b;
        }
        $i++;
    }

    return implode( $char, $r );
}

?>