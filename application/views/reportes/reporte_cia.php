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
<?php foreach($a as $r)
{
$ciax=$r['ciax'];    
?>                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th colspan="4" style="text-align: center"><?php echo $ciax ?></th>
                               </tr>
<?php foreach($r['segundo'] as $r1)
{
$sucx=$r1['sucx'];    
?>  
                               <tr>
                               <th colspan="4" style="text-align: center"><?php echo $sucx ?></th>
                               </tr> 
                                        <tr>
                                        <th>Lin</th>
                                        <th>Linea</th>
                                        <th>Piezas</th>
                                        <th>Importe</th>
                                       </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $num=0;
                                $importe=0;$toti1=0;$totp1=0;$color1='black';
                                foreach ($r1['tercero'] as $r2){
                               $num=$num+1;
                               //$l1 = anchor('reportes/reporte_cia_suc/'.$semana.'/'.$aaa.'/'.$cia.'/'.$r->suc.'/'.$r->nombre,$r->suc.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r2['lin']?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r2['linx']?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r2['piezas'],0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r2['importe'],2)?></td>
                                </tr>
                               <?php 
                               $totp1=$totp1+$r2['piezas'];
                               $toti1=$toti1+$r2['importe'];
                               } ?>
                                <tr>
                                <td colspan="2" style="color:<?php echo $color1?>; text-align: right"><?php echo 'TOTAL '.$sucx?></td>
                                <td style="color:<?php echo $color1?>; text-align: right"><?php echo number_format($totp1,0)?></td>
                                <td style="color:<?php echo $color1?>; text-align: right"><?php echo  number_format($toti1,2)?></td>
                                </tr>
                              <?php 
                              $toti1=0;$totp1=0; }} ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="3" style="color:red; text-align: right">TOTAL</td>
                              
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>