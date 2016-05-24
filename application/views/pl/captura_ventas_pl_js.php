<script>
var Script = function () {



$(document).ready(function() {
    
    $('input:text[name^="importe"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');
    var id = $(this).attr('id');
    
    //alert(id + ": " + valor);
    actualiza_importe(id, valor);

});

function actualiza_importe(id, valor){
    $.ajax({type: "POST",
        url: "<?php echo site_url(); ?>/pl/actualiza_importe/", data: ({ id: id, valor: valor }),
            success: function(data){
                
                if(data == '1')
                {
                    $('#confirma_' + id).html('OK');
                }else{
                    alert('Dato invalido.')
                }
                
                

        },
        beforeSend: function(data){
        
        },
        error: function(data){
            alert('Dato erroneo!');
            $('input:text[name^="importe_' + id + '"]').val(0).focus();
        }
        });

}
});

}();

</script>