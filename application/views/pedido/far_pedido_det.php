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
	$atributos = array('id' => 'far_generar_sumit_det');
    echo form_open('pedido/far_generar_sumit_det', $atributos);
    $data_codigo = array(
              'name'        => 'codigo',
              'id'          => 'codigo',
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
	<td align="left" ><font size="+1">Codigo: </font></td>
    <td align="left"><?php echo form_dropdown('codigo', $codigo, '', 'id="codigo"') ;?> </td>
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
                                     <th>Codigo</th>
                                     <th>Clave</th>
                                     <th>Sustancia Activa</th>
                                     <th>Descripcion</th>
                                     <th>Cantidad</th>
                                     
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                $tot=0; $n=0; 
                                $l0 = anchor('pedido/far_pedido_det_b/'.$r->id_cc.'/'.$r->id,'<img src="'.base_url().'img/error.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                ?> 
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>;"><?php echo $r->sec.' '.$l0?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->codigo?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->clave?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->susa?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r->descri?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r->ped?>
                                      </tr>
                                       <?php 
                                        $tcan=$tcan+$r->ped;
                                        $timp=$timp+$r->ped*$r->costo;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4"></td>
                             <td style="color:black; text-align: left; "><strong>Total de productos <?php echo number_format($num,0)?></strong></td>
                             <td></td>
                             <td style="color:black; text-align: right; "><strong><?php echo number_format($tcan,2)?></strong></td>
                                        
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