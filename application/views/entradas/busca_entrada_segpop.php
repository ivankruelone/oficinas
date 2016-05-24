<div class="span6" >
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo;?></h4>
                           <span class="tools">
                           <a class="icon-chevron-down" href="javascript:;"></a>
                           <a class="icon-remove" href="javascript:;"></a>
                           </span>
                         </div>
                         <div class="widget-body form">
                       
                         
                         
                      
                         <?php
	
    echo form_open('entradas/busca_entrada_segpop_submit', array('class' => 'form-horizontal', 'id' => 'busca_entrada_cedis')); ?>  
        
       <div class="control-group">
                                    <label class="control-label">Inicio:</label>

                                    <div class="controls">
                                        <div class="input-append date" id="dpYears" data-date="2014-04-01"
                                             data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                            <input class="m-ctrl-medium" id="perini" name="perini" size="16" type="text" value="" readonly>
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                    <br />
                                    <label class="control-label">Fin:</label>

                                    <div class="controls">
                                        <div class="input-append date" id="dpYears1" data-date="2014-04-01"
                                             data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                            <input class="m-ctrl-medium" id="perfin" name="perfin" size="16" type="text" value="" readonly>
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                    <br />
                                    
                                    <label class="control-label">Tipo</label>
                                    <div class="controls">
                                        <select class="input-large m-wrap" tabindex="1" id="tipo" name="tipo">
                                        <option value=" ">Selecciona una opci&oacute;n</option>
                                            <option value="agu">Aguascalientes</option>
                                            <option value="alm">Almacen segpop</option>
                                            <option value="ban">Bansefi</option>
                                            <option value="cht">Chetumal</option>
                                            <option value="con">Controlados</option>
                                            <option value="dur">Durango</option>
                                            <option value="edo">Estado de Mexico</option>
                                            <option value="esp">Especialidad</option>
                                            <option value="tep">Tepic</option>
                                            <option value="ver">Veracruz</option>
                                            <option value="zac">Zacatecas</option>
                                        </select>
                                    </div>
                                <br />
                                <label class="control-label">Proveedor</label>
                                <div class="controls">
                                    <input type="text" class="span6 " id="prove" name="prove" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="" />
                                </div>
                                    <br />
                                <label class="control-label">Clave</label>
                                <div class="controls">
                                    <input type="text" class="span6 " id="clave" name="clave" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="" />
                                </div>
                                
                                    <br />
                                <label class="control-label">Lote</label>
                                <div class="controls">
                                    <input type="text" class="span6" id="lot" name="lot" />
                                </div>
                               
        
    </div> 
    
                                <div class="form-actions">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="button" class="btn">Cancel</button>
                                </div>        
  <?php
	echo form_close();
  ?>              
                             
                    
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>