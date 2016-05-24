<script>
<!--
    $( "input[name^='especial_']" ).on('click', doClick);
    
    function doClick(event)
    {
        
        var $suc = event.currentTarget.value;
        var $varia=$(this).attr('checked');
  
        guarda($suc, $varia);

    }

    function guarda($suc, $varia)
    {
        var $url = '<?php echo site_url('catalogos/SavePermisoEspecial');?>';;
        var $vari = { suc : $suc, varia : $varia}; 

        var posting = $.post( $url, $vari );
           
         posting.done(function( data ) {
            if($varia == 'checked'){
              confirm('Se desactivara en 2 d\xEDas');
              }else
              {
               
              }
           
              
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
    
 var oTable = $('#tabla1').dataTable( {
            "aoColumns": [
                { "sSortDataType": "dom-text", "sType": "num-html" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text" },
            ],
            "bJQueryUI": true,
            "bPaginate": false
        });
} );
}(); 
</script>