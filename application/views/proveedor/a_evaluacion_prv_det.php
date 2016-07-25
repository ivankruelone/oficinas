                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    
                                     <tr>
                                        <th>Fecha<br />Limite</th>
                                        <th>Orden</th>
                                        <th>Secuencia</th>
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
                                        <th>Piezas<br />Pedidas</th>
                                        <th>Piezas<br />Recibidas</th>
                                        <th>Abasto<br />en piezas</th>
                                        <th>Productos<br />Pedidos</th>
                                        <th>Productos<br />Recibidos</th>
                                        <th>Abasto<br />en productos</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                             
                                <?php
                                $t1=0;$t2=0;$t3=0;$t4=0;$por1=0;$por2=0;
                               foreach ($q->result()as $r){
                               ?>
        
                                <tr>
                                <td style="text-align: left"><?php echo $r->fecha_limite; ?></td>
                                <td style="text-align: left"><?php echo $r->folprv; ?></td>
                                <td style="text-align: left"><?php echo $r->sec; ?></td>
                                <td style="text-align: left"><?php echo $r->codigo; ?></td>
                                <td style="text-align: left"><?php echo $r->susa1; ?></td>
                                <td style="text-align: right"><?php echo number_format($r->can, 0); ?></td>
                                <td style="text-align: right"><?php echo number_format($r->llego, 0); ?></td>
                                <td style="text-align: right"><?php echo '% '.number_format($r->abasto_can, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($r->prod, 0); ?></td>
                                <td style="text-align: right"><?php echo number_format($r->prod_sur, 0); ?></td>
                                <td style="text-align: right"><?php echo '% '.number_format($r->abasto_prod, 2); ?></td>
                                </tr>
                                <?php
                                $t1 = $t1+$r->can;
                                $t2 = $t2+$r->llego;
                                $t3 = $t3+$r->prod;
                                $t4 = $t4+$r->prod_sur; 
                                 }
                                 $por1 = (($t2/$t1)*100);
                                 $por2 = (($t4/$t3)*100);
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                <td colspan="5">TOTAL</td>
                                <td style="text-align: right"><?php echo number_format($t1, 0); ?></td>
                                <td style="text-align: right"><?php echo number_format($t2, 0); ?></td>
                                <td style="text-align: right"><?php echo '% '.number_format($por1, 2); ?></td>
                                <td style="text-align: right"><?php echo number_format($t3, 0); ?></td>
                                <td style="text-align: right"><?php echo number_format($t4, 0); ?></td>
                                <td style="text-align: right"><?php echo '% '.number_format($por2, 2); ?></td>
                              </tr>
                              </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                 
<!--------------------------------------------------------------------------------------------------------------------->
                    <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4><?php echo $titulo1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                             </thead>
                             <tbody>
                              
                                <?php
                                $l1=anchor('proveedor/a_evaluacion_prv_aplicar/'.$prv.'/'.$fec1.'/'.$fec2,'APLICAR EVALUACION');
                                     if($por2<50){$cuatro=0;}
                                 elseif($por2>=50 and $por2<=94){$cuatro=1;}
                                 else{$cuatro=2;}
                                     
                                     if($por1<50){$cinco=0;}
                                 elseif($por1>=50 and $por1<=94){$cinco=1;}
                                 else{$cinco=2;}
                                 
                                 if($por2<50 and $por1<50){$dos=0;}
                                 elseif($por2>=50 and $por2<=94 and $por1>=50 and $por1<=94){$dos=1;}
                                 else{$dos=2;}
                                 foreach($q1->result() as $r1)
                                 {
                                 if($r1->id_evaluacion_prv==1){$pregunta1=$r1->pregunta;}
                                 if($r1->id_evaluacion_prv==2){$pregunta2=$r1->pregunta;}
                                 if($r1->id_evaluacion_prv==3){$pregunta3=$r1->pregunta;}
                                 if($r1->id_evaluacion_prv==4){$pregunta4=$r1->pregunta;}
                                 if($r1->id_evaluacion_prv==5){$pregunta5=$r1->pregunta;}
                                 if($r1->id_evaluacion_prv==6){$pregunta6=$r1->pregunta;}
                                 if($r1->id_evaluacion_prv==7){$pregunta7=$r1->pregunta;}
                                 if($r1->id_evaluacion_prv==8){$pregunta8=$r1->pregunta;}
                                 if($r1->id_evaluacion_prv==9){$pregunta9=$r1->pregunta;}  
                                 }
                                 ?>
                              <tr>
                                <td style="text-align: left"><?php echo $pregunta2 ?></td>
                                <td style="text-align: right"><?php echo $dos ?></td>
                              </tr>
                              <tr>
                                <td style="text-align: left"><?php echo $pregunta4 ?></td>
                                <td style="text-align: right"><?php echo $cuatro ?></td>
                              </tr>
                              <tr>
                                <td style="text-align: left"><?php echo $pregunta5 ?></td>
                                <td style="text-align: right"><?php echo $cinco ?></td>
                              </tr>
                              <tr>
                                <td style="text-align: left"><?php echo $l1; ?></td>
                                <td style="text-align: right"><?php echo ($dos+$cuatro+$cinco) ?></td>
                              </tr>
                              
                              </tbody>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                 
                