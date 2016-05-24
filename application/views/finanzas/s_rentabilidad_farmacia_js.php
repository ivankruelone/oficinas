<script type="text/javascript" src="<?php echo base_url(); ?>fs/js/fusioncharts.js"></script>
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
    "sScrollY": "300px",
		"sScrollX": "100%",
		"sScrollXInner": "150%",
		"bScrollCollapse": true,
		"bPaginate": false,
    
            "aoColumns": [
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"}
            ],
            "bJQueryUI": true,
            "bPaginate": false
        });
                

                
} );
///////////////////////////////////////////////////////////////////////////////////////////////
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
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"}
            ],
            "bJQueryUI": true,
            "bPaginate": false
        });
                

                
} );
///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function() {
    
 var oTable = $('#tabla3').dataTable( {
    "sScrollY": "300px",
		"sScrollX": "100%",
		"sScrollXInner": "150%",
		"bScrollCollapse": true,
		"bPaginate": false,
    
            "aoColumns": [
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"}
            ],
            "bJQueryUI": true,
            "bPaginate": false
        });
                

                
} );
///////////////////////////////////////////////////////////////////////////////////////////////
}();



FusionCharts.ready(function () {
  var chart1 = new FusionCharts(<?php echo $json1; ?>);
   chart1.render();
});
FusionCharts.ready(function () {
  var chart2 = new FusionCharts(<?php echo $json2; ?>);
   chart2.render();
});
FusionCharts.ready(function () {
  var chart3 = new FusionCharts(<?php echo $json3; ?>);
   chart3.render();
});
FusionCharts.ready(function () {
  var chart4 = new FusionCharts(<?php echo $json4; ?>);
   chart4.render();
});
FusionCharts.ready(function () {
  var chart5 = new FusionCharts(<?php echo $json5; ?>);
   chart5.render();
});
FusionCharts.ready(function () {
  var chart6 = new FusionCharts(<?php echo $json6; ?>);
   chart6.render();
});
</script>