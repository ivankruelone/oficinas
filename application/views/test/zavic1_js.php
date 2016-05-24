<script type="text/javascript">
<!--
        
     
     
        
        

                $( "ul[id^='sortable']" ).sortable({
                    update: function( event, ui ) {
                        var ordenElementos = $(this).sortable("toArray").toString();
                        actualiza(ordenElementos);
                    }
                });
                
                $( "ul[id^='sortable']" ).disableSelection();

        


    
    
    
-->
</script>