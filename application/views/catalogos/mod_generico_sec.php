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
$r=$q->row();
	$atributos = array('id' => 'sumit_cambia_sec');
    echo form_open('catalogos/sumit_cambia_sec', $atributos);
   
    $data_ddr = array(
              'name'        => 'ddr',
              'id'          => 'ddr',
              'value'       => $r->ddr,
              'maxlength'   => '11',
              'size'        => '11'
              
            );
    $data_gen = array(
              'name'        => 'gen',
              'id'          => 'gen',
              'value'       => $r->gen,
              'maxlength'   => '11',
              'size'        => '11'
              
            );
         
   $data_natur = array(
              'name'        => 'natur',
              'id'          => 'natur',
              'value'       => $r->natur,
              'maxlength'   => '14',
              'size'        => '14'
              
            );
   $data_clasi = array(
              'name'        => 'clasi',
              'id'          => 'clasi',
              'value'       => $r->clasi,
              'maxlength'   => '14',
              'size'        => '14'
              
            );
            
   if($r->cos>0 and $r->gen>0){
                                    if($r->iva==0){$margen=100-(($r->cos*100)/$r->gen);$venta=$r->cos*1.4;}
                                    else{$margen=100-((($r->cos*1.16)*100)/$r->gen);$venta=($r->cos*1.16)*1.4;}
                                    }else{$margen=0;$venta=0;} 
  ?>
 
  <table>
<tr>
<td colspan="6"><font size="+1"><?php echo $r->sec.' '.$r->susa?></font></td>
</tr>
<tr>
<td  colspan="2" align="left" ><font size="+1"><strong><?php echo 'Costo base '.$r->cos?></strong></font></td>
<td  colspan="2" align="left" ><font size="+1"><strong><?php echo 'Margen '.number_format($margen,2)?></strong></font></td>
<td  colspan="2" align="left" ><font size="+1"><strong><?php echo 'Venta Sugerido '.number_format($venta,2)?></strong></font></td>
</tr>
<tr>
<td>.</td>
</tr>
    <tr>
    <td align="left" ><font size="+1"><strong>Venta Gen: </strong></font></td>
    <td><?php echo form_input($data_gen, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Venta Ddr:</strong></font></td>
    <td><?php echo form_input($data_ddr, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Comisionable:</strong></font></td>
    <td><?php echo form_input($data_natur, "", 'natur');?></td>
    </tr>
   <tr>
    <td align="left" ><font size="+1"><strong>Clasifica: </strong></font></td>
    <td><?php echo form_input($data_clasi, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Tipo:</strong></font></td>
    <td align="left"> 
    <select name="tipo" id="tipo">
    <option value="A"><?php if($r->tipo=='A')?>Activo</option>
    <option value="D"><?php if($r->tipo=='D')?><strong>Descontinuado</strong></option>
    <option value="X"><?php if($r->tipo=='X')?><strong>Borrado</strong></option>
    </select>
    </td>
    </tr>
<tr>
	<td colspan="8" align="center"><?php echo form_submit('envio', 'Cambiar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $r->sec ?>" name="sec" id="sec" />
<input type="hidden" value="<?php echo $venta ?>" name="venta" id="venta" />
  <?php
 
	echo form_close();
  ?>


<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
