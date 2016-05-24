<script type="text/javascript">
<!--
	$(document).on('ready', inicio);
    
    
    function inicio()
    {
        $('.eliminar_opcion').on('click', eliminar_opcion);
        
        function eliminar_opcion(e)
        {
            if(confirm("Seguro que deseas eliminar esta opcion ?"))
            {
                return true;
            }else{
                e.preventDefault();
                return false;
            }
        }
        
        $( "input[name^='reactivo']" ).on('click', asignaRespuestaCorrecta);
        
        function asignaRespuestaCorrecta(e)
        {
            var $nombre = e.currentTarget.attributes.name.value;
            var $reactivoID = $nombre.replace('reactivo', '');
            var $opcionID = e.currentTarget.value;
            
            guardaRespuestaCorrecta($reactivoID, $opcionID);
        }
        
        function guardaRespuestaCorrecta($reactivoID, $opcionID)
        {
            var $url = '<?php echo site_url('examen/saveCorrecta'); ?>';
            var $variables = { reactivoID : $reactivoID, opcionID: $opcionID };
            var posting = $.post( $url, $variables );
                
                 posting.done(function( data ) {
                    
                    $("#respuesta").html(data);
                    
                 });
        }
    }
-->
</script>