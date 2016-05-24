                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                         <h4><i class="icon-reorder"></i><?php echo $titulo;?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: center">Secuencia</th>
                                     <th style="text-align: center">Descripci&oacute;n</th>  
                                     <th style="text-align: center">Clasificaci&oacute;n</th>
                                     <th style="color:gray; text-align: center">Inventario CEDIS</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                if($var==' '){$var='_';}else{$var=$var;}
                                //$ap=($r->abasto/$r->productos)*100;
                                //$l0 = anchor('evaluacion/eval_cedis_cla_sec/'.$var.'/'.$r->prv,$r->prvx.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo $r->tipo?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo $r->inv1?></td>
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