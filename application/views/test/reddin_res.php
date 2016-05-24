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
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Edad</th>
                                        <th>Puesto</th>
                                        <th>Fecha Test</th>
                                      
                                
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='grey';
                                $num=0;
                                
                                foreach ($q->result()as $r){
                               $num=$num+1;
                               $l1 = anchor('test/test_detalle_reddin/'.$r->id,$r->completo.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->sexo?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->fecha_nacimiento?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->edad?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->puestox?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->fecha?></td>
                                
                                </tr>
                               <?php 
                                
                               
                               
                                } ?>
                              </tbody>
                              <!--<tfoot>
                              <tr>
                              <td colspan="5" style="color:red; text-align: right">TOTAL</td>
                              <td style="color:red; text-align: right"><?php echo $cantidad?></td>
                              </tr>
                             </tfoot>-->
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>