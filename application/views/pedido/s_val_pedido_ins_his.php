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

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Folio</th>
                                     <th>Pedido</th>
                                     <th>Tipo Pedido</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Importe</th>
                                     <th>Fecha Solicitado<br />Sucursal</th>
                                     <th>Fecha Validado<br />Supervisor</th>
                                     <th>Fecha Surtido</th>
                                     <th>Llego en sucursal</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $l2= anchor('pedido/s_val_pedido_ins_his_det/'.$r->id_cc.'/'.$r->fol,$r->id_cc.$r->fol.'</a>', array('title' => 'Haz Click aqui para detalle!', 'class' => 'encabezado'));
                                $num=$num+1;
                                  
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td><?php echo $l2?></td>
                                        <td style="text-align: left; "><?php echo $r->pedido?></td>
                                        <td style="text-align: left; "><?php echo $r->comprax?></td>
                                        <td style="text-align: right; "><?php echo $r->suc?></td>
                                        <td style="text-align: left; "><?php echo $r->sucx?></td>
                                        <td style="text-align: right; "><?php echo $r->imp?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha_suc?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha_cap?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha_sur?></td>
                                        <td style="text-align: left; "><?php echo $r->fecha_val?></td>
                                        </tr>
                                        <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             </tr>
                             </tfoot>
                         </table>                        

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>