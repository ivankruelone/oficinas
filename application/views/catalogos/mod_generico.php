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
                               <th style="text-align: left;">Sec</th>
                               <th style="text-align: left;">Stat</th>
                               <th style="text-align: left;">Clas</th>
                               <th style="text-align: left;">Sustancia Activa</th>
                               <th style="text-align: left;">Prv</th>
                               <th style="text-align: left;">Provedor</th>
                               <th style="text-align: left;">Linea</th>
                               <th style="text-align: left;">Sublinea</th>
                               <th style="text-align: left;">Iva</th>
                               <th style="text-align: left;">Costo Base</th>
                               <th style="text-align: left;">Vta DDr</th>
                               <th style="text-align: left;">Vta Gen</th>
                               <th style="text-align: left;">Margen</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;
                                 foreach ($q->result()as $r){
                                $num=$num+1;
                                $l0=anchor('catalogos/mod_generico_sec/'.trim($r->tipo).'/'.$r->sec,$r->sec.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                if($r->cos>0 and $r->gen>0){
                                    if($r->iva==0){$margen=100-(($r->cos*100)/$r->gen);}
                                    else{$margen=100-((($r->cos*1.16)*100)/$r->gen);}
                                    }else{$margen=0;}
                                    if($r->tipo=='D'){$color='orange';}
                                    elseif($r->tipo=='X'){$color='red';}
                                    elseif($r->tipo=='A'){$color='gray';}
                                    elseif($r->tipo=='F'){$color='brown';}
                                    elseif($r->tipo=='T'){$color='green';}else{$color='blue';}
                                 ?> 
                                 <tr>
                                   <td style=" text-align: left;"><?php echo $l0?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->tipo?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->clasi?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->susa?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->prv?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->corto?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->linx?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->sublinx?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo $r->iva?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->cos,2)?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->ddr,2)?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($r->gen,2)?></td>
                                   <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($margen,2)?></td>
                                                                     
                                 </tr> 
                           
                             
                               
                              
                                 
                               <?php } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>