                 <div class="span10">
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
?>
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               
                               <tr>
                               <th style="text-align: center;">CODIGO</th>
                               <th style="text-align: center;">DESCRIPCION</th>
                               <th style="text-align: center;">PRODUCTOS<br />SOLICITADOS</th>
                               <th style="text-align: center;">PRODUCTOS<br />SURTIDOS</th>
                               <th style="text-align: center;">NIVEL DE<br />SURTIDO POR<br />PRODUCTOS</th>
                               <th style="text-align: center;">PIEZAS<br />SOLICITADAS</th>
                               <th style="text-align: center;">PIEZAS<br />SURTIDAS</th>
                               <th style="text-align: center;">NIVEL DE<br />SURTIDO POR<br />PIEZAS</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color ='blue';$color1='red';
                                 foreach ($q->result()as $r){
                                
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->cod?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->descri?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->producto,0)?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->pro_surtido,0)?></td>
                                   <td style="color:<?php echo $color1?>;text-align: right;"><?php echo '% '.number_format($r->nivel_surtido_pro,4)?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->piezas,0)?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->surtido,0)?></td>
                                   <td style="color:<?php echo $color1?>;text-align: right;"><?php echo '% '.number_format($r->nivel_surtido_pie,4)?></td>
                                   
                                </tr>
                                <?php 
                                } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>