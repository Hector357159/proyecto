<?php
	
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
/*
$file = new SplFileObject("error_log");

// Loop until we reach the end of the file.
while (!$file->eof()) {
    // Echo one line from the file.
    echo $file->fgets();
}

// Unset the file to call __destruct(), closing the file handle.
$file = null;

*/

$myFile = "error_log";
$lines = file($myFile);//file in to an array
echo $lines[10]; //line2
echo "<br>";

$date = trim(strstr(strstr($lines[10], '['), ']', true), '[]');
echo $date;
echo "<br>";

$type_m = trim(strstr(strstr($lines[10], 'PHP'), ':', true), 'PHP:');
echo "PHP ".$type_m;
echo "<br>";

$rest = '['. strcut($lines[10], ':', 3); //undefined index
$error_m = trim(strstr(strstr($rest, '['), '/', true), '[/');
if(empty($error_m)){
	echo strcut($lines[10], ':', 3);
	
}else{
	echo $error_m;
}

echo "<br>";

$route =  strcut($lines[10], '/', 2);
echo $route;

echo "<br>";

?>