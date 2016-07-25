                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> <?php echo $titulo; ?> </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <div>
                         <table border="2">
                         <tr>
                         <th style="font-size: x-large;"><?php echo 'Ejemplo de como trabajar el archivo en excel'?></th>
                         </tr>
                         
                         <tr>
                         <td><?php echo 'Dema ||   Codigo ||Descripcion               ||     Sustancia Activa||     Precio Publico     ||     Precio costo'?></td>
                         </tr>
                         <tr>
                         <td>10010 ||   7501088505607 || ALIN 0.5 MG TAB 30 560                  ||     Dexametasona                                        ||         54.10      ||     32.94</td>
                         </tr>
                         <tr>
                         <td>10000 ||   7501125116810 ||AGRIFEN ANTIGRIPAL TAB/10                ||     Cafeina, Clorfenamina, Fenilefrina, Paracetamol||         21.25      ||     13.50</td>
                         </tr>
                         <tr>
                         <th><?php echo 'GUARDAR ARCHIVO COMO : Texto con formato(delimitado por espacios)'?></th>
                         </tr>
                          
                         </table>
                         </div>
                         
                         
                         
                                <?php
                                
                                echo form_open('catalogos/subir_cat_dema_sumit', array('enctype' => 'multipart/form-data'));
                                
                                ?>
                                <tr>
                                <td>Seleccione Archivo: <input type="file" name="uploadFile" /><br />
                                <input type="submit" value="Subir archivo" />
                                </td>
                                </tr>
                                
                                
                                <?php
                                
                                echo form_close();
                                
                                ?>
                         
                        
                         
                     </div>
                 </div>
                                      <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             <tr>
                             <th colspan="1">#</th>
                             <th colspan="1">Fecha</th>
                             <th colspan="1">Dema</th>
                             <th colspan="1">Pharmacy 1</th>
                             <th colspan="1">Pharmacy 2</th>
                             <th colspan="1">Codigo</th>
                             <th colspan="1">Descripcion</th>
                             <th colspan="1">Sustancia Activa</th>
                             <th colspan="1">Precio<br />Publico</th>
                             <th colspan="1">Precio<br />Costo</th>
                             </tr>
                             </thead>
                                
                                <tbody>
                                 <?php
                                $color='green';$nume=0;
                               foreach ($q->result()as $r){
                               $nume=$nume+1;
                               ?>
                               <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $nume?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->idcat_dema?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->rel1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->rel2?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->codigo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descri?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->pub,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->cos,2)?></td>
                                
                                </tr>
                               <?php
                               }
                               ?>
                              </tbody>
                              <tfoot>
                           
                             </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>