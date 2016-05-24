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
                                 <th colspan="6" style="text-align: center;">INVENTARIOS</th>
                                 <th colspan="12" style="text-align: center;">COMPRA</th>
                                 </tr>
                                 <tr>
                                     <th style="text-align: left">Clave Catalogo</th> 
                                     <th style="text-align: left">Clave SEGPOP</th>
                                     <th style="color:gray; text-align: left">Sustancia Activa</th>
                                     <th style="color:gray; text-align: left">INV.AGU</th>
                                     <th style="color:gray; text-align: left">INV.OFI<br />MENOR 1 A&Ntilde;O</th>
                                     <th style="color:gray; text-align: left">INV.OFI<br />MAYOR 1 A&Ntilde;O</th>
                                     <th style="color:gray; text-align: left">1</th>
                                     <th style="color:gray; text-align: left">2</th>
                                     <th style="color:gray; text-align: left">3</th>
                                     <th style="color:gray; text-align: left">4</th>
                                     <th style="color:gray; text-align: left">5</th>
                                     <th style="color:gray; text-align: left">6</th>
                                     <th style="color:gray; text-align: left">7</th>
                                     <th style="color:gray; text-align: left">8</th>
                                     <th style="color:gray; text-align: left">9</th>
                                     <th style="color:gray; text-align: left">10</th>
                                     <th style="color:gray; text-align: left">11</th>
                                     <th style="color:gray; text-align: left">12</th>
                              </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($a->result()as $r){
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->clavecat?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->clave?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descripcion?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->existencia,0)?></td>
                                <td style="color: <?php echo 'red'?>; text-align: right"><?php echo number_format($r->ofimenor,0)?></td>
                                <td style="color: <?php echo 'blue'?>; text-align: right"><?php echo number_format($r->ofimayor,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->ene,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->feb,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->mar,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->abr,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->may,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->jun,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->jul,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->ago,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->sep,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->oct,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->nov,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->dic,0)?></td>
                                </tr>
                               <?php 
                               $tinv=$tinv+$r->existencia;
                                } ?>
                              </tbody>
                              <tfoot>
                              
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>