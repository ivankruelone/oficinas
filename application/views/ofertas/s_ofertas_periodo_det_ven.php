                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: left">Codigo</th> 
                                     <th style="text-align: left">Descripcion</th>
                                     <th style="text-align: left">Ofe.Pzas</th>
                                     <th style="text-align: left">Ofe %</th>
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
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $v1=0;$v2=0;$v3=0;$v4=0;$v5=0;$v6=0;$v7=0;$v8=0;$v9=0;$v10=0;$v11=0;$v12=0;
                                foreach ($q->result()as $r){
$l1= anchor('ofertas/s_ofertas_periodo_det/'.$r->inicio, $r->inicio, 'class="button-link blue"');
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->codigo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descri?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->piezas.'+'.$r->regalo?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->oferta,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta1,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta2,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta3,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta4,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta5,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta6,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta7,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta8,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta9,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta10,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta11,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta12,0)?></td>
                                </tr>
                               <?php 
                                $v1=$v1+$r->venta1;
                                $v2=$v2+$r->venta2;
                                $v3=$v3+$r->venta3;
                                $v4=$v4+$r->venta4;
                                $v5=$v5+$r->venta5;
                                $v6=$v6+$r->venta6;
                                $v7=$v7+$r->venta7;
                                $v8=$v8+$r->venta8;
                                $v9=$v9+$r->venta9;
                                $v10=$v10+$r->venta10;
                                $v11=$v11+$r->venta11;
                                $v12=$v12+$r->venta12;
                                
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="4"></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v1,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v2,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v3,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v4,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v5,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v6,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v7,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v8,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v9,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v10,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v11,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($v12,0)?></strong></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>