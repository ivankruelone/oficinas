<script>
$(document).ready(function() {
    
    var $idProveedor = $("#idProveedor").html();
    
    $("#idProductoBusca").change(function(event){
            
        var $dato = event.currentTarget.value;
        
            idProductoBusca($dato, $idProveedor);
        
            
    });

    function idProductoBusca(dato, idProveedor){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>maestro/busquedaIDProductoProveedor/", data: ({ dato: dato, idProveedor: idProveedor }),
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
            descripcionBusca($dato, $idProveedor);
        }
        
            
    });

    function descripcionBusca(dato, idProveedor){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>maestro/busquedaDescripcionProveedor/", data: ({ dato: dato, idProveedor: idProveedor }),
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
        EANBusca($dato, $idProveedor);
        
            
    });

    function EANBusca(dato, idProveedor){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>maestro/busquedaEANProveedor/", data: ({ dato: dato, idProveedor: idProveedor }),
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
                



    $("#secuenciaBusca").change(function(event){
            
        var $dato = event.currentTarget.value;
        secuenciaBusca($dato, $idProveedor);
        
            
    });

    function secuenciaBusca(dato, idProveedor){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>maestro/busquedaSecuenciaProductoProveedor/", data: ({ dato: dato, idProveedor: idProveedor }),
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
            claveBusca($dato, $idProveedor);
        
            
    });

    function claveBusca(dato, idProveedor){
        $.ajax({type: "POST",
            url: "<?php echo site_url(); ?>maestro/busquedaClaveProductoProveedor/", data: ({ dato: dato, idProveedor: idProveedor }),
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