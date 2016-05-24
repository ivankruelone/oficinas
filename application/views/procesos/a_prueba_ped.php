                 <div class="span8">
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
	$atributos = array('id' => 'sumit_prueba_ped');
    echo form_open('procesos/sumit_prueba_ped', $atributos);
    
  ?>
 
  <table>
<tr>
<tr>
    <td align="left" ><font size="+1"><strong>Rango de Fecha: </strong></font></td>
	<td align="left"><?php echo form_dropdown('suc', $suc, '', 'id="suc"') ;?> </td>
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
                               <th style="text-align: left;">#</th>
                               <th style="text-align: left;">Sucursal</th>
                               <th></th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color='blue';$color1='orange';
                                 foreach ($q->result()as $r){
                                $l1=anchor('procesos/a_prueba_ped_det/'.$r->id,'CAPTURA PRODUCTOS');
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->suc?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->nombre?></td>
                                   <td><?php echo  $l1?></td>
                                 </tr> 
                           
                                <?php } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>

                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>