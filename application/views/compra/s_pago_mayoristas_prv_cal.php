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
                                     <th colspan="1"style="text-align: center;">Vencimiento</th>
                                     <th colspan="1" style="text-align: center;">Prv.Marzam</th>
                                     <th colspan="1" style="text-align: center;">N.Cre.Mar</th>
                                     <th colspan="1" style="text-align: center;">Cxp.Marzam</th>
                                     <th colspan="1" style="text-align: center;">Prv.Fanasa</th>
                                     <th colspan="1" style="text-align: center;">N.Cre.Fan</th>
                                     <th colspan="1" style="text-align: center;">Cxp.Fanasa</th>
                                     <th colspan="1" style="text-align: center;">Prv.Nadro</th>
                                     <th colspan="1" style="text-align: center;">N.Cre.Nad</th>
                                     <th colspan="1" style="text-align: center;">Cxp.Nadro</th>
                                     <th colspan="1" style="text-align: center;">Prv.Saba</th>
                                     <th colspan="1" style="text-align: center;">N.Cre.Sab</th>
                                     <th colspan="1" style="text-align: center;">Cxp.Saba</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php $color1='gray'; $color2='orange'; $color='blue';$num=1;
                                $mar_prv=0;$far_prv=0;$mar_cxp=0;$far_cxp=0;
                                $sab_prv=0;$nad_prv=0;$sab_cxp=0;$nad_cxp=0;
                                $tmar_prv=0;$tfar_prv=0;$tmar_cxp=0;$tfar_cxp=0;
                                $tsab_prv=0;$tnad_prv=0;$tsab_cxp=0;$tnad_cxp=0;                                                                    
                                     foreach ($a as $r) {
                                     
                             $l1 = anchor('compra/s_pago_mayoristas_prv_ven_cal/'.$r['fecven'],$r['fecven'].'</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));  

                                 foreach ($r['segundo'] as $r2) {
                                if($r2['prv']==500){$mar_prv=$r2['imp_prv'];}
                                if($r2['prv']==500){$mar_cxp=$r2['imp_cxp'];}
                                if($r2['prv']==825){$far_prv=$r2['imp_prv'];}
                                if($r2['prv']==825){$far_cxp=$r2['imp_cxp'];}
                                if($r2['prv']==221){$nad_prv=$r2['imp_prv'];}
                                if($r2['prv']==221){$nad_cxp=$r2['imp_cxp'];}
                                if($r2['prv']==400){$sab_prv=$r2['imp_prv'];}
                                if($r2['prv']==400){$sab_cxp=$r2['imp_cxp'];}
                                }?>                                        
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($mar_prv,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color2 ?>"><?php echo number_format($mar_prv-$mar_cxp,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($mar_cxp,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($far_prv,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color2 ?>"><?php echo number_format($far_prv-$far_cxp,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($far_cxp,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($nad_prv,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color2 ?>"><?php echo number_format($nad_prv-$nad_cxp,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($nad_cxp,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($sab_prv,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color2 ?>"><?php echo number_format($sab_prv-$sab_cxp,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($sab_cxp,2)?></td>
                                                
                                        </tr>
                                        <?php 
                                        $tmar_prv=$tmar_prv+$mar_prv;
                                        $tfar_prv=$tfar_prv+$far_prv;
                                        $tsab_prv=$tsab_prv+$sab_prv;
                                        $tnad_prv=$tnad_prv+$nad_prv;
                                        $tmar_cxp=$tmar_cxp+$mar_cxp;
                                        $tfar_cxp=$tfar_cxp+$far_cxp;
                                        $tsab_cxp=$tsab_cxp+$sab_cxp;
                                        $tnad_cxp=$tnad_cxp+$nad_cxp;
                                        
                                        $mar_prv=0;$far_prv=0;$mar_cxp=0;$far_cxp=0;
                                        $sab_prv=0;$nad_prv=0;$sab_cxp=0;$nad_cxp=0; //$num=$num+1; $tot=$tot+$r2->imp_prv;
                                        }?>
                                       
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td></td>
                             <td style="text-align: right; color: <?php echo $color1 ?>"><strong><?php echo number_format($tmar_prv,2)?></strong></td>
                             <td style="text-align: right; color: <?php echo $color2 ?>"><strong><?php echo number_format($tmar_prv-$tmar_cxp,2)?></strong></td>
                             <td style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tmar_cxp,2)?></strong></td>
                             <td style="text-align: right; color: <?php echo $color1 ?>"><strong><?php echo number_format($tfar_prv,2)?></strong></td>
                             <td style="text-align: right; color: <?php echo $color2 ?>"><strong><?php echo number_format($tfar_prv-$tfar_cxp,2)?></strong></td>
                             <td style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tfar_cxp,2)?></strong></td>
                             <td style="text-align: right; color: <?php echo $color1 ?>"><strong><?php echo number_format($tnad_prv,2)?></strong></td>
                             <td style="text-align: right; color: <?php echo $color2 ?>"><strong><?php echo number_format($tnad_prv-$tnad_cxp,2)?></strong></td>
                             <td style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tnad_cxp,2)?></strong></td>
                             <td style="text-align: right; color: <?php echo $color1 ?>"><strong><?php echo number_format($tsab_prv,2)?></strong></td>
                             <td style="text-align: right; color: <?php echo $color2 ?>"><strong><?php echo number_format($tsab_prv-$tsab_cxp,2)?></strong></td>
                             <td style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tsab_cxp,2)?></strong></td>
                             
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>