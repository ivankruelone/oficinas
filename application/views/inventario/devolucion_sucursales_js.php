<script type="text/javascript">
<!--
    
    $(document).live('ready', inicio);
    
    function inicio()
    {
        permitidos();
    }


    function permitidos()
    {
        var $url = '<?php echo site_url('inventario/permitidos'); ?>';
        var $variables = { };
        var posting = $.post( $url, $variables );
                
        posting.done(function( data ) {
            
            $("#permitidos").html(data);

        });
    }

	$("#forma").on('submit', envio);
    
    function envio(e)
    {
        e.preventDefault();
        
        var $url = e.currentTarget.attributes.action.value;
        var $sec = $("#sec").val();
        
        buscaSecuencias($url, $sec);
        
    }
    
    function buscaSecuencias($url, $sec)
    {
        var $url = $url;
        var $variables = { sec : $sec };
        var posting = $.post( $url, $variables );
                
        posting.done(function( data ) {
            
            $("#busqueda").html(data);
                    
        });
    }
    
    $(".permitir").live('click', permitir);
    
    function permitir(e)
    {
        e.preventDefault();
        var $url = e.currentTarget.attributes.href.value;
        permitirSecuencia($url);
    }

    function permitirSecuencia($url)
    {
        var $url = $url;
        var $variables = { };
        var posting = $.post( $url, $variables );
                
        posting.done(function( data ) {
            
            permitidos();
            $("#busqueda").html('');
            $("#sec").val('').focus();
                    
        });
    }
    
    $(".eliminar").live('click', eliminar);

    function eliminar(e)
    {
        e.preventDefault();
        var $url = e.currentTarget.attributes.href.value;
        if(confirm("Esta seguro que deseas eliminar este regitro ??"))
        {
            eliminarSecuencia($url);
            return true;
        }else{
            return false;
        }
        
    }

    function eliminarSecuencia($url)
    {
        var $url = $url;
        var $variables = { };
        var posting = $.post( $url, $variables );
                
        posting.done(function( data ) {
            
            permitidos();
            $("#busqueda").html('');
            $("#sec").val('').focus();
                    
        });
    }

-->
</script>