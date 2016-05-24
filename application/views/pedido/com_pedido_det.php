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
                                       <input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>Id</th>
                                     <th>Sec</th>
                                     <th>Clave</th>
                                     <th>Sustancia Activa</th>
                                     <th>Costo base</th>
                                     <th>Prv base</th>
                                     <th>Piezas</th>
                                     <th>Costo</th>
                                     <th>Importe</th>
                                     <th>Descuento</th>
                                     <th>Total</th>
                                     <th>Prv</th>
                                     <th>Provedor</th>
                                     
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;
                                $num=0;
                                foreach ($q->result() as $r) {
                                if($r->prv <> $r->prvbase){$color='blue';}else{$color='black';}
                                $num=$num+1;
                                if($r->descu>0){
                                    $tolal=($r->costo*$r->ped)-(($r->costo*$r->ped)*($r->descu/100));
                                    }else{
                                    $tolal=($r->costo*$r->ped);}
                                $tot=0; $n=0; 
                                $l0 = anchor('pedido/com_pedido_det_b/'.$r->id_cc.'/'.$r->id,'<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                        $data_ped = array(
                                       'name'        => 'pedi_'.$r->id,
                                       'id'          => $r->id,
                                       'size'        => '5',
                                       'maxlength'   => '5',
                                       'value'       => $r->ped
                                        );$data_regalo = array(
                                       'name'        => 'regalo_'.$r->id,
                                       'id'          => $r->id,
                                       'value'       => $r->regalo
                                        );$data_descu = array(
                                       'name'        => 'descu_'.$r->id,
                                       'id'          => $r->id,
                                       'value'       => $r->descu
                                        );$data_costo = array(
                                       'name'        => 'descu_'.$r->id,
                                       'id'          => $r->id,
                                       'value'       => $r->costo
                                        );?> 
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>;"><?php echo $r->sec.' '.$l0?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->clagob?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->susa.'<br />'.$r->descri?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r->costobase?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->prvbasex?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>">
                                        <span id="pedidoact_<?php echo $r->id; ?>"><?php echo $r->ped?></span>
                                        <?php if($r->prv==9998){?>
                                        <?php echo form_input($data_ped, "", 'required');?>
                                        <?php echo '<br />Regalo'.form_input($data_regalo, "", 'required');?>
                                        <?php echo'<br />Desc.'.form_input($data_descu, "", 'required');?>
                                        <?php echo'<br />Costo '.form_input($data_costo, "", 'required');?>
                                        <?php }else{ ?>
                                        <?php echo form_input($data_ped, "", 'required');?>
                                        <?php echo '<br />Regalo'.form_input($data_regalo, "", 'required');?>
                                        <?php echo'<br />Desc.'.form_input($data_descu, "", 'required');?>
                                        <?php } ?>	
                                        </td>

                                        <td style="text-align: right; color: <?php echo $color ?> " id="costo_<?php echo $r->id; ?>"><?php echo number_format($r->costo,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?> " id="importe_<?php echo $r->id; ?>"><?php echo number_format($r->costo*$r->ped,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?> " id="descuento_<?php echo $r->id; ?>"><?php echo number_format(($r->costo*$r->ped)-$tolal,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?> " id="total_<?php echo $r->id; ?>"><?php echo number_format($tolal,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?> "><?php echo $r->prv?></td>
                                        <td style="text-align: left; color: <?php echo $color ?> "><?php echo $r->prvx?></td>
                                        
                                        
                                      </tr>
                                        <?php 
                                        $tcan=$tcan+$r->ped;
                                        $timp=$timp+$r->ped*$r->costo;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4"></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($tcan,0)?></strong></td>
                             <td></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($timp,2)?></strong></td>
                                        
                             </tr>
                             </tfoot>
                         </table>                        

<!---->

<!---->
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>