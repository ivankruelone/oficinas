 <div class="span6" >
                     <!-- BEGIN SAMPLE FORMPORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body form">
                       
                         
                         
                       
                                                   <?php

    echo form_open('mantenimiento/consultas_mensual_submit',  array('class' => 'form-horizontal'));
  ?>
  
  <div class="control-group">
                                <label class="control-label">Inicio:</label>

                                    <div class="controls">
                                        <div class="input-append date" id="dpYears" data-date="2016-03-01"
                                             data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                            <input class="m-ctrl-medium" id="dpYears" name="dpYears" size="16" type="text" value="" readonly>
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                    <br />
                                    <label class="control-label">Fin:</label>

                                    <div class="controls">
                                        <div class="input-append date" id="dpYears1" data-date="2016-03-01"
                                             data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                            <input class="m-ctrl-medium" id="dpYears1" name="dpYears1" size="16" type="text" value="" readonly>
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                    <br />
                                
                                
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
                 