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
                                     <th>Id</th>
                                     <th>Tipo</th>
                                     <th>Clave</th>
                                     <th>Sustancia Activa</th>
                                     <th>Descripcion</th>
                                     <th>Inv</th>
                                     <th>Costo</th>
                                     <th>Importe</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                $tot=0; $n=0; 
                                ?> 
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->tipox?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->clave?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->susa?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->descri?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r->inv?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->costo,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->costo*$r->inv,2)?></td>
                                      </tr>
                                       <?php 
                                        $timporte=$timporte+($r->costo*$r->inv);
                                        $tcan=$tcan+$r->inv;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4"></td>
                             <td style="color:black; text-align: left; "><strong>Total de productos <?php echo number_format($num,0)?></strong></td>
                             <td style="color:black; text-align: left; "><strong><?php echo number_format($tcan,0)?></strong></td>
                            <td></td>
                             <td style="color:black; text-align: left; "><strong><?php echo number_format($timporte,2    )?></strong></td>
                             
                                        
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>