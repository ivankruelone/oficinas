<script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#cedula").focus();
        $("#codp").focus();
        //$('#colonias').attr('disabled','disabled');
    });
    
    $(document).ready(function(){        
       	$('#codp').change(function(){
        var cp_valor=$('#codp').attr("value");
        var largo=$('#codp').attr("value").length;
        if(largo >= 4 && largo <= 5){
        sendCp(cp_valor);
        sendColonia(cp_valor);
        }	
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
      
      
    });
    
function sendCp(codp){
    $.ajax({type: "POST",
        url: "<?php echo site_url();?>/medicos/checaCp/", data: ({ codp: codp }),
            success: function(data){
               if(data==0){
                  alert("El C\xf3digo Postal " + codp + " no existe")
                       $('#colonias').html("");
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
                  $("#colonias").removeAttr('disabled');  
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
       
       
       $("#cuenta").blur(function () {
       tipo_cuenta=$("#tipo_cuenta").attr("value");
       if(tipo_cuenta == '1'){
          largo=$('#cuenta').attr("value").length;  
          if(largo >= 10 && largo <= 16){
          }else{
            alert('Debe ser un m\xE1ximo de 16 d\xEDgitos');
            $('#cuenta').focus();
          }
       }else if(tipo_cuenta == '2'){
          largo=$('#cuenta').attr("value").length;  
          if(largo >= 10 && largo <= 18){
          }else{
            alert('Debe ser un m\xE1ximo de 18 d\xEDgitos');
            $('#cuenta').focus();
          }
       }
    });
  </script>     