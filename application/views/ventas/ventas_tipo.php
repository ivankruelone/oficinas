                <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-edit"></i> <?php echo $titulo; ?> </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body form">
                             <?php
                             
                             echo form_open('ventas/ventas_tipo_excel', array('class' => 'form-horizontal'));
                             
                             $fecha = array(
                                  'name'        => 'fecha',
                                  'id'          => 'fecha',
                                  'required'    => 'required'
                                );
                                
                             $fecha2 = array(
                                  'name'        => 'fecha2',
                                  'id'          => 'fecha2',
                                  'required'    => 'required'
                                );   
                             

                             ?>
                             <div class="control-group">
                                
                                <label class="control-label">Fecha Inicial: </label>
                                <div class="controls">
                                    <?php echo form_input($fecha);?>
                                </div>
                                
                             </div>
                             
                             <div class="control-group">
                                
                                <label class="control-label">Fecha Final: </label>
                                <div class="controls">
                                    <?php echo form_input($fecha2);?>
                                </div>
                                
                             </div>
                             
                             
                             <div class="control-group">

                                <label class="control-label">Elige Sucursal Imagen</label>
                                <div class="controls">
                                    <?php echo form_dropdown('tipo', $tipo, 'class="span6 chzn-select" data-placeholder="Escoge una sucursal" tabindex="1"');?>
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