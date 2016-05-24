  <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Nuevos insumos</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<table> 
<tr>

            <th>    <?php
              
                 echo form_open('catalogos/s_cat_insumos_nuevo_submit');
                 
                 echo form_label('Descripcion', 'descripcion');
                 echo form_input('descripcion', '', 'required');
                 
                 echo form_label('Empaque', 'empaque');
                 echo form_input('empaque', '', 'required'); 
                 
                 echo form_label('Costo', 'costo');
                 echo form_input('costo', '', 'required');
                 
                 echo form_label('Maximo', 'maximo');
                 echo form_input('maxi', '', 'required');
                 
                 
                 echo form_label('Observaciones', 'observaciones');
                 echo form_input('observa', '', 'Observaciones', 'observaciones',6);

                ?> </th>
</tr>
</table>
<table>
 <tr>
 <?php
                         
                 echo "<br />";
                 echo "<br />"; 
                 echo form_submit('mysubmit', 'Agregar');
                 echo "<br />";
                 echo "<br />";
                 echo form_close();
 ?>
 </tr>
</table>
          </div>	
     </div>
   </div>
