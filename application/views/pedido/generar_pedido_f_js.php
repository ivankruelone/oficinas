<script>



$(document).ready(function() {
    

   //////////////// /*Busqueda instantanea*///////////////////

    $('#codigo').on('change', checkEAN);
        
        function checkEAN(event)
        {
            var $codigo = event.currentTarget.value;
            searchEAN($codigo); 
        }

        function searchEAN($codigo)
        {
            $url = '<?php echo site_url('pedido/busq_num_ser'); ?>';
            $.post( $url, { ean: $codigo }).done(function( data ) {
                
                
                $("#descripcion").html(data);
                
            });
        }
    ////////////////////////////////////////////////////////
    
    
    } );


</script>