                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             
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
                                        <th>Producto</th>
                                        <th>Accesorio</th>
                                        <th>Cantidad</th>
                                
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $num=0;
                                $cantidad=0;
                                foreach ($a->result()as $r){
                               $num=$num+1;
                               //$l1 = anchor('reportes/reporte_cia/'.$semana.'/'.$aaa.'/'.$r->cia.'/'.$r->razon,$r->cia.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->aaa?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->mes?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->nombre?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->accesorio?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->total?></td>
                                </tr>
                               <?php 
                                
                                $cantidad= $cantidad+($r->total);
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="5" style="color:red; text-align: right">TOTAL</td>
                              <td style="color:red; text-align: right"><?php echo $cantidad?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>