                 <div class="span10">
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
	$atributos = array('id' => 'tarjetas_sumit');
    echo form_open('tarjetas/tarjetas_sumit', $atributos);
    $data_fol1 = array(
              'name'        => 'fol1',
              'id'          => 'fol1',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
    $data_fol2 = array(
              'name'        => 'fol2',
              'id'          => 'fol2',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
  
  ?>
 
  <table>
<tr>
<tr>
	<td align="left" ><font size="+1"><strong>Sucursal: </strong></font></td>
	<td align="left"><?php echo form_dropdown('suc', $suc, '', 'id="suc"') ;?> </td>
 </tr>
 <tr>   
    <td align="left" ><font size="+1">Folio Inicial: </font></td>
    <td><?php echo form_input($data_fol1, "", 'required');?></td>
    <td align="left" ><font size="+1">Folio Final: </font></td>
    <td><?php echo form_input($data_fol2, "", 'required');?></td>
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
                                     <th>Borrar</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Folio Inicial</th>
                                     <th>Folio Final</th>
                                     <th># Tarjetas</th>
                                     <th>Validar</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $l1= anchor('tarjetas/tarjetas_borrar/'.$r->id,'Borrar </a>', array('title' => 'Haz Click aqui para detalle!', 'class' => 'encabezado'));
                                $l2= anchor('tarjetas/tarjetas_validar/'.$r->id.'/'.$r->suc,'Validar </a>', array('title' => 'Haz Click aqui para detalle!', 'class' => 'encabezado'));
                                  
                                ?>
                                        <tr>
                                        <td style="text-align: right; "><?php echo $l1?></td>
                                        <td style="text-align: right; "><?php echo $r->suc?></td>
                                        <td style="text-align: left; "><?php echo $r->sucx?></td>
                                        <td style="text-align: left; "><?php echo $r->fol1?></td>
                                        <td style="text-align: left; "><?php echo $r->fol2?></td>
                                        <td style="text-align: left; "><?php echo number_format($r->tar,0)?></td>
                                        <td style="text-align: right; "><?php echo $l2?></td>
                                        </tr>
                                        <?php 
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