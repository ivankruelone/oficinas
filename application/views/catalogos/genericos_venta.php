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
                          <caption></caption> 
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Clas</th>
                                     <th>Sec</th>
                                     <th>Sustancia Activa</th>
                                     <th>$ Gen</th>
                                    
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;
                                foreach ($a as $r) {
                                
                                $num=$num+1;
                                ?>
                                <tr>
                                   <td style="color: orange;"><?php echo $num?></td>
                                    <td><?php echo $r['clasi']?></td>
                                    <td><?php echo $r['sec']?></td>
                                    <td style="width: inherit;"><?php echo $r['susa']?></td>
                                    <td style="text-align: right;"><?php echo number_format($r['gen'],2)?></td>
                                    
                                    
                                </tr>
                                <?php
                                }
                                ?>
                             </tbody>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>