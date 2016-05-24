                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 
                                     <tr>
                                        <th>#</th>
                                        <th>Area</th>
                                        <th>Responsable</th>
                                        <th>Pendientes</th>
                                        <th>Fecha Limite de Entrega</th>
                                        <th>Dias de Retraso</th>
                                        <th style="text-align: center;">Observaci&oacute;n</th>
                                        
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $num=0;
                                
                                if(count($a) > 0){
                                foreach ($a as $r){
                               $num=$num+1;
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $num ?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r['area']?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r['responsable']?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r['pendientes']?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r['fecha_comp']?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r['diasr']?></td>
                                <td>
                               <table>
                               <?php 
                               foreach ($r['segundo'] as $r1)
                               {
                               $l0 = anchor('pendientes/modificar_observacion/'.$r['id'],'OBSERVACION</a>', array('title' => 'Haz Click aqui para agregar una observacion!', 'class' => 'encabezado'));
                                ?>
                               
                               <tr>
                               <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1['observa']?></td>
                               <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1['libe']?></td>
                               <td style="text-align: left"><?php echo $l0?></td>
                               </tr>
                               <?php 
                                
                               
                                } ?>
                                </table> 
                               </td></tr>
                              <?php  } 
                              
                              
                              }?>
                              </tbody>
                              
                         </table>   
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>