                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
	$atributos = array('id' => 'sumit_clasifica_masiva');
    echo form_open('catalogos/sumit_clasifica_masiva', $atributos);
   
    $data_sec = array(
              'name'        => 'sec',
              'id'          => 'sec',
              'value'       => '',
              'maxlength'   => '255',
              'size'        => '10'
              
            );
    $data_cla = array(
              'name'        => 'cla',
              'id'          => 'cla',
              'value'       => '',
              'maxlength'   => '1',
              'size'        => '1'
              
            );
   
  ?>
 
  <table>

    <tr>
    <td align="left" ><font size="+1"><strong>Secuencias: </strong></font></td>
    <td><?php echo form_input($data_sec, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Clasificacion:</strong></font></td>
    <td><?php echo form_input($data_cla, "", 'required');?></td>
    </tr>
   
<tr>
	<td colspan="8" align="center"><?php echo form_submit('envio', 'Cambiar');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>Sec</th>
                                     <th>Clasificacion</th>
                                     <th>Sustancia Activa</th>
                                     <th>Descon</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->sec?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->tipo?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->susa?></td>
                                        <td style="text-align: center; color: <?php echo $color ?>"><?php echo $r->descon?></td>
                                        </tr>
                                       <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             </tfoot>
                         </table>                        

<!---->

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
