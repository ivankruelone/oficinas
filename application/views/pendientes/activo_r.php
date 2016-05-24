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

  <!-- FORMA-->                        
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 
                                     <tr>
                                        <th>Area</th>
                                        <th>Nombre</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $num=0;
                                foreach ($a->result() as $r){
                               $num=$num+1;
                               $l1 = anchor('pendientes/listado/'.$r->id, $r->completo.'</a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->subarea?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td>
                               <?php  } ?>
                              </tbody>
                              
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>