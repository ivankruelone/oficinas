                    <div class="span12">
                    
                        <div class="metro-nav">
                        
                            <div class="metro-nav-block nav-block-orange">
                                <a href="<?php echo site_url('auxiliar/muestra_gobierno_excel'); ?>" data-original-title="">
                                    <i class="icon-download"></i>
                                    <div class="info">
                        
                                        <?php echo number_format($this->pagination->total_rows, 0); ?> registros
                        
                                    </div>
                                    <div class="status">
                        
                                        Descargar en excel
                        
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="widget green">
                        
                            <div class="widget-title">
                                <h4>Busqueda de claves de Gobierno</h4>
                                   <span class="tools">
                                       <a href="javascript:;" class="icon-chevron-down"></a>
                                   </span>
                            </div>
                            
                            <div class="widget-body">
                                <form action="search_result.html">
                                    <div class="input-append search-input-area">

                                        <input id="claveBusca" class="" type="text" placeholder="Clave" />
                                        <button class="btn" type="button">
                                            <i class="icon-search"></i>
                                        </button>

                                        <input id="sustanciaBusca" class="" type="text" placeholder="Sustancia Activa" />
                                        <button class="btn" type="button">
                                            <i class="icon-search"></i>
                                        </button>
                                    </div>
                                </form>
                                
                                <div id="resultado">
                                
                                </div>
                            </div>
                        
                        </div>

                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>Catalogo de claves de Gobierno</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <?php 
                         
                         echo $this->pagination->create_links();
                     
                         ?>
                         <p style="text-align: right;">
                         <?php echo anchor('auxiliar/captura_gobierno', 'AGREGAR CLAVE GOBIERNO', 'class="button-link blue"')?>
                         </p>   
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                            <caption>Registros: <?php echo $this->pagination->total_rows; ?></caption>
                             <thead>
                                     <tr>
                                        <th>Clave</th>
                                        <th>Nombre Generico</th>
                                        <th>Forma Farmaceutica</th>
                                        <th>Concentracion</th>
                                        <th>Presentacion</th>
                                        <th>Unidad de Medida</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               
                               foreach ($s->result()as $r){

                                $l1 = anchor('auxiliar/editar_gobierno/'.$r->clave, $r->clave.'</a>', array('title' => 'Haz Click aqui para Editar!', 'class' => 'encabezado'));
                               
                                
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $l1?></td>
                                <td style="text-align: left"><?php echo $r->nombreGenerico?></td>
                                <td style="text-align: left"><?php echo $r->formaFarmaceutica?></td>
                                <td style="text-align: left"><?php echo $r->concentracion?></td>
                                <td style="text-align: left"><?php echo $r->presentacion?></td>
                                <td style="text-align: left"><?php echo $r->unidadMedida?></td>
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