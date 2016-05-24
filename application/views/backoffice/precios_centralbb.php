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
                               <th style="text-align: left;">Rel</th>
                               <th style="text-align: left;">Codigo</th>
                               <th style="text-align: left;">Descripcion</th>
                               <th style="text-align: left;"><?php echo $varnom?></th>
                               <th style="text-align: left;">Publico correcto</th>
                               <th style="text-align: left;">Pub <?php echo $varnom?></th>
                               <th style="text-align: left;">Farmacia correcto</th>
                               <th style="text-align: left;">Far <?php echo $varnom?></th>
                               <th style="text-align: left;">Diferencia</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color='black';$color1='orange';
                                 foreach ($q->result()as $r){
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->rel?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->codigo?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->descripcion?></td>
                                   <td style="color:<?php echo $color1?>;text-align: left;"><?php echo $r->descri?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo number_format($r->pub,2)?></td>
                                   <td style="color:<?php echo $color1?>;text-align: left;"><?php echo number_format($r->pub_mal,2)?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo number_format($r->farmacia,2)?></td>
                                   <td style="color:<?php echo $color1?>;text-align: right;"><?php echo number_format($r->far_mal,2)?></td>
                                   <td style="color: red ;text-align: right;"><?php echo number_format($r->dif,2)?></td>                                  
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