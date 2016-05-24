<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
$l0 = anchor('insumos/s_insumos_pextra','imprime_previos</a>', array('title' => 'Haz Click aqui para cerrar folio!', 'class' => 'encabezado'));
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla0">

                             <thead>
                                <tr>
                                <th colspan="6"><?php echo $l0?></th>
                                </tr>
                                 <tr> 
                                     <th>Id</th>
                                     <th># N&oacute;mina</th>
                                     <th>Nombre</th>
                                     <th>Puesto</th>
                                     <th></th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='black';$num=0;$tot=0;$totc=0;$dif=0;
                                     foreach ($q->result() as $r1) {
  if($this->session->userdata('nivel') == 30){
 $l1 = anchor('insumos/s_insumos_extra_det/'.$r1->id_cc.'/'.$r1->fol.'/'.$r1->id_comprar.'/'.$r1->nomina,'Detalle</a>', array('title' => 'Haz Click aqui para Ver Detalle!', 'class' => 'encabezado'));
  //$l1 = anchor('insumos/s_insumos_extra_det/'.$r1->id_cc.'/'.$r1->fol.'/'.$id_comprar,'Detalle</a>', array('title' => 'Haz Click aqui para Ver Detalle!', 'class' => 'encabezado'));
    if($r1->fol>'A'){$color='orange';}else{$color='black';
  }
  }else{
    $l1 = anchor('insumos/s_insumos_ctl_e/'.$r1->id_cc.'/'.$r1->fol.'/'.$id_comprar,'Detalle</a>', array('title' => 'Haz Click aqui para Ver Detalle!', 'class' => 'encabezado'));
  
 }
                                         $num=$num+1;?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->nomina?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->completo?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->puestox?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        </tr>
                                        <?php
                                        }?>
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="6" style="text-align: left; color: <?php echo $color ?>">Total de pedidos: <?php echo number_format($num,0)?></td>
                             </tr>
                             </tfoot>
                         </table> 
<!---->
                         </div>
                     </div>
                      <!-- END BLANK PAGE PORTLET-->
                 </div>