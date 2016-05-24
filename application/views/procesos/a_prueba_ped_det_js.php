<script>
$(document).ready(function() {
    

-->
    ////////////////////////////////////////////////////////
    $('#ean').on('change', checkEAN);
        
        function checkEAN(event)
        {
            var $ean = event.currentTarget.value;
            searchEAN($ean); 
        }

        function searchEAN($ean)
        {
            $url = '<?php echo site_url('procesos/busquedaEAN'); ?>';
            $.post( $url, { ean: $ean }).done(function( data ) {
                
                
                $("#descripcion").html(data);
                
            });
        }
    ////////////////////////////////////////////////////////
    
    
    } );

</script>