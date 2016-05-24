                 <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         
<?php 
	$atributos = array('id' => 'a_poliza_inv_det');
    echo form_open('backoffice/a_poliza_inv_det', $atributos);
    $data_aaa = array(
              'name'        => 'aaa',
              'id'          => 'aaa',
              'value'       => date('Y'),
              'maxlength'   => '4',
              'size'        => '4'
            );
     $data_mes = array(
              'name'        => 'mes',
              'id'          => 'mes',
              'value'       => date('m'),
              'maxlength'   => '2',
              'size'        => '2'
            );
      $data_dia = array(
              'name'        => 'dia',
              'id'          => 'dia',
              'value'       => date('d'),
              'maxlength'   => '2',
              'size'        => '2'
            );
      $data_sem = array(
              'name'        => 'sem',
              'id'          => 'sem',
              'value'       => '',
              'maxlength'   => '2',
              'size'        => '2'
            );
 if($sem_corrida>$sem_respal){$l0=anchor('backoffice/respalda_sem_inv/'.$sem_corrida,'Respaldar');}else{$l0='';}
 ?>
 <div>
  <table>
<tr>
<th colspan="2" style="color: blue;"><font size="+1">Ultima semana generada <?php echo"<br />".$sem_corrida ?></font></th>

<th colspan="1" style="color: green;"><font size="+1">Ultima semana respaldada <?php echo "<br />".$sem_respal ?></font></th>
<th colspan="1" style="color: green;"><?php echo $l0 ?></th>
</tr>
 <tr>
	<td colspan="2" align="left" ><font size="+1"><strong>A&ntilde;o: </strong></font></td>
	<td colspan="2" ><?php echo form_input($data_aaa, "", 'required');?></td>
 </tr>
 <tr>
	<td colspan="2"  align="left" ><font size="+1"><strong>Mes: </strong></font></td>
	<td colspan="2" ><?php echo form_input($data_mes, "", 'required');?></td>
 </tr>
 <tr>
	<td colspan="2"  align="left" ><font size="+1"><strong>Dia: </strong></font></td>
	<td colspan="2" ><?php echo form_input($data_dia, "", 'required');?></td>
 </tr><tr>
	<td colspan="2"  align="left" ><font size="+1"><strong>Semana: </strong></font></td>
	<td colspan="2" ><?php echo form_input($data_sem, "", 'required');?></td>
 </tr>

	<td colspan="4"align="center"><?php echo form_submit('envio', 'Generar');?></td>
</tr>
</table>

  <?php
	echo form_close();
  ?>
 </div>
 <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">Nid</th>
                               <th style="text-align: left;">Sucursal</th>
                               <th style="text-align: left;">Existencia</th>
                               <th style="text-align: left;">Observacion</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color ='blue';
                                 foreach ($q->result()as $r){
                              
                                
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->suc?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->nombre?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->exis?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->obser?></td>
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