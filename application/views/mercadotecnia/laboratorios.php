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
                                 <th style="text-align: left">Lab</th>
                                 <th style="text-align: left">Laboratorio</th>
                                </tr>
                             </thead>
                             <tbody>
                              <?php
                                 $num=0;$timp=0;$tcan=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                               ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->num?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->labor?></td>
                                  </tr>
                               <?php } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: left;"><?php echo 'TOTAL '.number_format($num,0)?></td>
                              </tr>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>