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
                                       
<?php
	$atributos = array('id' => 'com_generar_det_sumit_cla');
     echo form_open('pedido/com_generar_det_sumit_cla', $atributos);
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
    $data_regalo = array(
              'name'        => 'regalo',
              'id'          => 'regalo',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
    $data_costo = array(
              'name'        => 'costo',
              'id'          => 'costo',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11'
            );
  ?>
 
  <table>
<tr>
 <tr>   
    <td align="left" ><font size="+1"><strong>Producti: </strong></font></td>
	<td align="left"><?php echo form_dropdown('codigo', $codigo, '', 'id="codigo"') ;?> </td>
 </tr>
<tr>
	<td align="left" ><font size="+1">Cantidad: </font></td>
    <td><?php echo form_input($data_can, "", 'required');?></td>
	<td align="left" ><font size="+1"><strong>Regalo: </strong></font></td>
	<td><?php echo form_input($data_regalo, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Costo: </strong></font></td>
	<td><?php echo form_input($data_costo, "", 'required');?></td>
 </tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
  <?php
 
	echo form_close();
  ?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                 <tr>
                                     <th>Iasdasda</th>
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
                                      ?> 
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>;"><?php echo $r->sec.' '.$l0?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->clagob?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->susa.'<br />'.$r->descri?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r->costobase?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->prvbasex?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->ped?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->costo,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->costo*$r->ped,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format(($r->costo*$r->ped)-$tolal,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($tolal,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r->prv?></td>
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