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
                                     <th>Regional</th>
                                     <td>Supervisor</td>
                                     <th>Imagen</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Observacion</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                
                                
                                ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->regionalx?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->supervisorx?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->tipo2?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->nombre?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->obser?></td>
                                       </tr>
                                       <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>