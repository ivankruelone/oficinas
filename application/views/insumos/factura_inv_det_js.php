<script type="text/javascript">
<!--
	$( "input[name^='opcion_']" ).on('click', doClick);
    
    function doClick(event)
    {
       var $folio = event.currentTarget.attributes.folio.value;
       var $id_insumos = event.currentTarget.attributes.id_insumos.value;
   
        guarda($folio, $id_insumos);
    }


    function guarda($folio, $id_insumos)
    {
        var $url = '<?php echo site_url('insumos/agrega_insumo_factura'); ?>';;
        var $vari = {folio : $folio, id_insumos : $id_insumos}; 

        var posting = $.post( $url, $vari );
        
         posting.done(function( data ) {

         });
    }
-->
</script>