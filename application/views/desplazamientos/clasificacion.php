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
                        	$atributos = array('id' => 'sup_form_pedidos_ger_for_nid');
                            echo form_open('desplazamientos/clasificacion_nid', $atributos);
                            //$var=null;
                          ?>
                         
                          <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                        
                        
                        <tr>
                        	<td center="left" ><font size="+1">CLASIFICACION: </font></td>
                          
                            <td align="left"> 
                            <select name="var" id="var">
                            <option value="0" <?php if($var=="''") echo "Selected"?> >Seleccione una clasificacion</option>
                            <option value="1" <?php if($var=="'a','b'") echo "Selected"?> >A y B</option>
                            <option value="2" <?php if($var=="'a','b','c'") echo "Selected"?> >A,B y C </option>
                            <option value="3" <?php if($var=="'a','b','c'.'d'") echo "Selected"?> >A,B,C y D </option>
                            <option value="4" <?php if($var=="'a','b','c','d','e'") echo "Selected"?> >A,B,C,D Y E </option>
                            
                            </select>
                            </td>
                        </tr>
                        
                            <td></td>
                        	<td colspan="2" class="btn btn-large btn-primary" type="button"><?php echo form_submit('envio', 'ACEPTAR');?></td>
                            
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