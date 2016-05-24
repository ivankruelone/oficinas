                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                         <div class="widget orange">
                         <div class="widget-title">
                         <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
<!---->

<?php 
	$atributos = array('id' => 'sumit_ofertas_corta_caducidad_gral');
    echo form_open('ofertas/sumit_ofertas_corta_caducidad_gral', $atributos);
  
  
$data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10'
            ); 
  $data_fec2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10'
            ); 
$data_mas = array(
              'name'        => 'mas',
              'id'          => 'mas',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            ); 
  ?>
 
  <table>
 <tr>
	<td align="left" ><strong>Fecha Inicial: </strong></td>
    <td><?php echo form_input($data_fec1, "", 'required');?></td>
    <td align="left" ><strong>Fecha Final: </strong></td>
    <td><?php echo form_input($data_fec2, "", 'required');?></td>
 
    <td align="left" ><strong>Costo: </strong></td>
    <td align="left" colspan="1"> 
    <select name="tipo" id="tipo">
    <option value=" " <?php if($tipo==' ') echo "Selected"?> >Selecciona tipo</option>
    <option value="1" <?php if($tipo=='1') echo "Selected"?> >Costo PDV</option>
    <option value="2" <?php if($tipo=='2') echo "Selected"?> >Costo Catalogo</option>
    </select>
    </td>
    </tr>
 <tr>  
    <td align="left" ><strong>Mas: %</strong></td>
    <td><?php echo form_input($data_mas, "", 'required');?></td>
	<td colspan="4" align="center"><?php echo form_submit('envio', 'Grabar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
  <?php
 
	echo form_close();
  ?>                          
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: left"></th> 
                                     <th style="text-align: left">Codigo</th> 
                                     <th style="text-align: left">Descripcion</th>
                                     <th style="text-align: left">caduciad</th>
                                     <th style="text-align: left">Costo PDV</th>
                                     <th style="text-align: left">Publico PDV</th>
                                     <th style="text-align: left">Cantidad</th>
                                     <th style="text-align: left">Costo Catalogo</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                
                                foreach ($q->result()as $r){
                                $l0= anchor('ofertas/s_ofertas_corta_caducidad_det_cos/'.$id_cc.'/'.$r->id,'Menor al costo', 'class="button-link blue"');
                                $l1= anchor('ofertas/s_ofertas_corta_caducidad_bor_det/'.$id_cc.'/'.$r->id,'Borrar', 'class="button-link blue"');
                                if($r->costo_pdv==0 or $r->costo_catalogo==0){$color='red';}else{$color='gray';}
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->codigo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descripcion?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->cadu?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo number_format($r->costo_pdv,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo number_format($r->pub_pdv,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo number_format($r->cantidad,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo number_format($r->costo_catalogo,2)?></td>
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
                     <!-- BEGIN BLANK PAGE PORTLET-->
                         <div class="widget blue">
                         <div class="widget-title">
                         <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
<!---->                          
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                                 <tr>
                                     <th style="text-align: left">Codigo</th> 
                                     <th style="text-align: left">Descripcion</th>
                                     <th style="text-align: left">Caduciad</th>
                                     <th style="text-align: right">Cantidad</th>
                                     <th style="text-align: right">Costo</th>
                                     <th style="text-align: right">Publico</th>
                                     <th style="text-align: right">Precio Oferta</th>
                                     <th style="text-align: right">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;$tot=0;
                                foreach ($q1->result()as $r1){
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->codigo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->descripcion?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->cadu?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r1->cantidad,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo number_format($r1->costo,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r1->pub,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r1->oferta,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format(($r1->oferta*$r1->cantidad),2)?></td>
                                
                                </tr>
                               <?php
                               $tot=$tot+($r1->cantidad*$r1->oferta); 
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($tot,2)?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>