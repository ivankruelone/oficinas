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
     $atributos = array('id' => 'insumos/s_insumos_cer_cont');
     echo form_open('insumos/s_insumos_cer_cont/',$atributos);
?>
<table>
<tr>
 <tr>   
    <td align="center" ><font size="+1"><strong>Surtidor: </strong></font></td>
	<td align="center"><?php echo form_dropdown('surtidor', $surtidor, '', 'id="surtidor"') ;?> </td>
 </tr>
	<td colspan="2"align="center"><?php if($this->session->userdata('id') == 126){}else{?><?php echo form_submit('envio', 'CERRAR FOLIO');?><?php } ?></td>
 </tr>
</table>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
<input type="hidden" value="<?php echo $fol?>" name="fol" id="fol" />
<input type="hidden" value="<?php echo $id_comprar?>" name="id_comprar" id="id_comprar" />
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                  <tr> 
                                     <th>Nid Empleado</th>
                                     <th>Nombre</th>
                                     <th>Puesto</th>
                                     <th>Nid Sucursal</th>
                                     <th>Sucursal</th>
                                     <th>Cod</th>
                                     <th>Descripcion</th>
                                     <th></th>
                                     <th></th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0; $imp1=0; $imp2=0;
                                     foreach ($q->result() as $r) {
                                  
  $l0 = anchor('insumos/s_insumos_det_cero_cont/'.$r->id.'/'.$r->fol.'/'.$id_cc.'/'.$id_comprar,'Ceros</a>', array('title' => 'Haz Click aqui para dejar ceros en cantidad surtida!', 'class' => 'encabezado'));
  $l1 = anchor('insumos/s_insumos_det_cambio_cont/'.$r->id.'/'.$r->fol.'/'.$id_cc.'/'.$id_comprar.'/'.$r->ide,'Cambio</a>', array('title' => 'Haz Click aqui para Cambiar el producto!', 'class' => 'encabezado'));
 
  if($r->canp<>$r->cans){$color='orange';}else{$color='blue';}
  ?>
                                        
                                 <tr>
                                <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r->ide?></td>
                                <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r->name?></td>
                                <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r->puestox?></td>
                                <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r->suc?></td>
                                <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r->nombre?></td>
                                <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r->id_insumos?></td>
                                <td style="text-align: left; color:   <?php echo $color ?>"><?php echo  $r->descripcion?></td>
                                <td style="text-align: left; color: <?php echo $color ?>"><?php if($this->session->userdata('id') == 126){}else{?><?php echo $l0?><?php } ?></td>
                                <td style="text-align: left; color: <?php echo $color ?>"><?php if($this->session->userdata('id') == 126){}else{?><?php echo $l1?><?php } ?></td>
                                </tr>
                                        <?php $num=$num+1;
                                        $imp1=$imp1+($r->canp*$r->costo);
                                        $imp2=$imp2+($r->cans*$r->costo);
                                        }?>
                                        <tfoot>
                                        <tr>
                                        <td colspan="7"></td>
                                        </tr>
                                        </tfoot>
                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
 <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">

                             <thead>
                            <tr> 
                                     <th>Id</th>
                                     <th>Codigo</th>
                                     <th>Descripcion</th>
                                     <th>Presentacion</th>
                                     <th>Pedido</th>
                                     <th>Surtido</th>
                                     <th></th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0; $imp1=0; $imp2=0;
                                     foreach ($q->result() as $r2) {
  if($r2->canp<>$r2->cans){$color='orange';}else{$color='blue';}
  
                                     ?>
                                        
                                 <tr>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->id_insumos?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->descripcion?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->empaque?></td>
                                 <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->canp?></td>
                                 <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->cans?></td>
                                 </tr>
                                        <?php $num=$num+1;
                                        $imp1=$imp1+($r2->canp*$r2->costo);
                                        $imp2=$imp2+($r2->cans*$r2->costo);
                                        }?>
                                        <tfoot>
                                        <tr>
                                        <td colspan="7"></td>
                                        </tr>
                                        </tfoot>
                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>
  <!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET--> 
                     
                 </div>