// Este archivo contine funciones javascript que mediante jQuery manipulan el DOM y sus propiedades y valores

var tabla;

// Funcion init que inicializa
function init() 
{
    mostrarform(false);
    listar();
}

// Funcion limpiar que limpia el contenido de los campos
function limpiar() 
{
    $("idcategoria").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
}

// Funcion mostarform que dependienteo del valor del parámetro, muestra el div del listado y esconde el formulario o viceversa
function mostrarform(flag) 
{
    limpiar();
    if (flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("btnGuardar").prop("disabled", false);
    }
    else
    {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
    }
}

// Funcion cancelarform permite ocultar un formulario que ya no se va a usar
function cancelarform()
{
    limpiar();
    mostrarform(false);
}

// Función listar para enviar un valor mediante ajax a categoria.php
function listar()
{
    tabla = $("#tbllistado").dataTable(
        {
            "aProcessing": true, // Para activar el procesamiento del datatable
            "aServerSide": true, // Para indicar que la paginación y el filtadro se hacen del lado del servidor
            dom: 'Bfrtip', // Para definir los elementos de control de la tabla
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
            ],
            "ajax":
                {
                    url: '../ajax/categoria.php?op=listar',
                    type: 'GET',
                    dataType: 'json',
                    error: function(e){
                        console.log(e.responseText);
                    }
                },
            "bDestory": true, // Para
            "iDisplayLenght": 5, // Para indicar de cada cuanto se realizará la paginación
            "order": [[ 0, "desc" ]] // Para indicar el orden por la columna 0 en orden descendente
        }
    ).DataTable();

}

init();