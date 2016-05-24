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

  <?php
	$atributos = array('id' => 'juridico_form_rentas');
    echo form_open('juridico/agrega_rentas', $atributos);
    $data_rfc = array(
              'name'        => 'rfc',
              'id'          => 'rfc',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
$data_imp = array(
              'name'        => 'imp',
              'id'          => 'imp',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11'
              
              
            );
    $data_nom = array(
              'name'        => 'nom',
              'id'          => 'nom',
              'value'       => '',
              'maxlength'   => '70',
              'size'        => '70'
            );
  $data_icedular = array(
              'name'        => 'icedular',
              'id'          => 'icedular',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
      $data_contrato = array(
              'name'        => 'contrato',
              'id'          => 'contrato',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
      $data_termino = array(
              'name'        => 'termino',
              'id'          => 'termino',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
       $data_incremento = array(
              'name'        => 'incremento',
              'id'          => 'incremento',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
             
            );
  ?>
  
  <table>
<th colspan="6">AGREGAR ARRENDADOR </th>
<tr>
	<td align="left" ><font size="+1">SUCURSAL: </font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
	<td align="left" ><font size="+1">PERSONA: </font></td>
    <td align="left"> 
    <select name="auxi" id="auxi">
    <option value="7003"> <?php if($auxi=='7003')?>Fisica</option>
    <option value="7004"> <?php if($auxi=='7004')?>Moral</option>
    </select>
    </td>

	<td align="left" ><font size="+1">RFC: </font></td>
    <td><?php echo form_input($data_rfc, "", 'required');?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">NOMBRE: </font></td>
	<td><?php echo form_input($data_nom, "", 'required');?></td>
    </select> </td>
	<td align="left" ><font size="+1">IMPORTE: </font></td>
	<td><?php echo form_input($data_imp, "", 'required');?></td>
    <td align="left" ><font size="+1">REDONDEO: </font></td>
    <td align="left"> 
    <select name="redon" id="redon">
    <option value="0.00"><?php if($redon=='0.00')?>0.00</option>
    <option value="0.01"><?php if($redon=='0.01')?>0.01</option>
    <option value="-0.01"><?php if($redon=='-0.01')?><strong>-0.01</strong></option>
    </select>
    </td>
</tr>
<tr>
	<td align="left" ><font size="+1">PAGO: </font></td>
    <td align="left"> 
    <select name="pago" id="pago">
    <option value="MN"> <?php if($pago=='MN')?>MONEDA NACIONAL</option>
    <option value="USD"> <?php if($pago=='USD')?><strong>DOLAR</strong></option>
    </select>
    </td>

	<td align="left" ><font size="+1">FEC.DE CONTRATO: </font></td>
	<td><?php echo form_input($data_contrato, "", 'required');?></td>
    <td align="left" ><font size="+1">FEC.DE TERMINO: </font></td>
	<td><?php echo form_input($data_termino, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">INCREMENTO ANUAL: </font></td>
	<td><?php echo form_input($data_incremento, "", 'required');?></td>
    <td align="left" ><font size="+1">IMPUESTO CEDULAR: </font></td>
    <td><?php echo form_input($data_icedular, "", '');?> <strong>%</strong></td>
    <td align="left"> 
    <select name="local" id="local">
    <option value="1"> <?php if($local=='2')?>Rentado</option>
    <option value="2"> <?php if($local=='1')?>Propio</option>
    </select>
    </td>
    <td align="left" ><font size="+1">Grupo: <?php echo form_dropdown('grupo', $grupo, '', 'id="grupo"') ;?> </td>
	
</tr>
<tr>
	
</tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
</table>

  <?php
	echo form_close();
  ?>

                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">Grupo</th>
                                 <th style="color:black; text-align: left">Local</th>
                                 <th style="color:black; text-align: left">Nid</th>
                                 <th style="color:black; text-align: left">Sucursal</th>
                                 <th style="color:black; text-align: left">Contrato</th>
                                 <th style="color:black; text-align: left">Observacion</th>
                                 <th style="color:black; text-align: left">RFC</th>
                                 <th style="color:black; text-align: left">Arrendador</th>
                                 <th style="color:black; text-align: left">Persona</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';
                                foreach ($q->result()as $r) {
                                $l1=anchor('juridico/borrar_arrendador/'.$r->id,'Borrar');
                                $l2=anchor('juridico/rentas_cambios/'.$r->id,$r->rfc);
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->grupo?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->tipo_localx?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->suc?></td>                                  
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->sucx?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->contrato?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->observacion?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l2?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->nom?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->auxix?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalusd,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo $l1?></td>
                                  </tr>
                               <?php $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               
                              <tr>
                              <td colspan="12">TOTAL</td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tmn,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tusd,2)?></td>
                              <td></td>
                              </tr>
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                 </div>