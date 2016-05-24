                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">P&L SUCURSAL A&ntilde;o <?php echo $aaa ?> Mes <?php echo getMesNombre($mes)?></th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Sucursal</th>
                                        <th>Observaci&oacute;n</th>
                                        <th>Importe</th>
                                        <th>Input</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $num=0;
                               
                               $importe = 0;
                               $input = 0;
                               $observaciones = null;
                               
                               foreach ($s->result()as $r){
                                $num=$num+1;
                                $l1 = anchor('pl/captura_ventas_pl/'.$r->suc.'/'.$mes.'/'.$aaa, $r->suc.' '.$r->nombre.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));
                                
                               ?>
                               
                                <tr>
                                <td style="text-align: center;"><?php echo $num?></td>
                                <td style="text-align: center"><?php echo $l1?></td>
                                <td style="text-align: left"><?php echo $observaciones ?></td>
                                <td style="text-align: left"><?php echo number_format($r->importe, 2)?></td>
                                <td style="text-align: left"><?php echo number_format($r->input, 2)?></td>
                                </tr>
                               <?php 
                               
                               
                               
                               $importe= $importe+$r->importe;
                               $input= $input+$r->input;
                               
                              
                                 } 
                                 
                              
                               
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="3" style="text-align: right" >TOTALES</td>
                              <td style="text-align: left"><?php echo number_format($importe, 2)?></td>
                              <td style="text-align: left"><?php echo number_format($input, 2)?></td>
                              </tr>
                             </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>