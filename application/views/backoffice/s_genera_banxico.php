                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<?php
	$atributos = array('id' => 'envia_archivos');
    echo form_open('backoffice/sumit_banxico', $atributos);
$data_fec = array(
              'name'        => 'fec',
              'id'          => 'fec',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
            ); 
 $data_lis = array(
              'name'        => 'lis',
              'id'          => 'lis',
              'value'       => '8',
              'maxlength'   => '1',
              'size'        => '1'
            );    
  ?>
 
  <table>
<tr>
<tr>
    <td align="left" ><font size="+1"><strong>Rango de Fecha: </strong></font></td>
	<td align="left"><?php echo  form_input($data_fec, "", 'required');?> AAAA-MM-DD</td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Lista: </strong></font></td>
	<td align="left"><?php echo  form_input($data_lis, "", 'required');?></td>
</tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'GENERAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?>


<!----> 
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                                 <tr> 
                                     <th>#</th>
                                     <th style="text-align: center;">fecha</th>
                                     <th style="text-align: center;">Productos</th>
                                     <th style="text-align: center;">Lista</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;
                                     foreach ($q->result() as $r2) {
                                         ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha_activo?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->productos?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->lista,0)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>