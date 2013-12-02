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
	$atributos = array('id' => 'agrega_lic');
    echo form_open('mercadotecnia/agrega_lic', $atributos);
    $data_nombre = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'value'       => '',
              'maxlength'   => '40',
              'size'        => '40',
              
              
            );
    
  
  ?>
 
  <table>
<tr>
<tr>
    <td align="left" ><font size="+1"><strong>Nombre de la licitacion: </strong></font></td>
	<td><?php echo form_input($data_nombre, "", 'required');?></td>
    
	
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
                                 <th style="text-align: left">Nombre</th>
                                 <th style="text-align: left">Fecha</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$timp=0;$tcan=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                $l0 = anchor('mercadotecnia/mer_genera_lic_b/'.$r->id,$r->nombre.'</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                $l1 = anchor('mercadotecnia/agrega_det/1/'.$r->id,'T.Sustancias</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                $l2 = anchor('mercadotecnia/agrega_det/2/'.$r->id,'Clagob</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->id?></td>
                                   <td style="text-align: left;"><?php echo $l0?></td>
                                   <td style="text-align: left;"><?php echo $r->fecha?></td>
                                   <td style="text-align: right;"><?php echo $r->id_user?></td>
                                   <td style="text-align: right;"><?php echo $l1?></td>
                                   <td style="text-align: right;"><?php echo $l2?></td>
                                   </tr>
                               <?php } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td></td>
                              <td>TOTAL</td>
                              
                              <td></td>
                              
                              <td></td>
                              </tr>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>