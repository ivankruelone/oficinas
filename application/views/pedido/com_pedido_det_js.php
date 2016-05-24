<script>
var Script = function () {
    
    //////////////////////////////////
$( "input[name^='pedi_']" ).on("change", pedido);
$( "input[name^='regalo_']" ).on("change", regalo);
$( "input[name^='descu_']" ).on("change", descuento);
$( "input[name^='costo_']" ).on("change", costo);
function pedido(event){
    
    
    var $pedido = event.currentTarget.value;
    var $id = event.currentTarget.attributes.id.value;
    var $url = '<?php echo site_url('pedido/actualiza_detalle_pedido');?>';
    
    var $variables = {
        pedido: $pedido,
        id: $id
    }

    var posting = $.post( $url, $variables );
        
         posting.done(function( data ) {
            
            var $a = data.split("|");

            $('#pedidoact_' + $id).html($a[0]);
            $('#importe_' + $id).html($a[1]);
            $('#descuento_' + $id).html($a[2]);
            $('#total_' + $id).html($a[3]);
            $('#costo_' + $id).html($a[4]);
            
         });    
}

function descuento(event){
    
    
    var $descuento = event.currentTarget.value;
    var $id = event.currentTarget.attributes.id.value;
    var $url = '<?php echo site_url('pedido/actualiza_detalle_descuento');?>';
    
    var $variables = {
        descuento: $descuento,
        id: $id
    }

    var posting = $.post( $url, $variables );
        
         posting.done(function( data ) {
            
            var $a = data.split("|");

            $('#pedidoact_' + $id).html($a[0]);
            $('#importe_' + $id).html($a[1]);
            $('#descuento_' + $id).html($a[2]);
            $('#total_' + $id).html($a[3]);
            $('#costo_' + $id).html($a[4]);
            
         });    
}

function regalo(event){
    
    
    var $regalo = event.currentTarget.value;
    var $id = event.currentTarget.attributes.id.value;
    var $url = '<?php echo site_url('pedido/actualiza_detalle_regalo');?>';
    
    var $variables = {
        regalo: $regalo,
        id: $id
    }

    var posting = $.post( $url, $variables );
        
         posting.done(function( data ) {
            
            var $a = data.split("|");

            $('#pedidoact_' + $id).html($a[0]);
            $('#importe_' + $id).html($a[1]);
            $('#descuento_' + $id).html($a[2]);
            $('#total_' + $id).html($a[3]);
            $('#costo_' + $id).html($a[4]);
            
         });    
}
function costo(event){
    
    
    var $costo = event.currentTarget.value;
    var $id = event.currentTarget.attributes.id.value;
    var $url = '<?php echo site_url('pedido/actualiza_detalle_costo');?>';
    
    var $variables = {
        costo: $costo,
        id: $id
    }

    var posting = $.post( $url, $variables );
        
         posting.done(function( data ) {
            
            var $a = data.split("|");

            $('#pedidoact_' + $id).html($a[0]);
            $('#importe_' + $id).html($a[1]);
            $('#descuento_' + $id).html($a[2]);
            $('#total_' + $id).html($a[3]);
            $('#costo_' + $id).html($a[4]);
            
         });    
}
//////////////////////////////////

var oTable = $('#tabla1').dataTable( {
		
	} );

}();




</script>