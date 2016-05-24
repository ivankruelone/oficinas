                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                            <div class="span1">
                                
                                <?php
                                
                                echo form_open('licita/subida_submit_licita', array('enctype' => 'multipart/form-data'));
                                
                                ?>
                                
                                Please choose a file: <input type="file" name="uploadFile" /><br />
                                <input type="submit" value="Subir archivo" />
                                
                                <?php
                                
                                echo form_close();
                                
                                ?>
                                
                                
                                </div>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                                 <tr> 
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th>Id</th>
                                     <th style="text-align: center;">Fecha</th>
                                     <th style="text-align: center;">Contrato</th>
                                     <th>Productos</th>
                                     <th>Encontrados</th>
                                     <th></th>
                                     <th></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;
                                     foreach ($q->result() as $r2) {
                                    if($r2->encontrado==0){
                                        $lx  = anchor('licita/s_licita_borrar/'.$r2->fecha.'/'.$r2->contrato,'X.</a>', array('title' => 'Borrar!', 'class' => 'encabezado'));
                                        }else{$lx=' ';}    
                                    $l  = anchor('licita/s_licita_inserta_coinsidencia/'.$r2->fecha.'/'.$r2->contrato,'GENERAR COINSID.</a>', array('title' => 'Aplica coincidencias!', 'class' => 'encabezado'));    
                                    $l0 = anchor('licita/s_licita_inserta/'.$r2->fecha.'/'.$r2->contrato,'GENERAR IGUAL</a>', array('title' => 'Aplica coincidencias!', 'class' => 'encabezado'));
                                    $l1 = anchor('licita/s_licita_grupo/'.$r2->fecha.'/'.$r2->contrato,'SELECCIONAR</a>', array('title' => 'Haz Click aqui para Ver por grupo!', 'class' => 'encabezado'));
                                    $l2 = anchor('licita/s_licita_aplicada/'.$r2->fecha.'/'.$r2->contrato,'APLICADA</a>', array('title' => 'Haz Click aqui para Ver aplicada!', 'class' => 'encabezado'));
                                        ?>
                                        <tr>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $lx?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $l0?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $l?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r2->fecha?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo trim($r2->contrato)?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo number_format($r2->productos,0)?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo number_format($r2->encontrado,0)?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $l2?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>                        

<!---->
                  
<!--------------
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                 </div>
