<script type="text/javascript">
<!--
	$( "input[name^='opcion_']" ).on('click', doClick);
    
    function doClick(event)
    {
       var $id_insumos = event.currentTarget.attributes.id_insumos.value;
      
        guarda($id_insumos);
    }


    function guarda($id_insumos, $suc)
    {
        var $url = '<?php echo site_url('catalogos/s_cat_insumos_nuevo_submit'); ?>';;
        var $vari = { id_insumos : $id_insumos }; 

        var posting = $.post( $url, $vari );
        
         posting.done(function( data ) {
            
            
         });
    }
-->
</script>