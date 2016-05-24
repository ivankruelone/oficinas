<script type="text/javascript">
<!--
	
    
    $( "input[id^='calificacion_']" ).on('click', doClick);
    
    function doClick(e)
    {
        
        
        
        var $valor = e.currentTarget.value;
        var $idpregunta = e.currentTarget.attributes.idpregunta.value;
        var $periodo_sucursalID = e.currentTarget.attributes.periodo_sucursalID.value;
        guardar($valor, $idpregunta, $periodo_sucursalID);
    }
    
    function guardar($valor, $idpregunta, $periodo_sucursalID)
    {
            var $url = '<?php echo site_url('checklist/guardarResultado'); ?>';
            var $variables = { valor: $valor, idpregunta: $idpregunta, periodo_sucursalID: $periodo_sucursalID };
            var posting = $.post( $url, $variables );
                
                 posting.done(function( data ) {
                    
                    
                    
                 });
    }
    
    $( "input[id^='texto_']" ).on('change', dochange);
    
    function dochange(e)
    {
        var $valor = e.currentTarget.value;
        var $idpregunta = e.currentTarget.attributes.idpregunta.value;
        var $periodo_sucursalID = e.currentTarget.attributes.periodo_sucursalID.value;
        guardar2($valor, $idpregunta, $periodo_sucursalID);

    }
    
     function guardar2($valor, $idpregunta, $periodo_sucursalID)
    {
            var $url = '<?php echo site_url('checklist/guardaTexto'); ?>';
            var $variables = { valor: $valor, idpregunta: $idpregunta, periodo_sucursalID: $periodo_sucursalID };
            var posting = $.post( $url, $variables );
                
                 posting.done(function( data ) {
                    
                    
                    
                 });
    }
    
-->
</script>