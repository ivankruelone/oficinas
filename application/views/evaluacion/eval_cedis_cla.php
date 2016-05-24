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
                                     <th style="text-align: center"># Prov.</th>
                                     <th style="text-align: center">Provedor</th>  
                                     <th style="text-align: center">Productos</th>
                                     <th style="color:gray; text-align: center">Abasto Prod.</th>
                                     <th style="color:gray; text-align: center">Abasto %</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                if($var==' '){$var='_';}else{$var=$var;}
                                $ap=($r->abasto/$r->productos)*100;
                                $l0 = anchor('evaluacion/eval_cedis_cla_sec/'.$var.'/'.$r->prv,$r->prvx.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->prv?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->productos,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->abasto,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($ap,2)?></td>
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