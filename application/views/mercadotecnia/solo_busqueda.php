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
                               	$atributos = array('id' => 'buscar');
    echo form_open('mercadotecnia/productos_modifica_codigo/0', $atributos);
    $data_codigo = array(
              'name'        => 'codigo',
              'id'          => 'codigo',
              'value'       => '',
              'maxlength'   => '14',
              'size'        => '14'
              
            );
    ?>

<tr>
    <td align="left" ><font size="+1"><strong>Buscar codigo: </strong></font></td>
	<td><?php echo form_input($data_codigo, "", 'required');?></td>
    <td colspan="8" align="center"><?php echo form_submit('envio', 'Buscar');?></td>
    </tr>
                         
                                <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">Codigo</th>
                               <th style="text-align: left;">Descrpcion</th>
                               <th style="text-align: left;">Laboratorio</th>
                               <th style="text-align: left;">Min</th>
                               <th style="text-align: left;">Max</th>
                               <th style="text-align: left;">Fecha de Cambio</th>
                               </tr>  
                             </thead>
                             <tbody>
                             
                               
                               <?php foreach($q->result() as $r) {
                                
                                $l1 = anchor('mercadotecnia/productos_modifica_codigo/'.$r->codigo,$r->codigo.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                 ?>
                                 <tr>
                                   <td style="text-align: left;"><?php echo $l1 ?></td>
                                   <td style="text-align: left;"><?php echo $r->descripcion?></td>
                                   <td style="text-align: left;"><?php echo $r->labx?></td>
                                   <td style="text-align: left;"><?php echo $r->min?></td>
                                   <td style="text-align: left;"><?php echo $r->max?></td>
                                   <td style="text-align: left;"><?php echo $r->fecha_archivo?></td>                                  
                                 </tr>
                               <?php } ?> 
                              </tbody>
                              <tfoot>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>