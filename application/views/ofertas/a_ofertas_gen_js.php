
<script language="javascript" type="text/javascript">
$(window).load(function () {
        $("#sec").focus();
       
    });
    
  $(document).ready(function(){       
       	$('#sec').blur(function(){
        var sec=$('#sec').attr("value");
        sendcodigo(sec);
        	
      });
    });  
    
function sendcodigo(sec){
    $.ajax({type: "POST",
        url: "<?php echo site_url();?>/ofertas/busca_producto_gen/", data: ({ sec: sec }),
            success: function(data){
            	   if(data == '0'){
	               $('#codigo').val('');
                }else{
                   $("#codigo").html(data);
             }                  
        }, 
    });
}

 
</script>