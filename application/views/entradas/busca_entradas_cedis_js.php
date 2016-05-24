<?php
	$image_sppiner = array(
                                  'src' => base_url().'img/ajax-loader.gif'
                        );
?>

<script>
$(document).ready(function(){
    
    $('#dpYears').datepicker();
    $('#dpYears1').datepicker();
    
$(function() {
        
        var fuente = "<?php echo site_url();?>catalogos/busca_productos_autocomplete";

		$( "#clave" ).autocomplete({
			source: fuente
            
		});

		$( "#clave" ).autocomplete({
			source: fuente
            
		});
        
        var fuente = "<?php echo site_url();?>catalogos/busca_proveedores_autocomplete";

		$( "#prove" ).autocomplete({
			source: fuente
            
		});

		$( "#prove" ).autocomplete({
			source: fuente
            
		});
        
        
	});
    
});

</script>