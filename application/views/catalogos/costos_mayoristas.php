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
                             <th colspan="2" style="text-align: center;"></th>
                             <th colspan="3" style="text-align: center;">Costos</th>
                             <th colspan="1" style="text-align: center;">Preferencia compra</th>
                             </tr>
                               <tr>
                               <th style="text-align: left;">Codigo</th>
                               <th style="text-align: left;">Descripcion</th>
                               <th style="text-align: left;">Fanasa</th>
                               <th style="text-align: left;">Marzam</th>
                               <th style="text-align: left;">Dema</th>
                               <th style="text-align: left;">Preferencia</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$nfan=0;$nmar=0;$ndema=0;
                                 foreach ($q->result()as $r){
                                if($r->pref=='MARZAM'){$nmar=$nmar+1;}
                                if($r->pref=='FANASA'){$nfan=$nfan+1;}
                                if($r->pref=='DEMA'){$ndema=$ndema+1;}
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->codigo?></td>
                                   <td style="text-align: left;"><?php echo trim($r->descripcion)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->cos_fanasa,2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->cos_marzam,2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r->cos_dema,2)?></td>
                                   <td style="text-align: left;"><?php echo $r->pref?></td>
                                   </tr> 
                           
                             
                               
                              
                                 
                               <?php } ?> 
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="6">PRODUCTOS DE FANASA <?php echo $nfan ?></td>
                              </tr>
                              <tr>
                              <td colspan="6">PRODUCTOS DE MARZAM <?php echo $nmar ?></td>
                              </tr>
                              <tr>
                              <td colspan="6">PRODUCTOS DE DEMA <?php echo $ndema ?></td>
                              </tr>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>