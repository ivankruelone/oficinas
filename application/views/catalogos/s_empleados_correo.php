                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> <?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">Dep</th>
                               <th style="text-align: left;">Depto.</th>
                               <th style="text-align: left;">Nomina</th>
                               <th style="text-align: left;">Nombre</th>
                               <th style="text-align: left;">Correo</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0; $color='gray';
                                 foreach ($q->result()as $r){
                                $num=$num+1;
                                $l0=anchor('catalogos/s_empleados_correo_actualiza/'.$r->id,$r->nomina.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                
                                 ?> 
                                 <tr>
                                   
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->suc?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->sucx?></td>
                                   <td style=" text-align: left;"><?php echo $l0?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->nombre?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->correo?></td>
                                   </tr> 
                           
                             
                               
                              
                                 
                               <?php } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>