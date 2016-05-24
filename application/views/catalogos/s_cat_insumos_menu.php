<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                              <h4><i class="icon-reorder"></i>Permisos de insumos por Departamento</h4>
                             <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

 <?php
$l = anchor('catalogos/imp_max_ins/'.$suc,'Imprimir Catalogo</a>', array('title' => 'Haz Click aqui para imprimir catalogo!', 'class' => 'encabezado'));
?>

<table class="editinplace table table-bordered table-condensed table-striped table-hover" id="tabla3">
                             <thead>
                               
                               <tr>
                               <td colspan="6" style="text-align:center; font: +1;"><?php echo $l?></td>
                               </tr>
                               
                               <tr>
                               <th style="text-align: left;">ID INSUMO</th>
                               <th style="text-align: left;">Nombre Insumo</th>
                               <th style="text-align: left;">Empaque</th>
                               <th style="text-align: left;">Activos</th>
                               <th style="text-align: left;">Maximo</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $margen=0;$color ='blue';$num=0;
                                 foreach($query->result() as $row){
                                 $num=$num+1;
                                 if($row->activo == 0)
                                                {
                                                    $valor = FALSE;
                                                      
                                                }else{
                                                    $valor = TRUE;     
                                                }   
                                                $data = array(
                                                    'name'        => 'opcion_'.$row->descripcion,
                                                    'id_insumos'  => $row->id_insumos,
                                                    'empaque'     => $row->empaque,
                                                    'value'       => $suc,
                                                    'checked'     => $valor,
                                                    'style'       => 'margin:10px',
                                                    );
                                                    
                                                $maximo = array(
                                                    'name'        => 'maximo_'.$row->id_insumos.'_'.$row->suc,
                                                    'id_insumos'  => $row->id_insumos,
                                                    'id'          => 'maximo_'.$row->id_insumos,
                                                    'suc'         => $row->suc,
                                                    'value'       => $row->maximo,
                                                    'type'        => 'number',
                                                );
                                                    
                                                    if($row->activo == 0)
                                                    {
                                                        $maximo = form_input($maximo, $row->maximo, 'disabled'); 
                                                    }else{
                                                        $maximo = form_input($maximo); 
                                                    }
                                                     
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->id_insumos?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->descripcion?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->empaque?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo form_checkbox($data)?></td>
                                   <td class="editable" style="text-align: left;"><?php echo $maximo;?></td>
                                   
                                 </tr> 
                               
                             <?php
                             
                                } 
                                
                                ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>                          
                         </div>
                     </div>
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                              <h4><i class="icon-reorder"></i>Permisos de insumos por Departamento</h4>
                             <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

 
<table class="editinplace table table-bordered table-condensed table-striped table-hover" id="tabla4">
                             <thead>
                               <tr>
                               <th style="text-align: left;">ID INSUMO</th>
                               <th style="text-align: left;">Nombre Insumo</th>
                               <th style="text-align: left;">Empaque</th>
                               <th style="text-align: left;">Maximo</th>
                               <th style="text-align: left;">activo</th>
                               </tr>  
                             </thead>
                             <tbody>
                                 <?php
                                 $margen=0;$color ='blue';$num=0;
                                 foreach($query1->result() as $row1){
                                    if($row1->activo == 0){
                                        $l1 = 'no';
                                    }else{
                                        $l1 = 'si';
                                    }
                                 $num=$num+1;
                                 
                                 ?> 
                                 <tr>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row1->id_insumos?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row1->descripcion?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row1->empaque?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row1->maximo;?></td>
                                   <td style="color:<?php echo $color?>;text-align: left;"><?php echo $l1?></td>
                                   
                                 </tr> 
                               
                             <?php
                             
                                } 
                                
                                ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>                          
                         </div>
                     </div>
                     
                     
                      </div>     