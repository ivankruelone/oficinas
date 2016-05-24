                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <?php 
$l0 = anchor('catalogos/s_cat_insumos_nuevo/', 'Agregar nuevo insumo');
?>
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th colspan="9"><?php echo $l0?></th>
                               </tr>
                               <tr>
                               <th colspan="9" style="color: red; size: !important+10;"><?php echo 'SI QUIERES VER EL CATALOGO SOLO POR DEPARTAMENTOS ES EN PERMISOS'?></th>
                               </tr>
                               <tr>
                               <th style="text-align: left;">Id</th>
                               <th style="text-align: left;">Descripcion</th>
                               <th style="text-align: left;">Empaque</th>
                               <th style="text-align: left;">Costo</th>
                               <th style="text-align: left;">Maximo</th>
                               <th style="text-align: left;">Observacion</th>
                               <th style="text-align: left;">Activo en Sucursal</th>
                               <th style="text-align: left;">Activo en Deptos</th>
                               <th style="text-align: left;">Activo en Medicos</th>
                               <th style="text-align: left;">Activo Insumo</th>
                               <th style="text-align: left;">Activo<br />Ped.Especial</th>
                               <th style="text-align: left;">Acciones</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $num=0;$margen=0;$color ='blue';
                                 foreach ($q->result()as $r){
                              //  $l4 = anchor('insumos/s_ped_insumos_det_delete/'.$id_insumos.'/'.$r2->id,'Borrar</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                $num=$num+1;
                                if($r->suc==1){
                                $l1 ='<img src="'.base_url().'img/good.png" border="0" width="20px" />';
                                }else{$l1='';}
                                if($r->depto==1){
                                $l2='<img src="'.base_url().'img/good.png" border="0" width="20px" />';
                                }else{$l2='';}
                                if($r->activo==1){
                                $l3='<img src="'.base_url().'img/good.png" border="0" width="20px" />';
                                }else{$l3='';}
                                if($r->medico==1){
                                $l4='<img src="'.base_url().'img/good.png" border="0" width="20px" />';
                                }else{$l4='';}
                                if($r->ped_especial==1){
                                $l5='<img src="'.base_url().'img/good.png" border="0" width="20px" />';
                                }else{$l5='';}
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->id_insumos?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->descripcion?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->empaque?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->costo?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->maxi?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $r->observa?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $l1?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $l2?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $l4?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $l3?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $l5?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo anchor('catalogos/s_cat_insumos_edita/'.$r->id_insumos, 'Editar'); ?></td>
                                 <!--  <td style="color:<?php echo $color?>;text-align: left;"><?php echo anchor('catalogos/s_cat_insumos_baja/'.$r->id_insumos, 'Eliminar'); ?></td> -->
                                 <!-- <td style="color:<?php echo $color?>;text-align: left;"><?php echo $l4?></td> -->
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