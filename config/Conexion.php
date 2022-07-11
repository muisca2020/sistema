<?php
    require_once "global.php";

    // Se crea una nueva instancia de la conexión a la base de datos
    $conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Aquí se indica la codificación que se la dará a la información
    mysqli_query($conexion, 'SET NAMES "' . DB_ENCODE .	'"');

    // Este código imprime información si se produce un error de conexión a la base de datos
    if(mysqli_connect_errno())
    {
        printf("Error connecting to database: %s\n",mysqli_connect_errno());
        exit(1);
    }

    // Se valida si no existe aun la función ejecutarConsulta, y si es así se define
    if(!function_exists('ejecutarConsulta'))
    {
        // Esta función recibe una consulta a la base de datos de datos mediante un string que espera sea compatible con el estándar SQL
        function ejecutarConsulta( $sql )
        {
            global $conexion;
            $query = $conexion->query( $sql );
            return $query;
        }

        // Esta función recibe una consulta en formato SQL a la base de datos pero retorna solamente una fila
        function ejecutarConsultaSimpleFila( $sql )
        {
            global $conexion;
            $query = $conexion->query( $sql );
            $row = $query->fetch_assoc();
            return $row;
        }

        // Esta función recibe una consulta en formato SQL a la base de datos y retorna el id al registro insertado
        function ejecutarConsulta_retornarID( $sql )
        {
            global $conexion;
            $query = $conexion->query( $sql );
            return $conexion->insert_id;
        }

        // Esta función recibe una cadena de texto y escapa caracteres especiales
        function limpiarCadena( $str )
        {
            global $conexion;
            $str = mysqli_real_escape_string( $conexion, trim( $str ));
            return htmlspecialchars( $str );
        }
    }
?>