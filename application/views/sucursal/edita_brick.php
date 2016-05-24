 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4>EDITA BRICK  <?php echo $suc; ?> <?php echo $nombre; ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
  <?php
	$atributos = array('sucursal' => 'edita_brick');
    echo form_open('sucursal/actualiza_brick', $atributos);
    
    $data_brick1300 = array(
              'name'        => 'brick1300',
              'id'          => 'brick1300',
              'type'        => 'text',
              
              
                );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
    <td align="left" ><font size="+1"><strong>Brick </strong></font></td>
    <td align="left"> <?php echo form_input($data_brick1300, "", 'required'); ?></td>
</tr>
    <td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
</table>
  <?php
    echo form_hidden('suc', $suc);
	echo form_close();
  ?>
  
  <div>
  
  
  
  </div>

  </div>
  
  </div>
  </div>