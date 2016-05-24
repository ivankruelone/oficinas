<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                                 <tr> 
                                     <th style="text-align: center;">NID</th>
                                     <th style="text-align: center;">Suc</th>
                                     <th style="text-align: center;">Fecha</th>
                                     
                                     <th style="text-align: center;">Productos<br />Solicitadas</th>
                                     <th style="text-align: center;">Productos<br />Facturados</th>
                                     
                                     <th style="text-align: center;">Piezas<br />Solicitadas</th>
                                     <th style="text-align: center;">Piezas<br />Facturados</th>
                                     
                                     <th style="text-align: center;">Importe<br />Solicitado</th>
                                     <th style="text-align: center;">Importe<br />Facturado</th>
                                    
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$tot8=0;
                                     foreach ($q->result() as $r) {
                                   // $l1 = anchor('compra/a_pedido_fanasa_suc/'.$r->suc,$r->suc, array('title' => 'Haz Click aqui para ver desgloze por sucursal!', 'class' => 'encabezado'));
                                        
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->nombre?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->fecha?></td>
                                        
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->pro_ped,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->pro_fac,0)?></td>
                                        
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->pza_ped,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->pza_sur,0)?></td>
                                        
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->imp_ped,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->imp_fac,2)?></td>
                                       
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r->pro_ped;
                                        $tot2=$tot2+$r->pro_fac;
                                        $tot4=$tot4+$r->pza_ped;
                                        $tot5=$tot5+$r->pza_sur;
                                        $tot7=$tot7+$r->imp_ped;
                                        $tot8=$tot8+$r->imp_fac;
                                        
                                        }
                                        $tot3=(($tot2/$tot1)*100);
                                        $tot6=(($tot5/$tot4)*100);
                                        ?>
                                        
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="3">TOTAL</td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,0)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,0)?></strong></td>
                             
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,0)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,0)?></strong></td>
                             
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot7,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot8,2)?></strong></td>
                             <td></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
<!--------------
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>