                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                            <div class="span1">
                                
                                <?php
                                
                                echo form_open('lidia/subida_submit_depo', array('enctype' => 'multipart/form-data'));
                                
                                ?>
                                
                                Please choose a file: <input type="file" name="uploadFile" /><br />
                                <input type="submit" value="Subir archivo" />
                                
                                <?php
                                
                                echo form_close();
                                
                                ?>
                                
                                
                                </div>

                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                 </div>