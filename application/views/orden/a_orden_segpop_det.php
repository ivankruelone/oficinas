                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4>Id de orden: <span id="id_orden"><?php echo $id_orden; ?></span></h4>
                             <h4>Busqueda de productos por proveedor: <span id="prv"><?php echo $prv; ?></span></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php echo form_open('orden/a_orden_segpop_det_agrega',array('class' => 'form-horizontal', 'id' => 'forma'));
    $data_cla = array(
              'name'        => 'cla',
              'id'          => 'cla',
              'class'       => 'span2',
              'type'        => 'varchar',
              'required'    => 'required',
              'autofocus'   => 'autofocus',
              'maxlength'   => '20'
            );
  $data_sus = array(
              'name'        => 'sus',
              'id'          => 'sus',
              'class'       => 'span2',
              'type'        => 'varchar',
              'required'    => 'required',
              'maxlength'   => '15'
            );          
    $data_cos = array(
              'name'        => 'costo',
              'id'          => 'costo',
              'class'       => 'span2',
              'type'        => 'text',
              'maxlength'   => '255',
              'disabled'     => 'disabled'
            );
    $data_cod = array(
              'name'        => 'codigo',
              'id'          => 'codigo',
              'class'       => 'span2',
              'type'        => 'text',
              'maxlength'   => '255',
              'disabled'     => 'disabled'
            );
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'class'       => 'span2',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
    $data_canr = array(
              'name'        => 'canr',
              'id'          => 'canr',
              'class'       => 'span2',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
    $data_des = array(
              'name'        => 'des',
              'id'          => 'des',
              'class'       => 'span2',
              'value'       => '',
              'maxlength'   => '8',
              'size'        => '8'
            );
    
  ?>
 
  <table>
<tr>
<tr>
                            <div class="control-group">
                                <label class="control-label">Busqueda: </label>
                                <div class="controls">
                                <?php echo form_input($data_cla, "", 'required');?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Sustancia Activa: </label>
                                <div class="controls">
                                <select name="id_cat" id="id_cat" style="width:100%">
                                </select>
                                </div>
                            </div>
                            
                             <div class="control-group">
                                <label class="control-label">Codigo: </label>
                                <div class="controls">
                                <?php echo form_input($data_cod, "", 'required');?>
                                Costo .......................:
                                <?php echo form_input($data_cos, "", 'required');?>
                                </div>
                            </div>
                            
                            
                            <div class="control-group">
                                <label class="control-label">Cantidad: </label>
                                <div class="controls">
                                <?php echo form_input($data_can, "", 'required');?>
                                Cantidad sin Cargo: 
                                <?php echo form_input($data_canr, "", 'required');?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Descuento: </label>
                                <div class="controls">
                                <?php echo form_input($data_des, "", 'required');?>
                                <?php echo form_submit('envio', 'aceptar');?>
                                </div>
                            </div>
</tr>
</table>
<input type="hidden" value="<?php echo $id_orden?>" name="id_orden" id="id_orden" />
<input type="hidden" value="<?php echo $prv?>" name="prv" id="prv" />
  <?php
	echo form_close();
  ?>
  <div id="mostrar">
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
                                $l1=anchor('orden/a_orden_segpop_det_bor/'.$r->id_orden.'/'.$r->prv.'/'.$r->id_detalle,'Borrar');
                                
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
                                        $tu1=$tu1+$r->canp;
                                        $tu2=$tu2+$r->canr;
                                        $tu3=$tu3+$r->total;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4"></td>
                             <td style="text-align: right; "><?php echo number_format($tu1,0)?></td>
                             <td style="text-align: right; "><?php echo number_format($tu2,0)?></td>
                             <td colspan="6"></td>
                             <td style="text-align: right; "><?php echo number_format($tu3,2)?></td>
                             <td></td>
                             </tr>
                             </tfoot>
                         </table>                        
    </div>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
</div>