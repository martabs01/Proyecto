/*
    Alumno: Marta Broncano Suárez
    Asignatura: Proyecto San Romilla
    Curso: 20-21
    Descripción: Archivo que contiene las funciones que se van a emplear para la gestión de los colaboradores
*/
//Función que realiza una petición para averiguar x datos en base a la fecha de nacimiento
function fecha_inscripcion(){
    var accion='fecha_inscripcion'; //Variable que guarda la acción que queramos hacer al realizar la petición
    //Petición
    $.post('acciones.php?accion='+accion,function(data){
        //Método que realiza diferentes acciones según la respuesta devuelta
        switch (data.trim()) {
            case 'ok': //Plazo inscripción abierto
                //document.getElementById("inscripcion").disabled = false;
                //$('#cuadro_inscripcion1').hide();
                //$('#cuadro_inscripcion2').hide();
                break;
            case 'ko1'://Plazo inscripción no abierto
                //document.getElementById("inscripcion").disabled = true;
                //$('#cuadro_inscripcion2').hide();
                break;
            case 'ko2'://Plazo inscripción cerrado
                //document.getElementById("inscripcion").disabled = true;
                //$('#cuadro_inscripcion1').hide();
                break;

        }
    });
}
//Función que al cargar el documento hace una petición para consultar los registros de la baase de datos y mostrarlos
$(document).ready(function() {
    fecha_inscripcion();
    var accion='consultar'; //Variable que guarda la acción que queramos hacer al realizar la petición
    var funcion='listar'; //Variable que recoge el nombre de la función
    //Función que realiza la petición y muestra los registros devueltos
    $('#example').DataTable({
        "ajax": {
            "url":"acciones.php?accion="+accion,
            "method": "POST",
            "data":{funcion:funcion}
        },
        "columns": [
            { "data": "nInscripcion" },
            { "data": "dni" },
            { "data": "fecha_nacimiento" },
            { "data": "nombre" },
            { "data": "apellidos" },
            { "data": "telefono" },
            { "data": "dorsal" },
            { "data": "id_idTallaCamiseta_Talla" },
            { "data": "id_idCategoria_Categoria" },
            { "data": "donacion_dorsal" },
            { "data": "acciones" },
        ],
        "language":es
    });

} );
//Registro de comentarios de la librería en español
let es = {
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %d fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
    },
    "decimal": ",",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
            "date": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "notBetween": "No entre",
                "notEmpty": "No Vacio",
                "not": "Diferente de"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacio",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "notBetween": "No entre",
                "notEmpty": "No vacío",
                "not": "Diferente de"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "notEmpty": "No Vacio",
                "startsWith": "Empieza con",
                "not": "Diferente de"
            },
            "array": {
                "not": "Diferente de",
                "equals": "Igual",
                "empty": "Vacío",
                "contains": "Contiene",
                "notEmpty": "No Vacío",
                "without": "Sin"
            }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d"
    },
    "select": {
        "cells": {
            "1": "1 celda seleccionada",
            "_": "%d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        },
        "rows": {
            "1": "1 fila seleccionada",
            "_": "%d filas seleccionadas"
        }
    },
    "thousands": ".",
    "datetime": {
        "previous": "Anterior",
        "next": "Proximo",
        "hours": "Horas",
        "minutes": "Minutos",
        "seconds": "Segundos",
        "unknown": "-",
        "amPm": [
            "AM",
            "PM"
        ],
        "months": {
            "0": "Enero",
            "1": "Febrero",
            "10": "Noviembre",
            "11": "Diciembre",
            "2": "Marzo",
            "3": "Abril",
            "4": "Mayo",
            "5": "Junio",
            "6": "Julio",
            "7": "Agosto",
            "8": "Septiembre",
            "9": "Octubre"
        },
        "weekdays": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ]
    },
    "editor": {
        "close": "Cerrar",
        "create": {
            "button": "Nuevo",
            "title": "Crear Nuevo Registro",
            "submit": "Crear"
        },
        "edit": {
            "button": "Editar",
            "title": "Editar Registro",
            "submit": "Actualizar"
        },
        "remove": {
            "button": "Eliminar",
            "title": "Eliminar Registro",
            "submit": "Eliminar",
            "confirm": {
                "_": "¿Está seguro que desea eliminar %d filas?",
                "1": "¿Está seguro que desea eliminar 1 fila?"
            }
        },
        "error": {
            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
        },
        "multi": {
            "title": "Múltiples Valores",
            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
            "restore": "Deshacer Cambios",
            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
        }
    },
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"


};

var i=0;//Inicialización de variable que usaremos para realizar la inserción dinámica
//Función que carga las tallas de las camisetas disponibles en el formulario
function formulario(){
    var accion='cargar_talla';
    $.ajax({url:'acciones.php?accion='+accion,success:function(data){
        //console.log(data)
        formulario2(JSON.parse(data));
    }});

};

//Función que contiene la estructura del formulario dinámico
function formulario2(data){
    console.log(data)
    let tabla='<table class="table mb-5" id="table'+i+'">' +
        '<tr class="borde">'+
        '<td></td>' +
        '<td></td>' +
        '<td></td>' +
        '<td>' ;
        if(i==0){
            tabla+=' '
        }else{
            tabla+='   <button type="button" name="remove" id="'+i+'" class=" btn btn-danger btn_remove float-end col-2 btn-sm m-3"><i class="bi bi-x-lg"></i></button>'
        }
        tabla+='</td>' +
        '</tr>'+
        '<tr>' +
        '<th>Nombre</th>\n' +
        '<th>Apellidos</th>\n' +
        '<th>DNI</th>\n' +
        '<th>Fecha Nacimiento</th>\n' +
        '</tr> '+
        '<tr class="borde">' +
        '<td ><input class="inscripcion" name="nombre[]" type="text"></td>\n' +
        '<td><input class="inscripcion" name="apellidos[]" type="text"></td>\n' +
        '<td><input class="inscripcion" name="dni[]" type="text"></td>\n' +
        '<td><input id="'+i+'" class="inscripcion fecha" name="fecha_nacimiento[]" type="date"></td>\n' +
        '</tr> '+
        '<tr>' +
        '<th>Teléfono</th>' +
        '<th>Dorsal</th>\n' +
        '<th>Donación dorsal</th>\n' +
        //'<th>Categoría</th>\n' +
        '<th>Talla Camiseta</th>\n' +
        '</tr> '+
        '<tr class="borde">' +
        '<td><input class="inscripcion" name="telefono[]" type="text"></td>' +
        '<td ><input class="inscripcion" name="dorsal[]" type="text"></td>\n' +
        '<td><input id="donacion'+i+'" class="inscripcion" name="donacion[]"  type="text"></td>\n' + //value="valor precio consulta sql categoria"
        //'<td>' + '<input type="text" name="categoria[]">'+ '</td>'+
        '<td>' +
        '<select class="inscripcion pt-1" name="talla[]">\n' +
        '\n' +
        '<option value="0" >No quiere camiseta</option>\n' ;
        for(let j=0; j<data.length; j++){
            tabla+='<option value='+j+'>'+data[j][1]+'</option>\n' ;
        }
        tabla+=
        '</select>' +
        '</td>\n' +
        '</tr> ' +
        '</table>'
    i++
    $('#dynamic_field').append(tabla);
    //Función que elimina la tabla sleccionada del formulario
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");//Método que guarda el id seleccionado
        $('#table'+button_id+'').remove();//Métodopara eliminar elemento
    });
    //Función que averigua el precio del dorsal al perder el foco en la fecha
    $(document).on('blur', '.fecha', function(){
        var accion='precio_dorsal';//Variable que guarda la acción que queramos hacer al realizar la petición
        var str=$("#formulario").serialize();//Variable que guarda los datos del formulario
        var fecha_id = $(this).attr("id");//Método que guarda el id seleccionado
        //Petición
        $.post('acciones.php?accion='+accion+'&fecha_id='+fecha_id,str,function(data){
            var precio=data;
            $('#donacion'+fecha_id+'').attr("value",precio); //Método que añade valor al elemento selecionado
            $('#donacion'+fecha_id+'').attr("placeholder","Indique el importe (mínimo "+precio+"€)"); //Método que añade placeholder al elemento selecionado
        });
    })
}
//Función que muestra el formulario de registro de inscripciones
function mostrarInsertar() {
    var accion='mostrar_insertar';//Variable que guarda la acción que queramos hacer al realizar la petición
    //Petición
    $.post('acciones.php?accion='+accion,function(data){
        $('#mostrarInsertar').html(data);
        $(formulario()).html(data);
        $('.btn_remove').css('display','none');
        $('#add').click(function(){
            formulario();
        });
        $('#mostrarInsertar').css('display','block');
        $('#tabla').css('display','none');
        $('#editar').css('display','none');
    });
}
//Función que carga el cuadro de diálogo de los términos
function terminos(){
    var accion='terminos';//Variable que guarda la acción que queramos hacer al realizar la petición
    //Petición
    $.post('acciones.php?accion='+accion,function(data){
            $('#cuadroTerminos').html(data);
            $('#cuadroTerminos').css('display','block');
    });
}
//Función que oculta el cuadro de mensaje de términos
function ocultarTerminos(){
    $('#cuadroTerminos').css('display','none');
}
//Función que muestra un cuadro de mensaje con el total del precio de la compra
function totalCompra(){
    var accion='total_compra';//Variable que guarda la acción que queramos hacer al realizar la petición
    var str = $("#formulario").serialize();//Variable que guarda los datos del formulario
    //Petición
    $.post('acciones.php?accion='+accion,str,function(data){
        //Condición que realiza diferentes acciones según la respuesta devuelta
        if(data.trim()==='ko'){//Precio incorrecto
            alert("El importe de la donación no puede ser menor al precio del dorsal")
        }else{//Precio correcto
            $('#cuadroTramitar').html(data);
            $('#cuadroTramitar').css('display','block');
        }
    });
}
//Función que oculta el cuadro de mensaje de confirmación de inscripciones si pulsa "volver"
function seguirComprando(){
    $('#cuadroTramitar').css('display','none');
}
//Función que realiza la petición para el registro de inscripciones
function insertar() {
    var accion='insertar'; //Variable que guarda la acción que queramos hacer al realizar la petición
    var str = $("#formulario").serialize(); //Variable que guarda los datos del formulario
    //Petición
    $.post('acciones.php?accion='+accion,str,function(data){
        var condiciones = $("#aceptar").is(":checked"); //Comprobación del campo check marcado
        //Condición que realiza diferentes acciones según la respuesta devuelta
        if(data.trim()==='no'){//Importe de donación menor al establecido
            alert("El importe de donación no puede ser menor al precio del dorsal")
        }else{
            if (!condiciones) {//Condiciones no aceptadas
                alert("Debe aceptar las condiciones");
            }else{
                if(data.trim()==='ko'){//Error consulta
                    alert("El  dorsal ya está asignado a un registro de inscripción");
                }else{//Consulta correcta
                    $('#cuadroTramitar').css('display','none');
                    $('#tabla').css('display','block');
                    location.reload();
                }
            }
        }

    });
}
//Función que muestra el formulario de edición de inscripciones
function mostrarEditar(id){
    var accion='mostrar_editar'; //Variable que guarda la acción que queramos hacer al realizar la petición
    //Petición
    $.post('acciones.php?id='+id+'&accion='+accion,function(data){
        $('#editar').html(data);
        $('#editar').css('display','block');
        $('#tabla').css('display','none');
    });
}
//Función que valida la edición de inscripciones
function validarEditar(id){
    $("#submitenviar").validate({
        rules: {
            nombre : {
                required: true,
                minlength: 3,
                lettersonly: true
            },
            apellidos : {
                required: true,
                minlength: 3,
                lettersonly: true
            },
            telefono:{
                required: true,
                maxlength: 9,
                isMobile: true
            },
            fecha_nacimiento:{
                required: true,
            },
            dorsal:{
                required: true,
                dorsal: true
            },
            dni:{
                required: true,
                dni: true
            },

        },
        messages : {
            nombre: {
                required:"*Campo obligatorio",
                minlength: "El nombre debe tener al menos 3 caracteres",
                lettersonly:"*Sólo puede contener letras"
            },
            apellidos: {
                required:"*Campo obligatorio",
                minlength: "El nombre debe tener al menos 3 caracteres",
                lettersonly:"*Sólo puede contener letras"
            },
            telefono: {
                required: "*Campo obligatorio",
                maxlength: "¡El número de teléfono móvil no puede superar los 9 dígitos!",
                isMobile: "El formato del teléfono debe contener 9 dígitos, el primero debe comenzar por 6 ó 7"
            },
            dni:{
                required: "*Campo obligatorio",
                dni: "*Introduzca un formato correcto para el dni"
            },
            fecha_nacimiento:{
                required: "*Campo obligatorio",
            },
            dorsal:{
                required: "*Campo obligatorio",
                dorsal: "*Sólo números"
            }
        //Función que realiza una acción si la validación es correcta
        },submitHandler: function() {
            editar(id);
        }
    });
    //Validaciones personalizadas que no entran dentro de la librería
    jQuery.validator
        .addMethod(
            "isMobile",
            function(value, element) {
                var length = value.length;
                var mobile = /^[6-7][0-9]{8}$/;
                return this.optional(element) || (length == 9 && mobile
                    .test(value));
            }, "El formato del teléfono debe contener 9 dígitos, el primero debe comenzar por 6 ó 7");

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        var lettersonly = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
        return this.optional(element) || lettersonly.test(value);
    }, "*Sólo letras");

    jQuery.validator.addMethod("dni", function(value, element) {
        var dni =  /((([X-Z])|([LM])){1}([-]?)((\d){7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]))/;
        return this.optional(element) || dni.test(value);
    }, "*Introduzca un formato correcto para el dni");

    jQuery.validator.addMethod("dorsal", function(value, element) {
        var dorsal = /^([0-9])*$/;
        return this.optional(element) || dorsal.test(value);
    }, "*Sólo números");
}
//Función que realiza la petición para la edición de inscripciones
function editar(id){
    var accion='editar'; //Variable que guarda la acción que queramos hacer al realizar la petición
    var str = $("#submitenviar").serialize(); //Variable que guarda los datos del formulario
    //Petición
    $.post('acciones.php?id='+id+'&accion='+accion,str,function(data){
        //Condición que realiza diferentes acciones según la respuesta devuelta
        if(data.trim()==='ko'){ //Error consulta
            alert("Ha habido un error al realizar la petición solicitada intentelo de nuevo");
        }else{//Consulta correcta
            $('#editar').css('display','none');
            location.reload();
        }
    });
}

