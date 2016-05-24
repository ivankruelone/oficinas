            <div class="span8">
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
                                        <th>Nombre</th>
                                        <th>Serie</th>
                                        <th>Tipo</th>
                                        <th>Resultado</th>
                                
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                
                               
                                foreach ($q->result()as $r){
                                $tipo=$r->tipo;
                                    if($tipo=='+'){
                                        $color='blue';
                                        
                                           } elseif($tipo=='-'){
                                            $color='red';
                                           }
                                        
                                    
                               
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->completo?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->serie?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->tipo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->texto?></td>
                                </tr>
                               <?php 
                               
                                } ?>
                              </tbody>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>