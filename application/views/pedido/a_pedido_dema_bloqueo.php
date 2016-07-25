                 <div class="span11">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         
<!---->
                          
<?php
//$l1=anchor('ofertas/a_bloqueos_codigos_excel','Archivo en Excel');
	$atributos = array('id' => 'sumit_pedido_dema_bloqueo');
    echo form_open('pedido/sumit_pedido_dema_bloqueo', $atributos);


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
  ?>
                            <div class="widget-body">   
                            <table> 
                            <tr>
                                <td>Fecha inicio:</td> 
                                <td><?php echo form_input($data_fec1, "", 'required');?></td>
                                <td>Fecha Fin:</td>
                                <td colspan="4"><?php echo form_input($data_fec2, "", 'required');?></td>
                            </tr> 
                            <tr>
                            <td colspan="4" align="center"><?php echo form_submit('envio', 'Bloquear productos');?></td>
                            </tr>
                               </table>
                            <input type="hidden" value="<?php echo $id?>" name="id" id="id" />
  <?php
 
	echo form_close();
  ?>

<!---->
                                               
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                              
                                 <tr>
                                     <th>#</th>
                                     <th style="text-align: left">Codigo</th>
                                     <th style="text-align: left">Descripcion</th>
                                     <th style="text-align: right">Pharmacy 1</th>
                                     <th style="text-align: right">Pharmacy 2</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $num=0;
                                foreach ($q->result()as $r){
                                $num=$num+1;    
                                //$l1=anchor('ofertas/borrar_bloqueo_t/'.$r->id,'Borrar');
                               
                                
                                ?>
                                <tr>
                                <td><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->codigo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descri?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->rel1?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->rel2?></td>
                                
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