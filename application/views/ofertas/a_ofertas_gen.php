                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
<?php
	$atributos = array('id' => 'sumit_aferta_gen');
    echo form_open('ofertas/sumit_aferta_gen', $atributos);
$data_precio_oferta = array(
              'name'        => 'pre_ofe',
              'id'          => 'pre_ofe',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11',
              'type'        =>'decimal'
            );
$data_sec = array(
              'name'        => 'sec',
              'id'          => 'sec',
              'value'       => '',
              'maxlength'   => '4',
              'size'        => '4'
            ); 
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
$data_incentivo = array(
              'name'        => 'incentivo',
              'id'          => 'incentivo',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            ); 
  ?>
                            <table> 
                                    <tr>
                                    <td>Secuencia</td>
                                    <td colspan="2" style="width:5%"><?php echo form_input($data_sec, 'required'); ?></td>
                                    <td colspan="4"><select name="codigo" id="codigo" style="width:100%"></select></td>
                                    </tr>
                                    <tr> 
                                    <td>Inicia</td>
                                    <td><?php echo form_input($data_fec1, 'required'); ?></td>
                                    <td>Finaliza</td>
                                    <td><?php echo form_input($data_fec2, 'required'); ?></td>
                                    <td colspan="3"></td>
                                    </tr>
                                    <tr>
                                    <td>Precio Oferta</td>
                                    <td><?php echo form_input($data_precio_oferta, 'required'); ?></td>
                                    <td>Insentivo</td>
                                    <td><?php echo form_input($data_incentivo, 'required'); ?></td>
                                    <td colspan="3"></td>
                                    </tr>
                                    <tr>
	                                   <td align="left" ><font size="+1">PAGO: </font></td>
                                        <td align="left"> 
                                         <select name="tipo" id="tipo">
                                            <option value="NOMINA"> <?php if($tipo=='NOMINA')?>NOMINA</option>
                                        <option value="VALES"> <?php if($tipo=='VALES')?><strong>VALES</strong></option>
                                     </select>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td colspan="7" align="center"><?php echo form_submit('envio', 'Grabar');?></td>
                                    </tr>
                                    <tr>
                                    <td colspan="7" style=" color: red;">Si va a aplicar incentivo por nomina; deber&aacute; estar respaldado por memorandum; de lo contrario no aplicara el movimiento en la nomina</td>
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
                                     <th style="text-align: left">Inicio</th> 
                                     <th style="text-align: left">Final</th>
                                     <th style="text-align: left">Sec</th>
                                     <th style="text-align: left">Codigo</th>
                                     <th style="text-align: right">Descripcion</th>
                                     <th style="text-align: right">Precio Oferta</th>
                                     <th style="text-align: right">Incentivo</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                $l1=anchor('ofertas/borrar_oferta_gen/'.$r->id,'Borrar');
                               
                                
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha_activos?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha_fin?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->codigo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descripcion?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->precio_oferta,4)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->insentivo,2)?></td>
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