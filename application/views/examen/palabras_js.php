<script type="text/javascript">
<!--
	$( "input[name^='palabra_']" ).on('click', envioPalabra);
    
    
    function envioPalabra(e)
    {
        var $palabra = e.currentTarget.value;
        guardaPalabra($palabra);
    }


        function guardaPalabra($palabra)
        {
            var $enunciadoID = $("#enunciadoID").html();
            var $url = '<?php echo site_url('examen/savePalabra'); ?>';
            var $variables = { enunciadoID : $enunciadoID, palabra: $palabra };
            var posting = $.post( $url, $variables );
                
                 posting.done(function( data ) {
                    
                    $("#respuesta").html(data);
                    
                 });
        }

-->
</script>