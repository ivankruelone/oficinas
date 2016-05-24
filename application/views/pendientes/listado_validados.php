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
  <!--FORMA-->
 <!-- FORMA-->                        
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 
                                     <tr>
                                        <th>#</th>
                                        <th>Area</th>
                                        <th>Responsable</th>
                                        <th>Pendientes</th>
                                        <th>Fecha Limite de Entrega</th>
                                        <th>Dias de Retraso</th>
                                        <th>Fecha de Validaci&oacute;n</th>
                                        <th>Observaci&oacute;n</th>
                                        
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $num=0;
                                $dias=0;
                                foreach ($a as $r){
                               $num=$num+1;
                               $fec_com = $r['fecha_comp'];
                               $fec_upd = $r['fec_updated'];
                               
                               if($fec_com < $fec_upd){
                               if($fec_upd != '0000-00-00 00:00:00'){
                               $sq="SELECT DATEDIFF('$fec_upd','$fec_com') as dias";
                               $query2=$this->db->query($sq);
                               //echo $this->db->last_query();
                               //die();
                               $row2=$query2->row();
                               $dias=$row2->dias;
                               }else{
                                $dias=0;
                               }
                               }else{
                                $dias=0;
                               }
                               
                          
                               
                               
                              ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r['area']?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r['responsable']?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r['pendientes']?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $fec_com?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $dias?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $fec_upd?></td>
                                <td>
                               <table>
                               <?php 
                               foreach ($r['segundo'] as $r1)
                               {
                                ?>
                               
                               <tr>
                               <td style="color:<?php echo $color?>; text-align: center"><?php echo $r1['fec']?></td>
                               <td style="text-align: left"><?php echo $r1['observa']?></td>
                               <td style="color:<?php echo $color?>; text-align: center"><?php echo $r1['libe']?></td>
                               </tr>
                               <?php 
                                
                               
                                } ?>
                                </table> 
                               </td></tr>
                              <?php  } ?>
                              </tbody>
                              
                         </table>   
                            
                            
                         </div>
                     </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 