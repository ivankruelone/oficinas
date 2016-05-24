            <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 
                                     <tr>
                                        <th>Serie</th>
                                        <th>Nombre</th>
                                        <th>Correctas</th>
                                    
                                
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                
                               $color='grey';
                                foreach ($q->result()as $r){
                               
                                $l1 = anchor('test/test_detalle_beta1/'.$r->id.'/'.$r->serie, $r->serie.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));        
                                    
                               
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->nombre?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->correctas?></td>
                                </tr>
                               <?php 
                               
                                } ?>
                                
                                     <?php
                                
                               $color='grey';
                                foreach ($q1->result()as $r){
                               
                                $l1 = anchor('test/test_detalle_beta1/'.$r->id.'/'.$r->serie, $r->serie.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));        
                                    
                               
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->nombre?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->correctas?></td>
                                </tr>
                               <?php 
                               
                                } ?>
                              
                              
                              </tbody>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>