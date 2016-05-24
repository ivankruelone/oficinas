<div class="span9">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: right">Nomina</th>
                                 <th style="text-align: left">Nombre</th>
                                 <th style="text-align: left">Sucursal</th>
                                 <th style="text-align: left">Nom. Sucursal</th>
                                 <th style="text-align: left">Puesto</th>
                                 <th style="text-align: center">Fecha Alta</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                             
                                foreach ($query->result()as $row) {
                                //$l1 = anchor('empleados/estatus_detalle/'.$nomina, '<img src="'.base_url().'img/tabla.jpg" border="0" width="60px" />', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                 $sucursal=$row->succ;
                                 $sql="select * from catalogo.sucursal where suc=$sucursal";
                                 $q = $this->db->query($sql);
                                 foreach ($q->result() as $r){
                                    
                                 
                                 ?>
                                
                                 <tr>
                                    <td style="color: gray;text-align: right;"><?php echo $row->nomina?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->completo?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->succ?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $r->nombre?></td>
                                    <td style="color: gray;text-align: left;"><?php echo $row->puestox?></td>
                                    <td style="color: gray;text-align: center;"><?php echo $row->fechahis?></td>                          
                                  </tr>
                               
                               <?php 
                               }
                               } 
                               
                               ?>
                              </tbody>
                              
                         </table>   
                            
                            
                         </div>
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                         
<div class="span5" >
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         
                        <div align="center">
                                                   <?php
	$atributos = array('id' => 'ventas_imp_gen');
    echo form_open('empleados/estatus_dias', $atributos);
    echo form_hidden('nomina', $nomina);
    $anio=array('2013'=>'2013',
                '2014'=>'2014');
    $mes=array( '1'=>'ENERO',
                '2'=>'FEBRERO',
                '3'=>'MARZO',
                '4'=>'ABRIL',
                '5'=>'MAYO',
                '6'=>'JUNIO',
                '7'=>'JULIO',
                '8'=>'AGOSTO',
                '9'=>'SEPTIEMBRE',
                '10'=>'OCTUBRE',
                '11'=>'NOVIEMBRE',
                '12'=>'DICIEMBRE'
    );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="left" ><font size="+1"><strong>A&Ntilde;O: </strong></font></td>
	<td align="left"><?php echo form_dropdown('aaa', $anio, '', 'id="aaa"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mes', $mes, '', 'id="mes"') ;?> </td>
 </tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>

                        
                        </div>       
                       
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>