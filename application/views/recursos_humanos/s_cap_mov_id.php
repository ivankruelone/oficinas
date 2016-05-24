                 <div class="span5">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <?php
	$atributos = array('id' => 'sumit_agrega_movimientos');
    echo form_open('recursos_humanos/sumit_agrega_movimientos',$atributos);
    $data_fec = array(
              'name'        => 'fec',
              'id'          => 'fec',
              'value'       => $fec,
              'maxlength'   => '10',
              'size'        => '10'
            );
    

    
 ?>  
 <table>
 <tr  bgcolor="gray">
 <th colspan="2" style="text-align: center; color:blue"><?php echo $tit?></th>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>Empleado :</strong></font></td>
	<td colspan="1"><?php echo form_dropdown('nomina', $nomina, '', 'id="nomina"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Fecha :</strong></font></td>
	<td colspan="1"><?php echo form_input($data_fec, "", 'required');?></td>
</tr>
<?php if($mov==3){
?>
<tr>
    <td align="left" ><font size="+1"><strong>Sucursal :</strong></font></td>
	<td colspan="1"><?php echo form_dropdown('suc', $suc, '', 'id="suc"') ;?> </td>
</tr>
<?php }?>
<tr>
    <td align="left" ><font size="+1"><strong>Motivo :</strong></font></td>
	<td colspan="1"><?php echo form_dropdown('mot', $mot, '', 'id="mot"') ;?> </td>
</tr>

</table>
<input type="hidden" value="<?php echo $mov?>" name="mov" id="mov" />
<?php  
    echo form_submit('mysubmit', 'Aplicar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>
<!----> 
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->

                 </div>
                 

                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo_tabla?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th></th>
                                     <th>Fecha</th>
                                     <th>Motivo</th>
                                     <th>Causa</th>
                                     <th>Nomina</th>
                                     <th>Empleado</th>
                                     <th>Dias</th>
                                     <th>Aplicar</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
$l1= anchor('recursos_humanos/borrar_mov/'.$r->id.'/'.$r->motivo,'Borrar </a>', array('title' => 'Haz Click aqui para Borrar!', 'class' => 'encabezado'));
$l2= anchor('recursos_humanos/valida_movimiento/'.$r->id.'/'.$r->motivo,'Validar </a>', array('title' => 'Haz Click aqui para Validar!', 'class' => 'encabezado'))
                                ?>
                                        <tr>
                                        <td><?php echo $l1?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha_mov?></td>
                                        <td style="text-align: left; "><?php echo $r->motivox?></td>
                                        <td style="text-align: left; "><?php echo $r->causax?></td>
                                        <td style="text-align: left; "><?php echo $r->nomina?></td>
                                        <td style="text-align: left; "><?php echo $r->nombre?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->dias)?></td>
                                        <td style="text-align: right; "><?php echo $r->aplica?></td>
                                        <td><?php echo $l2?></td>
                                        </tr>
                                        <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             </tr>
                             </tfoot>
                         </table>                        

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>