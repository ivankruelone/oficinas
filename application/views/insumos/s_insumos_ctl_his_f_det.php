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

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                                 <tr> 
                                     <th>#</th>
                                     <th>Fecha</th>
                                     <th>Folio</th>
                                     <th>Tipo</th>
                                     <th>Pedido</th>
                                     <th>Surtido</th>
                                     <th>Nivel de surtido</th>
                                     <th>Imp.Surtido</th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0;$dif=0;
                                     foreach ($q->result() as $r2) {
  $l1 = anchor('insumos/s_insumos_det_f/'.$r2->id_cc.'/'.$r2->suc,'Detalle</a>', array('title' => 'Haz Click aqui para Ver Detalle!', 'class' => 'encabezado'));
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->id_cc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->comprax?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->canp,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->cans,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->nivel_surtido,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->imp_sur,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        </tr>
                                        <?php $num=$num+1;
                                        
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>