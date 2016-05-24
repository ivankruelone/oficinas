<?php
	$row = $query->row();
?>		
<div class="span8">
<!-- BEGIN BLANK PAGE PORTLET-->
         <div class="widget blue">
         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Modificar insumos</h4>
         <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
         </span>
         </div>
         <div class="widget-body">
        
<?php
   
	echo form_open('catalogos/s_cat_insumos_edita_submit');
 ?>                                      
         <table> 
            <tr>
            <th>    
            <?php
                                                         
                 echo form_label('Descripcion', 'descripcion');
                 echo form_input('descripcion', $row->descripcion, 'class= "mensaje" required'); 
               
                 echo form_label('Empaque', 'empaque');
                 echo form_input('empaque',$row->empaque, 'class= "mensaje" required');
               
                 echo form_label('Costo', 'costo');
                 echo form_input('costo',$row->costo, 'class= "mensaje" required');
             
                 echo form_label('Maximo', 'maximo');
                 echo form_input('maxi',$row->maxi, 'class= "mensaje" required'); 
                 
                 echo form_label('Observaciones', 'observaciones');                                    
                 echo form_input('observa',$row->observa);
             ?>
</th>
</tr>
</table>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla3">
 <thead>
                               <tr>
                               <th style="text-align: left;">Activo en Sucursal </th>
                               <th style="text-align: left;">Activo en Departamento</th>
                               <th style="text-align: left;">Activo en Medico</th>
                               <th style="text-align: left;">Insumo Activo</th>
                               <th style="text-align: left;">Insumo Activo<br />Ped.Especial</th>
                               </tr>  
 </thead>
 <tbody>
                                 <?php
                                 foreach($query->result() as $row){
                                 if($row->activo == 0)
                                                {
                                                    $valor = FALSE;
                                                }else{
                                                    $valor = TRUE;
                                                }
                                                
                                                $data1 = array(
                                                    'name'    => 'suc',
                                                    'value'   => 1,
                                                    'checked' => $row->suc,
                                                    'style'   => 'margin:10px',
                                                    );
                                    
                                                $data2 = array(
                                                    'name'    => 'depto',
                                                    'value'   => 1,
                                                    'checked' => $row->depto,
                                                    'style'   => 'margin:10px',
                                                    );
                                                
                                                $data3 = array(
                                                    'name'    => 'activo',
                                                    'value'   => 1,
                                                    'checked' => $row->activo,
                                                    'style'   => 'margin:10px',
                                                    );
                                                    
                                                $data4 = array(
                                                    'name'    => 'medico',
                                                    'value'   => 1,
                                                    'checked' => $row->medico,
                                                    'style'   => 'margin:10px',
                                                    );
                                                $data5 = array(
                                                    'name'    => 'ped_especial',
                                                    'value'   => 1,
                                                    'checked' => $row->ped_especial,
                                                    'style'   => 'margin:10px',
                                                    );

                                 ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo form_checkbox($data1); ?></td>
                                   <td style="text-align: left;"><?php echo form_checkbox($data2); ?></td>
                                   <td style="text-align: left;"><?php echo form_checkbox($data4); ?></td>
                                   <td style="text-align: left;"><?php echo form_checkbox($data3); ?></td>
                                   <td style="text-align: left;"><?php echo form_checkbox($data5); ?></td>
                                 </tr> 
                                                                             
                             <?php
                             
                                } 
                                
                                ?> 
                              </tbody>
</table>
<table>
 <tr>
 <?php
        echo form_hidden('id_insumos', $id_insumos); //hidden recaptura el id para poderlo modificar
                         
                 echo "<br />";
                 echo "<br />"; 
                 echo form_submit('mysubmit', 'Aceptar');
                 echo "<br />";
                 echo "<br />";
                 echo form_close();
 ?>
 </tr>
</table>
                                    
								</div>	
                            </div>
                            
        </div>	
   