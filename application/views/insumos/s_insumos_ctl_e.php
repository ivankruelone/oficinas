<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1 ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                                 <tr> 
                                     <th>Id</th>
                                     <th>Folio</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Fecha</th>
                                     <th>Piezas Ped</th>
                                     <th>Piezas Sur</th>
                                     <th>Dif</th>
                                     <th>Nivel Surtido</th>
                                     <th></th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0;$dif=0;
                                     foreach ($q1->result() as $r1) {
  $l1 = anchor('insumos/s_insumos_det_f/'.$r1->id_cc.'/'.$r1->suc,'Detalle</a>', array('title' => 'Haz Click aqui para Ver Detalle!', 'class' => 'encabezado'));
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->id_cc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->sucx?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->fecha?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->ped,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->sur,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->ped-$r1->sur,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->nivel_sur,0)?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        </tr>
                                        <?php $num=$num+1;
                                        $dif=$dif+($r1->ped-$r1->sur);
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="7"></td>
                             <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($dif,0)?></td>
                             <td></td>
                             <td></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
 <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2 ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">

                             <thead>
                                
                                 <tr> 
                                     <th>Id</th>
                                     <th>Folio</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Fecha</th>
                                     <th>Piezas Ped</th>
                                     <th>Piezas Sur</th>
                                     <th>Dif</th>
                                     <th>Nivel Surtido</th>
                                     <th></th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0;$dif=0;
                                     foreach ($q2->result() as $r2) {
  $l1 = anchor('insumos/s_insumos_det_e/'.$r2->id_cc.'/'.$r2->suc,'Detalle</a>', array('title' => 'Haz Click aqui para Ver Detalle!', 'class' => 'encabezado'));
                                          
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->id_cc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->sucx?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->ped,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->sur,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->ped-$r2->sur,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->nivel_sur,0)?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        </tr>
                                        <?php $num=$num+1;
                                        $dif=$dif+($r2->ped-$r2->sur);
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="7"></td>
                             <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($dif,0)?></td>
                             <td></td>
                             <td></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->                    
                 </div>