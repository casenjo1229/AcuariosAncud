<?php 
    session_start();
    require_once("../php/conexion.php");

    $query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

    $consulta = "call consulta_familia($query)";
    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    if ($columna = mysqli_fetch_array( $resultado ))
    {
        $rest = $columna['nombre_corto'];
    }

    $consulta = "call consulta_ultimo_cod($query,8)";
    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    if ($columna = mysqli_fetch_array( $resultado ))
    {
        $ultimo = $columna['codigo'];
        $num1 = substr($columna['codigo'], 0, 3) + 1;
        $num2 = substr($columna['codigo'], -3, 3) + 1;
        if(strlen($num2) == 1)
        {
            $num2 = "00".$num2;
        }
        $resultado = $num1.$rest.$num2;
        
        $arr = array();
        $arr[0] = $resultado;
        echo json_encode($arr);
    }
    else
    {
        $consulta = "call consulta_ultimo_cod($query,7)";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        if ($columna = mysqli_fetch_array( $resultado ))
        {
            $count = $columna['codigo'];
            $num1 = substr($columna['codigo'], 0, 3) + 1;
            $num2 = substr($columna['codigo'], -2, 2) + 1;
            if(strlen($num2) == 1)
            {
                $num2 = "00".$num2;
            }
            $resultado = $num1.$rest.$num2;
        
            $arr = array();
            $arr[0] = $resultado;
            echo json_encode($arr);
        }
        else
        {
            $final = 1;
            $final1 = 1;
    
            $arr = array();
            $arr[0] = "00".$final.$rest."0".$final1;
            echo json_encode($arr);
        }
    }

    
    
?>