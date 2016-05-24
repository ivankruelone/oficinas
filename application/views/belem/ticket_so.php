  <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
  <table> 
     <tr>
     <th><?php
                 echo form_open('belem/nuevo_ticket_submit');
                 
                 echo form_label('Titulo', 'titulo');
                 echo form_input('titulo', '');
                 
                 echo form_label('Correo', 'correo');
                 echo form_input('correo', '', 'required'); 
                 
                 echo form_label('Mensaje', 'mensaje');
                 echo form_textarea('mensaje', '', 'required');
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
