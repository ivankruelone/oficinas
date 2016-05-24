                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><? echo $titulo?></h4>
                           
                         </div>
                         <div class="widget-body">
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">#</th>
                               <th style="text-align: left;">Sistema</th>
                               <th style="text-align: left;">Mov</th>
                               <th style="text-align: left;">Cierre</th>
                               <th style="text-align: left;">Imagen</th>
                               <th style="text-align: left;">Nid</th>
                               <th style="text-align: left;">Sucursal</th>
                               <th style="text-align: left;">Telefono</th>
                               <th style="text-align: left;">Dias.Vta</th>
                               <th style="text-align: left;">Observ.</th>
                               <th style="text-align: left;"></th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color='gray';$color1='gray';
                                 foreach ($q->result()as $r){
                                 if($r->obser=='Cierra los domingos'){$nn=($r->dia_limite)-$n;}else{$nn=$r->dia_limite;}   
                                 if($r->dias<$nn and $r->fecha_act == '0000-00-00' and $r->fecha_act < date('Y-m-d')){
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $num?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->back?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->tras?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->fecha_act?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->tipo2?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->suc?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->nombre?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->tel.'<br />'.$r->tel1?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->dias?></td>
                                 <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->obser?></td>
                                 <td><?php echo
                                 anchor('backoffice/s_ventas_detalle_suc/'.$r->suc.'/'.$r->mes,'<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para generar comisiones!', 'class' => 'encabezado','target'=>'blank'));
                                 
                                 ?></td>
                                 
                                 </tr> 
                           
                                <?php }} ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>