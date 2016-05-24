                 <div class="span6">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-edit"></i> <?php echo $titulo; ?> </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body form">
                             <?php
                             
                             echo form_open('desplazamientos/s_diarias_sem_det', array('class' => 'form-horizontal'));
                             
                             
                             
                             

                             ?>
                             <div class="control-group">
                                
                                <label class="control-label">Elige una fecha inicial: </label>
                                <div class="controls">
                                    <td align="left"><?php echo form_dropdown('fecha', $fecha, '', 'id="fecha"') ;?> </td>
                                </div>
                                
                             </div>
                             <div class="form-actions">
                                <button type="submit" class="btn btn-success">Aceptar</button>
                            </div>                             
                             <?php
                             echo form_close();
                             
                             ?>
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>