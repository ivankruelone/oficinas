<script type="text/javascript">
<!--
	$(document).on('ready', inicio);
    
    
    function inicio()
    {
        $('#idLinea').on('change', cambiaIdLinea);
        
        
        function cambiaIdLinea(event)
        {
            var $idLinea = event.currentTarget.value;
            actualizaSublinea($idLinea);
        }
        
        function actualizaSublinea($idLinea)
        {
            $url = '<?php echo site_url('maestro/actualizaComboIdSublinea'); ?>';
            $.post( $url, { idLinea: $idLinea }).done(function( data ) {
                $('#idSublinea').html(data);
            });
        }
        
        $('#formAltaProducto').on('submit', guarda);
        
        function guarda(event)
        {
            event.preventDefault();
            var $idProducto = event.currentTarget.idProducto.value;
            var $ean = event.currentTarget.ean.value;
            var $descripcion = event.currentTarget.descripcion.value.toUpperCase();
            var $sustancia = event.currentTarget.sustancia.value.toUpperCase();
            var $formaFarmaceutica = event.currentTarget.formaFarmaceutica.value.toUpperCase();
            var $concentracion = event.currentTarget.concentracion.value.toUpperCase();
            var $presentacion = event.currentTarget.presentacion.value.toUpperCase();
            var $unidadMedida = event.currentTarget.unidadMedida.value.toUpperCase();
            var $idLaboratorio = event.currentTarget.idLaboratorio.value.toUpperCase();
            var $laboratorioProvisional = event.currentTarget.laboratorioProvisional.value.toUpperCase();
            var $registro = event.currentTarget.registro.value.toUpperCase();
            var $secuencia = event.currentTarget.secuencia.value.toUpperCase();
            var $clave = event.currentTarget.clave.value.toUpperCase();
            var $precioMaximoPublico = event.currentTarget.precioMaximoPublico.value.toUpperCase();
            var $precioFarmacia = event.currentTarget.precioFarmacia.value.toUpperCase();
            var $iva = event.currentTarget.iva.value.toUpperCase();
            var $servicio = event.currentTarget.servicio.value.toUpperCase();
            var $idLinea = event.currentTarget.idLinea.value.toUpperCase();
            var $idSublinea = event.currentTarget.idSublinea.value.toUpperCase();
            var $antibiotico = event.currentTarget.antibiotico.value.toUpperCase();
            var $claseTerapeutica = event.currentTarget.claseTerapeutica.value.toUpperCase();
            
            var parametros = {
                idProducto: $idProducto,
                ean: $ean,
                descripcion: $descripcion,
                sustancia: $sustancia,
                formaFarmaceutica: $formaFarmaceutica,
                concentracion: $concentracion,
                presentacion: $presentacion,
                unidadMedida: $unidadMedida,
                idLaboratorio: $idLaboratorio,
                laboratorioProvisional: $laboratorioProvisional,
                registro: $registro,
                secuencia: $secuencia,
                clave: $clave,
                precioMaximoPublico: $precioMaximoPublico,
                precioFarmacia: $precioFarmacia,
                iva: $iva,
                servicio: $servicio,
                idLinea: $idLinea,
                idSublinea: $idSublinea,
                antibiotico: $antibiotico,
                claseTerapeutica: $claseTerapeutica
            };
            
            $url = '<?php echo site_url('maestro/updateProducto'); ?>';
            $.post( $url, parametros).done(function( data ) {
                
                if(data >= 1)
                {
                    $url_destino = '<?php echo site_url('maestro/muestra_producto');?>';
                    window.location.href = $url_destino;
                }else{
                    $('#ean_message').html(data).css('color', 'green');
                }
                
            });
        }
    }
-->
</script>