                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                          <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
  <!--FORMA-->
  
 <?php
 if($nivel!=94){
	$atributos = array('id' => 'subir_pendientes');
    echo form_open('pendientes/subir_pendientes', $atributos);
    
    $fecha1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );
    
    
  ?>
 
  <table>
<tr>

<tr>    
    <td align="left" ><font size="+1">Responsable.: </font></td>
   	<td align="center"><?php echo form_dropdown('res', $res, '', 'id="res"') ;?> </td>
 </tr>
 <tr>
    <td align="left" ><font size="+1">Pendiente.: </font></td>
    <td align="center"><input type="text" name="pen" id="pen" value=""/></td>
</tr>
<tr>
    <td align="left" ><font size="+1">Fecha Compromiso.: </font></td>
    <td align="center"><?php echo form_input($fecha1, "", 'required'); ?></td>
    <td align="right" ><font size="+1">'AAAA-MM-DD'</font></td>
</tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'GUARDAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
    }else{}
  ?> 
  <!-- FORMA-->                        
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 
                                     <tr>
                                        <th>#</th>
                                        <th>Area</th>
                                        <th>Responsable</th>
                                        <th>Pendientes</th>
                                        <th>Fecha Limite de Entrega</th>
                                        <th>Dias de Retraso</th>
                                        <th>Observaci&oacute;n</th>
                                        
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $num=0;
                                foreach ($a as $r){
                               $num=$num+1;
                               if($nivel!=94){
                               $l1 = anchor('pendientes/validar_pendiente/'.$r['id'], '<img src="'.base_url().'img/icon_event.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
                               $l0 = anchor('pendientes/cambia_pendiente/'.$r['id'],$r['fecha_comp'].'</a>', array('title' => 'Haz Click aqui para validar!', 'class' => 'encabezado'));
                                }else{
                                    
                               $l1 = null;
                               $l0 = $r['fecha_comp'];     
                                }
                                
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $num.'<br />'.$l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r['area']?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r['responsable']?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r['pendientes']?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $l0?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r['diasr']?></td>
                                <td>
                               <table>
                               <?php 
                               foreach ($r['segundo'] as $r1)
                               {
                                ?>
                               
                               <tr>
                               <td style="text-align: left"><?php echo $r1['fec']?></td>
                               <td style="text-align: left"><?php echo $r1['observa']?></td>
                               <td style="color:<?php echo $color?>; text-align: center"><?php echo $r1['libe']?></td>
                               </tr>
                               <?php 
                                
                               
                                } ?>
                                </table> 
                               </td></tr>
                              <?php  } ?>
                              </tbody>
                              
                         </table>   
                            
                            
                         </div>
                     </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 