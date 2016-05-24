<script language="javascript" type="text/javascript">

        $('#nueva_secuencia').submit(function() {
            
            
            var data_secuencia = $('#secuencia').attr("value");
            var data_sustanciaActiva = $('#sustanciaActiva').attr("value");
            var data_ventaDrd = $('#ventaDrd').attr("value");
            var data_ventaGen = $('#ventaGen').attr("value");
            var data_ventaFen = $('#ventaFen').attr("value");
            var data_ventaFbo = $('#ventaFbo').attr("value");
        
                
                if(confirm("Seguro que los datos son correctos ?")){
                    return true;
                }else{
                   
                return false;
            }
    	    

    	    
    	 
    	}); 


</script>
</div>