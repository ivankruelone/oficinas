<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <?php
	                           $atributos = array('id' => 'busca_submit');
                               echo form_open('medicos/muestra_medicos2',$atributos);
                               $data_bus = array(
                                'name'        => 'bus',
                                'id'          => 'bus',
                                'value'       => '',
                                'maxlength'   => '10',
                                'size'        => '10'
                                );
                         ?>
                     <table>
                         <tr>
	                       <td align="left" ><font size="+1">Busqueda: </font></td>
                           <td align="left"><?php echo form_input($data_bus, '', 'required') ;?> </td>
                           <td align="left"><?php echo form_dropdown('busca1', $busca, '', 'id="busca1"') ;?> </td> 
                           <td align="left"><?php echo form_dropdown('busca2', $busca, '', 'id="busca2"') ;?> </td>
                           <td align="left"><?php echo form_dropdown('busca3', $busca, '', 'id="busca3"') ;?> </td>
                           <td> 
                            <?php  echo form_submit('busca','Buscar'); ?>
                           </td>
                        </tr>
                    </table>
                <?php echo form_close(); ?> 
                <?php echo anchor('medicos/medico_nuevo/','Medico Nuevo');?>
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">ID M&eacute;dico</th>
                                    <th style="text-align: center;">C&eacute;dula</th>
                                    <th style="text-align: center;">Apellido Paterno</th>
                                    <th style="text-align: center;">Apellido Materno</th>
                                    <th style="text-align: center;">Nombre</th>
                                    <th style="text-align: center;">Especialidad</th>
                                    <th style="text-align: center;">Direcci&oacute;n</th>
                                    <th style="text-align: center;">Colonia</th>
                                    <th style="text-align: center;">T&eacute;lefono</th>
                                    <th style="text-align: center;">N&uacute;mero De Cuenta</th>                                    
                                    <th style="text-align: center;">Acci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->id_med; ?></td>
                                    <td style="text-align: center;"><?php echo $row->cedula; ?></td>
                                    <td style="text-align: center;"><?php echo $row->apaterno; ?></td>
                                    <td style="text-align: center;"><?php echo $row->amaterno; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nombre; ?></td>
                                    <td style="text-align: center;"><?php echo $row->especialidad; ?></td>
                                    <td style="text-align: center;"><?php echo $row->dire; ?></td>
                                    <td style="text-align: center;"><?php echo $row->col; ?></td>
                                    <td style="text-align: center;"><?php echo $row->telefono; ?></td>
                                    <td style="text-align: center;"><?php echo $row->numero_cuenta; ?></td>
                                    <td style="text-align: center;"><?php echo anchor('medicos/edita_medico/'.$row->id_med, 'Editar');
                                              echo '<br />';
                                              echo anchor('medicos/borra_medico/'.$row->id_med, 'Desactivar medico'); ?></td>
                                    
                                </tr>
                                <?php
                                  }      
                                ?>
                            </tbody>
                         </table>
<!---->
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->  
                 </div>