                 <div class="span8">
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
if($valida==0){
$l0 = anchor('insumos/s_insumos_proceso_medicos','Procesa pedido Formulado');
$l2 = anchor('insumos/inserta_pre_pedido_cds','Graba Pedidos Formulados');
}else{$l0='';$l2='';}
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                          <tr>
                          <td colspan="5" style="text-align:center; font: +1;"><?php echo $l0 ?></td>
                          </tr>
                          <tr>
                          <td colspan="5" style="text-align:center; font: +1;"><?php echo $l2 ?></td>
                          </tr>
                                  <tr> 
                                     <th>#</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Insumos</th>
                                     <th>Piezas</th>
                                     
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0; $imp1=0; $imp2=0;
                                     foreach ($q->result() as $r2) {
                                 
  $l1 = anchor('insumos/s_insumos_proceso_medicos_ver_det/'.$r2->suc,$r2->suc);
                                     ?>
                                        
                                 <tr>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->nombre?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->articulos?></td>
                                 <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->pedido?></td>
                                 </tr>
                                        <?php $num=$num+1;
                                        $imp1=$imp1+($r2->pedido);
                                        
                                        }?>
                                        <tfoot>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><?php echo $imp1 ?></td>
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