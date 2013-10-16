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
                                     <th>Sec</th>
                                     <th>Codigo</th>
                                     <th>clagob</th>
                                     <th>Sustancia Activa</th>
                                     <th>Cedis</th>
                                     <th>Farmabodega</th>
                                     <th>Metro</th>
                                     <th>Bansefi</th>
                                     <th>Piezas</th>
                                     <th>Costo</th>
                                     <th>Importe</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;$timpo=0;
                                foreach ($a as $r) {
                                $num=$num+1;
                                $tot=0; $n=0;?> 
                               
                                        
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td><?php echo $r['sec']?></td>
                                        <td><?php echo $r['codigo']?></td>
                                        <td><?php echo $r['clagob']?></td>
                                        <td><?php echo $r['susa']?></td>
                                        
                                        
                                        <?php $tot=0; $n=0; 
                                        if($r['costobase']<$r['cos']){$color='red';}else{$color='blue';}
                                        foreach($r['segundo'] as $seg){?>
                                        
                                        <?php
                                        if($seg['almacen']=='alm'){$u1=$seg['cans'];}
                                        if($seg['almacen']=='fbo'){$u2=$seg['cans'];}
                                        if($seg['almacen']=='met'){$u3=$seg['cans'];}
                                        if($seg['almacen']=='ban'){$u4=$seg['cans'];}
                                        
                                        }?>
                                        
                                        <td style="text-align: right;"><?php echo number_format($u1,0)?></td>
                                        <td style="text-align: right;"><?php echo number_format($u2,0)?></td>
                                        <td style="text-align: right;"><?php echo number_format($u3,0)?></td>
                                        <td style="text-align: right;"><?php echo number_format($u4,0)?></td>
                                        
                                          <?php
                                        $tu1=$tu1+$u1;
                                        $tu2=$tu2+$u2;
                                        $tu3=$tu3+$u3;
                                        $tu4=$tu4+$u4; 
                                          $u5=$u1+$u2+$u3+$u4;
                                          $impo=$seg['costo']*$u5;
                                          $u1=0;$u2=0;$u3=0;$u4=0; ?>
                                        <td style="text-align: right; color:black"><?php echo number_format($u5,0)?></td>
                                        <td style="text-align: right; color:<?php echo $color?>;"><?php echo number_format($seg['costo'],2)?></td>
                                        <td style="text-align: right;"><?php echo number_format($impo,2)?></td>
                                        </tr>
                                        <?php 
                                        
                                        $final1=$final1+$u5;$timpo=$timpo+$impo;}?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="5">TOTAL GENERAL</td>
                             <td style="text-align: right;color: royalblue;"><?php echo number_format($tu1,0)?></td>
                             <td style="text-align: right;color: royalblue;"><?php echo number_format($tu2,0)?></td>
                             <td style="text-align: right;color: royalblue;"><?php echo number_format($tu3,0)?></td>
                             <td style="text-align: right;color: royalblue;"><?php echo number_format($tu4,0)?></td>
                             <td style="text-align: right;color: royalblue;"><?php echo number_format($final1,0)?></td>
                             <td ></td>
                             <td style="text-align: right;color: royalblue;"><?php echo number_format($timpo,2)?></td>
                             <td></td>
                             </tr></tfoot>
                         </table>                        





                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>