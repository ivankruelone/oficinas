                    <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4><?php echo $titulo1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <?php 
    $atributos = array('id' => 'sumit_evaluacion_prv');
    echo form_open('proveedor/sumit_evaluacion_prv', $atributos);
    
    
                         ?>
                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                             </thead>
                             <tbody>
                              
                                <?php
                                
                                $t1=0;$t2=0;$t3=0;$t4=0;$por1=0;$por2=0;
                               foreach ($q->result()as $r){
                                $t1 = $t1+$r->can;
                                $t2 = $t2+$r->llego;
                                $t3 = $t3+$r->prod;
                                $t4 = $t4+$r->prod_sur; 
                                 }
                                 $por1 = (($t2/$t1)*100);
                                 $por2 = (($t4/$t3)*100);
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
                                <td style="text-align: left"><?php echo $pregunta1 ?></td>
                                <td align="left"><?php echo form_dropdown('uno', $uno, '', 'id="uno"') ;?> </td>
                              </tr>
                              <tr>
                                <td style="text-align: left"><?php echo $pregunta2 ?></td>
                                <td style="text-align: right"><?php echo $dos ?></td>
                              </tr>
                              <tr>
                                <td style="text-align: left"><?php echo $pregunta3 ?></td>
                                <td align="left"><?php echo form_dropdown('tres', $tres, '', 'id="tres"') ;?> </td>
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
                                <td style="text-align: left"><?php echo $pregunta6 ?></td>
                                <td align="left"><?php echo form_dropdown('seis', $seis, '', 'id="seis"') ;?> </td>
                              </tr>
                              <tr>
                                <td style="text-align: left"><?php echo $pregunta7 ?></td>
                                <td>
                                Si<input name="siete" id="siete" type="checkbox" value="1" class="1" title="Si"/>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                <textarea  class="span12" name="siete_p" id="siete_p" rows="4" cols="10" wrap="virtual" maxlength="500" class="leftpad" lang="8"></textarea>
                                </td>
                              </tr>
                              <tr>
                                <td style="text-align: left"><?php echo $pregunta8 ?></td>
                                <td>No<input name="ocho" id="ocho" type="checkbox" value="0" class="1" title="No"/>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                <textarea  class="span12" name="ocho_p" id="ocho_p" rows="4" cols="10" wrap="virtual" maxlength="500" class="leftpad" lang="8"></textarea>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" style="text-align: left"><?php echo $pregunta9 ?></td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                <textarea  class="span12" name="nueve_p" id="nueve_p" rows="4" cols="10" wrap="virtual" maxlength="500" class="leftpad" lang="8"></textarea>
                                </td>
                              </tr>
                              </tr>

	                            <td colspan="2"align="center"><?php echo form_submit('envio', 'GENERAR');?></td>
                            </tr>
                        </table>
                        <input type="hidden" value="<?php echo $prv?>" name="prv" id="prv" />
                        <input type="hidden" value="<?php echo $dos?>" name="dos" id="dos" />
                        <input type="hidden" value="<?php echo $cuatro?>" name="cuatro" id="cuatro" />
                        <input type="hidden" value="<?php echo $cinco?>" name="cinco" id="cinco" />
                              </tbody>
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                 
                