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
                                     <th>Nid Empleado</th>
                                     <th>Nombre</th>
                                     <th>Puesto</th>
                                     <th>Sucursal</th>
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
                                $num=0;$imp=0;
                                foreach ($q->result() as $r) {
                                $l2 = anchor('pedido/pedido_extra_cero/'.$r->id_cc.'/'.$r->id_ex.'/'.$r->id.'/'.$r->descripcion,$r->descripcion.'</a>',array('title' => 'Haz Click aqui para dejar ceros en cantidad pedida!', 'class' => 'encabezado'));
                                $num=$num+1;
                                  
                                ?>
                                        <tr>
                                        <td style="text-align: left; "><?php echo $num?></td>
                                         <td style="text-align: left; "><?php echo $r->nomina?></td>
                                        <td style="text-align: left; "><?php echo $r->name?></td>
                                        <td style="text-align: left; "><?php echo $r->puestox?></td>
                                        <td style="text-align: left; "><?php echo $r->suc.'-'.$r->nombre?></td>
                                        <td style="text-align: left; "><?php echo $l2?></td>
                                        <td style="text-align: right; "><?php echo '1';?></td>
                                        <td style="text-align: right; "><?php echo '1';?></td>
                                        <td style="text-align: right; "><?php echo $r->cantidad?></td>
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
                             </tfoot>
                         </table>                        

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>