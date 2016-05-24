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
$atributos1 = array('id' => 's_orden_especial_det_agrega_fac');
    echo form_open('orden/s_orden_especial_det_agrega_fac', $atributos1);
    $data_fac = array(
              'name'        => 'fac',
              'id'          => 'fac',
              'class'       => 'span11',
              'value'       => '',
              'maxlength'   => '40',
              'size'        => '40'
            );
	$atributos = array('id' => 's_orden_especial_det_agrega');
    echo form_open('orden/s_orden_especial_det_agrega', $atributos);
    $data_cod = array(
              'name'        => 'cod',
              'id'          => 'cod',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
    $data_des = array(
              'name'        => 'des',
              'id'          => 'des',
              'value'       => '',
              'maxlength'   => '8',
              'size'        => '8'
            );
    $data_cos = array(
              'name'        => 'cos',
              'id'          => 'cos',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11'
            );
  ?>
 <div>
 <table>
 <tr>
	<td align="left" ><font size="+1">Facturas...: </font></td>
	<td><?php echo form_input($data_fac, "", 'required');?><span id="mensaje"></span></td>
    <td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar Facturas');?></td>
</tr>
 </table>
<input type="hidden" value="<?php echo $id_orden?>" name="id_orden" id="id_orden" />
<input type="hidden" value="<?php echo $prv?>" name="prv" id="prv" />
  <?php
	echo form_close();
  ?>
  </div>
  
  <table>
<tr>
<tr>
	<td align="left" ><font size="+1">Codigo: </font></td>
	<td><?php echo form_input($data_cod, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Cantidad: </font></td>
	<td><?php echo form_input($data_can, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Descuento: </font></td>
	<td><?php echo form_input($data_des, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Costo: </font></td>
	<td><?php echo form_input($data_cos, "", 'required');?></td>
</tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'aceptar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_orden?>" name="id_orden" id="id_orden" />
<input type="hidden" value="<?php echo $prv?>" name="prv" id="prv" />
  <?php
	echo form_close();
  ?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Clave</th>
                                     <th>Codigo</th>
                                     <th>Descripcion</th>
                                     <th>Cant.</th>
                                     <th>CantSin<br />Cargo</th>
                                     <th>Costo</th>
                                     <th>Descuento</th>
                                     <th>Importe</th>
                                     <th>Imp.Des</th>
                                     <th>Imp.Ieps</th>
                                     <th>Imp.Iva</th>
                                     <th>Total</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=1;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $l1=anchor('orden/orden_especial_det_bor/'.$id_orden.'/'.$prv.'/'.$r->id_detalle,'Borrar');
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; "><?php echo $r->clagob?></td>
                                        <td style="text-align: right; "><?php echo $r->codigo?></td>
                                        <td style="text-align: left; "><?php echo $r->susa1.'<br />'.$r->susa2?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->canp,0)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->canr,0)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->costo,0)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->descuento,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp_descu,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp_ieps,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp_iva,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->total,2)?></td>
                                        <td><?php echo $l1?></td>
                                        </tr>
                                        <?php 
                                        $num=$num+1;
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