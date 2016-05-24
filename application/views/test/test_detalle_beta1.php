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
                                        <th>#</th>
                                        <th>Pregunta</th>
                                        <th>Serie</th>
                                        <th>Respuesta Correcta</th>
                                        <th>Respuesta Usuario</th>
                                        <th>Resultado</th>
                                    
                                
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                
                               $color='grey';
                               $num=0;
                               
                                foreach ($q->result()as $r){
                               
                                $num=$num+1;
                                
                                
                                
                                
                                if($r->resultado=='Bien'){
                                    $color='green';
                                }elseif($r->resultado=='Mal'){
                                    $color='red';
                                }else{
                                    
                                }    
                               
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->pregunta?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->serie?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->respuestaCorrecta?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->respuestaDada?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->resultado?></td>
                                </tr>
                               <?php 
                               
                                } ?>
                                
                                
                                
                                
                              </tbody>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>