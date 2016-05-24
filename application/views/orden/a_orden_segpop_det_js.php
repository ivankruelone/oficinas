<script>
$(document).ready(function() {

    var $prv = $("#prv").html();
    var $id_orden = $("#id_orden").html();
    $("#forma").on('submit', envio);

    function envio(event)
    {
        event.preventDefault();
        var $id_cat = $("#id_cat").val();
        var $can = $("#can").val();
        var $canr = $("#canr").val();
        var $des = $("#des").val();
        
        $url = '<?php echo site_url('orden/a_orden_segpop_det_agrega'); ?>';

            $.post( $url, {
                id_orden : $id_orden, 
                prv      : $prv, 
                id_cat   : $id_cat, 
                can      : $can, 
                canr     : $canr, 
                des      : $des}).done(function( data ) {
            
            
           
             if(data==1){
                
                mostrar_tabla($id_orden,$prv);
                $("#id_cat").val('');
                $("#codigo").val('');
                $("#costo").val('');
                $("#can").val('');
                $("#canr").val('');
                $("#des").val('');
                $("#cla").val('').focus();
             }
             
            });
       
        
    }
    
    
    function mostrar_tabla($id_orden,$prv)
    {
                $url = '<?php echo site_url('orden/a_mostrar'); ?>';
               $.post( $url, { id_orden: $id_orden, prv:$prv }).done(function( data ) {
                
                $("#mostrar").html(data);
                
                
               });   
    }

    $("#id_cat").on('change', actualizadatos);
    function actualizadatos(event)
    {
        var $id_cat = event.currentTarget.value;
        $url = '<?php echo site_url('orden/a_busco_id_cat'); ?>';

            $.post( $url, { id_cat: $id_cat, id_orden:$id_orden }).done(function( data ) {
                var $arr = JSON.parse(data);

                $("#costo").val($arr.costo);
                $("#codigo").val($arr.codigo);

            });
    }
    

-->
    ////////////////////////////////////////////////////////
    $('#cla').on('change', checkcla);
        
        function checkcla(event)
        {
            var $cla = event.currentTarget.value;
            searchcla($cla,$prv);
        }
        function searchcla($cla,$prv)
        {
            $url = '<?php echo site_url('orden/a_busco_clave_segpop'); ?>';
            $.post( $url, { cla: $cla, prv: $prv }).done(function( data ) {
            $("#id_cat").html(data);
            });
            
        }
    ////////////////////////////////////////////////////////
    });
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



</script>