  <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Nuevos insumos</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
  <?php
    echo form_open('insumos/agrega_devolucion');
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
</table>
<table>
 <tr>
 <input type="hidden" value="<?php echo $folio?>" name="folio" id="folio"/>
 <input type="hidden" value="<?php echo $suc?>" name="suc" id="suc"/>
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
$l0=anchor('insumos/dev_insumos_cerrar/'.$folio,'CERRAR FOLIO')
?>
                             <thead>
                             <tr>
                             <th colspan="5" style="text-align: center;"><?php echo $l0?></th>
                             </tr>
                                 <tr> 
                                     <th style="text-align: center;">Cod</th>
                                     <th style="text-align: center;">Producto</th>
                                     <th style="text-align: center;">Empaque</th>
                                     <th style="text-align: center;">Piezas</th>
                                     <th style="text-align: center;">Cantidad</th>
                                     <th></th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='black';$num=0;$tot=0;$totc=0;$dif=0;
                                     foreach ($q->result() as $r2) {
 $l1 = anchor('insumos/dev_insumos_delete/'.$r2->folio.'/'.$r2->id_insumos,'Borrar</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                         $num=$num+1;?>
                                        <tr>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r2->id_insumos?></td>
                                        <td style="text-align: left;   color: <?php echo $color ?>"><?php echo $r2->descripcion?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r2->empaque?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r2->cantidad?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        </tr>
                                        <?php
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             </tfoot>
                         </table> 

          </div>	
     </div>
   </div>