                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: right">#</th>
                                 <th style="text-align: right">Nid</th>
                                 <th style="text-align: right">Sucursal</th>
                                 <th style="text-align: right">Imp.Almacen</th>
                                 <th style="text-align: right">Imp.Sucursal</th>
                                 <th style="text-align: right">Diferencia</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                $imp_suc=0;$imp_prv=0;
                                $timp_suc=0;$timp_prv=0;
                                $ttimp_suc=0;$ttimp_prv=0;
                                $imp_suc=0;$imp_prv=0;
                                $timp_suc=0;$timp_prv=0;
                                $num1=0;$num2=0;$num3=0;$num4=0;$num5=0;$num6=0;
                                $num7=0;$num8=0;$num9=0;$num10=0;$num11=0;$num12=0;
                                foreach($a->result() as $r){
                                $timp_suc=$timp_suc+$r->importe_suco;
                                $timp_prv=$timp_prv+$r->importe_prvo;    
                                if((($r->importe_suco)-($r->importe_prvo))<0){$color='red';}else{$color='gray';}
                                $num=$num+1;
                                $l0 = anchor('entradas/facturas_suc_fac/0/'.$r->mes.'/'.$r->suc,$r->suc.'</a>', array('title' => 'Haz Click aqui para ver sucursales!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color: gray; text-align: left"><?php echo $num?></td>
                                <td style="color: gray; text-align: left"><?php echo $l0?></td>
                                <td style="color: gray; text-align: left"><?php echo $r->sucx?></td>
                                <td style="color: gray; text-align: right"><?php echo number_format($r->importe_prvo,2)?></td>
                                <td style="color: gray; text-align: right"><?php echo number_format($r->importe_suco,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format(($r->importe_suco)-($r->importe_prvo),2)?></td>
                                </tr>
                               
                                <?php } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="color: maroon;text-align: right;">TOTAL ANUAL</td>                                  
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($timp_prv,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($timp_suc,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($timp_suc-$timp_prv,2)?></td>
                                  </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>