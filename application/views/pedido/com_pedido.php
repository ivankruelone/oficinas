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
    echo form_open('pedido/com_generar_sumit', $atributos);
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
    <td align="left" ><font size="+1"><strong>Provedor: </strong></font></td>
	<td align="left"><?php echo form_dropdown('prv', $prv, '', 'id="prv"') ;?> </td>
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
                                     <th>Fecha</th>
                                     <th>Almacen</th>
                                     <th>Importe</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                $tot=0; $n=0; 
                                  $l0 = anchor('pedido/com_pedido_det/'.$r->id,'Detalle</a>', array('title' => 'Haz Click aqui para detalle!', 'class' => 'encabezado'));
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; "><?php echo $r->fecha?></td>
                                        <td style="text-align: left; "><?php echo $r->almacenx?></td>
                                        <td style="text-align: left; "><?php echo $r->prvx?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->importe,2)?></td>
                                        <td style="text-align: right; "><?php echo $l0?></td>
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