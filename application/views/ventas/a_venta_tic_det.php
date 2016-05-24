<div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">Nid</th>
                                 <th style="text-align: left">Sucursal</th>
                                 <th style="text-align: left">Tikets</th>
                                 <th style="text-align: left">Rollos</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $fec_actual=date('Y-m-d');$color='blue';
                                foreach ($q->result()as $row) {
                                 
                                 ?>
                                
                                 <tr>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->suc?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->nombre?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->tic?></td>
                                    <td style="color: <?php echo $color?>;text-align: left;"><?php echo $row->rollos?></td>
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
                         

                 </div>