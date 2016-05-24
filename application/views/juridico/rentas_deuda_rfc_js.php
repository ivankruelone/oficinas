<script>
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
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////
//$( "input[name^='aplicame_']" ).on("click", aplica);
$( "input[name^='aplicame_']" ).on("change", aplica);
function aplica(event){
    
    
    var $aplica = event.currentTarget.value;
    var $id = event.currentTarget.attributes.id.value;
    
    //alert($aplica); 
    var $url = '<?php echo site_url('juridico/actualiza_prepago');?>';
    
    var $variables = {
        aplica: $aplica,
        id: $id
    }
   var posting = $.post( $url, $variables );
        
         posting.done(function( data ) {
            
            var $a = data.split("|");

            $('#cambiado_' + $id).html($a[0]);
            $('#cambiadousd_' + $id).html($a[1]);
         });    
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function() {
    
 var oTable = $('#tabla1').dataTable( {
        "sScrollY": "400px",
		"sScrollX": "100%",
		"sScrollXInner": "100%",
		"bScrollCollapse": true,
		"bPaginate": false,
            "aoColumns": [
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"}
            ],
            "bJQueryUI": true,
            "bPaginate": false
        });
} );
}();



</script>