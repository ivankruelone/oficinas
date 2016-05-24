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
                                        <th>Pregunta</th>
                                        <th>Texto</th>
                                        <th>Prioridad</th>
                                        <th>Respuesta Usuario</th>
                                        <th>Respuesta Usuario</th>
                                    
                                
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                
                               $color='grey';
                                foreach ($q->result()as $r){
                               
                                        
                                    
                               
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->pregunta?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->texto?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->orden?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->respuestaDada?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->textoOpcion?></td>
                                </tr>
                               <?php 
                               
                                } ?>
                              </tbody>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>