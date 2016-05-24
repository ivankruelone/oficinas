<script>
<!--
    $( "input[name^='opcion_']" ).on('click', doClick);
    
    function doClick(event)
    {
        
        var $suc = event.currentTarget.value;
        var $id_insumos = event.currentTarget.attributes.id_insumos.value;
        var $varia=$(this).attr('checked');
        
        guarda($id_insumos, $suc,$varia);

    }

    function guarda($id_insumos, $suc, $varia)
    {
        var $url = '<?php echo site_url('catalogos/savePermisoInsumo'); ?>';;
        var $vari = { suc : $suc, id_insumos : $id_insumos, varia : $varia}; 

        var posting = $.post( $url, $vari );
           
         posting.done(function( data ) {
            
              if($varia == 'checked'){
               $("#maximo_" + $id_insumos).removeAttr('disabled');
              }else
              {
               $("#maximo_" + $id_insumos).attr('disabled','disabled');
              }
              
         });
         
    }                       
    
    $( "input[name^='maximo_']" ).live('change', doChange); /* Para llamar a una funcion dinamicamente unicamente se le agrega un live*/
    
    function doChange(e)
    {
        var $id_insumos = e.currentTarget.attributes.id_insumos.value;
        var $suc = e.currentTarget.attributes.suc.value;
        var $maximo = e.currentTarget.value;
        var $url =  '<?php  echo site_url('catalogos/saveMaximoInsumoDepto');?>';;
        var $varia = {suc : $suc, id_insumos : $id_insumos, maximo: $maximo};
        
        var posting = $.post($url, $varia);
        
        posting.done(function(data){
            
        });
     }     
     
-->
 var Script = function () {
        
        jQuery.extend( jQuery.fn.dataTableExt.oSort, {
      "formatted-num-pre": function ( a ) {
        a = (a === "-" || a === "") ? 0 : a.replace( /[^\d\-\.]/g, "" );
        return parseFloat( a );
    },
 
    "formatted-num-asc": function ( a, b ) {
        return a - b;
    },
 
    "formatted-num-desc": function ( a, b ) {
        return b - a;
    }
} );

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "num-html-pre": function ( a ) {
        var x = String(a).replace( /<[\s\S]*?>/g, "" );
        return parseFloat( x );
    },
 
    "num-html-asc": function ( a, b ) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },
 
    "num-html-desc": function ( a, b ) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
} );

$(document).ready(function() {
    
 var oTable = $('#tabla3').dataTable( {
            "aoColumns": [
                { "sSortDataType": "dom-text", "sType": "num-html" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text", "sType": "num-html" },
                { "sSortDataType": "dom-text", "sType": "num-html" },
            ],
            "bJQueryUI": true,
            "bPaginate": false
        });
} );
}(); 
</script>