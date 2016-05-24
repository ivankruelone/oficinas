                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                              <thead>
                                 <tr>
                                 <th colspan="1"style="text-align: left">_</th>
                                 <th colspan="1"style="text-align: left">_</th>
                                 <th colspan="3"style="text-align: center">MAYORISTAS</th>
                                 <th colspan="2"style="text-align: left"></th>
                                 <th colspan="3"style="text-align: left">POLITICAS</th>
                                 <th colspan="3"style="text-align: left">OFERTA CANDADO</th>
                                 </tr>
                                 <tr>
                                 <th colspan="1" style="text-align: left">Farmacia</th>
                                 <th colspan="1" style="text-align: left"></th>
                                 <th style="text-align: left">Fanasa</th>
                                 <th style="text-align: left">Saba</th>
                                 <th style="text-align: left">Nadro</th>
                                 <th style="text-align: left">Descripcion</th>
                                 <th style="text-align: left">Publico</th>
                                 <th style="color: blue; text-align: left">%Descu</th>
                                 <th style="color: blue; text-align: left">Venta</th>
                                 <th style="color: blue; text-align: left">% Util.</th>
                                 <th style="color: green; text-align: left">%Descu</th>
                                 <th style="color: green; text-align: left">Venta</th>
                                 <th style="color: green; text-align: left">% Util.</th>
                                </tr>
                             </thead>
                             <tbody>
                              <?php
                                 $num=0;$timp=0;$tcan=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                               ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo number_format($r->farmacia,2)?></td>                                  
                                   <td style="text-align: left;">
                                   <table>
                                   <tr style="text-align: right;"><td>%.FINA</td></tr>
                                   <tr style="text-align: right;"><td>%.OFER</td></tr>
                                   <tr style="text-align: right;"><td>%.CAND</td></tr>
                                   <tr style="text-align: right;"><td>%.VOL</td></tr>
                                   <tr style="text-align: right;"><td>$.COST</td></tr>
                                   </table>
                                   </td>
                                   <td style="text-align: left;">
                                   <table>
                                   <tr><td style="text-align: right;"><?php echo number_format($r->fin_fanasa,2)?></td></tr>
                                   <tr><td style="text-align: right;"><?php echo number_format($r->ofe_fanasa,2)?></td></tr>
                                   <tr><td style="text-align: right;"><?php echo number_format($r->fanasa_candado,2)?></td></tr>
                                   <tr><td style="text-align: right;"><?php echo ' 3.00'?></td></tr>
                                   <tr><td style="text-align: right;"><?php echo number_format($r->cosf_final,2)?></td></tr>
                                   </table>
                                   </td>
                                   <td style="text-align: right;">
                                   <table>
                                   <tr><td style="text-align: right;"><?php echo number_format($r->fin_saba,2)?></td></tr>
                                   <tr><td style="text-align: right;"><?php echo number_format($r->ofe_saba,2)?></td></tr>
                                   <tr><td style="text-align: right;"><?php echo number_format($r->saba_candado,2)?></td></tr>
                                   <tr><td style="text-align: right;"><?php echo ' 4.00'?></td></tr>
                                   <tr><td style="text-align: right;"><?php echo number_format($r->coss_final,2)?></td></tr>
                                   </table>
                                   </td>
                                   <td style="text-align: right;">
                                   <table>
                                   <tr><td>_</td></tr>
                                   <tr><td>_</td></tr>
                                   <tr><td>_</td></tr>
                                   <tr><td>_</td></tr>
                                   <tr><td style="text-align: right;"><?php echo number_format($r->cos_nadro,2)?></td></tr>
                                   </table>
                                   </td>
                                   <td style="text-align: right;">
                                   <table>
                                   <tr><td><?php echo $r->cod_barras ?></td></tr>
                                   <tr><td><?php echo $r->descripcion ?></td></tr>
                                   <tr><td>Compra direccionada para <?php echo $r->surte ?></td></tr>
                                   <tr><td style="text-align: right;">Costo promedio sin candado <?php echo number_format($r->ult_costo,2) ?></td></tr>
                                   <tr><td style="text-align: right;">Costo asignado <?php echo number_format($r->cos_oferta,2) ?></td></tr>
                                   </table>
                                   </td>
                                   <td style="text-align: left;"><?php echo number_format($r->pub,2)?></td>
                                   <td style="color: blue; text-align: left;"><?php echo '%'.number_format($r->descu,2)?></td>
                                   <td style="color: blue; text-align: left;"><?php echo number_format($r->venta,2)?></td>
                                   <td style="color: blue; text-align: left;"><?php echo '%'.number_format($r->util_real,2)?></td>
                                   <td style="color: green; text-align: left;"><?php echo '%'.number_format($r->descu_candado,2)?></td>
                                   <td style="color: green; text-align: left;"><?php echo number_format($r->venta_candado,2)?></td>
                                   <td style="color: green; text-align: left;"><?php echo '%'.number_format($r->por_utilidad_oferta,2)?></td>
                                  </tr>
                               <?php } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: left;"><?php echo 'TOTAL '.number_format($num,0)?></td>
                              </tr>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>