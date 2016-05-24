                 <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                 <tr> 
                                     <th>Id</th>
                                     <th>Fecha</th>
                                     <th>Informacion</th>
                                     <th>Pharm</th>
                                     <th>Nid</th>
                                     <th>Sucurusal</th>
                                     <th>Observacion</th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;
                                     foreach ($q->result() as $r2) {
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->procesos?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->back?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->nombre ?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->observacion ?></td>
                                        </tr>
                                        <?php $num=$num+1;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             
                             
                             </tr>
                             </tfoot>
                         </table> 
<?php
	$atributos = array('id' => 's_falta_datos_observacion_sumit');
    echo form_open('backoffice/s_falta_datos_observacion_sumit', $atributos);
 $data_obs= array(
              'name'        => 'obs',
              'id'          => 'obs',
              'value'       => '',
              'maxlength'   => '200',
              'size'        => '255'
              
            );   
    
  ?>
 
  <table>

<tr>
<td colspan="2" align="center">Aplica el problema</td>
</tr>
<tr>
<td><?php echo form_input($data_obs, "", 'required');?></td>
<td colspan="2"align="center"><?php echo form_submit('envio', 'Guardar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />
<?php
 
	echo form_close();
  ?>
  
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>