<!--
    Alumno: Marta Broncano Suárez
    Asignatura: Proyecto San Romilla
    Curso: 20-21
    Descripción: funciones para gestionar el crudo
-->
function guardar(){

    var dni= document.getElementById("dni").value;
    var fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
    var fecha= document.getElementById("anio").value;
    var nombre= document.getElementById("nombre").value;
    var apellidos= document.getElementById("apellidos").value;
    var telefono= document.getElementById("telefono").value;
    var dorsal = document.getElementById("dorsal").value;
    var id_idCategoria_Categoria = document.getElementById("id_idCategoria_Categoria").value;
    // alert(fecha2);

    $.ajax({
        url: "Guardar.php",
        type: "post",
        // dataType: "json",
        data:  "&codOMDB= "+codpelicula+ "&titulo= "+titulo+  "&anio= "+anio+ "&duracion= "
            +duracion+ "&pais= "+pais+ "&director= "+director+ "&guion= "+guion+  "&productor= "
            +productor+ "&genero= "+genero+ "&portada= "+titulo+".jpg"+ "&sinopsis= "
            +sinopsis+ "&fecha= "+fecha2,
        success:  function (datos) {
            if (datos == 'bien') {
                alert("Añadido");
                portada(titulo);
            } else {
                alert("esta mal");
                alert(datos);
            }
        }
    })
}