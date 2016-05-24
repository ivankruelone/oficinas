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

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                                 <tr> 
                                    <th style="text-align: left;">Orden</th>
                                     <th style="text-align: left;">Id orden</th>
                                     <th style="text-align: left;">Prv</th>
                                     <th style="text-align: left;">Provedor</th>
                                     <th style="text-align: left;">Fecha Envio</th>
                                     <th style="text-align: left;">Fecha Limite</th>
                                     <th style="text-align: right;">Sec</th>
                                     <th style="text-align: left;">Sustancia Activa</th>
                                     <th style="text-align: right;">Solicitada</th>
                                     <th style="text-align: right;">Recibida</th>
                                      <th style="text-align: right;">Falta</th>
                                     </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;
                                $mismo='';
                                     foreach ($q->result() as $r2) {
//id_orden, prv, corto, fecha_envio, sec, susa1, cans, costo, descuento, importe, aplica                             
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->folprv?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->id_orden?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->prv?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->corto?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha_envio?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha_l?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->sec?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->susa1?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->cans?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->aplica?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo ($r2->cans)-($r2->aplica)?></td>
                                        </tr>
                                        <?php $num=$num+1;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>                        

<!---->
                  
<!--------------
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                 </div>
