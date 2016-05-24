       
                 <div class="span6" >
                     <!-- BEGIN SAMPLE FORMPORTLET-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body form">
                       
                         
                         
                       
                                                   <?php

    echo form_open('reportes/bitacora_submit',  array('class' => 'form-horizontal'));
  ?>
  
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
                                
                                <label class="control-label"> Tecnico</label>
                                <div class="controls">
                                    
                                      <?php echo form_dropdown('tecx', $tecx, '', 'id="tecx" class="span6 chzn-select" data-placeholder="Choose a Category" tabindex="1" ') ;?>  
                                        
                                </div>
  </div>
  
  <div class="form-actions">
                                <button type="submit" class="btn btn-success">Submit</button>
                                
  </div>
 
  
  <?php
	echo form_close();
  ?>

                        
                             
                       
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                 
