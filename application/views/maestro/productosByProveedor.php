                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->

                        <div class="widget green">
                        
                            <div class="widget-title">
                                <h4>Busqueda de productos por proveedor: <span id="idProveedor"><?php echo $idProveedor; ?></span></h4>
                                   <span class="tools">
                                       <a href="javascript:;" class="icon-chevron-down"></a>
                                   </span>
                            </div>
                            
                            <div class="widget-body">
                                <form action="search_result.html">
                                    <div class="input-append search-input-area">

                                        <input id="idProductoBusca" class="" type="text" placeholder="ID Producto" />
                                        <button class="btn" type="button">
                                            <i class="icon-search"></i>
                                        </button>

                                        <input id="EANBusca" class="" type="text" placeholder="EAN" />
                                        <button class="btn" type="button">
                                            <i class="icon-search"></i>
                                        </button>

                                        <input id="descripcionBusca" class="" type="text" placeholder="Sustancia Activa o descripcion" />
                                        <button class="btn" type="button">
                                            <i class="icon-search"></i>
                                        </button>

                                        <input id="secuenciaBusca" class="" type="text" placeholder="Secuencia" />
                                        <button class="btn" type="button">
                                            <i class="icon-search"></i>
                                        </button>

                                        <input id="claveBusca" class="" type="text" placeholder="Clave de gobierno" />
                                        <button class="btn" type="button">
                                            <i class="icon-search"></i>
                                        </button>

                                    </div>
                                </form>
                                
                                <div id="resultado">
                                
                                </div>
                            </div>
                        
                        </div>

                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>Productos por proveedor: <?php echo $idProveedor; ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         <?php 
                         
                         echo $this->pagination->create_links();
                     
                         ?>
                         <p style="text-align: right;">
                         <?php echo anchor('maestro/captura_producto', 'AGREGAR NUEVO PRODUCTO', 'class="button-link blue"')?>
                         </p>
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                            <caption>Registros: <?php echo $this->pagination->total_rows; ?></caption>
                             <thead>
                                     <tr>
                                        <th>Id Producto</th>
                                        <th>Ean</th>
                                        <th>Descripcion</th>
                                        <th>Sustancia</th>
                                        <th>Laboratorio</th>
                                        <th>Secuencia</th>
                                        <th>Clave de Gobierno</th>
                                        <th>Linea</th>
                                        <th>Sublinea</th>
                                        <th>Max. Publico</th>
                                        <th>Proveedor</th>
                                        <th>Max. Publico Prv.</th>
                                        <th>Precio Farmacia</th>
                                        <th>Costo Privado</th>
                                        <th>Costo Gobierno</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                               
                               foreach ($query->result()as $r){

                                $l1 = anchor('maestro/editar_producto/'.$r->idProducto, $r->idProducto.'</a>', array('title' => 'Haz Click aqui para Editar!', 'class' => 'encabezado'));
                                    
                                
                               ?>
        
                                <tr>
                                <td style="text-align: right"><?php echo $l1; ?></td>
                                <td style="text-align: right"><?php echo $r->ean; ?></td>
                                <td style="text-align: left"><?php echo $r->descripcion; ?></td>
                                <td style="text-align: left"><?php echo $r->sustancia; ?></td>
                                <td style="text-align: left"><?php echo $r->laboratorioProvisional; ?></td>
                                <td style="text-align: right"><?php echo $r->secuencia; ?></td>
                                <td style="text-align: left"><?php echo $r->clave; ?></td>
                                <td style="text-align: left"><?php echo $r->linea; ?></td>
                                <td style="text-align: left"><?php echo $r->sublinea; ?></td>
                                <td style="text-align: right"><?php echo number_format($r->precioMaximoPublico, 2); ?></td>
                                <td style="text-align: left"><?php echo $r->razonSocial; ?></td>
                                <td style="text-align: right"><?php echo number_format($r->precioMaximoPublicoProveedor, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($r->precioFarmacia, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($r->costoPrivado, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($r->costoGobierno, 2); ?></td>
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