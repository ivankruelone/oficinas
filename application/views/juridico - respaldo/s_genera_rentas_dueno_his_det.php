                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">



<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">RFC</th>
                                 <th style="color:black; text-align: left">Nombre</th>
                                 <th style="color:black; text-align: left">Local</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                
                                 $tmn=0;$tusd=0;
                                foreach ($q->result()as $r) {
                                
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->rfc?></td> 
                                   <td style="text-align: left;"><?php echo $r->nom?></td>
                                   <td style="text-align: left;"><?php echo $r->sucx?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalusd,2)?></td>
                                   
                                  </tr>
                               <?php  
                               $tmn=$tmn+$r->totalmn;
                               $tusd=$tusd+$r->totalusd;
                               } ?>
                              </tbody>
                              <tfoot>
                               
                              <tr>
                              <td colspan="3"><strong>TOTAL</strong></td>
                              <td style="color:black; text-align: right;"><strong><?php echo number_format($tmn,2)?></strong></td>
                              <td style="color:black; text-align: right;"><strong><?php echo number_format($tusd,2)?></strong></td>
                              </tr>
                              </tfoot>
                         </table>



                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>