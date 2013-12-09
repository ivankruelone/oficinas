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
	echo form_open('procesos/sumit_pedidos_formulados');
    echo "<br />";
    

    
 ?>  
 <table> 
 <tr>
    <td align="left" ><font size="+1"><strong>Clasificacion A: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por1', $por1, '', 'id="por1"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion B: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por2', $por2, '', 'id="por2"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion C: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por3', $por3, '', 'id="por3"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion D: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por4', $por4, '', 'id="por4"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion E: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por5', $por5, '', 'id="por4"') ;?> </td>
</tr>
</table>
<?php  
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();                         
 ?>                    
                     
                     
                     
                         
                         
                         
                     
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             <tr><th colspan="5">Entradas y salidas</th></tr>
                            
                             <tr>
                             <th colspan="1">#</th>
                             <th colspan="1">Fecha Limite</th>
                             <th colspan="1">Fecha Inv</th>
                             <th colspan="1">Nid</th>
                             <th colspan="1">Sucursal</th>
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