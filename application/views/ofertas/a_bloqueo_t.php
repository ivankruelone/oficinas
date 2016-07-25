                 <div class="span11">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<!---->
                         
<?php
$l1=anchor('ofertas/a_bloqueos_codigos_excel','Archivo en Excel');
	$atributos = array('id' => 'sumit_pedido_dema_bloqueo');
    echo form_open('ofertas/sumit_bloqueo_transfer', $atributos);

$data_cod = array(
              'name'        => 'cod',
              'id'          => 'cod',
              'autofocus'   => 'autofocus',
              'value'       => '',
              'maxlength'   => '13',
              'size'        => '13'
            ); 
$data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => $fec1,
              'maxlength'   => '10',
              'size'        => '10'
            ); 
$data_fec2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => $fec2,
              'maxlength'   => '10',
              'size'        => '10'
            );
  ?>
  <div>
                            <table class="table table-bordered table-condensed table-striped table-hover" id="tabla"> 
                            <tr>
                            <div class="control-group">
                                <label class="control-label">Busqueda: </label>
                                <div class="controls">
                                <?php echo form_input($data_cod, "", 'required');?>
                                <select name="codigo" id="codigo" style="width:50%">
                                </select>
                                </div>
                            </div>
                            </tr>
                            <tr>
                             <div class="control-group">
                                <div class="controls">
                                Fecha inicio: 
                                <?php echo form_input($data_fec1, "", 'required');?>
                                Fecha Fin:
                                <?php echo form_input($data_fec2, "", 'required');?>
                                </div>
                            </div>
                            </tr> 
                            <tr>
                            <td colspan="4" align="center"><?php echo form_submit('envio', 'Bloquear producto');?></td>
                            </tr>
                               </table>
                               

  <?php
 
	echo form_close();
  ?>
</div>
<!---->                          
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                              <tr>
                                     <th colspan="7"><?php echo $l1?></th>
                                 </tr>
                                 <tr>
                                     <th>#</th>
                                     <th style="text-align: left">Inicio</th> 
                                     <th style="text-align: left">Final</th>
                                     <th style="text-align: left">Codigo</th>
                                     <th style="text-align: left">Descripcion</th>
                                     <th style="text-align: right">Pharmacy 1</th>
                                     <th style="text-align: right">Pharmacy 2</th>
                                     <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $num=0;
                                foreach ($q->result()as $r){
                                $num=$num+1;    
                                $l1=anchor('ofertas/borrar_bloqueo_t/'.$r->id,'Borrar');
                               
                                
                                ?>
                                <tr>
                                <td><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha2?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->codigo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descripcion?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->rel1?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->rel2?></td>
                                <td><?php echo $l1 ?></td>
                                </tr>
                               <?php 
                                } ?>
                              </tbody>
                              <tfoot>
                              
                             </tfoot>
                         </table>      
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>