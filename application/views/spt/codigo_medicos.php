              <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
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
                                    <th colspan="10" style="color: blue; text-align: center;">SEGUIMIENTO AL CODIGO DE VESTIR DE MEDICOS DEL <?php echo $perini?> AL <?php echo $perfin?></th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Medico</th>
                                        <th>Sucursal</th>
                                        <th>Falta</th>
                                        <th>Retardo</th>
                                        <th>Bata</th>
                                        <th>Pantalon</br>o Falda</th>
                                        <th>Camisa o</br>Blusa</th>
                                        <th>Cabello</th>
                                        <th>Barba y </br>Bigote</th>
                                        <th>Maquillaje</th>
                                        <th>Accesorios</th>
                                        <th>Zapatos</th>
                                        <th>Tatuajes o</br>Piercings</br>Visibles</th>
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $num=0;
                               
                               $falta = 0;
                               $retardo = 0;
                               $bata = 0;
                               $pantalon = 0;
                               $camisa = 0;
                               $cabello = 0;
                               $barba = 0;
                               $maquillaje = 0;
                               $accesorios = 0;
                               $zapatos = 0;
                               $tatuajes = 0;
                               
                               foreach ($s->result()as $r){
                                $num=$num+1;
                                
                               ?>
                               
                                <tr>
                                <td style="text-align: center;"><?php echo $num?></td>
                                <td style="text-align: center"><?php echo $r->nomina.' '.$r->medico?></td>
                                <td style="text-align: center"><?php echo $r->suc.' '.$r->farmacia?></td>
                                <td style="text-align: left"><?php echo number_format($r->falta, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->retardo, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->bata, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->pantalon, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->camisa, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->cabello, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->barba, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->maquillaje, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->accesorios, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->zapatos, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->tatuajes, 0)?></td>
                                </tr>
                               <?php 
                               
                               
                               $falta= $falta+$r->falta;
                               $retardo= $retardo+$r->retardo;
                               $bata= $bata+$r->bata;
                               $pantalon= $pantalon+$r->pantalon;
                               $camisa= $camisa+$r->camisa;
                               $cabello= $cabello+$r->cabello;
                               $barba= $barba+$r->barba;
                               $maquillaje= $maquillaje+$r->maquillaje;
                               $accesorios= $accesorios+$r->accesorios;
                               $zapatos= $zapatos+$r->zapatos;
                               $tatuajes= $tatuajes+$r->tatuajes;

                               
                              
                                 } 
                                 
                              
                               
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="3" style="text-align: right" >TOTALES</td>
                              <td style="text-align: left"><?php echo number_format($falta, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($retardo, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($bata, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($pantalon, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($camisa, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($cabello, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($barba, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($maquillaje, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($accesorios, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($zapatos, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($tatuajes, 0)?></td>
                              </tr>
                             </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>