                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>Proveedores disponibles</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       <?php      
                       echo anchor('maestro/captura_proveedor', 'AGREGAR NUEVO PROVEEDOR', 'class="button-link blue"')
                       ?>
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">CONSULTA PROVEEDOR</th>
                                    </tr>
                                     <tr>
                                        <th>Id Proveedor</th>
                                        <th>Rfc</th>
                                        <th>Razon Social</th>
                                        <th>Limite de Credito</th>
                                        <th>Ver productos</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                                
                               $numero = $s->num_rows();
                               
                               foreach ($s->result()as $r){
                                $consul=$s->num_rows($r);
                                $l1 = anchor('maestro/editar_proveedor/'.$r->idProveedor, $r->idProveedor.'</a>', array('title' => 'Haz Click aqui para Editar!', 'class' => 'encabezado'));
                               
                                
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $l1; ?></td>
                                <td style="text-align: left"><?php echo $r->rfc; ?></td>
                                <td style="text-align: left"><?php echo $r->razonSocial; ?></td>
                                <td style="text-align: right"><?php echo number_format($r->limiteCredito, 2); ?></td>
                                <td style="text-align: center;"><?php echo anchor('maestro/productosByProveedor/'.$r->idProveedor, '<i class="icon-plus-sign-alt"></i>'); ?></td>
                                </tr>
                                <?php 
                                 } 
                                 ?>
                              </tbody>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>