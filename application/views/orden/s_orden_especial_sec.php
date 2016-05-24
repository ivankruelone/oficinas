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
	$atributos = array('id' => 'com_generar_sumit');
    echo form_open('orden/com_generar_sumit_sec', $atributos);
    $data_pass = array(
              'name'        => 'pass',
              'id'          => 'pass',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15',
              'type'        =>'password'
              
            );
  
  ?>
 
  <table>
<tr>
<tr>
	<td align="left" ><font size="+1">PASSWORD: </font></td>
    <td><?php echo form_input($data_pass, "", 'required');?></td>
	<td align="left" ><font size="+1"><strong>ALMACEN: </strong></font></td>
	<td align="left"><?php echo form_dropdown('alm', $alm, '', 'id="alm"') ;?> </td>
 </tr>
 <tr>   
    <td align="left" ><font size="+1"><strong>Provedor: </strong></font></td>
	<td align="left"><?php echo form_dropdown('prv', $prv, '', 'id="prv"') ;?> </td>
    <td align="left" ><font size="+1"><strong>Compa&ntilde;ia: </strong></font></td>
    <td align="left"> 
    <select name="cia" id="cia">
    <option value="13"><?php if($cia=='13')?>Farmacia de Genericos</option>
    <option value="1"><?php if($cia=='1')?><strong>Farmacias el Fenix</strong></option>
    </select>
    <td align="left" ><font size="+1"><strong>Licitacion: </strong></font></td>
	<td align="left"><?php echo form_dropdown('lic', $lic, '', 'id="lic"') ;?> </td>
    
    </td>

 </tr>
 


	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>Id</th>
                                     <th>Folio</th>
                                     <th>Fecha</th>
                                     <th>Almacen</th>
                                     <th>Prv</th>
                                     <th>Provedor</th>
                                     <th>Importe</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=1;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $l1=anchor('orden/s_orden_especial_det_sec/'.$r->id_orden.'/'.$r->prv,$r->id_orden);
                                $l2=anchor('orden/cerrar_especial/'.$r->id_orden.'/'.$r->prv.'/'.$r->cia,'Cerrar Orden');
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; "><?php echo $l1?></td>
                                        <td style="text-align: right; "><?php echo $r->fecha_captura?></td>
                                        <td style="text-align: left; "><?php echo $r->almacenx?></td>
                                        <td style="text-align: left; "><?php echo $r->prv?></td>
                                        <td style="text-align: left; "><?php echo $r->prvx?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp,2)?></td>
                                        <td><?php echo $l2?></td>
                                        </tr>
                                        <?php 
                                        $num=$num+1;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             </tr>
                             </tfoot>
                         </table>                        

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>