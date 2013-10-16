                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
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
                                     <th>Id</th>
                                     <th>Fecha</th>
                                     <th>Prv</th>
                                     <th>Provedor</th>
                                     
                                     <th style="text-align: right;">Cedis</th>
                                     <th style="text-align: right;">Farmabodega</th>
                                     <th style="text-align: right;">Metro</th>
                                     <th style="text-align: right;">Bansefi</th>
                                     <th style="align: right;">Total</th>
                                     <th style="text-align: right;"></th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;
                                foreach ($a as $r) {
                                $num=$num+1;
                                $tot=0; $n=0; 
                                foreach($r['segundo'] as $items){
                                $l0 = anchor('orden/orden_compra_detalle/'.$items['prv'].'/'.$items['id_ped'],$items['prv'].'</a>', array('title' => 'Haz Click aqui para ver productos!', 'class' => 'encabezado'));
                                
                                    $n=$n+1;?>
                                        
                                        <tr>
                                        <td><?php echo $items['id_ped']?></td>
                                        <td style="width: inherit;"><?php echo $items['fecha_ped']?></td>
                                        <td style="width: inherit;"><?php echo $l0?></td>
                                        <td style="width: inherit;"><?php echo $items['prvx']?></td> 
                                        
                                        
                                        <?php $tot=0; $n=0; 
                                        foreach($items['tercero'] as $ter){?>
                                        
                                        <?php
                                        if($ter['almacen']=='alm'){$u1=$ter['impo'];}
                                        if($ter['almacen']=='fbo'){$u2=$ter['impo'];}
                                        if($ter['almacen']=='met'){$u3=$ter['impo'];}
                                        if($ter['almacen']=='ban'){$u4=$ter['impo'];}
                                        }?>
                                        
                                        <td style="text-align: right; "><?php echo number_format($u1,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($u2,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($u3,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($u4,2)?></td>
                                          <?php
                                        $atributos = array('id' => 'cerrar');
                                        echo form_open('orden/cerrar', $atributos);
                                        
                                        if($items['var']=='NO'){$l1='<strong>Pida autorizacion</strong>';}else{
                                        }
                                        $tu1=$tu1+$u1;
                                        $tu2=$tu2+$u2;
                                        $tu3=$tu3+$u3;
                                        $tu4=$tu4+$u4; 
                                        $u5=$u1+$u2+$u3+$u4;
                                        $u1=0;$u2=0;$u3=0;$u4=0; 
                                        ?>
                                        <td style="text-align:right;color:black"><?php echo number_format($u5,2)?></td>
                                        <td><?php echo form_dropdown('cia', $items['cia'], '', 'id="cia"') ;?> </td>
                                        <td><?php echo form_submit('envio', 'CERRAR');?></td>
                                        </tr>
                                        <input type="hidden" value="<?php echo $items['id_ped']?>" name="id_ped" id="id_ped" />
                                        <input type="hidden" value="<?php echo $items['prv']?>" name="prv" id="prv" />
                                        
                                         <?php 
                                         echo form_close();
                                        $final1=$final1+$u5;}?>
                                        
                                <?php 
                                }
                                
                                ?>
                             </tbody>
                             <tfoot>
                             <tr>
                             <td></td>
                             <td></td>
                             <td></td>
                             
                             <td >TOTAL GENERAL</td>
                             <td style="text-align: right;color: royalblue;"><?php echo number_format($tu1,2)?></td>
                             <td style="text-align: right;color: royalblue;"><?php echo number_format($tu2,2)?></td>
                             <td style="text-align: right;color: royalblue;"><?php echo number_format($tu3,2)?></td>
                             <td style="text-align: right;color: royalblue;"><?php echo number_format($tu4,2)?></td>
                             <td style="text-align: right;color: royalblue;"><?php echo number_format($final1,2)?></td>
                             <td></td>
                             </tr></tfoot>
                         </table>                        





                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>