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
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">Codigo</th>
                                 <th style="text-align: left">Descripcion</th>
                                 <th style="text-align: right">Cantidad</th>
                                 <th style="text-align: right">Costo</th>
                                 <th style="text-align: right">Importe a costo</th>
                                 <th style="text-align: right">Importe a publico</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$timp=0;$tcan=0;$tpub=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                $l0 = anchor('mercadotecnia/sumit_borrar/'.$r->id.'/'.$id,'BORRAR</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->codigo?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->descri?></td>
                                   <td style="text-align: right;"><?php echo $r->can?></td>
                                   <td style="text-align: right;"><?php echo $r->costo?></td>
                                   <td style="text-align: right;"><?php echo number_format(($r->costo*$r->can),2)?></td>
                                   <td style="text-align: right;"><?php echo number_format(($r->publico*$r->can),2)?></td>
                                  </tr>
                               <?php $timp=$timp+($r->costo*$r->can);$tcan=$tcan+$r->can;$tpub=$tpub+($r->can*$r->publico);} ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td></td>
                              <td>TOTAL</td>
                              <td style="text-align: right;"><?php echo number_format($tcan,0)?></td>
                              <td></td>
                              <td style="text-align: right;"><?php echo number_format($timp,2)?></td>
                              <td style="text-align: right;"><?php echo number_format($tpub,2)?></td>
                              </tr>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>