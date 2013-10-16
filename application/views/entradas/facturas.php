                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: right">Imagen</th>
                                     <th style="text-align: right">Imp.Almacen</th>
                                     <th style="text-align: right">Imp.Sucursal</th>
                                     <th style="text-align: right">Diferencia</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $imp_suc=0;$imp_prv=0;
                                $timp_suc=0;$timp_prv=0;
                                $num1=0;$num2=0;$num3=0;$num4=0;$num5=0;$num6=0;
                                $num7=0;$num8=0;$num9=0;$num10=0;$num11=0;$num12=0;
                                foreach($a->result() as $r){
                                $timp_suc=$timp_suc+$r->importe_suco;
                                $timp_prv=$timp_prv+$r->importe_prvo;
                                $l0 = anchor('entradas/facturas_suc/'.$r->mes.'/'.$r->tipo2,str_pad($r->mes,2,'0',STR_PAD_LEFT).' '.$r->tipox.'</a>', array('title' => 'Haz Click aqui para ver sucursales!', 'class' => 'encabezado'));
                                if($r->mes==1){$num1=$num1+1;}if($r->mes==2){$num2=$num2+1;$num1=0;}
                                if($r->mes==3){$num3=$num3+1;$num2=0;}if($r->mes==4){$num4=$num4+1;$num3=0;}
                                if($r->mes==5){$num5=$num5+1;$num4=0;}if($r->mes==6){$num6=$num6+1;$num5=0;}
                                if($r->mes==7){$num7=$num7+1;$num6=0;}if($r->mes==8){$num8=$num8+1;$num7=0;}
                                if($r->mes==9){$num9=$num9+1;$num8=0;}if($r->mes==10){$num10=$num10+1;$num9=0;}
                                if($r->mes==11){$num11=$num11+1;$num10=0;}if($r->mes==12){$num12=$num12+1;$num11=0;}
                                
                                if($num1==1 || $num2==1 || $num3==1 || $num4==1 || $num5==1 || $num6==1||$num7==1 
                                || $num8==1 || $num9==1 || $num10==1 || $num11==1 || $num12==1){?> 
                                <tr>
                                <td colspan="4" style="color: maroon; text-align: left"><?php echo $r->mesx?></td>
                                </tr>
                                <?php }?>
                                <tr>
                                <td style="color: gray; text-align: left"><?php echo $l0?></td>
                                <td style="color: gray; text-align: right"><?php echo number_format($r->importe_prvo,2)?></td>
                                <td style="color: gray; text-align: right"><?php echo number_format($r->importe_suco,2)?></td>
                                <td style="color: gray; text-align: right"><?php echo number_format($r->importe_suco-$r->importe_prvo,2)?></td>
                                </tr>
                               
                                <?php } ?>
                              </tbody>
                              <tfoot>
                              <tr>
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