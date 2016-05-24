                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><? echo $titulo?></h4>
                           
                         </div>
                         <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                               <tr>
                               <th style="text-align: left;">#</th>
                               <th style="text-align: left;">Nombre</th>
                               <th style="text-align: left;">Extraer</th>
                               <th style="text-align: left;">Procesar</th>
                               <th style="text-align: left;">Vista</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color='gray';$color1='gray';
                                 foreach ($q->result()as $r){
                                 if($r->id==1){
                                    $men0='Mes actual';
                                    $men1='Dia actual';
                                    }
                                 elseif($r->id==2){
                                    $men0='Mes anterior';
                                    $men1='Dia anterior';
                                    }
                                 else{$men0='';$men1='';}
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->id?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->nombre?></td>
                                 <td><?php echo
                                 anchor('backoffice/'.$r->extrae.'/'.$r->id,'<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para Extraer!', 'class' => 'encabezado','target'=>'blank'));
                                 ?></td>
                                 <td><?php echo
                                 anchor('backoffice/'.$r->proceso.'/'.$r->id,$men0.'<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para Procesar!', 'class' => 'encabezado','target'=>'blank'));
                                 ?></td>
                                 <td><?php echo
                                 anchor('backoffice/'.$r->vista.'/'.$r->id,' <img src="'.base_url().'img/product5.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para visalizar!', 'class' => 'encabezado'));
                                 ?></td>
                                 <td><?php  if($r->id >0 and $r->id<=2){
                                 echo anchor('backoffice/s_ventas_mensuales_general/'.$r->id,' <img src="'.base_url().'img/product5.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para visalizar!', 'class' => 'encabezado'));   
                                 }else{ '';}
                                 ?></td>
                                 
                                 </tr> 
                           
                                <?php } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- END BLANK PAGE PORTLET-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><? echo $titulo?></h4>
                           
                         </div>
                         <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">#</th>
                               <th style="text-align: left;">Nombre</th>
                               
                               <th style="text-align: left;">Vista</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color='gray';$color1='gray';
                                 foreach ($a->result()as $r1){
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r1->id?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r1->nombre?></td>
                                 <td><?php echo
                                 anchor('backoffice/'.$r1->extrae.'/'.$r1->id,'<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para generar comisiones!', 'class' => 'encabezado','target'=>'blank'));
                                 ?></td>
                                
                                 </tr> 
                           
                                <?php } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- END BLANK PAGE PORTLET-->
 