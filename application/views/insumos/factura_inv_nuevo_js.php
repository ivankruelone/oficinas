<script type="text/javascript">
<!--
	$( "input[name^='opcion_']" ).on('click', doClick);
    
    function doClick(event)
    {
       var $folio = event.currentTarget.attributes.folio.value;
       var $id = event.currentTarget.attributes.id.value;
      
        guarda($folio, $id);
    }


    function guarda($folio, $id)
    {
        var $url = '<?php echo site_url('insumos/factura_nueva_submit'); ?>';;
        var $vari = { folio : $folio, id : $id }; 

        var posting = $.post( $url, $vari );
        
         posting.done(function( data ) {
         });
    }
-->
</script>