
<div class="panel panel-default">
    </div>
    <div class="span5">

     <!-- BEGIN BLANK PAGE PORTLET-->
        <div class="widget blue">
            <div class="widget-title">
                <h4><i class="icon-reorder"></i> Maximo Sucursal</h4>
                <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
                <div class="widget-body">
                 
                  <?php
                    echo form_open('catalogos/sumit_max_sucursal');
                    echo "<br />";   
                    $sec = array(
                        'name' => 'sec',
                        'id' => 'sec',
                        'size' => '50',
                        'class'=> 'span3',
                        'maxlength' => '4',
                        'autofocus'   => 'autofocus',              
                        'value' => set_value('sec') 
                    );

                    $cant = array(
                        'name' => 'cant',
                        'id' => 'cant',
                        'size' => '50',
                        'class'=> 'span3',
                        'maxlength'   => '4',              
                        'value' => set_value('cant') 
                    );
                    $cant_cedis = array(
                        'name' => 'cant_cedis',
                        'id' => 'cant_cedis',
                        'size' => '50',
                        'class'=> 'span3',
                        'maxlength'   => '6',              
                        'value' => set_value('cant') 
                    );

                  ?>  

                   <table> 

                     <tr>
                        <td colspan="2" style="color: blue;">SOLO APLICA A SECUENCIAS NUEVAS; YA QUE SI EXISTE UN MAXIMO EN SUCURSAL; NO APLICAR&Aacute; EL CAMBIO</td>
                     </tr>
                     <tr>
                        <td align="left" ><font size="+0.5"><strong>Secuencia</strong></font></td>
                        <td>
                        <?php echo form_input($sec,"", 'required'); ?>
                        </td>
                        <td colspan="8"> </td>
                     </tr>

                      <tr>
                        <td align="left" ><font size="+0.5"><strong>Cantidad Farmacia</strong></font></td>
                        <td>
                        <?php echo form_input($cant,"", 'required'); ?>
                        </td>
                        <td colspan="8"> </td>
                     </tr>
                    <tr>
                        <td align="left" ><font size="+0.5"><strong>Cantidad Cedis</strong></font></td>
                        <td>
                        <?php echo form_input($cant_cedis,"", 'required'); ?>
                        </td>
                        <td colspan="8"> </td>
                     </tr>
                   </table>
              
                    <center>
                    <div class="row">
                       <input type="submit" class="btn btn-primary dropdown-toggle" value="Agregar" />
                        <?php  
                            echo "<br />";
                            echo "<br />";
                            echo form_close();
                        ?>
                    </center>
                                       
        </div>
    </div>
    <!-- END BLANK PAGE PORTLET-->
    
</div>

