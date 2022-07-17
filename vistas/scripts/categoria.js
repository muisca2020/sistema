// Este archivo contine funciones javascript que mediante jQuery manipulan el DOM y sus propiedades y valores

var tabla;

// Funcion init que inicializa
function init() 
{
    mostrarform(false);
    listar();

    // Este código se activa cuando se dispara el evento submit y es la encargada de pasar el evento y sus datos a la función guardaryeditar
    $( "#formulario" ).on( "submit", function( event ){
        guardaryeditar( event );
    })
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

function guardaryeditar( e )
{
    e.preventDefault(); // Se usa para evitar que se ejecute la acción por default del evento
    $("#btnGuardar").prop("disabled", true); // Desabilita el botón de guardar
    var formData = new FormData( $("#formulario")[0] ); // Se recibe todo el contenido del formulario

    $.ajax({
        url: "../ajax/categoria.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function( datos ) {
            bootbox.alert( datos ); // Este alert miestra los mensajes que recibe como respuesta desde el categoria de ajax
            mostrarform( false ); // Se oculta de nuevo el formulario
            tabla.ajax.reload(); // Se hace un llamado mediante Ajax para recargar la tabla de categorias
        }
    });
    limpiar();
}

init();