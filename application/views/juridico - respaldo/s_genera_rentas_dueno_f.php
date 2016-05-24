                 <div class="span7">
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
                                 <th style="color:black; text-align: left">A&ntilde;o</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                
                                 $tmn=0;$tusd=0;
                                foreach ($q->result()as $r) {
                               $l1 = anchor('juridico/s_genera_rentas_dueno/'.$r->aaa,$r->aaa.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));    
                                
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $l1?></td>
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
                              <td colspan="1"><strong>TOTAL</strong></td>
                              <td style="color:black; text-align: right;"><strong><?php echo number_format($tmn,2)?></strong></td>
                              <td style="color:black; text-align: right;"><strong><?php echo number_format($tusd,2)?></strong></td>
                              </tr>
                              </tfoot>
                         </table>



                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>