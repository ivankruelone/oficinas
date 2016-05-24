 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Buscar existencia </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

                             <?php 
                               	$atributos = array('id' => 'buscar');
    echo form_open('mercadotecnia/producto_bus_codi', $atributos);
    $cod = array(
              'name'        => 'codigo',
              'id'          => 'codigo',
              'value'       => '',
              'maxlength'   => '14',
              'size'        => '14'
              
            );
    ?>

<tr>
    <td align="left" ><font size="+1"><strong>Buscar codigo: </strong></font></td>
	<td><?php echo form_input($cod, "", 'required');?></td>
    <td colspan="8" align="center"><?php echo form_submit('envio', 'Buscar');?></td>
    </tr>
                         
                                <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                               <tr>
                               <th style="text-align: left;">NID</th>
                               <th style="text-align: left;">SUCURSAL</th>
                               <th style="text-align: left;">CODIGO</th>
                               <th style="text-align: left;">DESCRIPCION</th>
                               <th style="text-align: left;">EXISTENCIA</th>
                               <th style="text-align: left;">FECHA</th>
                               
                               </tr>  
                             </thead>
                             <tbody>
                             
                                  <?php
                                 $num=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                 ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->suc?></td>
                                   <td style="text-align: left;"><?php echo $r->nombre?></td>
                                   <td style="text-align: left;"><?php echo $r->codigo?></td>
                                   <td style="text-align: left;"><?php echo $r->descripcion1?></td>
                                   <td style="text-align: left;"><?php echo $r->cantidad?></td>
                                   <td style="text-align: left;"><?php echo $r->fechai?></td>                                  
                                
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