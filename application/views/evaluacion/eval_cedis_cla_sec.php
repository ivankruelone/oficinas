                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: center">Clasifica</th>
                                     <th style="text-align: center">Descripcion</th>  
                                     <th style="text-align: center">Existencia <?php echo date('Y-m-d')?></th>
                                     <th style="text-align: center">Ene</th>
                                     <th style="text-align: center">Feb</th>
                                     <th style="text-align: center">Mar</th>
                                     <th style="text-align: center">Abr</th>
                                     <th style="text-align: center">May</th>
                                     <th style="text-align: center">Jun</th>
                                     <th style="text-align: center">Jul</th>
                                     <th style="text-align: center">Ago</th>
                                     <th style="text-align: center">Sep</th>
                                     <th style="text-align: center">Oct</th>
                                     <th style="text-align: center">Nov</th>
                                     <th style="text-align: center">Dic</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa.'<br /><font color="orange">OTRO PRV</font>'?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->exis,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->ene,0)."<br /><font color='orange'>".number_format($r->enen,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->feb,0)."<br /><font color='orange'>".number_format($r->febn,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->mar,0)."<br /><font color='orange'>".number_format($r->marn,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->abr,0)."<br /><font color='orange'>".number_format($r->abrn,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->may,0)."<br /><font color='orange'>".number_format($r->mayn,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->jun,0)."<br /><font color='orange'>".number_format($r->junn,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->jul,0)."<br /><font color='orange'>".number_format($r->juln,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->ago,0)."<br /><font color='orange'>".number_format($r->agon,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->sep,0)."<br /><font color='orange'>".number_format($r->sepn,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->oct,0)."<br /><font color='orange'>".number_format($r->octn,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->nov,0)."<br /><font color='orange'>".number_format($r->novn,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->dic,0)."<br /><font color='orange'>".number_format($r->dicn,0)?></td>
                                </tr>
                               <?php 
                               
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>