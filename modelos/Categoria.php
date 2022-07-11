<?php
    // Se incluye la conexión a la base de datos
    require "../config/Conexion.php";

    // Aquí se define la clase que va a controlar la tabla Categoria
    Class Categoria
    {
        // Constructor por defecto la clase
        public function __construct()
        {
        }

        // Método para insertar
        public function insertar( $nombre, $descripcion)
        {
            $sql = "INSERT INTO categoria (nombre, descripcion, condicion) 
                    VALUES ('$nombre', '$descripcion', '1')";
            return ejecutarConsulta( $sql );
        }

        // Método para editar
        public function editar( $idcategoria, $nombre, $descripcion)
        {
            $sql = "UPDATE categoria SET nombre='$nombre', descripcion='$descripcion' 
                    WHERE idcategoria=$idcategoria";
            return ejecutarConsulta( $sql );
        }

        // Médoto para desactivar categorias
        public function desactivar( $idcategoria )
        {
            $sql = "UPDATE categoria SET condicion='0' 
                    WHERE idcategoria='$idcategoria'";
            return ejecutarConsulta( $sql );
        }

        // Médoto para activar categorias
        public function activar( $idcategoria )
        {
            $sql = "UPDATE categoria SET condicion='1' 
                    WHERE idcategoria='$idcategoria'";
            return ejecutarConsulta( $sql );
        }

        // Método para mostrar todos los datos de un registro a modificar
        public function mostrar( $idcategoria )
        {
            $sql = "SELECT * FROM categoria 
                    WHERE idcategoria='$idcategoria'";
            return ejecutarConsultaSimpleFila( $sql );
        }

        // Método para listar los registros
        public function listar()
        {
            $sql = "SELECT * FROM categoria";
            return ejecutarConsulta( $sql );
        }
    }
?>