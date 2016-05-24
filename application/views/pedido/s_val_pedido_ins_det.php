                 <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Art&iacute;culo</th>
                                     <th>Can.Farmacia</th>
                                     <th>Can.Calculada</th>
                                     <th>Can.Supervisor</th>
                                     <th>$ Costo</th>
                                     <th>Importe</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $l= anchor('pedido/sumit_ins_det_cerrar/'.$id_cc,'CERRAR FOLIO');  
                                $num=0;$imp=0;
                                foreach ($q->result() as $r) {
                                if($r->id_insumos==22 || $r->id_insumos==23 || $r->id_insumos==34 ||
                                $r->id_insumos==35 || $r->id_insumos==32 || $r->id_insumos==33){
                                $l2=$r->descripcion;
                                }else{
                                $l2= anchor('pedido/s_val_pedido_ins_det_c/'.$id_cc.'/'.$r->id,$r->descripcion.'</a>', array('title' => 'Haz Click aqui para cambiar cantidad!', 'class' => 'encabezado'));
                                }
                                $num=$num+1;
                                  
                                ?>
                                        <tr>
                                        <td style="text-align: left; "><?php echo $num?></td>
                                        <td style="text-align: left; "><?php echo $l2?></td>
                                        <td style="text-align: right; "><?php echo $r->canp_suc?></td>
                                        <td style="text-align: right; "><?php echo $r->canp?></td>
                                        <td style="text-align: right; "><?php echo $r->canp_sup?></td>
                                        <td style="text-align: right; "><?php echo $r->costo?></td>
                                        <td style="text-align: right; "><?php echo ($r->costo*$r->canp_sup)?></td>
                                        </tr>
                                        <?php 
                                        $imp=$imp+($r->canp_sup*$r->costo);
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="7" style="text-align: right; "><?php echo number_format($imp,2)?></td>
                             </tr>
                             <tr>
                             <td colspan="7" style="text-align: center;"><?php echo $l?></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>