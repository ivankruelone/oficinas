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
    echo form_open('mercadotecnia/graba_mer_prv', $atributos);
    $data_prv = array(
              'name'        => 'prv',
              'id'          => 'prv',
              'value'       => '',
              'maxlength'   => '4',
              'size'        => '4'
              
            );
    $data_razo = array(
              'name'        => 'razo',
              'id'          => 'razo',
              'value'       => '',
              'maxlength'   => '40',
              'size'        => '40'
              
            );
    $data_dire= array(
              'name'        => 'dire',
              'id'          => 'dire',
              'value'       => '',
              'maxlength'   => '50',
              'size'        => '50'
              
            );
    $data_cp= array(
              'name'        => 'cp',
              'id'          => 'cp',
              'value'       => '',
              'maxlength'   => '5',
              'size'        => '5'
              
            );
    $data_pobla= array(
              'name'        => 'pobla',
              'id'          => 'pobla',
              'value'       => '',
              'maxlength'   => '30',
              'size'        => '30'
              
            );
    $data_rfc= array(
              'name'        => 'rfc',
              'id'          => 'rfc',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
              
            );
    $data_corto= array(
              'name'        => 'corto',
              'id'          => 'corto',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
              
            );
     $data_tel= array(
              'name'        => 'tel',
              'id'          => 'tel',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
              
            );
  
  ?>
 
  <table>
<tr>
<tr>
    <td align="left" ><font size="+1"><strong>Prv: </strong></font></td>
	<td><?php echo form_input($data_prv, "", 'required');?></td>
	<td align="left" ><font size="+1">Provedor: </font></td>
    <td><?php echo form_input($data_razo, "", 'required');?></td>
    <td align="left" ><font size="+1">Direccion: </font></td>
    <td><?php echo form_input($data_dire, "", 'required');?></td>
</tr>
<tr>
    <td align="left" ><font size="+1">CP: </font></td>
    <td><?php echo form_input($data_cp, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Poblacion: </strong></font></td>
	<td><?php echo form_input($data_pobla, "", 'required');?></td>
	<td align="left" ><font size="+1">RFC: </font></td>
    <td><?php echo form_input($data_rfc, "", 'required');?></td>
 </tr>
<tr>
    <td align="left" ><font size="+1">Telefono: </font></td>
    <td><?php echo form_input($data_tel, "", 'required');?></td>
    <td align="left" ><font size="+1">Nombre Corto: </font></td>
    <td><?php echo form_input($data_corto, "", 'required');?></td>
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
                                 <th style="text-align: left">Prv</th>
                                 <th style="text-align: left">Provedor</th>
                                 <th style="text-align: left">Direccion</th>
                                 <th style="text-align: right">C.P</th>
                                 <th style="text-align: left">Poblacion</th>
                                 <th style="text-align: left">RFC</th>
                                 <th style="text-align: right">Telefono</th>
                                 <th style="text-align: right"></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$timp=0;$tcan=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                if($r->prov >5002 and $r->prov<=9996){
                                $l0 = anchor('mercadotecnia/sumit_borra_prv/'.$r->prov,'BORRAR</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));    
                                }else{$l0='';}
                                $l1 = anchor('mercadotecnia/modifica_prv/'.$r->prov,$r->prov.'</a>', array('title' => 'Haz Click aqui para modificar!', 'class' => 'encabezado'));
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $l1?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->razo?></td>
                                   <td style="text-align: left;"><?php echo $r->dire?></td>
                                   <td style="text-align: right;"><?php echo $r->cp?></td>
                                   <td style="text-align: left;"><?php echo $r->pobla?></td>
                                   <td style="text-align: left;"><?php echo $r->rfc?></td>
                                   <td style="text-align: right;"><?php echo $r->tel?></td>
                                   <td style="text-align: right;"><?php echo $l0?></td>
                                  </tr>
                               <?php } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="8" style="text-align: left;"><?php echo 'TOTAL '.number_format($num,0)?></td>
                              </tr>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>