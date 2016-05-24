                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>Farmacias que hacen el 80 % de la venta</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       <?php      
                       //echo anchor('maestro/captura_proveedor', 'AGREGAR NUEVO PROVEEDOR', 'class="button-link blue"')
                       ?>
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">CONSULTA SUCURSAL POR TIPO DE IMAGEN <?php echo $tipo; ?>  <?php echo $nombre; ?></th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Nid</th>
                                        <th>Nombre</th>
                                        <th>Domicilio</th>
                                        <th>Colonia</th>
                                        <th>Cp</th>
                                        <th>Poblacion</th>
                                        <th>Estado</th>
                                        <th>brick</th>
                                        <th>Clasifica</th>
                                        <th>1000+<br />Vendidos</th>
                                        <th>1000+<br />Vendidos</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                                
                               
                               
                               foreach ($s1->result()as $r){
                               $l1 = anchor('sucursal/edita_brick/'.$r->suc, $r->suc.'</a>', array('title' => 'Haz Click aqui para editar brick1300!', 'class' => 'encabezado'));
                               $l2 = anchor('sucursal/mas_vendidos_precio/'.$r->suc, 'PRECIO'.'</a>', array('title' => 'Haz Click aqui para ver los mil productos mas vendidos por precio!', 'class' => 'encabezado'));
                               $l3 = anchor('sucursal/mas_vendidos_pieza/'.$r->suc, 'PIEZA'.'</a>', array('title' => 'Haz Click aqui para ver los mil productos mas vendidos por pieza', 'class' => 'encabezado')); 
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $r->ranking; ?></td>
                                <td style="text-align: left"><?php echo $l1; ?></td>
                                <td style="text-align: left"><?php echo $r->nombre; ?></td>
                                <td style="text-align: left"><?php echo $r->dire; ?></td>
                                <td style="text-align: left"><?php echo $r->col; ?></td>
                                <td style="text-align: left"><?php echo $r->cp; ?></td>
                                <td style="text-align: left"><?php echo $r->pobla; ?></td>
                                <td style="text-align: left"><?php echo $r->estado; ?></td>
                                <td style="text-align: left"><?php echo $r->brick1300; ?></td>
                                <td style="text-align: left"><?php echo $r->clasificacion; ?></td>
                                <td style="text-align: left"><?php echo $l2; ?></td>
                                <td style="text-align: left"><?php echo $l3; ?></td>
                                </tr>
                                <?php 
                                 } 
                                 ?>
                              </tbody>
                         </table>                            
                         </div>
                     </div>
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>Farmacias que hacen el 20 % de la venta</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       <?php      
                       //echo anchor('maestro/captura_proveedor', 'AGREGAR NUEVO PROVEEDOR', 'class="button-link blue"')
                       ?>
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                                    <tr>
                                    <th colspan="10" style="color: blue; text-align: center;">CONSULTA SUCURSAL POR TIPO DE IMAGEN <?php echo $tipo; ?><?php echo $nombre; ?></th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Nid</th>
                                        <th>Nombre</th>
                                        <th>Domicilio</th>
                                        <th>Colonia</th>
                                        <th>Cp</th>
                                        <th>Poblacion</th>
                                        <th>Estado</th>
                                        <th>brick</th>
                                        <th>Clasifica</th>
                                        <th>1000+<br />Vendidos</th>
                                        <th>1000+<br />Vendidos</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                                
                               
                               
                               foreach ($s2->result()as $r){
                               $l1 = anchor('sucursal/edita_brick/'.$r->suc, $r->suc.'</a>', array('title' => 'Haz Click aqui para editar brick1300!', 'class' => 'encabezado'));
                               $l2 = anchor('sucursal/mas_vendidos_precio/'.$r->suc, 'PRECIO'.'</a>', array('title' => 'Haz Click aqui para ver los mil productos mas vendidos por precio!', 'class' => 'encabezado'));
                               $l3 = anchor('sucursal/mas_vendidos_pieza/'.$r->suc, 'PIEZA'.'</a>', array('title' => 'Haz Click aqui para ver los mil productos mas vendidos por pieza', 'class' => 'encabezado')); 
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $r->ranking; ?></td>
                                <td style="text-align: left"><?php echo $l1; ?></td>
                                <td style="text-align: left"><?php echo $r->nombre; ?></td>
                                <td style="text-align: left"><?php echo $r->dire; ?></td>
                                <td style="text-align: left"><?php echo $r->col; ?></td>
                                <td style="text-align: left"><?php echo $r->cp; ?></td>
                                <td style="text-align: left"><?php echo $r->pobla; ?></td>
                                <td style="text-align: left"><?php echo $r->estado; ?></td>
                                <td style="text-align: left"><?php echo $r->brick1300; ?></td>
                                <td style="text-align: left"><?php echo $r->clasificacion; ?></td>
                                <td style="text-align: left"><?php echo $l2; ?></td>
                                <td style="text-align: left"><?php echo $l3; ?></td>
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