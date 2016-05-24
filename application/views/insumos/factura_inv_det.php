  <div class="span12">
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
    echo form_open('insumos/agrega_insumo_factura');
  ?> 
 <table>
 <tr>
    <td align="left" ><font size="+1"><strong>Producto: </strong></font></td>
   <td align="left"><?php echo form_dropdown('id_insumos', $id_insumos, " ", "id='id_insumos'");?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Cantidad: </strong></font></td>
    <td><?php echo form_input('cantidad', '', 'required');?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Precio unitario: </strong></font></td>
    <td><?php echo form_input('precio', '', 'required');?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Iva: </strong></font></td>
    <td>Si no tiene i.v.a colocar 0</td>
    <td><?php echo form_input('iva', '', 'required');?></td>
</tr>
</table>
<table>
 <tr>
 <input type="hidden" value="<?php echo $folio?>" name="folio" id="folio"/>
 <?php
                         
                 echo "<br />";
                 echo "<br />"; 
                 echo form_submit('mysubmit', 'Agregar');
                 echo "<br />";
                 echo "<br />";
                 echo form_close();
 ?>
 </tr>
</table>
          <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
<?php
$l0=anchor('insumos/fact_inv_cer/'.$folio,'CERRAR FACTURA')
?>
                             <thead>
                             <tr>
                             <th colspan="5" style="text-align: center;"><?php echo $l0?></th>
                             </tr>
                                 <tr> 
                                     <th style="text-align: center;">Cod</th>
                                     <th style="text-align: center;">Producto</th>
                                     <th style="text-align: center;">Empaque</th>
                                     <th style="text-align: center;">Cantidad</th>
                                     <th style="text-align: center;">Precio</th>
                                     <th style="text-align: center;">Subtotal</th>
                                     <th style="text-align: center;">I.V.A</th>
                                     <th style="text-align: center;">Total</th>
                                     <th></th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='black';$num=0;$tot=0;$totc=0;$dif=0;
                                     foreach ($q->result() as $r2) {
 $l3 = anchor('insumos/fact_inv_editar/'.$r2->folio.'/'.$r2->id_insumos,'Editar</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
 $l1 = anchor('insumos/fact_inv_delete/'.$r2->folio.'/'.$r2->id_insumos,'Borrar</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                          $num=$num+1;?>
                                        <tr>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r2->id_insumos?></td>
                                        <td style="text-align: left;   color: <?php echo $color ?>"><?php echo $r2->descripcion?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r2->empaque?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r2->cantidad?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>">$<?php echo $r2->precio?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>">$<?php echo $r2->subtotal?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>">$<?php echo $r2->iva?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>">$<?php echo $r2->total?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $l3?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        </tr>
                                        <?php
                                        }?>
                                        
                                
                             </tbody>
                            <tfoot>
                            <?php
                             foreach ($q2->result() as $r) {
                             ?>
                              <tr>
                              <td colspan="8" style="text-align: right" >TOTALES</td>
                              <td style="text-align: right">Iva: $<?php echo number_format($r->iva_total, 2)?></td>
                              <td style="text-align: right">Total: $<?php echo number_format($r->total, 2)?></td>
                              </tr> 
                             <?php
                            }
                             ?>
                         </tfoot>
                         </table>

          </div>	
     </div>
   </div>