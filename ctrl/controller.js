

$(function(){
    guardar_curso();
    listar_curso("curso");
});
  
       
function guardar_curso()
{
    var v_action="registrar";
   $('#btnguardar').click(function(){
        
       var nombre= $('#nombre').val();
       var descripcion=$('#descripcion').val();
       var iddocente=1; // el id debe capturarse cuando se inicie el login
      // console.log("nombre"+nombre+", "+"descripcion"+descripcion);
       $.ajax({
        type: "POST",
        url: "../ctrl/controlador_curso.php",
        data:	{
            action: v_action,
            nombre:nombre,
            descripcion:descripcion,
            docente_iddocente:iddocente
            
        },
        dataType: 'text', 
        beforeSend: function() { 
            $('#btnguardar').val("Guardando...");
        },
        success: function(data){
            $('#btnguardar').val("Guardar");
            if(data){
               
                $('#resultado').removeClass('hidden');
            }
            
        }
        
        });
   });
}

function listar_curso(v_nombre_tabla)
{
     //event.preventDefault();
    var v_action = "listar";
    //cargar el controlador de la respectiva tabla
    var v_controlador ="../ctrl/controlador_"+v_nombre_tabla+".php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            nombre_tabla:v_nombre_tabla
        },
        dataType: 'text', 
        beforeSend: function() { 
         console.log("v_nombre_tabla: " + v_nombre_tabla + "v_accion: "+v_action+", v_controlador: "+v_controlador);
        },
        success: function(data)
        {
            console.log("!! successsss   !!");
            console.log("data  "+data);
            
            if(data !== null)
            {
           var $log = $( "#area_data" ),
          str = data,
          html = $.parseHTML( str );
          

        // Append the parsed HTML
        $log.append( html );

        // Gather the parsed HTML's node names
        
                
                   
            }
        },
        error: function( jqXHR, textStatus, errorThrown ) 
        {
            if (jqXHR.status === 0) { alert('Not connect: Verify Network.');  } 
            else if (jqXHR.status == 404) { alert('Requested page not found [404]'); } 
                 else if (jqXHR.status == 500) { alert('Internal Server Error [500].');  } 
                      else if (textStatus === 'parsererror') {	alert('Requested JSON parse failed.');  } 
                           else if (textStatus === 'timeout') {alert('Time out error.');  } 
                                 else if (textStatus === 'abort') { alert('Ajax request aborted.');  } 
                                      else { alert('Uncaught Error: ' + jqXHR.responseText); 	}
        },
        complete: function() 
        {
                //$('#ajax-loader').hide();
        }
    });

}
function eliminar_curso()
{
    
}
function modificar_curso()
{
    
}
   




//esto es lo que falta hacer
//metodo entre diferenciar entre actualizar y registrar
//listar los cursos
//metodo eliminar
//adicionar variables de secion

