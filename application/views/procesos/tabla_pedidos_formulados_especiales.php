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

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla0">
                             <thead>
<?php 
$l0=anchor('procesos/correo_nivel_de_surtido','ENVIA CORREO NIVEL DE SURTIDO</a>', array('title' => 'Haz Click aqui para enviar correo!', 'class' => 'encabezado'));
$l1=anchor('procesos/correo_ventas','ENVIA CORREO VENTAS ACUMULADAS</a>', array('title' => 'Haz Click aqui para enviar correo!', 'class' => 'encabezado'));
?>                            
                            
                             <tr>
                             <td colspan="4"><?php echo $l0 ?></td>
                             <td colspan="4"><?php echo $l1 ?></td>
                             </tr>
                             <tr>
                             <th colspan="1">#</th>
                             <th colspan="1">Nid</th>
                             <th colspan="1">Sucursal</th>
                             <th colspan="1">Tel</th>
                             <th colspan="1">Tel</th>
                             <th colspan="1">Tel Iusacel</th>
                             <th colspan="1">Tel Actual</th>
                             <th colspan="1">Observacion</th>
                             <th colspan="1">Correo</th>
                             </tr>
                             </thead>
                                
                                <tbody>
                                 <?php
                                $color='blue';$nums=0;
                               foreach ($q1->result()as $r1){
                             //suc, nombre, obser, tel, tel1, tel_actual, tel_iu
                               $nums=$nums+1;
                               ?>
                               <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $nums?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->nombre?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->tel?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->tel1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->tel_iu?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->tel_actual?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r1->obser?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r1->correo?></td>
                                </tr>
                               <?php
                               }
                               ?>
                              </tbody>
                              <tfoot>
                           
                             </tfoot>
                         </table>
<!----> 


 <?php
	echo form_open('procesos/sumit_pedidos_formulados_especiales');
    echo "<br />";
    $data_sec = array(
              'name'        => 'in_sec',
              'id'          => 'in_sec',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '100'
              
            );
 ?>  
 <table> 
 <tr>
    <td align="left" ><font size="+1"><strong>Clasificacion A: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por1', $por1, '', 'id="por1"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion B: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por2', $por2, '', 'id="por2"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion C: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por3', $por3, '', 'id="por3"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion D: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por4', $por4, '', 'id="por4"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion E: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por5', $por5, '', 'id="por4"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Secuencias: </strong></font></td>
	<td><?php echo form_input($data_sec, "", 'required');?></td>
    <td colspan="6"></td>
</tr>

</table>
<input type="hidden" value="<?php echo $in_suc?>" name="in_suc" id="in_suc" />
  
<?php  
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
    $l0= anchor('procesos/imprime_pedidos_diarios_especiales','Imprime</a>', array('title' => 'Haz Click aqui para imprimir!', 'class' => 'encabezado', 'target'=>'black'));
    $l1= anchor('procesos/imprime_pedidos_diarios_ctl','Imprime_ctl</a>', array('title' => 'Haz Click aqui para imprimir control!', 'class' => 'encabezado', 'target'=>'black'));
    $l2= anchor('procesos/imprime_pedidos_diarios_sec','Imprime_sec</a>', array('title' => 'Haz Click aqui para imprimir Secuencias!', 'class' => 'encabezado', 'target'=>'black'));                                                     
    $l3= anchor('procesos/descarga_pedidos','Aqui</a>', array('title' => 'Haz Click aqui para Descargar', 'class' => 'encabezado', 'target'=>'_blank'));
 ?>                    
                     
                     
                     
                         
                         
                         
                     
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             <tr>
                             <th colspan="3" style="text-align: center;"><?php echo $l0 ?> Descarga <?php echo $l3; ?></th>
                             <th colspan="2" style="text-align: center;"><?php echo $l1 ?></th>
                             <th colspan="3" style="text-align: center;"><?php echo $l2 ?></th>
                             </tr>
                            
                             <tr>
                             <th colspan="1">#</th>
                             <th colspan="1">Fecha Limite</th>
                             <th colspan="1">Fecha Inv</th>
                             <th colspan="1">Nid</th>
                             <th colspan="1">Sucursal</th>
                             <th colspan="1">Tel</th>
                             <th colspan="1">Inv</th>
                             <th colspan="1">Fol.Ped</th>
                             </tr>
                             </thead>
                                
                                <tbody>
                                 <?php
                                $color='green';$nume=0;
                               foreach ($q->result()as $r){
                               if($r->pedido==0 and $r->fechai<$r->limite){$color='red';}
                               elseif($r->pedido==0 and $r->fechai>$r->limite){$color='blue';}else{$color='green';}
                               $nume=$nume+1;
                               ?>
                               <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $nume?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->limite?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fechai?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->nombre?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->tel.'<br />'.$r->tel1?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->inv,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->pedido?></td>
                                </tr>
                               <?php
                               }
                               ?>
                              </tbody>
                              <tfoot>
                           
                             </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>