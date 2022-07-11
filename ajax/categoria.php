<?php

use JetBrains\PhpStorm\ArrayShape;

    require_once "../modelos/Categoria.php";

    $categoria = new Categoria();

    // Código para recibir y validar los objetos del formulario, recibidos mediante POST
    $idcategoria = isset( $_POST["idcategoria"] ) ? limpiarCadena( $_POST["idcategoria"] ) : "";
    $nombre = isset( $_POST["nombre"] ) ? limpiarCadena( $_POST["nombre"] ) : "";
    $descripcion = isset( $_POST["descripcion"] ) ? limpiarCadena( $_POST["descripcion"] ) : "";

    // Se declara un case para responder de acuerdo a la opción seleccionada
    switch ( $_GET["op"] )
    {
        case 'guardaryeditar':
            if ( empty( $idcategoria) )
            {
                $rspta = $categoria->insertar( $nombre, $descripcion );
                echo $rspta ? "Categoria registrada" : "Categoria no registrada";
            }
            else
            {
                $rspta = $categoria->editar( $idcategoria, $nombre, $descripcion );
                echo $rspta ? "Categoria actualizada" : "Categoria no actualizada";
            }
        break;
        
        case 'desactivar':
            $rspta = $categoria->desactivar( $idcategoria );
            echo $rspta ? "Categoria desactivada" : "Categoria no desactivada";
        break;
        
        case 'activar':
            $rspta = $categoria->activar( $idcategoria );
            echo $rspta ? "Categoria activada" : "Categoria no activada";
        break;
        
        case 'mostar':
            $rspta = $categoria->mostrar( $idcategoria );
            // El resultado se codifica en formato JSON
            echo json_encode( $rspta );
        break;

        case 'listar':
            $rspta = $categoria->listar( $idcategoria );
            
            // Se declara un array para almacenar todos los registros recuperados
            $data = Array();
            
            // Se almacenan los registros recuperados en el arreglo
            while ( $row = $rspta->fetch_object() )
            {
                $data[] = array(
                    "0" => $row->idcategoria,
                    "1" => $row->nombre,
                    "2" => $row->descripcion,
                    "3" => $row->condicion
                );
            }

            // Ahora se contruye el arreglo que se devuelve
            $results = array(
                "sEcho" => 1, // Información para el datatables, usado para listar y paginacion
                "iTotalRecords" => count( $data), // Conteo del total de registros
                "iTotalDisplayRecords" => count( $data ), // Valor del total de registros a desplegar
                "aaData" => $data, // Arreglo con la información recuperada
            );

            echo json_encode( $results );
        break;

    }
?>