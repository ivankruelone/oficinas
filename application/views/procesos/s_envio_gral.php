                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">#</th>
                               <th style="text-align: left;">Informacion</th>
                               <th></th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color='blue';$color1='orange';
                                 foreach ($q->result()as $r){
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $num?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->nombre?></td>
                                   <td><?php echo
                                 anchor('procesos/'.$r->extrae.'/'.$r->id,'<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para Extraer!', 'class' => 'encabezado','target'=>'blank'));
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
                     <!-- END BLANK PAGE PORTLET-->
                 </div>