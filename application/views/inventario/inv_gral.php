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
                                 <th colspan="4" style="color:gray;text-align: center"></th>
                                 <th colspan="6" style="color:gray;text-align: center">Inventarios</th>
                                 </tr>
                                 <tr>
                                     <th style="text-align: left">Sec</th> 
                                     <th style="text-align: left">Clave</th>
                                     <th style="color:gray; text-align: left">Sustancia Activa</th>
                                     <th style="color:gray; text-align: right">Req.Far</th>
                                     <th style="color:gray; text-align: right">Cedis</th>
                                     <th style="color:gray; text-align: right">F.Bodega</th>
                                     <th style="color:gray; text-align: right">Chet</th>
                                     <th style="color:gray; text-align: right">Agu</th>
                                     <th style="color:gray; text-align: right">Tra</th>
                                     <th style="color:gray; text-align: right">Seg</th>
                                     <th style="color:gray; text-align: right">Con</th>
                                     <th style="color:gray; text-align: right">Mod</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($a->result()as $r){
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->clagob?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->farmacia,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cedis,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->fbo,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cht,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->agu,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->tra,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->seg,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->con,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->modu,0)?></td>
                                </tr>
                               <?php 
                               $tinv=$tinv+$r->cedis;
                               $tinv_impo=$tinv_impo+$r->farmacia;
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>