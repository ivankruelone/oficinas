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
                                     <th>#</th>
                                     <th>ID_ped</th>
                                     <th>Captura</th>
                                     <th>Sec</th>
                                     <th>Clave</th>
                                     <th>Sustancia Activa</th>
                                     <th>Costo base</th>
                                     <th>Prv base</th>
                                     <th>Importe base</th>
                                     <th>Piezas</th>
                                     <th>regalo</th>
                                     <th>Costo</th>
                                     <th>Importe</th>
                                     <th>Descuento</th>
                                     <th>Total</th>
                                     <th>Prv</th>
                                     <th>Provedor</th>
                                     
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;
                                $num=0;$tbase=0;$ttot=0;
                                $color1='blue';$color='black';
                                foreach ($q as $r) {
                                
                                $num=$num+1;
                                if($r['descu']>0){
                                    $descu=($r['costo']*$r['ped'])-(($r['costo']*$r['ped'])*($r['descu']/100));
                                    }else{
                                    $descu=($r['costo']*$r['ped']);}
                                $tot=0; $n=0; 
                                $l0 = anchor('pedido/com_pedido_det_auto/'.$r['id'],'<img src="'.base_url().'img/good.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
                                      ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?> "><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?> "><?php echo $r['id_cc']?></td>
                                        <td style="text-align: left; color: <?php echo $color ?> "><?php echo $r['id_userx'].' '.$r['fecc']?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>;"><?php echo $r['sec'].' '.$l0?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r['clagob']?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r['susa']?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($r['costobase'],2)?></td>
                                        <td style="text-align: left;  color: <?php echo $color1 ?>"><?php echo $r['prvbasex']?></td>
                                        <td style="text-align: left;  color: <?php echo $color1 ?>"><?php echo number_format($r['costobase']*$r['ped'],2)?></td>
                                        <td style="text-align: right; color: green"><?php echo $r['ped']?></td>
                                        <td style="text-align: right; color: green"><?php echo $r['regalo']?></td>
                                        <td style="text-align: right; color: <?php echo $color ?> "><?php echo number_format($r['costo'],2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?> "><?php echo number_format($r['costo']*$r['ped'],2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?> "><?php echo number_format(($r['costo']*$r['ped'])-$descu,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?> "><?php echo number_format($descu,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?> "><?php echo $r['prv']?></td>
                                        <td style="text-align: left; color: <?php echo $color ?> "><?php echo $r['prvx']?></td>
                                         </tr>
                                          <?php foreach ($r['uno'] as $r1){ ?>
                                        <tr>
                                        <td  style="text-align: right;" colspan="3"><?php echo number_format($r1['costo_alterno'],2)?></td>
                                        <td><?php echo $r1['prv_alterno']?></td>
                                        <td colspan="13"><?php echo $r1['prvx_alterno']?></td>
                                        </tr>
                                        <?php 
                                         }//$r1[''] 
                                        $tcan=$tcan+$r['ped'];
                                        $timp=$timp+$r['ped']*$r['costo'];
                                        $tbase=$tbase+$r['ped']*$r['costobase'];
                                        $ttot=$ttot+$descu;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="6"></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($tbase,2)?></strong></td>
                             <td></td>
                             <td></td>
                             <td></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($tcan,0)?></strong></td>
                             <td></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($timp,2)?></strong></td>
                             <td></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($ttot,2)?></strong></td>
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