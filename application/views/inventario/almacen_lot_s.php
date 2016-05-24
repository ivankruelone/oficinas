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
                                <?php if($tipo=='con'){ ?>
                                <tr>
                                <th colspan="7" style="text-align: center;">INVENTARIO CONTROLADOS</th>
                                </tr>
                                
                                <?php	} ?>
                                
                                <?php if($tipo=='fbo'){ ?>
                                <tr>
                                <th colspan="7" style="text-align: center;">INVENTARIO FARMABODEGA</th>
                                </tr>
                                
                                <?php	} ?>
                                
                                <?php if($tipo=='alm'){ ?>
                                <tr>
                                <th colspan="7" style="text-align: center;">INVENTARIO CEDIS</th>
                                </tr>
                                
                                <?php	} ?>
                                
                                <?php if($tipo=='agu'){ ?>
                                <tr>
                                <th colspan="7" style="text-align: center;">INVENTARIO AGUASCALIENTES</th>
                                </tr>
                                
                                <?php	} ?>
                                
                                <?php if($tipo=='cht'){ ?>
                                <tr>
                                <th colspan="7" style="text-align: center;">INVENTARIO QUINTANA ROO</th>
                                </tr>
                                
                                <?php	} ?>
                                
                                <?php if($tipo=='tra'){ ?>
                                <tr>
                                <th colspan="7" style="text-align: center;">INVENTARIO TRASIMENO140</th>
                                </tr>
                                
                                <?php	} ?>
                                
                                <?php if($tipo=='seg'){ ?>
                                <tr>
                                <th colspan="7" style="text-align: center;">INVENTARIO ALM SP OFICINAS</th>
                                </tr>
                                
                                <?php	} ?>
                                
                                 
                                 <tr>
                                     <th style="text-align: left">Sec</th> 
                                     <th style="color:gray; text-align: left">Sustancia Activa</th>
                                     <th style="color:gray; text-align: left">Lote</th>
                                     <th style="color:gray; text-align: right">Caducidad</th>
                                     <th style="color:gray; text-align: right">Piezas</th>
                                     <th style="color:gray; text-align: right">Costo</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                    
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->lote?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->cadu ?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->inv1,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->costo,2)?></td>
                                </tr>
                               <?php 
                               $tinv=$tinv+$r->inv1;
                               $tinv_impo=$tinv_impo+($r->inv1*$r->costo);
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="4">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv_impo,2)?></td>
                                </tr>
                             </tfoot>
                         </table>
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>