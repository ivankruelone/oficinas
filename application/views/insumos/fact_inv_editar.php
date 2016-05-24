<?php
	$row = $q->row();
?>		
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
        
<?php
   
	echo form_open('insumos/fact_inv_edita_submit');
 ?>                                      
         <table> 
            <tr>
            <th>    
            <?php
                                                         
                 echo form_label('Descripcion', 'descripcion');
                 echo form_label($row->descripcion); 
               
                 echo form_label('Precio', 'precio');
                 echo form_input('precio',$row->precio, 'class= "mensaje" required');
             
                 echo form_label('Cantidad', 'cantidad');
                 echo form_input('cantidad',$row->cantidad, 'class= "mensaje" required'); 
                 
                 echo form_label('I.V.A', 'iva');
                 echo form_input('iva',intval($row->iva * 100), 'class= "mensaje" required'); 
             ?>
</th>
</table>
<table>
 <tr>
 <?php
        echo form_hidden('folio', $folio);
        echo form_hidden('id_insumos', $id_insumos);
                         
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