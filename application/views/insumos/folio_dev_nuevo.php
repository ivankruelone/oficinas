  <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Nuevos insumos</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
  <?php
    echo form_open('insumos/inserta_folio_devoluciones');
  ?>
   <table>
  <tr>
    <td align="left" ><font size="+1"><strong>Sucursal: </strong></font></td>
    <td align="left" > <?php echo form_dropdown('suc', $suc, " ", "id='suc'");?></td>
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