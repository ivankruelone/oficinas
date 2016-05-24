<section>
    <div class="block-border">
        <div class="block-content">
            <h1><?php echo $titulo;?></h1>
            
            <?php
            echo form_open('empleados/estatus_resultado', array('class' => 'form', 'id' => 'estatus_form'));
            
            $data1 = array(
              'name'        => 'nomina',
              'id'          => 'nomina',
              'maxlength'   => '10',
              'type'        => 'number',
             
            );
            $data2 = array(
              'name'        => 'emple',
              'id'          => 'emple',
              'maxlength'   => '10',
              'type'        => 'text',
           
            );
            
            
            echo " Nomina: ";
            echo form_input($data1);
            echo " Empleado: ";
            echo form_input($data2);
            echo '<br /><br />';
            echo " ";
            echo '<button class="big" type="submit">BUSCAR</button>';
            echo form_close();
            ?>
            
        </div>
    </div>
</section>