<script>


$( "input[name^='cod']" ).on("change", aplica);
function aplica(event){
    
    
    var $aplica = event.currentTarget.value;
    var $id = event.currentTarget.attributes.id.value;
    
    //alert($aplica); 
   
    var $url = '<?php echo site_url('pedido/bus_codi_fanasa');?>';
    
    var $variables = {
        aplica: $aplica,
        id: $id
    }
   var posting = $.post( $url, $variables );
        
         posting.done(function( data ) {
            
            var $a = data.split("|");

            $('#demo').html($q2);
            $('#demo').html($q2);

            alert($q2); 

         });    

}

</script>