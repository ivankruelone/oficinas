                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit1?></h4>
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
                                     <th style="text-align: right">Ene</th>
                                     <th style="text-align: right">Feb</th>
                                     <th style="text-align: right">Mar</th>
                                     <th style="text-align: right">Abr</th>
                                     <th style="text-align: right">May</th>
                                     <th style="text-align: right">Jun</th>
                                     <th style="text-align: right">Jul</th>
                                     <th style="text-align: right">Ago</th>
                                     <th style="text-align: right">Sep</th>
                                     <th style="text-align: right">Oct</th>
                                     <th style="text-align: right">Nov</th>
                                     <th style="text-align: right">Dic</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$t08=0;$t09=0;$t10=0;$t11=0;$t12=0;       
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r->suc?></td>
                                <td style="color: maroon;"><?php echo $r->sucx?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con01,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con02,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con03,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con04,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con05,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con06,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con07,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con08,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con09,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con10,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con11,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con12,2)?></td>
                                </tr>
                                <?php 
                                
                                $t01=$t01+$r->con01;
                                $t02=$t02+$r->con02;
                                $t03=$t03+$r->con03;
                                $t04=$t04+$r->con04;
                                $t05=$t05+$r->con05;
                                $t06=$t06+$r->con06;
                                $t07=$t07+$r->con07;
                                $t08=$t08+$r->con08;
                                $t09=$t09+$r->con09;
                                $t10=$t10+$r->con10;
                                $t11=$t11+$r->con11;
                                $t12=$t12+$r->con12;
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t01,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t02,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t03,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t04,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t05,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t06,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t07,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t08,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t09,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t10,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t11,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t12,2)?></td>
                                </tr>
                             </tfoot>
                         </table>                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>