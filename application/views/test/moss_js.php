<script type="text/javascript">
<!--
    var clock;
	$(document).on('ready', inicio);
    
    function inicio()
    {
        var $testStatus = $( "input[name='control']" ).val();
        
        if($testStatus == 1){
            
            var $url = '<?php echo base_url('test/moss_tiempo_terminado');?>';
            window.location.href = $url;
    
        }
        
        
        $('#contestado').hide();
        var clock;
        var contestado = $('#contestado').html();
        comienza();
        
        if(contestado == 'SI')
        {
            $('#instrucciones').hide();
            $('#contestado').show();
        }
        
        tiempo = 30 * 60;
        $('#preguntas').hide();
        
        clock = $('.clock').FlipClock(tiempo, {
		        clockFace: 'MinuteCounter',
		        countdown: true,
                autoStart: true,
		        callbacks: {
		        	stop: function() {

                        var $url = '<?php echo base_url('test/moss_tiempo_terminado');?>';
                        window.location.href = $url;

		        	},
                    start: function(){
                        //comienza(serie);
                    }
		        }
        });

        $('#iniciar_serie').on('click', inicia_serie);
        
        function inicia_serie()
        {
            $('#preguntas').show();
            $('#instrucciones').hide();
            clock.start();
        }


        $('#form_serie').submit(function(event){
            
            event.preventDefault();
            
            function wait(nsegundos) {
                objetivo = (new Date()).getTime() + 1000 * Math.abs(nsegundos);
                while ( (new Date()).getTime() < objetivo );
            };
            

            if(confirm("realmente deseas terminar esta serie ?"))
            {
                wait(2);
                return true;
            }else{
                return false;
            }
            
        });
        
        $( "input[name^='optionsRadios']" ).click(function(evento){
            var $valor = evento.currentTarget.value;
            actualiza($valor);
        });
        
        
        function actualiza($valor){
            $.ajax({type: "POST",
                url: "<?php echo site_url(); ?>test/actualiza_moss/", data: ({ valor: $valor}),
                    success: function(data){
                        
        
                },
                beforeSend: function(data){
                
                },
                error: function(data){
                    alert('Dato erroneo!');
                }
                });
        
        }


        function comienza(){
            
            $.post( "<?php echo site_url(); ?>test/mossComienza/", { } );
            return false;
        }


    }
    
    
    
-->
</script>