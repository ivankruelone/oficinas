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
              'class'       => 'span5',
              'size'        => '4',
              'autofocus'   => 'autofocus'
            );
     $data_mes = array(
              'name'        => 'mes',
              'id'          => 'mes',
              'value'       => date('m'),
              'class'       => 'span3',
              'maxlength'   => '2',
              'size'        => '8'
            );
      $data_dia = array(
              'name'        => 'dia',
              'id'          => 'dia',
              'value'       => date('d'),
              'class'       => 'span3',
              'maxlength'   => '2',
              'size'        => '8'
            );
      $data_sem = array(
              'name'        => 'sem',
              'id'          => 'sem',
              'value'       => '',
              'class'       => 'span3',
              'maxlength'   => '2',
              'size'        => '2'
            );
 if($sem_corrida>$sem_respal){$l0=anchor('backoffice/respalda_sem_inv/'.$sem_corrida,'Respaldar');}else{$l0='';}
 ?>
 <div>
  <table class="table table-bordered table-condensed table-striped table-hover" id="tabla0">
<tr>
<th colspan="3" style="color: blue;"><font size="+1">Ultima semana generada <?php echo"<br />".$sem_corrida ?></font></th>

<th colspan="2" style="color: green;"><font size="+1">Ultima semana respaldada <?php echo "<br />".$sem_respal ?></font></th>
<th colspan="2" style="color: green;"><?php echo $l0 ?></th>
</tr>
 <tr>
	<td colspan="1"><strong>A&ntilde;o:</strong> <?php echo form_input($data_aaa, "", 'required');?></td>
 	<td colspan="1"><strong>Mes:</strong> <?php echo form_input($data_mes, "", 'required');?></td>
 	<td colspan="1"><strong>Dia:</strong> <?php echo form_input($data_dia, "", 'required');?></td>
    <td colspan="2"><strong>Semana: </strong><?php echo form_input($data_sem, "", 'required');?></td>
    <td colspan="4"><?php echo form_submit('envio', 'Generar');?></td>
</tr>
</table>

  <?php
	echo form_close();
  ?>
 </div>
 <div class="widget-body">
 <!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         

 <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th>#</th>
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
                              
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $num?></td>
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
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         

 <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                               <tr>
                               <th>#</th>
                               <th style="text-align: left;">Sem</th>
                               <th style="text-align: left;">A&ntilde;o</th>
                               <th style="text-align: left;">Mes</th>
                               <th style="text-align: left;">Dia</th>
                               <th style="text-align: left;">Piezas</th>
                               <th style="text-align: left;">Importe</th>
                               <th></th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num1=0;$margen=0;$color ='blue';
                                 foreach ($q1->result()as $r1){
                              $l0=anchor('backoffice/envia_inv_as400_archivo/'.$r1->aaa.'/'.$r1->sem,'Enviar AS400');
                                $num1=$num1+1;
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $num1?></td> 
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r1->sem?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r1->aaa?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r1->mes?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r1->dia?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo number_format($r1->piezas,2)?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo number_format($r1->imp,2)?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $l0?></td>
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