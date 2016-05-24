
<script language="javascript" type="text/javascript">
$(window).load(function () {
        $("#suc").focus();
       
    });
    
  $(document).ready(function(){       
       	$('#suc').blur(function(){
        var suc=$('#suc').attr("value");
        sendempleado(suc);
      });
    });  
   
function sendempleado(suc){
    $.ajax({type: "POST",
        url: "<?php echo site_url();?>/prenomina/busca_empleado_sucursal/", data: ({ suc: suc }),
            success: function(data){
                   if(data == '0'){
            	       
	               $('#nomina').val('');
                }else{
                   $("#nomina").html(data);
                  
             }                  
        }, 
    });
}

 
</script>