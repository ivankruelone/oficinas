                 <div class="span8">
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
                                        <th>#</th>
                                        <th>A&ntilde;o</th>
                                        <th>Mes</th>
                                        <th>Piezas</th>
                                        <th>Importe</th>
                                        <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
                                $num=0;
                                foreach ($a->result()as $r){
                               $num=$num+1;
                               $l1 = anchor('desplazamientos/s_desplaza_metro_suc_det/'.$r->aaa.'/'.$r->mes.'/'.$r->suc,'Por Sucursal</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                               
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sucx?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->piezas,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->imp,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                </tr>
                               <?php 
$t1=$t1+($r->piezas);
$t2=$t2+($r->imp);

                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="3" style="color:red; text-align: right">TOTAL</td>
                              <td style="color:red; text-align: right"><?php echo number_format($t1,2)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t2,2)?></td>}
                              <td></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>