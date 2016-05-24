<script>
$(document).ready(function() {
    
    $("#sustanciaBusca").keyup(function(event){
            
        var $dato = event.currentTarget.value;
        if($dato.length >= 4){
            sustanciaBusca($dato);
        }else{
            $("#resultado").html(null);
        }
        
            
    });

    function sustanciaBusca(dato){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>auxiliar/busquedaSustanciaGobierno/", data: ({ dato: dato }),
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
                


    $("#claveBusca").keyup(function(event){
            
        var $dato = event.currentTarget.value;
        claveBusca($dato);
        
            
    });

    function claveBusca(dato){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>auxiliar/busquedaClaveGobierno/", data: ({ dato: dato }),
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