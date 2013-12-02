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
                                        <th>#</th>
                                        <th>Linea</th>
                                        <th>Nombre</th>
                                        <th>Suc. Contable</th>
                                        <th>Importe</th>
                                
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $num=0;
                                $importe=0;
                                foreach ($a->result()as $r){
                               $num=$num+1;
                               //$l1 = anchor('reportes/reporte_cia_suc/'.$semana.'/'.$aaa.'/'.$cia.'/'.$r->suc.'/'.$r->nombre,$r->suc.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->lin?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->linx?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->succ?></td>
                                <td style="color:<?php echo $color?>; text-align: right">$<?php echo number_format($r->importe, 2)?></td>
                                </tr>
                               <?php 
                                
                                $importe= $importe+($r->importe);
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="4" style="color:red; text-align: right">TOTAL</td>
                              <td style="color:red; text-align: right">$<?php echo number_format($importe,2)?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>