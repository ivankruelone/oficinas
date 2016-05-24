<script>
$(document).ready(function() {
    
    $("#idProductoBusca").change(function(event){
            
        var $dato = event.currentTarget.value;
            idProductoBusca($dato);
        
            
    });

    function idProductoBusca(dato){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>maestro/busquedaIDProducto/", data: ({ dato: dato }),
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

    $("#descripcionBusca").keyup(function(event){
            
        var $dato = event.currentTarget.value;
        if($dato.length >= 4){
            descripcionBusca($dato);
        }
        
            
    });

    function descripcionBusca(dato){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>maestro/busquedaDescripcion/", data: ({ dato: dato }),
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
                


    $("#EANBusca").change(function(event){
            
        var $dato = event.currentTarget.value;
        EANBusca($dato);
        
            
    });

    function EANBusca(dato){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>maestro/busquedaEAN/", data: ({ dato: dato }),
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


    $("#secuenciaBusca").change(function(event){
            
        var $dato = event.currentTarget.value;
            secuenciaBusca($dato);
        
            
    });

    function secuenciaBusca(dato){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>maestro/busquedaSecuenciaProducto/", data: ({ dato: dato }),
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

    $("#claveBusca").change(function(event){
            
        var $dato = event.currentTarget.value;
            claveBusca($dato);
        
            
    });

    function claveBusca(dato){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>maestro/busquedaClaveProducto/", data: ({ dato: dato }),
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

</script>