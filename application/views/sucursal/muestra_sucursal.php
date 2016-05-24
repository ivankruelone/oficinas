                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="metro-nav">
                        
                            <div class="metro-nav-block nav-block-orange">
                                <a href="<?php echo site_url('sucursal/muestra_sucursal_excel'); ?>" data-original-title="">
                                    <i class="icon-download"></i>
                                    <div class="info">
                        
                                        <?php //echo number_format($this->pagination->total_rows, 0); ?> Sucursales
                        
                                    </div>
                                    <div class="status">
                        
                                        Descargar en excel
                        
                                    </div>
                                </a>
                            </div>
                        </div>
                     
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>Tipo de Farmacia</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">CONSULTA SUCURSAL POR TIPO DE IMAGEN</th>
                                    </tr>
                                     <tr>
                                        <th>TIPO</th>
                                        <th>NOMBRE</th>
                                        <th>CLASIFICA 80</th>
                                        <th>CLASIFICA 20</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                                
                               
                               $clasificacion80 = 0;
                               $clasificacion20 = 0;
                               
                               foreach ($s->result()as $r){
                               $l1 = anchor('sucursal/farmacia_tipo/'.$r->tipo, $r->nombre.'</a>', array('title' => 'Haz Click aqui ver el detalle!', 'class' => 'encabezado'));
                               
                                
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $r->tipo; ?></td>
                                <td style="text-align: left"><?php echo $l1; ?></td>
                                <td style="text-align: left"><?php echo $r->clasificacion80; ?></td>
                                <td style="text-align: left"><?php echo $r->clasificacion20; ?></td>
                                </tr>
                                <?php 
                               $clasificacion80= $clasificacion80+$r->clasificacion80;
                               $clasificacion20= $clasificacion20+$r->clasificacion20;
                               $total=$clasificacion80+$clasificacion20;
                                 } 
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: right" >TOTALES</td>
                              <td style="text-align: left"><?php echo number_format($clasificacion80, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($clasificacion20, 0)?></td>
                              </tr>
                              <tr>
                              <td colspan="3" style="text-align: right" >TOTAL GENERAL</td>
                              <td style="text-align: left"><?php echo number_format($total, 0)?></td>
                              </tr>
                             </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>