
$(function()
{
     $(".modal").modal();
     $(".button-collapse").sideNav();
     
     $('select').material_select();
     $('.datepicker').pickadate({
          selectMonths: true, // Creates a dropdown to control month
          selectYears: 100, // Creates a dropdown of 15 years to control year,
          today: 'Hoy',
          clear: 'Eliminar',
          close: 'Listo',
          closeOnSelect: false // Close upon selecting a date,
      });

/////////////// metodos de la tabla estudiante /////////////   

     
  $('.li_estudiante').click(function(){
         $('.li_estudiante').sideNav('hide');
        listar("estudiante");
        console.log("voy a cargar el form_estudiante.html");
        $("#mostrar_datos").load('../vista/form_estudiante.html');
   });

    
    $('#btn_agregar_estudiante').click(function(){
      
      vaciar_cajas_estudiante();
      $('#titulo_editar').addClass('hide');
      $('#titulo_registrar').removeClass('hide');
      $('#resultado').addClass('hide');
      
        
    });

    $('#btn_guardar_estudiante').click(function(){
        guardar_estudiante();
        vaciar_cajas_estudiante()
       
    });
///////////// ////////////////// fin metodos de la tabla estudiante  /////////////////////////////////////////////////////////////

   
///////////// ////////////////// medotos de la tabla Docente  /////////////////////////////////////////////////////////////
    $('.li_docente').click(function(){
       $('.li_docente').sideNav('hide');
       listar("docente");
       console.log("voy a cargar el form_docente.html");
       $("#mostrar_datos").load('../vista/form_docente.html');
  });
//   
   
   $('#btn_agregar_docente').click(function(){
       vaciar_cajas_docente();
       $('#titulo_editar').addClass('hide');
       $('#titulo_registrar').removeClass('hide');
       $('#resultado').addClass('hide');
   });
   
   $('#btn_guardar_docente').click(function(){
       guardar_docente();
       vaciar_cajas_docente();
       
   });

//////////////////////////////// fin metodos de la tabla docente //////////////////////////////////////////// 



//////////////////////////////// metodos de la tabla curso ////////////////////////////////////////////  




$('.li_curso').click(function(){
    listar("curso");
    console.log("voy a cargar el form_curso.html");
    $("#mostrar_datos").load('../vista/form_curso.html');
});
$('#btn_agregar_curso').click(function(){
  $('#cont_ver_imagen').addClass('hide');

});

$('#btn_agregar_curso').one('click',function(){
  llenar_combo_tablas("curso",1);

  
});
$('#btn_guardar_curso').click(function(){
       guardar_curso();
       vaciar_cajas_curso();
       llenar_combo_tablas("curso",1,"");

       
});



 /*$('#li_curso').click(function(){
       
       console.log("voy a cargar el form_curso.html");
       $("#mostrar_datos").load('vista/form_curso.html');
  });


   */

/*metodos de estudiante curso2*/


    
  $('#btn_guardar_estudiante_curso2').click(function(){
      
         guardar_estudiante_curso2();
         vaciar_cajas_estudiante_curso2();
       
   });










//////////////////////////////// fin metodos de la tabla curso //////////////////////////////////////////// 



//////////////////////////////// metodos de la tabla estudiante_curso //////////////////////////////////////////// 

  
   $('.li_estudiante_curso').click(function(){
        listar("estudiante_curso");
        console.log("voy a cargar el form_estudiante_curso.html");
        $("#mostrar_datos").load('../vista/form_estudiante_curso.html');
   });

   $('#btn_guardar_estudiante_curso').click(function(){
       guardar_estudiante_curso();
       
   });

   $('#btn_agregar_estudiante_curso').one('click',function(){
       llenar_combo_tablas("estudiante_curso",1,"");
       llenar_combo_tablas("estudiante_curso",2,"");
        
       
   });

   

//////////////////////////////// fin metodos de la tabla estudiante_curso //////////////////////////////////////////// 
    
//   

//   
//   $('#li_reportes').click(function(){
//       
//        console.log("voy a cargar la vista de reportes.html");
//         reporte_total_estudiantesxcurso();
//        $("#mostrar_datos").load('vista/vista_reportes.html');
//       
//   });
//   
//    

//    

    
//    


//    
    });

function vaciar_cajas_curso(){
    $('#idcurso').val("");
    $('#nombre_curso').val("");
    $('#descripcion').val("");
    
    
}
function vaciar_cajas_docente(){
      $('#iddocente').val("");
      $('#nombre_docente').val("");
      $('#apellido_docente').val("");
      $('#correo_docente').val(""); 
      $('#fechaNacimiento_docente').val("");
      $('#licenciatura').val("");
      $('#idusuario_docente').val("");
      document.getElementById("sexo_docente").innerHTML= "<option disabled selected>Sexo</option><option value='1' data-icon='../imagenes/male.png' class='left circle'>Hombre</option><option value='2' data-icon='../imagenes/female.png' class='left circle'>Mujer</option>";
      $('select').material_select();
}
function vaciar_cajas_estudiante(){
      $('#idestudiante').val("");
      $('#nombre_estudiante').val("");
      $('#apellido_estudiante').val("");
      $('#correo_estudiante').val(""); 
      $('#fechaNacimiento_estudiante').val("");
      $('#idusuario_estudiante').val("");
      document.getElementById("sexo_estudiante").innerHTML= "<option disabled selected>Sexo</option><option value='1' data-icon='../imagenes/male.png' class='left circle'>Hombre</option><option value='2' data-icon='../imagenes/female.png' class='left circle'>Mujer</option>";
      document.getElementById("estado").innerHTML= "<option disabled selected>Estado</option><option value='1' data-icon='../imagenes/retirado.png' class='left circle'>Retirado</option><option value='2' data-icon='../imagenes/estudiante.png' class='left circle'>Activo</option><option value='3' data-icon='../imagenes/egresado.png' class='left circle'>Egresado</option>";
      $('select').material_select();
    
}

function vaciar_cajas_estudiante_curso2(){
  $('idestudiante_curso2').val("");
  $('idcurso2').val("");
  llenar_combo_tablas("estudiante_curso",3,"");
  $('select').material_select();
  document.getElementById("estado_estudiante_curso2").innerHTML= "<option disabled selected>Estado del estudiante</option><option value='2' data-icon='../imagenes/cursando.png' class='left circle'>Cursando</option><option value='3' data-icon='../imagenes/terminado.png' class='left circle'>Terminado</option>";

}






 
       
function guardar_curso()
{
   
    var v_action="";
   
    
      if($('#idcurso').val().length<1)  //Se lega por modificación de cliente
    {
        
        console.log("\nSe registrara el curso : " + idcurso );
        v_action="registrar";
       
    }
    else{
        console.log("se actualizara el curso"+idcurso)
        v_action = "actualizar"; 
    }
    var datos= new FormData($('#frm_curso')[0]);
    datos.append("action",v_action);

     
        
       /*var idcurso=$('#idcurso').val();
       var nombre= $('#nombre_curso').val();
       var descripcion=$('#descripcion').val();
       var iddocente=$('#combo_curso').val(); 
       
       console.log("nombre: "+nombre+" descripcion: "+descripcion+" iddocente: "+iddocente);*/
       $.ajax({
        type: "POST",
        url: "../ctrl/controlador_curso.php",
        data:	datos,
        contentType:false,
        processData:false, 
        beforeSend: function(data) { 
            console.log("data enviada..."+data);
            
        },
        success: function(data){
            
            //console.log("data :"+data);
            if(data){
               
                
            }

             listar("curso"); 
            
        }
        
        });
   
  

}

function guardar_estudiante_curso()
{
   
    var v_action="";
   
    
      if($('#idestudiante_curso').val().length<1)  //Se lega por modificación de cliente
    {
        
        console.log("\nSe registrara  : "  );
        v_action="registrar";
       
    }
    else{
        console.log("se actualizara");
        v_action = "actualizar"; 
    }
     
        
       var idestudiante_curso=$('#idestudiante_curso').val();
       var combo= $('#combo_estudiante_curso').val();
       var combo2=$('#combo2_estudiante_curso').val();
       var estado=$('#estado_estudiante_curso').val(); 
       
       console.log("idestudiante "+idestudiante_curso+" combo_estudiante: "+combo+" combo_curso: "+combo2+" estado: "+estado);
       $.ajax({
        type: "POST",
        url: "../ctrl/controlador_estudiante_curso.php",
        data:	{
            action: v_action,
            idestudiante_curso:idestudiante_curso,
            estudiante_idestudiante:combo,
            curso_idcurso:combo2,
            estado:estado
            
        },
        dataType: 'text', 
        beforeSend: function(data) { 
            console.log("data enviada..."+data);
            
        },
        success: function(data){
            
            console.log("data :"+data);
            if(data){
               
               
            }

             listar("estudiante_curso"); 
            
        }
        
        });
   
  

}




function guardar_estudiante_curso2()
{
   
   
    var v_action="";
   
    
      if($('#idestudiante_curso2').val().length<1)  //Se lega por modificación de cliente
    {
        
        console.log("\nSe registrara  : "  );
        v_action="registrar";
       
    }
    else{
        console.log("se actualizara");
        v_action = "actualizar"; 
    }
     
        
       var idestudiante_curso=$('#idestudiante_curso2').val();
       var combo= $('#combo3_estudiante_curso').val();
       var combo2=$('#idcurso2').val();
       var estado=$('#estado_estudiante_curso2').val(); 
       
       console.log("idestudiante "+idestudiante_curso+" combo_estudiante: "+combo+" combo_curso: "+combo2+" estado: "+estado);
       $.ajax({
        type: "POST",
        url: "../ctrl/controlador_estudiante_curso.php",
        data:	{
            action: v_action,
            idestudiante_curso:idestudiante_curso,
            estudiante_idestudiante:combo,
            curso_idcurso:combo2,
            estado:estado
            
        },
        dataType: 'text', 
        beforeSend: function(data) { 
            console.log("data enviada..."+data);
            
        },
        success: function(data){
            
            console.log("data :"+data);
            if(data){
               
               
            }

            listar_estudiantes(combo2); 
            
        }
        
        });
   
  

}

function eliminar_estudiante_curso2(id,idcurso)
{
    var v_action = "eliminar";
    
    //cargar el controlador de la respectiva tabla
    var v_controlador ="../ctrl/controlador_estudiante_curso.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            idestudiante_curso:id
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
           
        },
        success: function(data)
        {
            console.log("\n!! Se eliminó el campo : " + data);
           
            alert("!!! El campo ha sido eliminado !!!"); 
            
            
            listar_estudiantes(idcurso);  //llamo mevamente a esta funcion para que actualice el listado de clientes
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

function modificar_estudiante_curso2(id)
{
    
    
    var v_action = "editar";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="../ctrl/controlador_estudiante_curso.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            idestudiante_curso:id
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
        },
        success: function(data)
        {
       console.log("\n!! vamos a cargar los datos del cliente !!"+data);
             llenar_combo_tablas("estudiante_curso",3,"editar");
             
            var estudiante_curso=JSON.parse(data); 
            console.log("curso_"+estudiante_curso);
            document.getElementById("idestudiante_curso2").value = estudiante_curso['idestudiante_curso'];
            document.getElementById("estado_estudiante_curso2").innerHTML = estudiante_curso['estado'];
            document.getElementById("combo3_estudiante_curso").innerHTML = estudiante_curso['idestudiante'];
           
           
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
function guardar_docente()
{
   
    var v_action="";
   
    
      if($('#iddocente').val().length<1)  //Se lega por modificación de cliente
    {
        
        console.log("\nSe registrara el docente  ");
        v_action="registrar";
       
    }
    else{
        console.log("se actualizara el docente");
        v_action = "actualizar"; 
    }
     
        
       var iddocente=$('#iddocente').val();
       var nombre= $('#nombre_docente').val();
       var apellido=$('#apellido_docente').val();
       var correo=$('#correo_docente').val(); 
       var fechaNacimiento=$('#fechaNacimiento_docente').val();
       var sexo=$('#sexo_docente').val();
       var licenciatura=$('#licenciatura').val();
       var usuario=$('#idusuario_docente').val();
       
       console.log("nombre: "+nombre+" apellido: "+apellido+" correo: "
               +correo+" fechaNacimiento: "+fechaNacimiento+" sexo: "
               +sexo+" licenciatura: "+licenciatura+" usuario: "+usuario);
       $.ajax({
        type: "POST",
        url: "../ctrl/controlador_docente.php",
        data:	{
            action: v_action,
            iddocente:iddocente,
            nombre:nombre,
            apellido:apellido,
            correo:correo,
            fechaNacimiento:fechaNacimiento,
            sexo:sexo,
            licenciatura:licenciatura,
            usuario_idusuario:usuario
            
        },
        dataType: 'text', 
        beforeSend: function(data) { 
            console.log("data enviada..."+data);
            
        },
        success: function(data){
            console.log("data :"+data);
            if(data){
               
                $('#resultado').removeClass('hide');
            }

             listar("docente"); 
            
        }
        
        });
   
  

}
function guardar_estudiante()
{
   
    var v_action="";
   
    
      if($('#idestudiante').val().length<1)  //Se lega por modificación de cliente
    {
        
        console.log("\nSe registrara el estudiante ");
        v_action="registrar";
       
    }
    else{
        console.log("se actualizara el estudiante");
        v_action = "actualizar"; 
    }
     
        
       var idestudiante=$('#idestudiante').val();
       var nombre= $('#nombre_estudiante').val();
       var apellido=$('#apellido_estudiante').val();
       var correo=$('#correo_estudiante').val(); 
       var fechaNacimiento=$('#fechaNacimiento_estudiante').val();
       var sexo=$('#sexo_estudiante').val();
       var estado=$('#estado').val();
       var usuario=$('#idusuario_estudiante').val();
       
       console.log("nombre: "+nombre+" apellido: "+apellido+" correo: "
               +correo+" fechaNacimiento: "+fechaNacimiento+" sexo: "
               +sexo+" licenciatura: "+estado+" usuario: "+usuario);
       $.ajax({
        type: "POST",
        url: "../ctrl/controlador_estudiante.php",
        data:	{
            action: v_action,
            idestudiante:idestudiante,
            nombre:nombre,
            apellido:apellido,
            correo:correo,
            fechaNacimiento:fechaNacimiento,
            sexo:sexo,
            estado:estado,
            usuario_idusuario:usuario
            
        },
        dataType: 'text', 
        beforeSend: function(data) { 
            console.log("data enviada..."+data);
            
        },
        success: function(data){
          
            console.log("data :"+data);
            if(data){
               
                $('#resultado').removeClass('hide');
            }

             listar("estudiante"); 
            
        }
        
        });
   
  

}


function listar(v_nombre_tabla)
{
     
    var v_action = "listar";
    //cargar el controlador de la respectiva tabla
    //var v_controlador ="../ctrl/controlador_"+v_nombre_tabla+".php";
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
           // console.log("!! successsss   !!"+ data);
           
            
            if(data !== null)
            {
                
                
               $('#area_data_'+v_nombre_tabla).text('');
           var $log = $( "#area_data_"+v_nombre_tabla ),
          str = data,
          html = $.parseHTML( str );
          
        $log.append( html );
        $('.collapsible').collapsible();

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
function eliminar_curso(id,ruta_imagen)
{
    var v_action = "eliminar";
    
    //cargar el controlador de la respectiva tabla
    var v_controlador ="../ctrl/controlador_curso.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            idcurso:id,
            ruta_imagen:ruta_imagen
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
           
        },
        success: function(data)
        {
            console.log("\n!! Se eliminó el curso : " + data);
           
            alert("!!! El curso ha sido eliminado !!!");    
            listar("curso"); //llamo mevamente a esta funcion para que actualice el listado de clientes
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
function eliminar_estudiante_curso(id)
{
    var v_action = "eliminar";
    
    //cargar el controlador de la respectiva tabla
    var v_controlador ="../ctrl/controlador_estudiante_curso.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            idestudiante_curso:id
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
           
        },
        success: function(data)
        {
            console.log("\n!! Se eliminó el campo : " + data);
           
            alert("!!! El campo ha sido eliminado !!!");    
            listar("estudiante_curso"); //llamo mevamente a esta funcion para que actualice el listado de clientes
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
function eliminar_estudiante(id)
{
    var v_action = "eliminar";
    
    //cargar el controlador de la respectiva tabla
    var v_controlador ="../ctrl/controlador_estudiante.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            idestudiante:id
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
           
        },
        success: function(data)
        {
            console.log("\n!! Se eliminó el estudiante : " + data);
           
            alert("!!! El estudiante ha sido eliminado !!!");    
            listar("estudiante"); //llamo mevamente a esta funcion para que actualice el listado de clientes
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
function eliminar_docente(id)
{
    var v_action = "eliminar";
    
    //cargar el controlador de la respectiva tabla
    var v_controlador ="../ctrl/controlador_docente.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            iddocente:id
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
           
        },
        success: function(data)
        {
            console.log("\n!! Se eliminó el docente : " + data);
           
            alert("!!! El docente ha sido eliminado !!!");    
            listar("docente"); //llamo mevamente a esta funcion para que actualice el listado de clientes
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

function modificar_curso(id)
{
    $('#cont_ver_imagen').removeClass('hide');
        
    var v_action = "editar";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="../ctrl/controlador_curso.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            idcurso:id
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
        },
        success: function(data)
        {
       console.log("\n!! vamos a cargar los datos del cliente !!"+data);
             llenar_combo_tablas("curso",1,"editar");
            var curso=JSON.parse(data); 
            console.log("curso_"+curso);
            document.getElementById("idcurso").value = curso['idcurso'];
            document.getElementById("nombre_curso").value = curso['nombre'];
            document.getElementById("descripcion").value = curso['descripcion'];
            document.getElementById("combo_curso").innerHTML= curso['iddocente'];
            document.getElementById("ver_imagen").innerHTML= curso['ruta_imagen'];
            document.getElementById("ruta_imagen_tmp").value= curso['ruta_imagen_tmp'];

           
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

function modificar_estudiante_curso(id)
{
    
    
    var v_action = "editar";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="../ctrl/controlador_estudiante_curso.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            idestudiante_curso:id
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
        },
        success: function(data)
        {
       console.log("\n!! vamos a cargar los datos del cliente !!"+data);
             llenar_combo_tablas("estudiante_curso",1,"editar");
             llenar_combo_tablas("estudiante_curso",2,"editar");
             
            var estudiante_curso=JSON.parse(data); 
            console.log("curso_"+estudiante_curso);
            document.getElementById("idestudiante_curso").value = estudiante_curso['idestudiante_curso'];
            document.getElementById("estado_estudiante_curso").innerHTML = estudiante_curso['estado'];
            document.getElementById("combo_estudiante_curso").innerHTML = estudiante_curso['idestudiante'];
            document.getElementById("combo2_estudiante_curso").innerHTML= estudiante_curso['idcurso'];
           
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


function listar_estudiantes(id)
{
    
    
    var v_action = "listar_estudiantes";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="../ctrl/controlador_estudiante_curso.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            curso_idcurso:id
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
        },
        success: function(data)
        {
       console.log("\n!! vamos a cargar los datos del cliente !!"+data);
             
             
           if(data !== null)
            {
                
                
               $('#lista_estudiantes'+id).text('');
           var $log = $( "#lista_estudiantes"+id),
          str = data,
          html = $.parseHTML( str );
          
        $log.append( html );
        

        // Gather the parsed HTML's node names
             
            }else{
                $('#lista_estudiantes'+id).text('');
                 var $log = $( "#lista_estudiantes"+id ),
          str = "<div class='alert alert-success'><p>no hay estudiantes registrados</p></div>",
          html = $.parseHTML( str );
          
        $log.append( html );
                
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
function cargar_curso_input(id)
{
   
    
    var v_action = "editar";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="../ctrl/controlador_curso.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            idcurso:id
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
        },
        success: function(data)
        {
       console.log("\n!! vamos a cargar los datos del cliente !!"+data);
            
             
            var curso=JSON.parse(data); 
            console.log("curso_"+curso);
            document.getElementById("idcurso2").value = curso['idcurso'];
           
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


function modificar_docente(id)
{
    $('#titulo_registrar').addClass('hide');
    $('#titulo_editar').removeClass('hide');
    $('#resultado').addClass('hide');
    
    var v_action = "editar";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="../ctrl/controlador_docente.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            iddocente:id
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
        },
        success: function(data)
        {
            console.log("\n!! vamos a cargar los datos del docente !!"+data);
            var docente=JSON.parse(data);   
            console.log('docente: '+docente);
            document.getElementById("iddocente").value = docente['iddocente'];
            document.getElementById("nombre_docente").value = docente['nombre'];
            document.getElementById("apellido_docente").value = docente['apellido'];
            document.getElementById("correo_docente").value = docente['correo'];
            document.getElementById("fechaNacimiento_docente").value = docente['fechaNacimiento'];
            document.getElementById("sexo_docente").innerHTML= docente['sexo'];
            document.getElementById("licenciatura").value = docente['licenciatura'];
            document.getElementById("idusuario_docente").value = docente['idusuario'];
            $('select').material_select();
           
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
function modificar_estudiante(id)
{
    $('#titulo_registrar').addClass('hide');
    $('#titulo_editar').removeClass('hide');
    $('#resultado').addClass('hide');
     
    var v_action = "editar";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="../ctrl/controlador_estudiante.php";
    $.ajax({
        type: "POST",
        url: v_controlador,
        data:	{
            action: v_action,
            idestudiante:id
        },
        dataType: 'text', 
        beforeSend: function(x) { 
            console.log("\nv_accion: "+v_action);
        },
        success: function(data)
        {
            console.log("\n!! vamos a cargar los datos del estudiante !!"+data);
            var estudiante=JSON.parse(data);   
            console.log('estudiante: '+estudiante);
            document.getElementById("idestudiante").value = estudiante['idestudiante'];
            document.getElementById("nombre_estudiante").value = estudiante['nombre'];
            document.getElementById("apellido_estudiante").value = estudiante['apellido'];
            document.getElementById("correo_estudiante").value = estudiante['correo'];
            document.getElementById("fechaNacimiento_estudiante").value = estudiante['fechaNacimiento'];
            document.getElementById("sexo_estudiante").innerHTML= estudiante['sexo'];
            document.getElementById("estado").innerHTML= estudiante['estado'];
            document.getElementById("idusuario_estudiante").value = estudiante['idusuario'];
            $('select').material_select();
            
           
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


function llenar_combo_tablas(v_tabla,op,metodo)

{

	alert ("Se va a cargar el listbox de la tabla : " + v_tabla);
	var v_accion="cargar_listbox";
        var opcion=op;
	$.ajax({
		type: "POST",
		url: "../ctrl/controlador_"+v_tabla+".php",
		data:	{
                        action:v_accion,
                        tabla:v_tabla,
                        op:op,
                        metodo:metodo,
                                      
				},
		dataType: 'text', 
		beforeSend: function(x)
		{
		   console.log("envio : " + v_accion + ", tabla : " + v_tabla);
		},
		success: function(data)
		{
			console.log("valores regresados desde php : " + data);		
			if(data != null)

			{
			   if(opcion==2){
               $('#combo2_'+v_tabla).append(data);
               $('select').material_select();
           }
           else if(opcion==1){

            $('#combo_'+v_tabla).append(data);
            $('select').material_select();

            }
            else if(opcion==3){
                $('#combo3_'+v_tabla).html(data);
                $('select').material_select();
            }
                            
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


function  reporte_total_estudiantesxcurso()
{
	console.log("Se cargará el reporte de Total facturas x cliente");
	sql="select c.nombre curso, count(ec.estudiante_idestudiante) total_estudiantes from estudiante_curso ec inner join curso c on ec.curso_idcurso=c.idcurso group by c.nombre";
	alert("Se ejecutará la consulta : " + sql);
	tit="total nuemero de estudiantes por curso";
	drawChart_pie(tit,sql,"1");
}

function drawChart_pie(tit_reporte,v_sql,id_rep) 
{
	alert ("\nTitulo : " + tit_reporte + "\nv_sql : " + v_sql + "\nid_rep : " + id_rep);
	$.ajax({
		type: "POST",
		url: "ctrl/reporte.php",
		data:	{sql:v_sql},
		dataType: 'json', 
		beforeSend: function(x)
		{
		   //$('#ajax-loader').show();
		   console.log("\nenvio : \n" + v_sql);
		},
		success: function(jsonData)
		{  
                    console.log(" "+jsonData)
			if(jsonData != null)
			{
				console.log(JSON.stringify(jsonData));
				// Create our data table out of JSON data loaded from server., dataGrafico esta definida globalmente
				dataGrafico = new google.visualization.DataTable(jsonData);
				/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//  Primero configuramos los encabezados, es decir los nombres de los campos del select   //
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				dataGrafico.addColumn("string","curso");
				dataGrafico.addColumn("number","numero estudiantes");
				var ban=1;
				console.log("\nvamos a recorrer el json");
				$.each(JSON.parse(jsonData), function(i,item)
				//$.each(jsonData, function(i,item)
				{
					console.log("\ni : " + i + ", item : " + item);
					//$.each(JSON.parse(item), function(x,valor)
					$.each(item, function(x,valor)
					{
						console.log("\nx : " + x + ", valor : " + valor + ", ban : " + ban);
						//	data.addRows( [  ['Work', 11],   ['Eat', 2],  ['Commute', 2],  ['Watch TV', 2],  ['Sleep', {v:7, f:'7.000'}  ]	 ]);
						if (ban==1)
						{
							campo = valor;
							ban=2;
						}
						else
						{
							if(typeof(valor)=='string') dato=parseInt(valor);
							else dato=valor;
							console.log("\ncampo : " + campo +  
										"\nvalor : " + valor + ", tipo de dato de valor: " + typeof(valor) + 
										"\ndato : <" + dato + ">, tipo de dato de dato: " + typeof(dato));
							dataGrafico.addRows([[campo,dato]]);
							ban=1;
						}
					});
				});
				//var opciones = {};
				var opciones = {
					title: tit_reporte,
					is3D:true,
					//legend:cad_select_mostrar,
					width: 1000, 
					height: 800
				};
				// Instantiate and draw our chart, passing in some options.
				   //Area de texto exlicativo de despliegue del reporte
				//recuerda que chart esta definida global
				var chart_div=document.getElementById('reporte' + id_rep);
				chart = new google.visualization.PieChart(chart_div);
				// Wait for the chart to finish drawing before calling the getImageURI() method.
				/*
				google.visualization.events.addListener(chart, 'ready', function () 
				{
					chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
					//console.log(chart_div.innerHTML);
				});
				*/
				//////console.log("\ntipo de datos de chart : " + typeof(chart));
				//chart.draw(dataGrafico, {width: 400, height: 240});
				chart.draw(dataGrafico, opciones);
				//$('#area_contenedor5').append("despues del grafico");
				//document.getElementById('png').outerHTML = '<a href="' + chart.getImageURI() + '">Version para imprimir</a>';
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
		complete: function() 	{	//$('#ajax-loader').hide();	
		}
	});
}
   






