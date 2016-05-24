                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
<?php
$l1 = anchor('backoffice/graba_pedido','Grabar pedido</a>', array('title' => 'Haz Click aqui para Ver Sucursal!', 'class' => 'encabezado'));
?>                           
                         </div>
                         <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             <tr>
                             <th><?php echo $l1?></th>
                             </tr>
                               <tr>
                               <th style="text-align: left;">Fecha</th>
                               <th style="text-align: left;">Nid</th>
                               <th style="text-align: left;">Sucursal</th>
                               <th style="text-align: right;">Piezas</th>
                               <th style="text-align: right;">Importe</th>
                               <th style="text-align: right;">Renglones ceros</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color='gray';$color1='gray';
                                 foreach ($q->result()as $r){
                                 
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->fecha?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->suc?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->nombre?></td>
                                 <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->piezas,0)?></td>
                                 <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->importe,2)?></td>
                                 <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->ceros,0)?></td>
                                  </tr> 
                           
                                <?php } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                             
                               <tr>
                               <th style="text-align: left;">Fecha</th>
                               <th style="text-align: left;">Fol</th>
                               <th style="text-align: left;">Prv</th>
                               <th style="text-align: left;">Proveedor</th>
                               <th style="text-align: right;">Piezas</th>
                               <th style="text-align: right;">Importe</th>
                               <th></th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color='gray';$color1='gray';
                                 foreach ($qq->result()as $rr){
 if($rr->tipo=='A'){
 $l1 = anchor('backoffice/envia_pedido/'.$rr->prv.'/'.$rr->fol,'Envia pedido</a>', array('title' => 'Haz Click aqui para Enviar Pedido!', 'class' => 'encabezado'));   
 }else{
 $l1=0;   
 }
 
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $rr->fecha?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $rr->fol?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $rr->prv?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $rr->razo?></td>
                                 <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($rr->piezas,0)?></td>
                                 <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($rr->importe,2)?></td>
                                 <td><?php echo $l1?></td>
                                 </tr>  
                           
                                <?php } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>

                          
                         </div>
                     </div>
                </div>
                     <!-- END BLANK PAGE PORTLET-->
  