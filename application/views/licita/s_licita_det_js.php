<script>
var Script = function () {
    
    //////////////////////////////////
$( "input[name^='aplicame_']" ).on("change", aplica);
function aplica(event){
    
    
    var $aplica = event.currentTarget.value;
    var $id = event.currentTarget.attributes.id.value;
    var $url = '<?php echo site_url('licita/actualiza_partida_d');?>';
    
    var $variables = {
        aplica: $aplica,
        id: $id
    }

    var posting = $.post( $url, $variables );
        
         posting.done(function( data ) {
            
            var $a = data.split("|");

            $('#cambiado' + $id).html($a[0]);
            
         });    
}


//////////////////////////////////

var oTable = $('#tabla1').dataTable( {

	} );

}();



</script>