                 
                  <table>
                  <tr>
                  
                  <td>
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
 $var1="103,105,106,107,108,109,112,114<br />116,129,193,201,202,501,504,511,552";
 $var2="103,105,106,107,108,109,112,114,116,129,<br />193,201,202,501,504,511,552,806,812";
 $var3="806,812";                       
$l1=anchor('backoffice/a_pedidos_farmacos/1',$var1);
$l2=anchor('backoffice/a_pedidos_farmacos/2',$var2);
$l3=anchor('backoffice/a_pedidos_farmacos/3',$var3);
$l4=anchor('backoffice/a_pedidos_fenix_a_cedis','PEDIDO DE SUCURSALES FENIX DE MEDICAMENTOS GENERICOS');
?>
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               
                               <tr>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;">SUCURSALES</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <tr>
                                 <td><?php echo 'FARMACOS NACIONALES SOLO CEROS FILTRO'?></td>
                                 <td><?php echo $l1?></td>
                                 </tr>
                                 <tr>
                                 <td><?php echo 'FARMACOS NACIONALES SOLO CEROS TODAS'?></td>
                                 <td><?php echo $l2?></td>
                                 </tr>
                                 <tr>
                                 <td><?php echo 'FARMACOS NACIONALES SOLO CEROS SOLO LA PAZ'?></td>
                                 <td><?php echo $l3?></td>
                                 </tr> 
                                 <tr>
                                 <td><?php echo 'PEDIDOS GENERICOS'?></td>
                                 <td><?php echo $l4?></td>
                                 </tr>
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
</div>
                         
                     </div>
                     </div>
                     </td>
                      
                     <!-- END BLANK PAGE PORTLET-->

                     <!-- BEGIN BLANK PAGE PORTLET-->
                     
                     <td>
                     <div class="span12">
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1 ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <?php
$lx=anchor('backoffice/addiciona_pedido_esp_for','ADICIONA PEDIDO ESPECIAL EN FORMULADO'); 

?>
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <td colspan="7"><?php echo $lx?></td>
                               </tr>
                               <tr>
                               <th style="text-align: center;">Fecha</th>
                               <th style="text-align: center;">Fol</th>
                               <th style="text-align: center;">Nid</th>
                               <th style="text-align: center;">Sucursal</th>
                               <th style="text-align: center;">Importe</th>
                               <th style="text-align: center;">Pzas Pedido</th>
                               <th style="text-align: center;">Inv</th>
                               <th>B</th>
                               </tr>  
                             </thead>
                             <tbody>
                              <?php $tot=0;$l1='';$fol=0;
                              foreach($q->result() as $r)
                              {
                                $l0=anchor('backoffice/a_pedidos_envio_mayorista_bor/'.$r->suc,'BOR');
                                
                              ?>
                              <tr>
                              <td style="font-size: x-small; color: blue;"><?php echo $r->fecha?></td>
                              <td style="font-size: x-small; color: blue;"><?php echo $r->fol?></td>
                              <td style="font-size: x-small; color: blue;"><?php echo $r->suc?></td>
                              <td style="font-size: x-small; color: blue;"><?php echo $r->nombre?></td>
                              <td style="text-align: right; color: blue; font-size: x-small;"><?php echo number_format($r->importe,2)?></td>
                              <td style="text-align: right; color: blue; font-size: x-small;"><?php echo number_format($r->pedido,0)?></td>
                              <td style="text-align: right; color: blue; font-size: x-small;"><?php echo number_format($r->inv,0)?></td>
                              <td style="font-size: x-small; color: blue;"><?php echo $l0?></td>
                              </tr>
                              <?php
                              $tot=$tot+$r->importe;
                              $fol=$r->fol;
                              }
                              $l1=anchor('backoffice/a_pedidos_envio_mayorista/'.$fol,'ENVIAR PEDIDO GENERADO');
                              $l2=anchor('backoffice/a_pedidos_envio_mayorista_sin_enviar/'.$fol,'GUARDAR PEDIDO SIN ENVIAR');
                              ?>   
                              </tbody>
                              <tfoot>
                              <tr>
                              <td style="font-size: x-small; color: red;" colspan="4"><strong><?php echo $l1?></strong></td>
                              <td style="text-align: right; color: red; font-size: x-small;"><strong><?php echo number_format($tot,2)?></strong></td>
                              <td></td>
                              <td></td>
                              
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     </div>
                     </td>
                     </tr>
                     <tr>
                                          <!-- BEGIN BLANK PAGE PORTLET-->
<td>
                   <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET--> 
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulox ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <?php
 $var1="103,105,106,107,108,109,112,114<br />116,129,193,201,202,501,504,511,552";
 $var2="103,105,106,107,108,109,112,114,116,129,<br />193,201,202,501,504,511,552,806,812";
 $var3="806,812";                       
$l1x=anchor('backoffice/a_formula_fanasa_dias/1',$var1);
$l2x=anchor('backoffice/a_formula_fanasa_dias/2',$var2);
$l3x=anchor('backoffice/a_formula_fanasa_dias/3',$var3);
$l4x=anchor('backoffice/a_pedidos_fenix_a_cedis','PEDIDO DE SUCURSALES FENIX DE MEDICAMENTOS GENERICOS');
?>
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               
                               <tr>
                               <th style="text-align: center;"></th>
                               <th style="text-align: center;">SUCURSALES</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <tr>
                                 <td><?php echo 'FARMACOS NACIONALES SOLO CEROS FILTRO'?></td>
                                 <td><?php echo $l1x?></td>
                                 </tr>
                                 <tr>
                                 <td><?php echo 'FARMACOS NACIONALES SOLO CEROS TODAS'?></td>
                                 <td><?php echo $l2x?></td>
                                 </tr>
                                 <tr>
                                 <td><?php echo 'FARMACOS NACIONALES SOLO CEROS SOLO LA PAZ'?></td>
                                 <td><?php echo $l3x?></td>
                                 </tr> 
                                 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
</div>
                         
                     </div>
                     </div>
                     </td>
                     <td><?php echo $l2?></td> 
                     <!-- END BLANK PAGE PORTLET-->
                     </tr>
                     </table>
                 