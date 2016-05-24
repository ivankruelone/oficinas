<script type="text/javascript">
<!--
    var clock;
	$(document).on('ready', inicio);
    
    function inicio()
    {
        $('#contestado').hide();
        var clock;
        var tiempo = $('#tiempo').html();
        var contestado = $('#contestado').html();
        var serie = $('#serie').html();
        
        if(contestado == 'SI')
        {
            $('#instrucciones').hide();
            $('#contestado').show();
        }
        
        tiempo = tiempo * 60;
        $('#preguntas').hide();
        
        clock = $('.clock').FlipClock(tiempo, {
		        clockFace: 'MinuteCounter',
		        countdown: true,
                autoStart: false,
		        callbacks: {
		        	stop: function() {
		        	 
                        var $url = $('#form_serie').attr('action');
                        finaliza(serie);
                        window.location.href = $url;
		        	},
                    interval: function() {
                        var time  = clock.getTime();
                        //actualizaTiempoRestanteActual(time, serie);
                        
                    },
                    start: function(){
                        comienza(serie);
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
            
            function termina()
            {
                var $url = $('#form_serie').attr('action');
                window.location.href = $url
            }

            if(confirm("realmente deseas terminar esta serie ?"))
            {
                finaliza(serie);
                wait(2);
                termina();
                return true;
            }else{
                return false;
            }
            
        });
        
        
        
        $( "input[name^='optionsRadios']" ).click(function(evento){
            var $valor = evento.currentTarget.value;
            actualiza($valor);
        });
        
        $( "input[name^='serie3_']" ).change(function(evento){
            console.log(evento);
            var $valor = evento.currentTarget.value;
            var $dato = evento.currentTarget.attributes.name.value;
            var $pregunta = $dato.replace('serie3_', '');
            var $opcion = evento.currentTarget.attributes.id.value;
            actualiza_pregunta_valor($pregunta, $valor.toLowerCase(), $opcion);
        });

        $( "input[name^='serie4_']" ).change(function(evento){
            console.log(evento);
            var $valor = evento.currentTarget.value;
            var $dato = evento.currentTarget.attributes.name.value;
            var $pregunta = $dato.replace('serie4_', '');
            var $opcion = evento.currentTarget.attributes.id.value;
            actualiza_pregunta_valor2($pregunta, $valor, $opcion);
        });

        function actualiza($valor){
            $.ajax({type: "POST",
                url: "<?php echo site_url(); ?>test/actualiza_terman/", data: ({ valor: $valor }),
                    success: function(data){
                        
        
                },
                beforeSend: function(data){
                
                },
                error: function(data){
                    alert('Dato erroneo!');
                }
                });
        
        }

        function actualiza_pregunta_valor($pregunta, $valor, $opcion){
            
            $.post( "<?php echo site_url(); ?>test/actualizaPreguntaValor/", { pregunta: $pregunta, valor: $valor, opcion: $opcion } );
            return false;
        }

        function actualiza_pregunta_valor2($pregunta, $valor, $opcion){
            
            $.post( "<?php echo site_url(); ?>test/actualizaPreguntaValor2/", { pregunta: $pregunta, valor: $valor, opcion: $opcion } );
            return false;
        }

        function actualizaTiempoRestanteActual($tiempoRestanteActual, $serie){
            
            $.post( "<?php echo site_url(); ?>test/actualizaTiempoRestanteActual/", { tiempoRestanteActual: $tiempoRestanteActual, serie: $serie } );
            return false;
        }


        function comienza($serie){
            
            $.post( "<?php echo site_url(); ?>test/termanComienza/", { serie: $serie } );
            return false;
        }

        function finaliza($serie){
            
            $.post( "<?php echo site_url(); ?>test/termanFinaliza/", { serie: $serie } );
            return false;
        }

    }
    
    
    
-->
</script>