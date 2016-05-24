<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Clave</th>
                                     <th>Codigo</th>
                                     <th>Descripcion</th>
                                     <th>Cant.</th>
                                     <th>CantSin<br />Cargo</th>
                                     <th>Costo</th>
                                     <th>Descuento</th>
                                     <th>Importe</th>
                                     <th>Imp.Des</th>
                                     <th>Imp.Ieps</th>
                                     <th>Imp.Iva</th>
                                     <th>Total</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=1;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $l1=anchor('orden/a_orden_segpop_det_bor/'.$r->id_orden.'/'.$r->prv.'/'.$r->id_detalle,'Borrar');
                                
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; "><?php echo $r->clagob?></td>
                                        <td style="text-align: right; "><?php echo $r->codigo?></td>
                                        <td style="text-align: left; "><?php echo $r->susa1.'<br />'.$r->susa2?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->canp,0)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->canr,0)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->costo,0)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->descuento,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp_descu,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp_ieps,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp_iva,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->total,2)?></td>
                                        <td><?php echo $l1?></td>
                                        </tr>
                                        <?php 
                                        $num=$num+1;
                                        $tu1=$tu1+$r->canp;
                                        $tu2=$tu2+$r->canr;
                                        $tu3=$tu3+$r->total;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4"></td>
                             <td style="text-align: right; "><?php echo number_format($tu1,0)?></td>
                             <td style="text-align: right; "><?php echo number_format($tu2,0)?></td>
                             <td colspan="6"></td>
                             <td style="text-align: right; "><?php echo number_format($tu3,2)?></td>
                             <td></td>
                             </tr>
                             </tfoot>
                         </table>