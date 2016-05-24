                 <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">


<?php
	echo form_open('insumos/inserta_producto_insumo');
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
 ?>  
 <table> 
<tr>
    <td align="left" ><font size="+1"><strong>Producto : </strong></font></td>
    <td align="left"><?php echo form_dropdown('id_insumos', $suc, " ", "id='id_insumos'");?> </td> <!-- Aqui obtenemos primero la funcion getInsumo en Catalogos model-->
    <td colspan="1"></td>                                                                          <!-- despues suc que es la sucursal y puede ser considerado como depto-->
</tr>                                                                                              <!-- id_insumos se obtiene de la funcion del controlador inserta_producto_insumo -->     
<tr>
    <td align="left" ><font size="+1"><strong>Cantidad : </strong></font></td>
	<td align="left"><?php echo form_input($data_can,"",'requiered') ;?> </td>
</tr>

</table>
  <input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc"/>

<?php  
    echo form_submit('mysubmit', 'Agregar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>
<!----> 
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
<?php
$l0=anchor('insumos/s_ped_insumos_cer/'.$id_cc,'CERRAR FOLIO')
?>
                             <thead>
                             <tr>
                             <th colspan="5" style="text-align: center;"><?php echo $l0?></th>
                             </tr>
                                 <tr> 
                                     <th>#</th>
                                     <th>Cod</th>
                                     <th>Insumo</th>
                                     <th>Piezas</th>
                                     <th>Empaque</th>
                                     <th></th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='black';$num=0;$tot=0;$totc=0;$dif=0;
                                     foreach ($q->result() as $r2) {
 $l1 = anchor('insumos/s_ped_insumos_det_delete/'.$id_cc.'/'.$r2->id,'Borrar</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                         $num=$num+1;?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->id_insumos?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->descripcion?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->empaque?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->canp_suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        </tr>
                                        <?php
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="6" style="text-align: left; color: <?php echo $color ?>">Total de pedidos: <?php echo number_format($num,0)?></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>