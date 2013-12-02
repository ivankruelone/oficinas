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
	$atributos = array('id' => 'agrega_lic');
    echo form_open('mercadotecnia/agrega_lic', $atributos);
    $data_nombre = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'value'       => '',
              'maxlength'   => '40',
              'size'        => '40',
              
              
            );
    
  
  ?>
 
  <table>

</table>
  <?php
 
	echo form_close();
  ?>

 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">Codigo</th>
                                 <th style="text-align: left">Clave</th>
                                 <th style="text-align: left">Sustancia Activa</th>
                                 <th style="text-align: left">Marca</th>
                                 <th style="text-align: left">Lab</th>
                                 <th style="text-align: left">Registro</th>
                                 <th style="text-align: left">A&ntilde;o Reg.</th>
                                 <th style="text-align: left">Costo</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$timp=0;$tcan=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                //$l0 = anchor('mercadotecnia/mer_genera_lic_b/'.$r->id,$r->nombre.'</a>', array('title' => 'Haz Click aqui para borrar!', 'class' => 'encabezado'));
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->codigo?></td>
                                   <td style="text-align: left;"><?php echo $r->clave?></td>
                                   <td style="text-align: left;"><?php echo $r->susa?></td>
                                   <td style="text-align: left;"><?php echo $r->marca?></td>
                                   <td style="text-align: left;"><?php echo $r->lab?></td>
                                   <td style="text-align: left;"><?php echo $r->registro?></td>
                                   <td style="text-align: left;"><?php echo $r->aaa_reg?></td>
                                    <td style="text-align: left;"><?php echo $r->costo?></td>
                                   </tr>
                               <?php } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td></td>
                              <td>TOTAL</td>
                              
                              <td></td>
                              
                              <td></td>
                              </tr>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>