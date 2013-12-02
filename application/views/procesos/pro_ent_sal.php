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
	$atributos = array('id' => 'ent_sal');
    echo form_open('procesos/ent_sal', $atributos);
    $data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
              
            );
    $data_fec2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
              
            );
    $data_sem = array(
              'name'        => 'sem',
              'id'          => 'sem',
              'value'       => '',
              'maxlength'   => '2',
              'size'        => '2'
              
            );
    
  ?>
 
  <table>

<tr>
<td colspan="2">Generar Entradas y Salidas por piezas</td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Fecha Ini: </strong></font></td>
	<td><?php echo form_input($data_fec1, "", 'required');?> AAAA-MM-DD</td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Fecha Fin: </strong></font></td>
	<td><?php echo form_input($data_fec2, "", 'required');?> AAAA-MM-DD</td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Semana: </strong></font></td>
	<td><?php echo form_input($data_sem, "", 'required');?></td>
</tr>
<tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'GENERAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?>

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             <tr><th colspan="5">Entradas y salidas</th></tr>
                            
                             <tr>
                             <th colspan="1">#</th>
                             <th colspan="1">Fecha Ini</th>
                             <th colspan="1">Fecha Fin</th>
                             <th colspan="1">Semana</th>
                             <th style="text-align: right" colspan="1">Entradas</th>
                             <th style="text-align: right" colspan="1">Salidas</th>
                             <th></th>
                             </tr>
                             </thead>
                                
                                <tbody>
                                 <?php
                                $color='green';$nume=0;
                               foreach ($q->result()as $r){
                                $l0 = anchor('procesos/borrar_ent_sal/'.$r->sem.'/'.$r->fec1,'Borrar</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                $l1 = anchor('procesos/p_ent_sal/'.$r->sem.'/'.$r->fec1,$r->sem.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                $nume=$nume+1;
                               ?>
                               <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $nume?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fec1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fec2?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->ent,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->sal,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                </tr>
                               <?php
                               }
                               ?>
                              </tbody>
                              <tfoot>
                           
                             </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>