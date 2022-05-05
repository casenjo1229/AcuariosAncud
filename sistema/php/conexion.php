<?php
    // define('DB_HOST','localhost');
    // define('DB_USER','root');
    // define('DB_PASS','betroox1229');
    // define('DB_NAME','peces');

    define('DB_HOST','localhost');
    define('DB_USER','acuario3_adminacuarios');
    define('DB_PASS','91YI)pJv9!7cEt');
    define('DB_NAME','acuario3_acuariosancud');

    # conectare la base de datos
    function conectar(){
        $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $con->query("SET NAMES 'utf8'");
        if(!$con){
            die("imposible conectarse: ".mysqli_error($con));
        }
        else{ return $con;}
    }
?>