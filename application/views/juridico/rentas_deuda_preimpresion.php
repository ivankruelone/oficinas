                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="table-responsive">
                         <table style="
                         border-left-style: groove; 
                         border-right-style: groove; 
                         border-bottom-style: groove; 
                         border-top-style: groove;
                         border-collapse: separate;">
                             <thead>
                                  
                                 <tr style="background-color: blanchedalmond;">
                                 <th style="border-bottom-style: groove; color:blue; text-align: left border-left-style: groove;  border-right-style: groove; font-size: small;">ARRENDADOR</th>
                                 <th style="border-bottom-style: groove; color:blue; text-align: center border-left-style: groove;  border-right-style: groove; font-size: small;">MESES DE PAGO</th>
                                 <th style="border-bottom-style: groove; color:blue; text-align: center border-left-style: groove;  border-right-style: groove; font-size: small;">MESES</th>
                                 <th style="border-bottom-style: groove; color:blue; text-align: right border-left-style: groove;  border-right-style: groove; font-size: small;">RENTA</th>
                                 <th style="border-bottom-style: groove; color:blue; text-align: right border-left-style: groove;  border-right-style: groove; font-size: small;">IVA</th>
                                 <th style="border-bottom-style: groove; color:blue; text-align: right border-left-style: groove;  border-right-style: groove; font-size: small;">RETENSION</th>
                                 <th style="border-bottom-style: groove; color:blue; text-align: right border-left-style: groove;  border-right-style: groove; font-size: small;">IVA RETENIDO</th>
                                 <th style="border-bottom-style: groove; color:blue; text-align: right border-left-style: groove;  border-right-style: groove; font-size: small;">TOTAL MN</th>
                                 <th style="border-bottom-style: groove; color:blue; text-align: right border-left-style: groove;  border-right-style: groove; font-size: small;">TOTAL USD</th>
                                 <th style="border-bottom-style: groove; color:blue; text-align: right border-left-style: groove;  border-right-style: groove; font-size: small;">APLICA_PAGO_GENERADO</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';$conversion=0;$tmn_pre=0;$tusd_pre=0;$obser='';
                                foreach ($q->result()as $r) {
                                $ss="select x.aaa,c.mes as mesx,(case when pago='MN'
then
case
when y.auxi=7004  then imp+(imp*y.iva)
when y.auxi=7003  then imp+(imp*y.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
(case when pago='USD'
then
case
when y.auxi=7004  then imp+(imp*y.iva)
when y.auxi=7003  then imp+(imp*y.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd 
 from juridico.rentas_c x, juridico.rentas_d y, catalogo.mes c where c.num=x.mes and 
                                 x.id_renta=y.id_renta and y.suc=$r->suc and pagado=2";
                                $qq=$this->db->query($ss);
                                foreach ($qq->result()as $rr)
                                {$obser=$obser.$rr->aaa.'-'.$rr->mesx.' '.number_format($rr->totalmn,2).'<br />';}
                                if($r->meses1>0){$meses=$r->meses.'+'.$r->meses1;}else{$meses=$r->meses;}
                                $num=$num+1;

                                ?> 
                                 <tr>
                                   <td style="border-bottom-style: groove; border-left-style: groove;  border-right-style: groove; text-align: left; color: <?php echo $color?>; font-size: small;"><?php echo $r->nom?><br /><?php echo $r->suc.' '.$r->sucx?></td>
                                   <td style="border-bottom-style: groove; border-right-style: groove; text-align: left; color: <?php echo $color?>; font-size: small;"><?php echo $r->mesi.' DEL '.$r->aaai.' - '.$r->mesf.' DEL '.$r->aaaf?></td>
                                   <td style="border-bottom-style: groove; border-right-style: groove; text-align: center; color: <?php echo $color?>; font-size: small;"><?php echo $meses?></td>
                                   <td style="border-bottom-style: groove; border-right-style: groove; text-align: right; color: <?php echo $color?>; font-size: small;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="border-bottom-style: groove; border-right-style: groove; text-align: right; color: <?php echo $color?>; font-size: small;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="border-bottom-style: groove; border-right-style: groove; text-align: right; color: <?php echo $color?>; font-size: small;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="border-bottom-style: groove; border-right-style: groove; text-align: right; color: <?php echo $color?>; font-size: small;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="border-bottom-style: groove; border-right-style: groove; text-align: right; color: <?php echo $color?>; font-size: small;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="border-bottom-style: groove; border-right-style: groove; text-align: right; color: <?php echo $color?>; font-size: small;"><?php echo number_format($r->totalusd,2)?></td>
                                   <td style="border-bottom-style: groove; border-right-style: groove; text-align: right; color: <?php echo $color?>; font-size: small;"><?php echo $obser?></td>
                                    
                                   </tr>
                                   <tr>
                                   <td colspan="9"></td>
                                   </tr>
                               <?php $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;$obser='';
                                    } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="7" style="text-align: right;"><strong>TOTAL</strong></td>
                              <td style="text-align: right; color: <?php echo $color?>;"><strong><?php echo number_format($tmn,2)?></strong></td>
                              <td style="text-align: right; color: <?php echo $color?>;"><strong><?php echo number_format($tusd,2)?></strong></td>
                              </tr> 
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                     
                 </div>