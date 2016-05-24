<script>
$(document).ready(function() {
    
    $("#sustanciaBusca").keyup(function(event){
            
        var $dato = event.currentTarget.value;
        if($dato.length >= 4){
            sustanciaBusca($dato);
        }
        
            
    });

    function sustanciaBusca(dato){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>auxiliar/busquedaSustancia/", data: ({ dato: dato }),
                success: function(data){
                    
                    $("#resultado").html(data);
    
            },
            beforeSend: function(data){
            
            },
            error: function(data){
                $("#resultado").html(data);
            }
            });
    
    }
                


    $("#secuenciaBusca").keyup(function(event){
            
        var $dato = event.currentTarget.value;
        secuenciaBusca($dato);
        
            
    });

    function secuenciaBusca(dato){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>auxiliar/busquedaSecuencia/", data: ({ dato: dato }),
                success: function(data){
                    
                    $("#resultado").html(data);
    
            },
            beforeSend: function(data){
            
            },
            error: function(data){
                $("#resultado").html(data);
            }
            });
    
    }
                
} );



</script>