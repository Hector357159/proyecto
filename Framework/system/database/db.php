<?php
function db_connect() {
    // COMO ESTATICA PARA SOLO CONECTARNOS UNA VEZ
    static $connection;

    // NOS CONECTAMOS
    if(!isset($connection)) {
        $connection = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        mysqli_set_charset($connection, 'utf8') 
            or trigger_error(mysqli_error($connection));
            $connection->query("SET lc_time_names = 'es_ES'");
            $connection->query("SET global time_zone='America/El_Salvador'"); //wont work in shared hostings.
    }

    // ERROR
    if($connection === false) {
       return mysqli_connect_error(); 
    }    
    return $connection;
}
?>