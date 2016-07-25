<div class="span5">
<!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<div align="center">

<?php
    echo form_open('proveedor/a_evaluacion_prv');
     
    $data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'size'        => '10',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
      
                );
    
    $data_fec2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'size'        => '10',
              'type'        => 'text',
              'required'    => 'required'
     
                 );
                 
    
    ?>
<table>
<tr>
	<td align="left" ><font size="+1"><strong>Fecha inicial: </strong></font></td>
    <td align="left"> <?php echo form_input($data_fec1, ""); ?></td>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>Fecha final: </strong></font></td>
    <td align="left"> <?php echo form_input($data_fec2, ""); ?></td>
</tr>

</table>

	<input type="submit" value="ACEPTAR" class="button-link blue" />

    

<?php
	echo form_close();
?>

                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>