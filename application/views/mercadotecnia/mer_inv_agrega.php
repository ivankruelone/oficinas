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
	$atributos = array('id' => 'agrega_inv_sumit');
    echo form_open('mercadotecnia/agrega_inv_sumit', $atributos);
    $data_codigo = array(
              'name'        => 'codigo',
              'id'          => 'codigo',
              'value'       => '',
              'maxlength'   => '14',
              'size'        => '14'
              
            );
            $data_costo = array(
              'name'        => 'costo',
              'id'          => 'costo',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11'
              
            );
            $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
              
            );
  
  ?>
 
  <table>
<tr>
<tr>
	<td align="left" ><font size="+1">Codigo: </font></td>
    <td><?php echo form_input($data_codigo, "", 'required');?></td>
	<td align="left" ><font size="+1">Piezas: </font></td>
    <td><?php echo form_input($data_can, "", 'required');?></td>
    <td align="left" ><font size="+1">Costo: </font></td>
    <td><?php echo form_input($data_costo, "", 'required');?></td>
 </tr>
 


	<td colspan="2"align="center"><?php echo form_submit('envio', 'AGREGAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?>
  <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">#</th>
                                 <th style="text-align: left">Codigo</th>
                                 <th style="text-align: left">Descripcion</th>
                                 <th style="text-align: right">Piezas</th>
                                 <th style="text-align: right">Costo</th>
                                 <th style="text-align: right">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $num?></td>
                                   <td style="text-align: left;"><?php echo $r->codigo?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->descripcion?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->can,0)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->costo,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->can*$r->costo,2)?></td>
                                   </tr>
                               <?php $timp_prv=0;$timp_suc=0;} ?>
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div> 
  
  
  