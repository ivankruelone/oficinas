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

$(document).ready(function() {
    
 var oTable = $('#sample_1').dataTable( {
    "sScrollY": "300px",
		"sScrollX": "100%",
		"sScrollXInner": "150%",
		"bScrollCollapse": true,
		"bPaginate": false,
    
            "aoColumns": [
                { "sSortDataType": "dom-text", "sType": "num-html" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text" },
                { "sSortDataType": "dom-text", "sType": "formatted-num"},
                { "sSortDataType": "dom-text", "sType": "formatted-num"}
        
            ],
            "bJQueryUI": true,
            "bPaginate": false
        });
                

                
} );
}();

/*
 var Script = function () {

         // begin first table
         $('#sample_1').dataTable({
             "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
             "sPaginationType": "bootstrap",
             "oLanguage": {
                 "sLengthMenu": "_MENU_ records per page",
                 "oPaginate": {
                     "sPrevious": "Prev",
                     "sNext": "Next"
                 }
             },
             "aoColumnDefs": [{
                 'bSortable': false,
                 'aTargets': [0]
             }]
         });

                 $('#sample_2').dataTable({
             "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
             "sPaginationType": "bootstrap",
             "oLanguage": {
                 "sLengthMenu": "_MENU_ records per page",
                 "oPaginate": {
                     "sPrevious": "Prev",
                     "sNext": "Next"
                 }
             },
             "aoColumnDefs": [{
                 'bSortable': false,
                 'aTargets': [0]
             }]
         });
         
         //jQuery('#sample_1 .group-checkable').change(function () {
             //var set = jQuery(this).attr("data-set");
             //var checked = jQuery(this).is(":checked");
             //jQuery(set).each(function () {
                 //if (checked) {
                     //$(this).attr("checked", true);
                // } else {
                     //$(this).attr("checked", false);
                 //}
             //});
             //jQuery.uniform.update(set);
         //});

         jQuery('#sample_1_wrapper .dataTables_filter input').addClass("input-medium"); // modify table search input
         jQuery('#sample_1_wrapper .dataTables_length select').addClass("input-mini"); // modify table per page dropdown
         
         jQuery('#sample_2_wrapper .dataTables_filter input').addClass("input-medium"); // modify table search input
         jQuery('#sample_2_wrapper .dataTables_length select').addClass("input-mini"); // modify table per page dropdown


 }();
 */
</script>