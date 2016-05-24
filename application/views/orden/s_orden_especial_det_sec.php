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
	$atributos = array('id' => 's_orden_especial_det_agrega_sec');
    echo form_open('orden/s_orden_especial_det_agrega_sec', $atributos);
    $data_sec = array(
              'name'        => 'sec',
              'id'          => 'sec',
              'value'       => '',
              'maxlength'   => '4',
              'size'        => '4'
            );
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
    $data_canr = array(
              'name'        => 'canr',
              'id'          => 'canr',
              'value'       => '0',
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
  ?>
 
  <table>
<tr>
<tr>
	<td align="left" ><font size="+1">Sec: </font></td>
	<td><?php echo form_input($data_sec, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Cantidad: </font></td>
	<td><?php echo form_input($data_can, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Cantidad Sin Cargo: </font></td>
	<td><?php echo form_input($data_canr, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Descuento: </font></td>
	<td><?php echo form_input($data_des, "", 'required');?></td>
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
                                     <th>sec</th>
                                     <th>Codigo</th>
                                     <th>Sustancia Activa</th>
                                     <th>Descripcion</th>
                                     <th>Cantidad</th>
                                     <th>Cantidad Sin Cargo</th>
                                     <th>Costo o Farmacia</th>
                                     <th>Descuento</th>
                                     <th>Importe</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=1;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $l1=anchor('orden/orden_especial_det_bor_sec/'.$id_orden.'/'.$prv.'/'.$r->id_detalle,'Borrar');
                                if($r->descuento>0 and $r->iva==0){
                                    $imp=($r->canp*$r->costo)-(($r->canp*$r->costo)*($r->descuento/100));
                                }elseif($r->descuento>0 and $r->iva==1)
                                {
                                    $imp=($r->canp*$r->costo)-(($r->canp*$r->costo)*($r->descuento/100));
                                }else{
                                    $imp=($r->canp*$r->costo); 
                                }
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; "><?php echo $r->sec?></td>
                                        <td style="text-align: right; "><?php echo $r->codigo?></td>
                                        <td style="text-align: left; "><?php echo $r->susa1?></td>
                                        <td style="text-align: left; "><?php echo $r->susa2?></td>
                                        <td style="text-align: left; "><?php echo $r->canp?></td>
                                        <td style="text-align: left; "><?php echo $r->canr?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->costo,2)?></td>
                                        <td style="text-align: right; "><?php echo '% '.number_format($r->descuento,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($imp,2)?></td>
                                        
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