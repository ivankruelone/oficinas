<script type="text/javascript">
<!--
    var clock;
	$(document).on('ready', inicio);
    
    
    function inicio()
    {

        var $testStatus = $( "input[name='control']" ).val();
        var $funcion = '<?php echo $this->uri->rsegment(2);?>';
        var $test = $funcion.replace('beta_serie', '');
        
        //alert($funcion);
        
        if($testStatus == 1){
            
            var $url = '<?php echo base_url('test/beta_tiempo_terminado/');?>' + '/' + $test;
            window.location.href = $url;
    
        }


        $('#contestado').hide();
        var clock;
        var contestado = $('#contestado').html();
        var serie = "<?php echo $serie; ?>";
        //alert(serie);
        
        if(serie == 1){
            tiempo = 2 * 60;
        }
        if(serie == 2){
            tiempo = 2 * 75;
        }
        if(serie == 3){
            tiempo = 2 * 60;
        }
        if(serie == 4){
            tiempo = 3 * 60;
        }
        if(serie == 5){
            tiempo = 5 * 60;
        }
        
        comienza(serie);
        
        if(contestado == 'SI')
        {
            $('#instrucciones').hide();
            $('#contestado').show();
        }
        
        tiempo = tiempo;
        $('#preguntas').hide();
        
        clock = $('.clock').FlipClock(tiempo, {
		        clockFace: 'MinuteCounter',
		        countdown: true,
                autoStart: true,
		        callbacks: {
		        	stop: function() {

                        var $url = '<?php echo base_url('test/beta_tiempo_terminado');?>';
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
        
        
        $( "input[name^='beta']" ).change(function(evento){
            console.log(evento);
            var $valor = evento.currentTarget.value;
            var $dato = evento.currentTarget.attributes.name.value;
            var $pregunta = $dato.replace('beta', '');
            actualiza_pregunta_valor1($pregunta, $valor.toLowerCase());
        });
        
        

        function actualiza_pregunta_valor1($pregunta, $valor){
            
            $.post( "<?php echo site_url(); ?>test/actualizaPreguntaValor1/", { pregunta: $pregunta, valor: $valor } );
            return false;
        }


        function comienza($serie){
            
            $.post( "<?php echo site_url(); ?>test/betaComienza/", { serie: $serie } );
            return false;
        }


    }
    
    
-->
</script>