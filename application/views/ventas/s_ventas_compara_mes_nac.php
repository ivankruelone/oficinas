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
                                 <th style="text-align: center">#</th>
                                    <th style="text-align: center">Imagen</th> 
                                     <th style="text-align: right">Ene</th>
                                     <th style="text-align: right">Feb</th>
                                     <th style="text-align: right">Mar</th>
                                     <th style="text-align: right">Abr</th>
                                     <th style="text-align: right">May</th>
                                     <th style="text-align: right">Jun</th>
                                    
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$t08=0;$t09=0;$t10=0;$t11=0;$t12=0;       
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
$tm=$r->con01+$r->con02+$r->con03+$r->con04+$r->con05+$r->con06+$r->con07+$r->con08+$r->con09+$r->con10+$r->con11+$r->con12;
$ttm=$ttm+$r->con01+$r->con02+$r->con03+$r->con04+$r->con05+$r->con06+$r->con07+$r->con08+$r->con09+$r->con10+$r->con11+$r->con12;
if($r->tipo2=='G'){$num_suc=$g;}elseif($r->tipo2=='F'){$num_suc=$f;}elseif($r->tipo2=='D'){$num_suc=$d;}else{$num_suc=0;}
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $num_suc?></td>
                                <td style="color: maroon;"><?php echo $r->imagen?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con01,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con02,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con03,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con04,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con05,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con06,2)?></td>
                                </tr>
                                <?php 
                                $t01=$t01+$r->con01;
                                $t02=$t02+$r->con02;
                                $t03=$t03+$r->con03;
                                $t04=$t04+$r->con04;
                                $t05=$t05+$r->con05;
                                $t06=$t06+$r->con06;
                                
                                $tm=0;
                                
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
                                </tr>
                                
                                
                             </tfoot>
                         </table>
                         
                         
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
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
                                 <th style="text-align: center">#</th>
                                    <th style="text-align: center">Imagen</th> 
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
$tm=$r->con01+$r->con02+$r->con03+$r->con04+$r->con05+$r->con06+$r->con07+$r->con08+$r->con09+$r->con10+$r->con11+$r->con12;
$ttm=$ttm+$r->con01+$r->con02+$r->con03+$r->con04+$r->con05+$r->con06+$r->con07+$r->con08+$r->con09+$r->con10+$r->con11+$r->con12;
if($r->tipo2=='G'){$num_suc=$g;}elseif($r->tipo2=='F'){$num_suc=$f;}elseif($r->tipo2=='D'){$num_suc=$d;}else{$num_suc=0;}
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $num_suc?></td>
                                <td style="color: maroon;"><?php echo $r->imagen?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con07,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con08,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con09,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con10,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con11,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->con12,2)?></td>
                                </tr>
                                <?php 
                                
                                $t07=$t07+$r->con07;
                                $t08=$t08+$r->con08;
                                $t09=$t09+$r->con09;
                                $t10=$t10+$r->con10;
                                $t11=$t11+$r->con11;
                                $t12=$t12+$r->con12;
                                $tm=0;
                                
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                
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
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-credensed table-striped table-hover" id="tabla2">
                             <thead>
                                 <tr>
                                 <th style="text-align: center">#</th>
                                    <th style="text-align: center">Imagen</th> 
                                     <th style="text-align: right">Ene</th>
                                     <th style="text-align: right">Feb</th>
                                     <th style="text-align: right">Mar</th>
                                     <th style="text-align: right">Abr</th>
                                     <th style="text-align: right">May</th>
                                     <th style="text-align: right">Jun</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$t08=0;$t09=0;$t10=0;$t11=0;$t12=0;       
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
$tm=$r->cre01+$r->cre02+$r->cre03+$r->cre04+$r->cre05+$r->cre06+$r->cre07+$r->cre08+$r->cre09+$r->cre10+$r->cre11+$r->cre12;
$ttm=$ttm+$r->cre01+$r->cre02+$r->cre03+$r->cre04+$r->cre05+$r->cre06+$r->cre07+$r->cre08+$r->cre09+$r->cre10+$r->cre11+$r->cre12;
if($r->tipo2=='G'){$num_suc=$g;}elseif($r->tipo2=='F'){$num_suc=$f;}elseif($r->tipo2=='D'){$num_suc=$d;}else{$num_suc=0;}
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $num_suc?></td>
                                <td style="color: maroon;"><?php echo $r->imagen?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre01,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre02,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre03,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre04,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre05,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre06,2)?></td>
                                
                                </tr>
                                <?php 
                                $t01=$t01+$r->cre01;
                                $t02=$t02+$r->cre02;
                                $t03=$t03+$r->cre03;
                                $t04=$t04+$r->cre04;
                                $t05=$t05+$r->cre05;
                                $t06=$t06+$r->cre06;
                                
                                $tm=0;
                                
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
                                
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                   <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-credensed table-striped table-hover" id="tabla2">
                             <thead>
                                 <tr>
                                 <th style="text-align: center">#</th>
                                    <th style="text-align: center">Imagen</th> 
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
$tm=$r->cre01+$r->cre02+$r->cre03+$r->cre04+$r->cre05+$r->cre06+$r->cre07+$r->cre08+$r->cre09+$r->cre10+$r->cre11+$r->cre12;
$ttm=$ttm+$r->cre01+$r->cre02+$r->cre03+$r->cre04+$r->cre05+$r->cre06+$r->cre07+$r->cre08+$r->cre09+$r->cre10+$r->cre11+$r->cre12;
if($r->tipo2=='G'){$num_suc=$g;}elseif($r->tipo2=='F'){$num_suc=$f;}elseif($r->tipo2=='D'){$num_suc=$d;}else{$num_suc=0;}
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $num_suc?></td>
                                <td style="color: maroon;"><?php echo $r->imagen?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre07,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre08,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre09,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre10,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre11,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->cre12,2)?></td>
                                
                                </tr>
                                <?php 
                                
                                $t07=$t07+$r->cre07;
                                $t08=$t08+$r->cre08;
                                $t09=$t09+$r->cre09;
                                $t10=$t10+$r->cre10;
                                $t11=$t11+$r->cre11;
                                $t12=$t12+$r->cre12;
                                $tm=0;
                                
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
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
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget yellowBorder">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-credensed table-striped table-hover" id="tabla3">
                             <thead>
                                 <tr>
                                 <th style="text-align: center">#</th>
                                    <th style="text-align: center">Imagen</th> 
                                     <th style="text-align: right">Ene</th>
                                     <th style="text-align: right">Feb</th>
                                     <th style="text-align: right">Mar</th>
                                     <th style="text-align: right">Abr</th>
                                     <th style="text-align: right">May</th>
                                     <th style="text-align: right">Jun</th>
                                     </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$t08=0;$t09=0;$t10=0;$t11=0;$t12=0;       
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
$tm=$r->rec01+$r->rec02+$r->rec03+$r->rec04+$r->rec05+$r->rec06+$r->rec07+$r->rec08+$r->rec09+$r->rec10+$r->rec11+$r->rec12;
$ttm=$ttm+$r->rec01+$r->rec02+$r->rec03+$r->rec04+$r->rec05+$r->rec06+$r->rec07+$r->rec08+$r->rec09+$r->rec10+$r->rec11+$r->rec12;
if($r->tipo2=='G'){$num_suc=$g;}elseif($r->tipo2=='F'){$num_suc=$f;}elseif($r->tipo2=='D'){$num_suc=$d;}else{$num_suc=0;}
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $num_suc?></td>
                                <td style="color: maroon;"><?php echo $r->imagen?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec01,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec02,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec03,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec04,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec05,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec06,2)?></td>
                                </tr>
                                <?php 
                                $t01=$t01+$r->rec01;
                                $t02=$t02+$r->rec02;
                                $t03=$t03+$r->rec03;
                                $t04=$t04+$r->rec04;
                                $t05=$t05+$r->rec05;
                                $t06=$t06+$r->rec06;
                                $tm=0;
                                
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
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget yellowBorder">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-credensed table-striped table-hover" id="tabla3">
                             <thead>
                                 <tr>
                                 <th style="text-align: center">#</th>
                                    <th style="text-align: center">Imagen</th> 
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
$tm=$r->rec01+$r->rec02+$r->rec03+$r->rec04+$r->rec05+$r->rec06+$r->rec07+$r->rec08+$r->rec09+$r->rec10+$r->rec11+$r->rec12;
$ttm=$ttm+$r->rec01+$r->rec02+$r->rec03+$r->rec04+$r->rec05+$r->rec06+$r->rec07+$r->rec08+$r->rec09+$r->rec10+$r->rec11+$r->rec12;
if($r->tipo2=='G'){$num_suc=$g;}elseif($r->tipo2=='F'){$num_suc=$f;}elseif($r->tipo2=='D'){$num_suc=$d;}else{$num_suc=0;}
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $num_suc?></td>
                                <td style="color: maroon;"><?php echo $r->imagen?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec07,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec08,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec09,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec10,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec11,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->rec12,2)?></td>
                                </tr>
                                <?php 
                                $t07=$t07+$r->rec07;
                                $t08=$t08+$r->rec08;
                                $t09=$t09+$r->rec09;
                                $t10=$t10+$r->rec10;
                                $t11=$t11+$r->rec11;
                                $t12=$t12+$r->rec12;
                                $tm=0;
                                
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
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