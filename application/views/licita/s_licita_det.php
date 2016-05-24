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

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                                 <tr> 
                                     <th>Partida</th>
                                     <th style="text-align: center;">Sustancia</th>
                                     <th style="text-align: center;">Presentacion</th>
                                     <th style="text-align: center;">Codigo</th>
                                     <th style="text-align: center;">Sustancia Encontrada</th>
                                     <th style="text-align: center;">Descripcion</th>
                                     <th style="text-align: center;">Archivo</th>
                                     <th style="text-align: center;">Costo</th>
                                     <th>Val</th>
                                     <th></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;
                                $mismo='';
                                     foreach ($q->result() as $r2) {
                                     // $l1 = anchor('compra/s_pago_mayoristas_prv/'.$r2->aaa.'/'.$r2->mes,'VENCIMIENTO CXP</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                                     if($r2->aplica>0){$color='red';}else{$color='blue';}
                                     if($mismo<>trim($r2->presenta)){
                                            $clave_p=$r2->clave_p;
                                            $susa=$r2->susa;
                                            $presenta=$r2->presenta;
                                        }else{
                                            $clave_p='';
                                            $susa='';
                                            $presenta='';
                                        }   
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $clave_p?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo trim($susa)?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo trim($presenta)?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo trim($r2->codigo)?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo trim($r2->susa1)?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo ($r2->susa2)?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo trim($r2->archivo)?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->costo?></td>
                                        
<?php
$data_val = array(
'name'        => 'aplicame_'.$r2->id_det,
'id'          => $r2->id_det,
'size'        => '1',
'maxlength'   => '1',
'value'       => $r2->totalmn
 );
?>
                                        <td style="color: green;"><span id="cambiado_<?php echo $r2->id_det; ?>"><strong><?php echo $r2->aplica?></strong></span>
                                        <?php echo form_input($data_val, "", 'required');?></td>
                                        </tr>
                                        <?php $num=$num+1; $mismo=trim($r2->presenta);
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
