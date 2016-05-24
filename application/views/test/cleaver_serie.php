            <div class="row-fluid">
                <div class="span6">
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i><?php echo $titulo; ?></h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                        
                        
                        
                        
                            
                            <?php
                            
                            echo form_open('test/cleaver', array('id' => 'cleaver'));
                            
                            echo form_hidden('control', $control);
                                    
                            $num=0;
                            
                            foreach ($series->result()as $serie){
                                
                                $this->db->where('serie', $serie->serie);
                                $q = $this->db->get('test.cleaver_pregunta');
                               
                            ?>
                            
                            <h2>Serie <?php echo $serie->serie; ?></h2>
                            
                        <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th style="text-align: center; width: 60%;">Palabras</th>
                                <th style="text-align: center; width: 20%;">Mas</th>
                                <th style="text-align: center; width: 20%;">Menos</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            
                            <?php foreach($q->result() as $r){?>

                            <tr class="odd gradeX">
                                <td style="text-align: left;"><?php echo $r->texto?></td>
                                <td style="text-align: center;"><input type="radio" name="mas_<?php echo $serie->serie; ?>" class="checkboxes" value="<?php echo $r->pregunta; ?>" required /></td>
                                <td style="text-align: center;"><input type="radio" name="menos_<?php echo $serie->serie; ?>"  class="checkboxes" value="<?php echo $r->pregunta; ?>" required /></td>
                            </tr>
                            
                            <?php }?>
                            
                            </tbody>
                                </table>
                            <?php
                                    
                           	}
                            
                            ?>
                            
                        
                        <div class="clock" style="margin:2em;"></div>
                        <div id="message"></div>
                        <br />
                        
                        <div class="form-actions" style="text-align: center;">
                        
                            <button class="btn blue" type="submit">
                                <i class="icon-ok"></i>
                        
                                 Terminar esta serie
                        
                            </button>
                        
                        </div>
                        
                        <?php
                        
                        echo form_close();
                        
                        ?>
                        
                        </div>
                    </div>
                </div>
            </div>
                        