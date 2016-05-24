                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">



                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">Cia</th>
                                 <th style="color:black; text-align: left">Compa&ntilde;ia</th>
                                 <th style="color:black; text-align: left">local</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;
                                foreach ($q->result()as $r){
                               $l1 = anchor('juridico/s_rentas_propias_cia/'.$r->cia.'/'.$r->rfc.'/'.$r->nu,$r->cia.'</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));    
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $l1?></td>
                                   <td style="text-align: left;"><?php echo $r->razon?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->num?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalusd,2)?></td>
                                   
                                  </tr>
                               <?php $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               <tr>
                                 <th style="color:black; text-align: left">Cia</th>
                                 <th style="color:black; text-align: left">Compa&ntilde;ia</th>
                                 <th style="color:black; text-align: left">local</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 </tr>
                              <tr>
                              <td colspan="7">TOTAL</td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tmn,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tusd,2)?></td>
                              </tr>
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <div class="widget blue-box">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">



                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">Cia</th>
                                 <th style="color:black; text-align: left">Compa&ntilde;ia</th>
                                 <th style="color:black; text-align: left">local</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;
                                foreach ($qq->result()as $r) {
                               $l1 = anchor('juridico/s_rentas_propias_cia/'.$r->cia.'/'.$r->rfc.'/'.$r->nu,$r->cia.'</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));    
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $l1?></td>
                                   <td style="text-align: left;"><?php echo $r->razon?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->num?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalusd,2)?></td>
                                   
                                  </tr>
                               <?php $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               <tr>
                                 <th style="color:black; text-align: left">Cia</th>
                                 <th style="color:black; text-align: left">Compa&ntilde;ia</th>
                                 <th style="color:black; text-align: left">local</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 </tr>
                              <tr>
                              <td colspan="7">TOTAL</td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tmn,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tusd,2)?></td>
                              </tr>
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                      <!-- BEGIN BLANK PAGE PORTLET-->
                      <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">



                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">Cia</th>
                                 <th style="color:black; text-align: left">Compa&ntilde;ia</th>
                                 <th style="color:black; text-align: left">local</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;
                                foreach ($qqq->result()as $r) {
                               $l1 = anchor('juridico/s_rentas_propias_cia/'.$r->cia.'/'.$r->rfc.'/'.$r->nu,$r->cia.'</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));    
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $l1?></td>
                                   <td style="text-align: left;"><?php echo $r->razon?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->num?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalusd,2)?></td>
                                   </tr>
                               <?php $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               <tr>
                                 <th style="color:black; text-align: left">Cia</th>
                                 <th style="color:black; text-align: left">Compa&ntilde;ia</th>
                                 <th style="color:black; text-align: left">local</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 </tr>
                              <tr>
                              <td colspan="7">TOTAL</td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tmn,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tusd,2)?></td>
                              </tr>
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                      <!-- BEGIN BLANK PAGE PORTLET-->
                        <!-- BEGIN BLANK PAGE PORTLET-->
                 </div>