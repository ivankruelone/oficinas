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
	$atributos = array('id' => 'com_generar_det_sumit');
    echo form_open('pedido/com_generar_det_sumit', $atributos);
    $data_sec = array(
              'name'        => 'sec',
              'id'          => 'sec',
              'value'       => '',
              'maxlength'   => '13',
              'size'        => '13'
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
	<td align="left" ><font size="+1">Sec: </font></td>
    <td><?php echo form_input($data_sec, "", 'required');?></td>
    <td align="left" ><font size="+1">Cantidad: </font></td>
    <td><?php echo form_input($data_can, "", 'required');?></td>	
 	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
  <?php
 
	echo form_close();
  ?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>Id</th>
                                     <th>Sec</th>
                                     <th>Clave</th>
                                     <th>Sustancia Activa</th>
                                     <th>Costo base</th>
                                     <th>Prv base</th>
                                     <th>Piezas</th>
                                     <th>Costo</th>
                                     <th>Importe</th>
                                     <th>Prv</th>
                                     <th>Provedor</th>
                                     
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;
                                $num=0;
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                $tot=0; $n=0; 
                                $l0 = anchor('pedido/com_pedido_det_b/'.$r->id_cc.'/'.$r->id,'<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                        $atributos = array('id' => 'com_ped_cambia');
                                        echo form_open('pedido/com_ped_cambia', $atributos);
                                        $data_ped = array(
                                       'name'        => 'pedi',
                                       'id'          => 'pedi',
                                       'value'       => $r->ped
                                        );?> 
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; "><?php echo $r->sec.' '.$l0?></td>
                                        <td style="text-align: left; "><?php echo $r->clagob?></td>
                                        <td style="text-align: left; "><?php echo $r->susa?></td>
                                        <td style="text-align: right; "><?php echo $r->costobase?></td>
                                        <td style="text-align: left; "><?php echo $r->prvbasex?></td>
                                        <td style="text-align: right; "><?php echo $r->ped?>
                                        <?php echo form_input($data_ped, "", 'required');?>	
                                        <?php echo form_submit('envio', 'acepta');?></td>
                                        <input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
                                       <input type="hidden" value="<?php echo $r->id?>" name="id" id="id" /> 
                                        <?php echo form_close();?>
                                       <td style="text-align: right; "><?php echo number_format($r->costo,2)?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->costo*$r->ped,2)?></td>
                                        <td style="text-align: right; "><?php echo $r->prv?></td>
                                        <td style="text-align: left; "><?php echo $r->prvx?></td>
                                        
                                        
                                      </tr>
                                       <input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
                                       <input type="hidden" value="<?php echo $r->id?>" name="id" id="id" /> 
                                        <?php 
                                         echo form_close();
                                        $tcan=$tcan+$r->ped;
                                        $timp=$timp+$r->ped*$r->costo;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4"></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($tcan,0)?></strong></td>
                             <td></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($timp,2)?></strong></td>
                                        
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
<script language=\"javascript\" type=\"text/javascript\">

$('input:text[name^=\"cansur_\"]').change(function() {
    
    var nombre = $(this).attr('name');
    var valor = $(this).attr('value');
    //var pedido = $('#pedido').html();
    

    var id = nombre.split('_');
    id = id[1];
    //alert(id + \" \" + valor);
    actualiza_surtido(id, valor);

});

function actualiza_surtido(id, valor){
    $.ajax({type: \"POST\",
        url: \"".site_url()."/a_surtido/actualiza_cansur/\", data: ({ id: id, valor: valor }),
            success: function(data){
                
                

        },
        beforeSend: function(data){

        }
        });
}

</script>
 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>