<script type="text/javascript">

$(document).on('ready', carga);

function carga()
{
   var Sliders = function () {
    
    var utilidadBruta = <?php echo $datos->utilidadBruta; ?>;
    var inputUtilidad = <?php echo $datos->inputUtilidad; ?>;
    var gastosControlables = <?php echo $datos->gastosControlables; ?>;
    var gastosNoControlables = <?php echo $datos->gastosNoControlables; ?>;
    var gastoFinanciero = <?php echo $datos->gastoFinanciero; ?>;
    var otrosIngresos = <?php echo $datos->otrosIngresos; ?>;
    var ventaTotal = <?php echo $datos->ventaTotal; ?>;
    
    
    $("#snap-inc-slider").slider({
        value: ventaTotal,
        min: 0,
        max: ventaTotal * 10,
        step: ventaTotal / 2,
        slide: function (event, ui) {
            $("#snap-inc-slider-amount").text("$" + ui.value);
            
            var ventaProyectada = ui.value;
            var utilidadBrutaProyectada = ventaProyectada * (inputUtilidad / 100);
            var balance = utilidadBrutaProyectada - gastosControlables - gastosNoControlables - gastoFinanciero + otrosIngresos;
            var ganancia = utilidadBrutaProyectada + otrosIngresos - gastosControlables - gastosNoControlables + balance;
            var inputProyectado = (balance / ventaProyectada) * 100;

            
            $("#importe_proyectado").html(balance.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            $("#input_proyectado").html(inputProyectado.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        }
    });

    $("#snap-inc-slider-amount").text("$" + $("#snap-inc-slider").slider("value"));
    
    
    
    }(); 
}

</script>