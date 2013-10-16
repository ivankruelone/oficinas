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
                                 <th style="text-align: right">Nid</th>
                                 <th style="text-align: left">Sucursal</th>
                                 <th style="text-align: center">Dia</th>
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
                                foreach ($a as $r0) {
                                ?> 
                                
                                <?php
                                foreach ($r0['m'] as $r) {
                                
                                foreach ($r['segundo']as $r1) {
                                if($r0['f1']==$r0['mes'] and $r1['superv']==$r0['f2']){
                                foreach ($r1['tercero']as $r2) {
                                $imp_suc=$imp_suc+$r2['importe_suco'];
                                $imp_prv=$imp_prv+$r2['importe_prvo'];
                                $timp_suc=$timp_suc+$r2['importe_suco'];
                                $timp_prv=$timp_prv+$r2['importe_prvo'];
                                $ttimp_suc=$ttimp_suc+$r2['importe_suco'];
                                $ttimp_prv=$ttimp_prv+$r2['importe_prvo'];
                                
                                $num=$num+1;
                                $l0 = anchor('entradas/facturas_suc_fac/'.$r0['fa'].'/'.$r0['mes'].'/'.$r2['suc'],$r2['sucx'].'</a>', array('title' => 'Haz Click aqui para ver sucursales!', 'class' => 'encabezado'));
                                ?> 
                                    <tr>
                                    <td style="text-align: right;"><?php echo $r2['suc']?></td>
                                    <td><?php echo $l0?></td>
                                    <td style="text-align: center;"><?php echo $r2['dia']?></td>
                                    <td style="text-align: right;"><?php echo number_format($imp_prv,2)?></td>
                                    <td style="text-align: right;"><?php echo number_format($imp_suc,2)?></td>
                                    <td style="text-align: right;"><?php echo number_format($imp_suc-$imp_prv,2)?></td>
                                 </tr>   
                                 <?php
                                 $imp_suc=0;$imp_prv=0;
                                }}}}}?>
                                
                                 
                              </tbody>
                              <tfoot>
                              <tr>
                              <td></td>
                              <td></td>
                                    <td style="color: maroon;text-align: right;">TOTAL </td>                                  
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($ttimp_prv,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($ttimp_suc,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($ttimp_suc-$ttimp_prv,2)?></td>
                                  </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>