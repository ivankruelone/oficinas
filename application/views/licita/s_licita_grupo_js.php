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
///////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function() {
    
 var oTable = $('#tabla1').dataTable( {
    "sScrollY": "900px",
		"sScrollX": "100%",
		"sScrollXInner": "150%",
		"bScrollCollapse": true,
		"bPaginate": false,
    
            "aoColumns": [
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text" }
                
            ],
            "bJQueryUI": true,
            "bPaginate": false
        });
                

                
} );
///////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function() {
    
 var oTable = $('#tabla2').dataTable( {
    "sScrollY": "300px",
		"sScrollX": "100%",
		"sScrollXInner": "150%",
		"bScrollCollapse": true,
		"bPaginate": false,
    
            "aoColumns": [
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text" }
            ],
            "bJQueryUI": true,
            "bPaginate": false
        });
                

                
} );
///////////////////////////////////////////////////////////////////////////////////////////////
}();

</script>