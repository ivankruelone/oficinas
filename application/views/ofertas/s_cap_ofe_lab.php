                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
<?php
	$atributos = array('id' => 'sumit_aferta');
    echo form_open('ofertas/sumit_aferta', $atributos);
  $data_cod = array(
              'name'        => 'codigo',
              'id'          => 'codigo',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11',
              'type'        =>'decimal'
            );
  $data_ofe_lab = array(
              'name'        => 'ofe_lab',
              'id'          => 'ofe_lab',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11',
              'type'        =>'decimal'
            ); 
  $data_ofe_far = array(
              'name'        => 'ofe_far',
              'id'          => 'ofe_far',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11',
              'type'        =>'decimal'
            ); 
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
  ?>
 
  <table  class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
   
<tr>
	<td align="left" ><strong>Producto: </strong></td>
	<td align="left"><?php echo form_input('codigo', "", 'required');?></td>
    <td align="left" ><strong>F.Inicial: </strong></td>
    <td><?php echo form_input($data_fec1, "", 'required');?></td>
    <td align="left" ><strong>F.Final: </strong></td>
    <td><?php echo form_input($data_fec2, "", 'required');?></td>
    
 </tr>
 <tr>
    <td align="left" ><strong>Oferta Laboratorio: </strong></td>
    <td><?php echo form_input($data_ofe_lab, "", 'required');?></td>
	<td align="left" ><strong>Oferta Farmacia: </strong></td>
    <td><?php echo form_input($data_ofe_far, "", 'required');?></td>
    <td></td>
    <td></td>
 </tr>   
   
<tr>
	<td colspan="6" align="center"><?php echo form_submit('envio', 'Grabar');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?>
</div>
</div>

                         <div class="widget blue">
                         <div class="widget-title">
                         <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
<!---->                          
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: left"></th> 
                                     <th style="text-align: left">Inicio</th> 
                                     <th style="text-align: left">Final</th>
                                     <th style="text-align: left">Laboratorio o mayorista</th>
                                     <th style="text-align: left">Codigo</th>
                                     <th style="text-align: right">Descripcion</th>
                                     <th style="text-align: right">% Oferta Lab</th>
                                     <th style="text-align: right">% Oferta Far</th>
                                     <th style="text-align: right">$ Far</th>
                                     <th style="text-align: right">$ Pub</th>
                                     <th style="text-align: right">$ Cos_Mar</th>
                                     <th style="text-align: right">$ Cos_Fan</th>
                                     <th style="text-align: right">% Util_Mar</th>
                                     <th style="text-align: right">% Util_Fan</th>
                                     <th ></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                if($r->activo==2){$l1='Oferta Validada '; $color='blue';$l0=' ';}else{
                                $l1= anchor('ofertas/borra_aferta/'.$r->id,'Borrar', 'class="button-link blue"');
                                $l0= anchor('ofertas/val_aferta/'.$r->id,'Val', 'class="button-link blue"');
                                $l2= anchor('ofertas/s_mod_aferta/'.$r->id,$r->codigo, 'class="button-link blue"');
                                $color='gray';
                                }
                                
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha2?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->labprv?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l2?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descripcion?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->ofe_lab,4)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->ofe_far,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->farmacia,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->pub,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cos_marzam,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cos_fanasa,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->util_marzam,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->util_fanasa,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                
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