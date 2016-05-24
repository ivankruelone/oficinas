  <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                              <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<table> 
<tr>

            <th><?php
              
                 echo form_open('insumos/factura_nueva_submit');
                 
                 echo form_label('Folio de factura', 'folio');
                 echo form_input('folio', '', 'required');
                 
                 echo form_label('Proveedor', 'id_prov');
                 echo form_dropdown('id', $proveedor, " ", "id='id'"); 
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