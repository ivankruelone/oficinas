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
                                        <th>Habilidades</th>
                                        <th>Nombre</th>
                                        <th>Puesto</th>
                                        <th>Resultado</th>
                                
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $num=0;
                                $cantidad=0;
                                foreach ($q->result()as $r){
                               $num=$num+1;
                               $l1 = anchor('test/test_detalle_detalle/'.$r->id.'/'.$r->serie,$r->serie.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->habilidades?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->completo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->puestox?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->resultado?></td>
                                </tr>
                               <?php 
                                
                               $cantidad= $cantidad + $r->resultado;
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="4" style="color:red; text-align: right">TOTAL</td>
                              <td style="color:red; text-align: right"><?php echo $cantidad?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>