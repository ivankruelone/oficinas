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
                                 <th colspan="2" style="color:gray;text-align: center"></th>
                                 <th colspan="2" style="color:gray;text-align: center">Inv.Inicial</th>
                                 <th colspan="2" style="color:gray;text-align: center">Entradas</th>
                                 <th colspan="2" style="color:gray;text-align: center">Salidas</th>
                                 <th colspan="2" style="color:gray;text-align: center">Inv.Final</th>
                                 </tr>
                                 <tr>
                                     <th style="text-align: center">Fecha</th> 
                                     <th style="text-align: center">Semana</th>
                                     <th style="color:gray; text-align: right">Inv_Inicial</th>
                                     <th style="color:gray; text-align: right">Imp.Inv_Inicial</th>
                                     <th style="color:gray; text-align: right">Entradas</th>
                                     <th style="color:gray; text-align: right">Imp.Ent</th>
                                     <th style="color:gray; text-align: right">Salidas</th>
                                     <th style="color:gray; text-align: right">Imp.Salidas</th>
                                     <th style="color:gray; text-align: right">Inv.Final</th>
                                     <th style="color:gray; text-align: right">Imp.Inv.Final</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $inv=0;$ent=0;$sal=0;$inv_imp=0;$ent_imp=0;$sal_imp=0;
                                foreach ($a->result()as $r){
                                $l0 = anchor('inventario/inv_farmacias_imagen/'.$r->sem,$r->sem.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->fecha?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $l0?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->inv,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->inv_imp,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->ent,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->ent_imp,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->sal,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->sal_imp,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format(($r->inv+$r->ent-$r->sal),0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format(($r->inv_imp+$r->ent_imp-$r->sal_imp),2)?></td>
                                 </tr>
                               <?php 
$inv=$inv+$r->inv;
$ent=$ent+$r->ent;
$sal=$sal+$r->sal;
$inv_imp=$inv_imp+$r->inv_imp;
$ent_imp=$ent_imp+$r->ent_imp;
$sal_imp=$sal_imp+$r->sal_imp;
                               } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td></td>
                              <td></td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($inv,0)?></td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($inv_imp,2)?></td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($ent,0)?></td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($ent_imp,2)?></td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($sal,0)?></td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($sal_imp,2)?></td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format(($inv+$ent-$sal),0)?></td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format(($inv_imp+$ent_imp-$sal_imp),2)?></td>
                                
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>