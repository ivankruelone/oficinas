<script>
var Script = function () {
    
//////////////////////////////////
$( "input[name^='aplicame1_']" ).on("change", canp);
function canp(event){
  
    var $canp = event.currentTarget.value;
    var $id = event.currentTarget.attributes.id.value;
    var $url = '<?php echo site_url('orden/actualiza_orden_d_canp');?>';
    
    var $variables = {
        canp: $canp,
        id: $id
    }
    var posting = $.post( $url, $variables );
        
         posting.done(function( data ) {
            
            var $a = data.split("|");

            $('#cambiado1' + $id).html($a[0]);
            
         });    
}
//////////////////////////////////
//////////////////////////////////
$( "input[name^='aplicame2_']" ).on("change", costo);
function costo(event){
    
    
    var $costo = event.currentTarget.value;
    var $id = event.currentTarget.attributes.id.value;
    var $url = '<?php echo site_url('orden/actualiza_orden_d_costo');?>';
    
    var $variables = {
        costo: $costo,
        id: $id
    }

    var posting = $.post( $url, $variables );
        
         posting.done(function( data ) {
            
            var $a = data.split("|");

            $('#cambiado2' + $id).html($a[0]);
            
         });    
}
//////////////////////////////////
    //////////////////////////////////
$( "input[name^='aplicame3_']" ).on("change", descu);
function descu(event){
    
    
    var $descu = event.currentTarget.value;
    var $id = event.currentTarget.attributes.id.value;
    var $url = '<?php echo site_url('orden/actualiza_orden_d_descu');?>';
    
    var $variables = {
        descu: $descu,
        id: $id
    }

    var posting = $.post( $url, $variables );
        
         posting.done(function( data ) {
            
            var $a = data.split("|");

            $('#cambiado3' + $id).html($a[0]);
            
         });    
}
//////////////////////////////////

var oTable = $('#tabla1').dataTable( {
       "sScrollY": "400px",
		"sScrollX": "100%",
		"sScrollXInner": "150%",
		"bScrollCollapse": true,
		"bPaginate": false,
        "bJQueryUI": true,
            "bPaginate": false
	} );

}();



</script>