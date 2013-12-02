                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <script src="<?php echo base_url();?>scripts/minified/jquery.ui.datepicker.min.js" type="text/javascript"></script>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
	$atributos = array('id' => 'cambia_productos_sumit_c');
    echo form_open('mercadotecnia/cambia_productos_sumit_c', $atributos);
    $data_venta = array(
              'name'        => 'venta',
              'id'          => 'venta',
              'value'       => $venta,
              'maxlength'   => '11',
              'size'        => '11'
              
            );
    $data_publico = array(
              'name'        => 'publico',
              'id'          => 'publico',
              'value'       => $pub,
              'maxlength'   => '11',
              'size'        => '11'
              
            );
            $data_farmacia = array(
              'name'        => 'farmacia',
              'id'          => 'farmacia',
              'value'       => $farmacia,
              'maxlength'   => '11',
              'size'        => '11'
              
            );
         
             $data_codigo = array(
              'name'        => 'codigo',
              'id'          => 'codigo',
              'value'       => $codigo,
              'maxlength'   => '14',
              'size'        => '14'
              
            );
            $data_descri = array(
              'name'        => 'descripcion',
              'id'          => 'descripcion',
              'value'       => $descripcion,
              'maxlength'   => '40',
              'size'        => '40'
              
            );
            $data_registro = array(
              'name'        => 'registro',
              'id'          => 'registro',
              'value'       => $registro,
              'maxlength'   => '20',
              'size'        => '20'
              
            );
            $data_registro_fec = array(
              'name'        => 'registro_fec',
              'id'          => 'registro_fec',
              'value'       => $fecha_registro,
              'maxlength'   => '20',
              'size'        => '20'
              
            );
            $data_clave = array(
              'name'        => 'clave',
              'id'          => 'clave',
              'value'       => $clave,
              'maxlength'   => '20',
              'size'        => '20'
              
            );
            $data_susa = array(
              'name'        => 'susa',
              'id'          => 'susa',
              'value'       => $susa,
              'maxlength'   => '200',
              'size'        => '200'
              
            );
            $data_max = array(
              'name'        => 'max',
              'id'          => 'max',
              'value'       => $max,
              'maxlength'   => '7',
              'size'        => '7'
              
            );
            $data_min = array(
              'name'        => 'min',
              'id'          => 'min',
              'value'       => $min,
              'maxlength'   => '7',
              'size'        => '7'
              
            );
            $data_antibio = array(
              'name'        => 'antibio',
              'id'          => 'antibio',
              'value'       => $antibio,
              'maxlength'   => '1',
              'size'        => '1'
              
            );
            
  
  ?>
 
  <table>
<tr>
<tr>
    <td align="left" ><font size="+1"><strong>Codigo: </strong></font></td>
	<td><?php echo $codigo;?></td>
    <td align="left" ><font size="+1"><strong>Descripcion: </strong></font></td>
	<td><?php echo form_input($data_descri, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Laboratorio: </strong></font></td>
    <td><?php echo form_dropdown('lab', $lab, '', 'id="lab"') ;?> </td>
   	</tr>
    <tr>
    <td align="left" ><font size="+1"><strong>Farmacia: </strong></font></td>
    <td><?php echo form_input($data_farmacia, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Venta: </strong></font></td>
    <td><?php echo form_input($data_venta, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Publico: </strong></font></td>
    <td><?php echo form_input($data_publico, "", 'required');?></td>
    </tr>
    <tr>
    <td align="left" ><font size="+1"><strong>Iva: </strong></font></td>
    <td align="left"> 
    <select name="iva" id="iva">
    <option value="0"> <?php if($iva=='0')?>Sin Iva</option>
    <option value="1"> <?php if($iva=='1')?><strong>Con Iva</strong></option>
    </select>
    </td>
    
    <td align="left" ><font size="+1"><strong>Producto: </strong></font></td>
    <td><?php echo form_dropdown('tipo_p', $tipo_p, '', 'id="tipo_p"') ;?> </td>
    <td align="left" ><font size="+1"><strong>Registro: </strong></font></td>
	<td><?php echo form_input($data_registro, "");?></td>
    </tr>
    <tr>
    <td align="left" ><font size="+1"><strong>Fecha_Reg: </strong></font></td>
	<td><?php echo form_input($data_registro_fec, "");?></td>
    <td align="left" ><font size="+1"><strong>Clave: </strong></font></td>
	<td><?php echo form_input($data_clave, "");?></td>
    <td align="left" ><font size="+1"><strong>Sustancia: </strong></font></td>
	<td><?php echo form_input($data_susa, "");?></td>
 </tr>
 <tr>
    <td align="left" ><font size="+1"><strong>Tipo:</strong></font></td>
    <td><?php echo form_dropdown('tipo', $tipo, '', 'id="tipo"') ;?> </td>
    <td align="left" ><font size="+1"><strong>Linea: </strong></font></td>
	<td><?php echo form_dropdown('lin', $lin, '', 'id="lin"') ;?> </td>
    <td align="left" ><font size="+1"><strong>Sublin: </strong></font></td>
	<td><?php echo form_dropdown('sublin', $sublin, '', 'id="sublin"') ;?> </td>
 </tr>
  <tr>
    <td align="left" ><font size="+1"><strong>Minimo:</strong></font></td>
    <td><?php echo form_input($data_min, "");?></td>
    <td align="left" ><font size="+1"><strong>Maximo: </strong></font></td>
	<td><?php echo form_input($data_max, "");?></td>
    <td align="left" ><font size="+1"><strong>Antibiotico: </strong></font></td>
	<td><?php echo form_input($data_antibio, "");?></td>
 </tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'CAMBIAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
  <?php
 
	echo form_close();
  ?>

 <!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>