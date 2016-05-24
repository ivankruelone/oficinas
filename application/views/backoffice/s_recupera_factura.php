                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
	$atributos = array('id' => 'factura_central_enlaza');
    echo form_open('backoffice/factura_central_enlaza', $atributos);
    $data_fecha = array(
              'name'        => 'fecha',
              'id'          => 'fecha',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
              
            );

  ?>
 
  <table>

<tr>
    <td align="left" ><font size="+1"><strong>Fecha: </strong></font></td>
	<td><?php echo form_input($data_fecha, "", 'required');?> AAAA-MM-DD</td>
</tr>

<tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'Extraer');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                                <thead>
                                    <tr>
                                     <th>#</th>   
                                     <th style="text-align: left">Fecha</th> 
                                     <th style="text-align: left">Prv</th>
                                     <th style="text-align: left">Provedor</th>
                                     <th style="color:gray; text-align: right">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                               $color='gray';$num=0;
                               foreach ($q->result()as $r){
                                $num=$num+1;
                               ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->prv?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->razo?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->imp_prv,2)?></td>
                                </tr>
                               <?php 
                             
                                } ?>
                              </tbody>
                              <tfoot>
                           
                             </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>