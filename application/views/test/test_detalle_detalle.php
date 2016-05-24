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
                                        <th>Pregunta</th>
                                        <th>Respuesta Correcta</th>
                                        <th>Respuesta Correcta</th>
                                        <th>Respuesta Usuario</th>
                                        <th>Resultado</th>
                                
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                
                                $num=0;
                                $cantidad=0;
                                foreach ($q->result()as $r){
                               $num=$num+1;
                               $resultado=$r->resultado;
                               
                               if($resultado=='Bien'){
                                $color='green';
                               
                               }elseif($resultado=='Mal'){
                                $color='red';
                               }else{
                                
                               }
                               
                               //$l1 = anchor('test/test_detalle_detalle/'.$r->id.'/'.$r->serie,$r->serie.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->serie?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->texto?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->respuestaCorrecta?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->textoOpcion?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->respuestaDada?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $resultado?></td>
                                </tr>
                               <?php 
                               
                               
                               
                               $cantidad= $cantidad + $r->resultado;
                               
                                } ?>
                              </tbody>
                              
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>