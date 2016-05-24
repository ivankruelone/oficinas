                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                    <th style="text-align: center">Nid</th>
                                    <th style="text-align: center">Sucursal</th> 
                                    <th style="text-align: right">$ Venta</th>
                                    
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;       
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
                                if($r->venta==0){$color='red';}else{$color='blue';}
                               ?>
                                
                                <tr>
                                <td style="color:<?php echo  $color?>;"><?php echo $r->suc?></td>
                                <td style="color: <?php echo $color?>;"><?php echo $r->nombre?></td>
                                <td style="color: <?php echo $color?>; text-align: right;"><?php echo number_format($r->venta,2)?></td>
                                </tr>
                                <?php 
                                $t01=$t01+$r->venta;
                                
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td colspan="2" style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t01,2)?></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>