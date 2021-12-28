$(document).ready(function(){
    tablaNodos = $("#tablaNodos").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formNodos").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Nodo");
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    node_id= fila.find('td:eq(1)').text();
    alias = fila.find('td:eq(2)').text();
    min_light_needed = parseInt(fila.find('td:eq(3)').text());
    water_needed = parseFloat(fila.find('td:eq(4)').text());
    max_temperature = parseInt(fila.find('td:eq(5)').text());
    min_temperature = parseInt(fila.find('td:eq(6)').text());

    $("#node_id").val(node_id);
    $("#alias").val(alias);
    $("#min_light_needed").val(min_light_needed);
    $("#water_needed").val(water_needed);
    $("#max_temperature").val(max_temperature);
    $("#min_temperature").val(min_temperature);
    opcion = 2; //editar
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Nodos");
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaNodos.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formNodos").submit(function(e){
    e.preventDefault();    
    node_id = $.trim($("#node_id").val());
    alias = $.trim($("#alias").val());
    min_light_needed = $.trim($("#min_light_needed").val());
    water_needed = $.trim($("#water_needed").val());
    max_temperature = $.trim($("#max_temperature").val());
    min_temperature = $.trim($("#min_temperature").val());
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {
            node_id:node_id,
            alias:alias,
            min_light_needed:min_light_needed,
            water_needed:water_needed,
            max_temperature:max_temperature,
            min_temperature:min_temperature,
            id:id,
            opcion:opcion
        },
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            node_id = data[0].node_id;
            alias = data[0].alias;
            min_light_needed = data[0].min_light_needed;
            water_needed = data[0].water_needed;
            max_temperature = data[0].max_temperature;
            min_temperature = data[0].min_temperature;
            if(opcion == 1){tablaNodos.row.add([id,node_id,alias,min_light_needed,water_needed,max_temperature,min_temperature]).draw();}
            else{tablaNodos.row(fila).data([id,node_id,alias,min_light_needed,water_needed,max_temperature,min_temperature]).draw();}
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});