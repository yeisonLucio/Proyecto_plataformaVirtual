
//investigar datepicker en jquery
$(function()
{
    $('#li_curso').click(function(){
        listar("curso");
        console.log("voy a cargar el form_curso.html");
        $("#mostrar_datos").load('vista/form_curso.html');
   });
   
   $('#li_docente').click(function(){
        listar("docente");
        console.log("voy a cargar el form_docente.html");
        $("#mostrar_datos").load('vista/form_docente.html');
   });
   
    $('#li_estudiante').click(function(){
        listar("estudiante");
        console.log("voy a cargar el form_estudiante.html");
        $("#mostrar_datos").load('vista/form_estudiante.html');
   });
   
   $('#li_estudiante_curso').click(function(){
        listar("estudiante_curso");
        console.log("voy a cargar el form_estudiante_curso.html");
        $("#mostrar_datos").load('vista/form_estudiante_curso.html');
   });
   
   
   
    
   
  
  
    
    //listar("estudiante_curso");
    
    $('#btn_agregar_docente').click(function(){
        $('.fecha_docente').datepicker({
        format: "dd/mm/yyyy",
        language: "es"
        });
    });
    $('#btn_agregar_estudiante').click(function(){
        $('.fecha_estudiante').datepicker({
        format: "dd/mm/yyyy",
        language: "es"
        });
    });
    $('#btn_agregar_curso').one('click',function(){
        console.log("di click en el boton agregar");
        llenar_combo_tablas("curso",1);
         
        
    });
    $('#btn_agregar_estudiante_curso').one('click',function(){
        llenar_combo_tablas("estudiante_curso",1);
        llenar_combo_tablas("estudiante_curso",2);
         
        
    });
//    $('#btn_agregar_estudiante_curso2').one('click',function(){
//        console.log("di click en el boton agregar");
//        llenar_combo_tablas("estudiante_curso",3);
//        
//         
//        
//    });
    $('#btn_agregar_curso').click(function(){
        vaciar_cajas_curso();
        
        
    });
    $('#btn_agregar_docente').click(function(){
        vaciar_cajas_docente();
    });
    $('#btn_agregar_estudiante').click(function(){
        vaciar_cajas_estudiante();
    });
   
    $('#btn_guardar_curso').click(function(){
        guardar_curso();
        vaciar_cajas_curso();
        
    });
    $('#btn_guardar_estudiante_curso').click(function(){
        guardar_estudiante_curso();
        
    });
    
    
    $('#btn_guardar_docente').click(function(){
        guardar_docente();
        vaciar_cajas_docente();
        
        
    });
    $('#btn_guardar_estudiante').click(function(){
        guardar_estudiante();
        vaciar_cajas_estudiante()
        
        
    });
    
   $('#btn_guardar_estudiante_curso2').click(function(){
       
          guardar_estudiante_curso2();
        
    });
    
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
}
function vaciar_cajas_estudiante(){
      $('#idestudiante').val("");
      $('#nombre_estudiante').val("");
      $('#apellido_estudiante').val("");
      $('#correo_estudiante').val(); 
      $('#fechaNacimiento_estudiante').val("");
      $('#idusuario_estudiante').val("");
    
    
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
     
        
       var idcurso=$('#idcurso').val();
       var nombre= $('#nombre_curso').val();
       var descripcion=$('#descripcion').val();
       var iddocente=$('#combo_curso').val(); 
       
       console.log("nombre: "+nombre+" descripcion: "+descripcion+" iddocente: "+iddocente);
       $.ajax({
        type: "POST",
        url: "ctrl/controlador_curso.php",
        data:	{
            action: v_action,
            idcurso:idcurso,
            nombre:nombre,
            descripcion:descripcion,
            docente_iddocente:iddocente
            
        },
        dataType: 'text', 
        beforeSend: function(data) { 
            console.log("data enviada..."+data);
            $('#btn_guardar_curso').val("Guardando...");
        },
        success: function(data){
            $('#btn_guardar_curso').val("Guardar");
            console.log("data :"+data);
            if(data){
               
                $('#resultado').removeClass('hidden');
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
        url: "ctrl/controlador_estudiante_curso.php",
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
            $('#btn_guardar_estudiante_curso').val("Guardando...");
        },
        success: function(data){
            $('#btn_guardar_estudiante_curso').val("Guardar");
            console.log("data :"+data);
            if(data){
               
                $('#resultado').removeClass('hidden');
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
        url: "ctrl/controlador_estudiante_curso.php",
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
            $('#btn_guardar_estudiante_curso2').val("Guardando...");
        },
        success: function(data){
            $('#btn_guardar_estudiante_curso2').val("Guardar");
            console.log("data :"+data);
            if(data){
               
                $('#resultado').removeClass('hidden');
            }

            listar_estudiantes(combo2); 
            
        }
        
        });
   
  

}

function eliminar_estudiante_curso2(id,idcurso)
{
    var v_action = "eliminar";
    
    //cargar el controlador de la respectiva tabla
    var v_controlador ="ctrl/controlador_estudiante_curso.php";
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
    $('#resultado').addClass('hidden');
    
    var v_action = "editar";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="ctrl/controlador_estudiante_curso.php";
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
             llenar_combo_tablas("estudiante_curso",3);
             
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
        url: "ctrl/controlador_docente.php",
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
            $('#btn_guardar_curso').val("Guardando...");
        },
        success: function(data){
            $('#btn_guardar_curso').val("Guardar");
            console.log("data :"+data);
            if(data){
               
                $('#resultado').removeClass('hidden');
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
        url: "ctrl/controlador_estudiante.php",
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
            $('#btn_guardar_estudiante').val("Guardando...");
        },
        success: function(data){
            $('#btn_guardar_estudiante').val("Guardar");
            console.log("data :"+data);
            if(data){
               
                $('#resultado').removeClass('hidden');
            }

             listar("estudiante"); 
            
        }
        
        });
   
  

}

function listar(v_nombre_tabla)
{
     //event.preventDefault();
    var v_action = "listar";
    //cargar el controlador de la respectiva tabla
    //var v_controlador ="../ctrl/controlador_"+v_nombre_tabla+".php";
    var v_controlador ="ctrl/controlador_"+v_nombre_tabla+".php";
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
            console.log("!! successsss   !!"+ data);
           
            
            if(data !== null)
            {
                
                
               $('#lista_'+v_nombre_tabla).text('');
           var $log = $( "#lista_"+v_nombre_tabla ),
          str = data,
          html = $.parseHTML( str );
          
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
function eliminar_curso(id)
{
    var v_action = "eliminar";
    
    //cargar el controlador de la respectiva tabla
    var v_controlador ="ctrl/controlador_curso.php";
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
    var v_controlador ="ctrl/controlador_estudiante_curso.php";
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
    var v_controlador ="ctrl/controlador_estudiante.php";
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
    var v_controlador ="ctrl/controlador_docente.php";
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
    $('#resultado').addClass('hidden');
    
    var v_action = "editar";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="ctrl/controlador_curso.php";
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
             llenar_combo_tablas("curso",1);
            var curso=JSON.parse(data); 
            console.log("curso_"+curso);
            document.getElementById("idcurso").value = curso['idcurso'];
            document.getElementById("nombre_curso").value = curso['nombre'];
            document.getElementById("descripcion").value = curso['descripcion'];
            document.getElementById("combo_curso").innerHTML= curso['iddocente'];
           
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
    $('#resultado').addClass('hidden');
    
    var v_action = "editar";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="ctrl/controlador_estudiante_curso.php";
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
             llenar_combo_tablas("estudiante_curso",1);
             llenar_combo_tablas("estudiante_curso",2);
             
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
     var v_controlador ="ctrl/controlador_estudiante_curso.php";
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
           var $log = $( "#lista_estudiantes"+id ),
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
     var v_controlador ="ctrl/controlador_curso.php";
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
    $('#resultado').addClass('hidden');
     $('.fecha_docente').datepicker({
        format: "dd/mm/yyyy",
        language: "es"
    });
    var v_action = "editar";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="ctrl/controlador_docente.php";
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
    $('#resultado').addClass('hidden');
     $('.fecha_estudiante').datepicker({
        format: "dd/mm/yyyy",
        language: "es"
    });
    var v_action = "editar";
    //cargar el controlador de la respectiva tabla
     var v_controlador ="ctrl/controlador_estudiante.php";
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


function llenar_combo_tablas(v_tabla,op)

{
	
	alert ("Se va a cargar el listbox de la tabla : " + v_tabla);
	var v_accion="cargar_listbox";
        var opcion=op;
	$.ajax({
		type: "POST",
		url: "ctrl/controlador_"+v_tabla+".php",
		data:	{
                        action:v_accion,
                        tabla:v_tabla,
                        op:op,
                        
					
                                       
                                        
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
                           }
                           else if(opcion==1){
                            $('#combo_'+v_tabla).append(data);
                            }
                            else if(opcion==3){
                                $('#combo3_'+v_tabla).append(data);
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
   






