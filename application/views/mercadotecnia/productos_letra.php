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
	$atributos = array('id' => 'agrega');
    echo form_open('mercadotecnia/agrega_productos_sumit', $atributos);
    $data_venta = array(
              'name'        => 'venta',
              'id'          => 'venta',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11'
              
            );
    $data_publico = array(
              'name'        => 'publico',
              'id'          => 'publico',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11'
              
            );
            $data_farmacia = array(
              'name'        => 'farmacia',
              'id'          => 'farmacia',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11'
              
            );
         
             $data_codigo = array(
              'name'        => 'codigo',
              'id'          => 'codigo',
              'value'       => '',
              'maxlength'   => '14',
              'size'        => '14'
              
            );
            $data_descri = array(
              'name'        => 'descri',
              'id'          => 'descri',
              'value'       => '',
              'maxlength'   => '40',
              'size'        => '40'
              
            );
            $data_registro = array(
              'name'        => 'registro',
              'id'          => 'registro',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
              
            );
            $data_aaa_registro = array(
              'name'        => 'aaa_registro',
              'id'          => 'aaa_registro',
              'value'       => '',
              'maxlength'   => '4',
              'size'        => '4'
              
            );
            $data_clave = array(
              'name'        => 'clave',
              'id'          => 'clave',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
              
            );
            $data_susa = array(
              'name'        => 'susa',
              'id'          => 'susa',
              'value'       => '',
              'maxlength'   => '200',
              'size'        => '200'
              
            );
         $data_max = array(
              'name'        => 'max',
              'id'          => 'max',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
              
            );
            $data_min = array(
              'name'        => 'min',
              'id'          => 'min',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
              
            );
            $data_antibio = array(
              'name'        => 'antibio',
              'id'          => 'antibio',
              'value'       => '',
              'maxlength'   => '1',
              'size'        => '1'
              
            );
  
  ?>
 
  <table>
<tr>
    <td align="left" ><font size="+1"><strong>Codigo: </strong></font></td>
	<td><?php echo form_input($data_codigo, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Descripcion: </strong></font></td>
	<td><?php echo form_input($data_descri, "", 'required');?></td>
	<td align="left" ><font size="+1"><strong>Laboratorio: </strong></font></td>
    <td><?php echo form_dropdown('lab', $lab, '', 'id="lab"') ;?> </td>
    </tr>
    <tr>
    <td align="left" ><font size="+1"><strong>Farmacia: </strong></font></td>
    <td><?php echo form_input($data_farmacia, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Venta:</strong></font></td>
    <td><?php echo form_input($data_venta, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Publico:</strong></font></td>
    <td><?php echo form_input($data_publico, "", 'required');?></td>
    </tr>
    <tr>
    <td align="left" ><font size="+1"><strong>Iva: </strong></font></td>
    <td align="left"> 
    <select name="iva" id="iva">
    <option value="0"><?php if($iva=='0')?>Sin Iva</option>
    <option value="1"><?php if($iva=='1')?><strong>Con Iva</strong></option>
    </select>
    </td>
    
    <td align="left" ><font size="+1"><strong>Producto: </strong></font></td>
    <td align="left"> 
    <select name="tipo_p" id="tipo_p">
    <option value="NOR"><?php if($tipo_p=='NOR')?>Normal</option>
    <option value="NET"><?php if($tipo_p=='NET')?><strong>Neto</strong></option>
    <option value="LIM"><?php if($tipo_p=='LIM')?><strong>Limitado</strong></option>
    </select>
    </td>
    <td align="left" ><font size="+1"><strong>Registro: </strong></font></td>
	<td><?php echo form_input($data_registro, "");?></td>
 </tr>
 <tr>
     <td align="left" ><font size="+1"><strong>A&ntilde;o del registro: </strong></font></td>
	<td><?php echo form_input($data_aaa_registro, "");?></td>
    <td align="left" ><font size="+1"><strong>Clave: </strong></font></td>
	<td><?php echo form_input($data_clave, "");?></td>
    <td align="left" ><font size="+1"><strong>Sustancia: </strong></font></td>
	<td><?php echo form_input($data_susa, "");?></td>
 </tr>
 <tr>
    <td align="left" ><font size="+1"><strong>Linea: </strong></font></td>
	<td><?php echo form_dropdown('lin', $lin, '', 'id="lin"') ;?> </td>
    <td align="left" ><font size="+1"><strong>Sublin: </strong></font></td>
	<td><?php echo form_dropdown('sublin', $sublin, '', 'id="sublin"') ;?> </td>
    <td></td>
    <td></td>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>Minimo:</strong></font></td>
    <td><?php echo form_input($data_min, "");?></td>
    <td align="left" ><font size="+1"><strong>Maximo: </strong></font></td>
	<td><?php echo form_input($data_max, "");?></td>
    <td align="left" ><font size="+1"><strong>Antibiotico: </strong></font></td>
	<td><?php echo form_input($data_antibio, "");?></td>
 </tr> 

<tr>
	<td colspan="8" align="center"><?php echo form_submit('envio', 'AGREGAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?>
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             <tr>
                             <th>Codigo</th>
                             <th>Descripcion</th>
                             <th>Laboratorio</th>
                             <th>Farmacia</th>
                             <th>Publico</th>
                             <th>Venta</th>
                             <th>Registro</th>
                             <th>Fecha reg</th>
                             <th>Clave</th>
                             <th>Iva</th>
                             <th>Prod</th>
                             </tr>    
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                foreach ($q as $r) {
                                $num=$num+1;
                                $l0 = anchor('mercadotecnia/productos_modifica/'.$r['id'],$r['codigo'].'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                 ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $l0?></td>
                                   <td style="text-align: left;"><?php echo $r['descripcion'].'-'.$r['susa']?></td>
                                   <td style="text-align: left;"><?php echo $r['labor']?></td> 
                                   <td style="text-align: left;"><?php echo number_format($r['farmacia'],2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r['pub'],2)?></td>
                                   <td style="text-align: left;"><?php echo number_format($r['venta'],2)?></td>
                                   <td style="text-align: left;"><?php echo $r['registro']?></td>
                                   <td style="text-align: left;"><?php echo $r['fecha_registro']?></td>
                                   <td style="text-align: left;"><?php echo $r['clave']?></td>
                                   <td style="text-align: left;"><?php echo $r['ivax']?></td>
                                   <td style="text-align: left;"><?php echo $r['producto']?></td>
                                 </tr>
                                                                    
                                 
                               <?php } ?>
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>