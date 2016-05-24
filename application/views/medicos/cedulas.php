    <?php
    $cedula = array('name' => 'cedula',
                    'id'   => 'cedula',
                    'value'=>'');
    echo form_label('Ingresa N&uacute;mero de C&eacute;dula');
    echo form_input($cedula, '','required');
    ?>
    <input type="submit" value="verificar" onclick = "enviar();" />
<script type="text/javascript" language="javascript">
    
    function enviar(){
             valor= $('#cedula').attr('value');
             window.open('http://www.buholegal.com/'+valor)
     }
     
</script>