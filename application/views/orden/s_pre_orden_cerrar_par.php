<div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                          <div align="center">
                                                   <?php
	$atributos = array('id' => 'sumit_preorden_prv');
    echo form_open('orden/sumit_preorden_prv', $atributos);
    
    
   ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Proveedor: </strong></font></td>
	<td><?php echo $corto;?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Razon Social: </strong></font></td>
	<td align="left"><?php echo form_dropdown('cia', $cia, '', 'id="cia"') ;?> </td>
</tr>


 
	<td colspan="2"align="center"><?php echo form_submit('envio', 'Cerrar Orden');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_pre_orden?>" name="id_pre_orden" id="id_pre_orden" />
<input type="hidden" value="<?php echo $prv?>" name="prv" id="prv" />
  <?php
	echo form_close();
  ?>

                        
                         </div>
<!------->
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th></th>
                                 <th>Sec</th>
                                 <th style="text-align: left">Sustancia Activa</th>
                                 <th style="text-align: left">Costo</th>
                                 <th style="text-align: right;">Compra</th>
                                 <th style="text-align: right;">Descuento</th>
                                 <th style="text-align: right;">Iva</th>
                                 <th style="text-align: right;">Total</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $num=1;$compra=0;$importe=0;$descuento=0;$iva=0;
                                foreach ($q->result() as $r) {
                                
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r->id_pre_orden?></td>
                                <td style="color: maroon;"><?php echo $r->sec?></td>
                                <td style="color: maroon;"><?php echo $r->susa?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format($r->costo,2)?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format($r->compra,0)?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format($r->descu,4)?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format($r->iva,2)?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format(($r->importe-$r->descu+$r->iva),2)?></td>
                                
                                </tr>
                                <?php 
                                $num=$num+1;
                                $compra=$compra+$r->compra;
                                $iva=$iva+$r->iva;
                                $descuento=$descuento+$r->descu;
                                $importe=$importe+($r->importe-$r->descu+$r->iva);
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td colspan="4" style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($compra,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($descuento,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($iva,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($importe,2)?></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>

                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                 
                         

                 </div>