<script type="text/javascript">
<!--
	$( "input[name^='opcion_']" ).on('click', doClick);
    
    function doClick(event)
    {
       var $id_insumos = event.currentTarget.attributes.id_insumos.value;
       var $suc = event.currentTarget.attributes.suc.value;
       var $folio = event.currentTarget.attributes.folio.value;
      
        guarda($id_insumos,$suc,$folio);
    }


    function guarda($id_insumos, $suc,$folio)
    {
        var $url = '<?php echo site_url('insumos/agrega_devolucion'); ?>';;
        var $vari = { id_insumos : $id_insumos, suc : $suc, folio : $folio }; 

        var posting = $.post( $url, $vari );
        
         posting.done(function( data ) {
            
            
         });
    }
-->
</script>