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
                                        <th>Nid</th>
                                        <th>Sucursal</th>
                                        <th>Abasto A</th> 
                                        <th>Abasto B</th>
                                        <th>Abasto C</th>
                                        <th>Abasto D</th>
                                        <th>Abasto E</th>
                                        <th>Abasto</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $t1=0;$pro=0;
                                $num=0;$color1=0;$tip1=0;$tip2=0;$tip3=0;$tip4=0;$tip5=0;
                                foreach ($a->result()as $r){
                               $num=$num+1;
?>                                   
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->nombre?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo'% '.number_format($r->tipo1,4)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo'% '.number_format($r->tipo2,4)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo'% '.number_format($r->tipo3,4)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo'% '.number_format($r->tipo4,4)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo'% '.number_format($r->tipo5,4)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo'% '.number_format($r->abasto,4)?></td>
                                
                                </tr>
                               <?php 
                               $t1=$t1+$r->abasto;
                                }
                                $pro=($t1)/$num; ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="8" style="color:red; text-align: right">PROMEDIO</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo '% '.number_format($pro,4)?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>