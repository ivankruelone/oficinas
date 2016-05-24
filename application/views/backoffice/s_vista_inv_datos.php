                 <div class="span">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                 <tr> 
                                     <th>Id</th>
                                     <th>Obser</th>
                                     <th>Fecha</th>
                                     <th>Informacion</th>
                                     <th>Pharm</th>
                                     <th>Nid</th>
                                     <th>Sucurusal</th>
                                     <th>Pzas.Ant</th>
                                     <th>Pzas.Act</th>
                                     <th>Imp.Ant</th>
                                     <th>Imp.Act</th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$color1='green';
                                     foreach ($q->result() as $r2) {
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->obser?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha_act?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->dia?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->back?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->nombre ?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo number_format($r2->p_ant,0) ?></td>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo number_format($r2->p_act,0) ?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo number_format($r2->i_ant,2) ?></td>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo number_format($r2->i_act,2) ?></td>
                                        
                                        </tr>
                                        <?php $num=$num+1;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             
                             
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>