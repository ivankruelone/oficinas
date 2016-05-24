<script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#cedula").focus();
        $("#codp").focus();
    });
    
    $(document).ready(function(){
    /*$("#cedula").change(function () {
            cedula=$("#cedula").attr("value"); 
            $.get("http://cedula.buholegal.com/",cedula, { }, function(data){ 
                 alert(JSON.stringify(data));
         });
       });
    */
    
    $("#cedula").change(function () {
            cedula=$("#cedula").attr("value");
            largo=$('#cedula').attr("value").length;
            $.post("<?php echo site_url();?>/medicos/checaCedula/", { cedula: cedula }, function(data){ 
                 if(data==0){
                    alert("La c\xe9dula "+cedula+" esta duplicada");
                    $("#cedula").focus(); 
                 }else{
                    if(largo <= 10 && largo >= 7){
                     $("#apaterno").focus();   
                    }else{
                     alert('Debe tener al menos 7 d\xEDgitos');
                     $("#cedula").focus();   
                    }  
                 }
         });
       }); 
       
           $("#esp").change(function () {
            esp=$("#esp").attr("value");
            $.post("<?php echo site_url();?>/medicos/traeEspecialidad/", { esp: esp }, function(data){ 
                 if(data==0){
                    $('#especial').val('');
                    $('#especial').attr('disabled','disabled');
                 }else{
                    $json = JSON.parse(data);
                    if($json[0].especialidad == 'Otro.'){
                     $('#especial').removeAttr('disabled');
                     $('#especial').val('');   
                    }else{
                     $('#especial').removeAttr('disabled');
                     $('#especial').val($json[0].especialidad);  
                    }
                 }
         });
       });
       
       	$('#codp').blur(function(){
        var cp_valor=$('#codp').attr("value");
        var largo=$('#codp').attr("value").length;
        if(largo >= 4 && largo <= 5){
        sendCp(cp_valor);
        sendColonia(cp_valor);
        }	
      });
    });
 
    
function sendCp(codp){
    $.ajax({type: "POST",
        url: "<?php echo site_url();?>/medicos/checaCp/", data: ({ codp: codp }),
            success: function(data){
               if(data==0){
                  alert("El C\xf3digo Postal " + codp + " no existe")
                       $('#validando').html('');
                       $('#colonia_span').html("");
            		   $('#col').val('');
            		   $('#mnpio').val('');
            		   $('#estado').val('');
            		   $('#ciudad').val('');
                       $('#codp').focus();
               }else{
            	   
           	      $json = JSON.parse(data);
                  //alert('El c\xf3digo es :' + codp);
                  $("#col").val($json[0].d_asenta);
                  $("#mnpio").val($json[0].d_mnpio);
                  $("#ciudad").val($json[0].d_ciudad);
                  $("#estado").val($json[0].d_estado);  
                  $('#validando').html('');
               }
        },
        
        });
}

function sendColonia(codp){
    $.ajax({type: "POST",
        url: "<?php echo site_url();?>/medicos/checaColonia/", data: ({ codp: codp }),
            success: function(data){
            	   if(data == '0'){
	               $('#colonias').val('');
                }else{
                   $("#colonias").html(data);
             }                  
        }, 
    });
}

  $("#colonias").change(function () {
            colonia=$("#colonias").attr("value"); 
            $.post("<?php echo site_url();?>/medicos/obtenColonia/", { colonia: colonia }, function(data){
                 if(data==0){
                    $('#col').val('');
                 }else{
                    $json = JSON.parse(data);
                    $("#col").val($json[0].d_asenta);
                 }
         });
       }); 

  /*$("input[name^='tipo_com']").live('click', doClick);  despues se va a utilizar
    function doClick(event)
    {
        var $valor = event.currentTarget.value;
        if($valor == '1'){
          largo = $('#tarjeta').attr("value").length;
          if(largo)
        }
        //alert($valor);
    }*/
    
    $("#tipo_cuenta").change(function () {
       tipo_cuenta=$("#tipo_cuenta").attr("value");
       if(tipo_cuenta != '0'){
          $('#tarjeta').removeAttr('disabled');
          $('#tarjeta').val('');  
       }else{
         $('#tarjeta').val(''); 
         $('#tarjeta').attr('disabled','disabled');
       }
    });
     
     $("#tarjeta").change(function () {
       tipo_cuenta=$("#tipo_cuenta").attr("value");
       if(tipo_cuenta == '1'){
          largo=$('#tarjeta').attr("value").length;  
          if(largo >= 10 && largo <= 16){
          }else{
            alert('Debe ser un m\xE1ximo de 16 d\xEDgitos');
            $('#tarjeta').focus();
          }
       }else if(tipo_cuenta == '2'){
          largo=$('#tarjeta').attr("value").length;  
          if(largo >= 10 && largo <= 18){
          }else{
            alert('Debe ser un m\xE1ximo de 18 d\xEDgitos');
            $('#tarjeta').focus();
          }
       }
    });

  </script>     