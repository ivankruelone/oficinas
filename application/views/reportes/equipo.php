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
                        	echo form_open('reportes/reporte_equipo');
                            echo "<br />";
                            
                            $c = array();
                            
                            for($k = 1; $k <= 12; $k++)
                            {
                                $c[str_pad($k, 2, '0', STR_PAD_LEFT)] = str_pad($k, 2, '0', STR_PAD_LEFT);
                            }
                            
                            $b = array();
                            
                            for($j = 2013; $j <= 2015; $j++)
                            {
                                $b[str_pad($j, 4, '0', STR_PAD_LEFT)] = str_pad($j, 4, '0', STR_PAD_LEFT);
                            }
                           
                            echo form_label('Mes: ', 'mes', array('class' => 'label label-important'));
                            echo "<br />";
                            echo form_dropdown('mes', $c, date('M'), 'id="mes"');
                            echo "<br />";
                            echo form_label('A&ntilde;o: ', 'anio', array('class' => 'label label-important'));
                            echo "<br />";
                            echo form_dropdown('anio', $b, date('Y'), 'id="anio"', 'class="dropdown-menu"');
                            echo "<br />";
                            echo form_submit('mysubmit', 'Generar!', 'class="btn btn-large btn-primary"');
                            echo form_close();
                            
                        ?>
                        
                        </div>       
                       
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>