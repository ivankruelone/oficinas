                    <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                          <h4></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    <tr>
                                    <th colspan="15" style="color: blue; text-align: center;">COMPARATIVO CONSULTAS MEDICAS 2015</th>
                                    </tr>
                                     <tr>
                                        <th>#</th>
                                        <th>Sucursal</th>
                                        <th>1ra Ene</th>
                                        <th>2da Ene</th>
                                        <th>1ra Feb</th>
                                        <th>2da Feb</th>
                                        <th>1ra Mar</th>
                                        <th>2da Mar</th>
                                        <th>1ra Abr</th>
                                        <th>2da Abr</th>
                                        <th>1ra May</th>
                                        <th>2da May</th>
                                        <th>1ra Jun</th>
                                        <th>2da Jun</th>
                                        <th>1da Jul</th>
                                        <th>2da Jul</th>
                                        <th>1da Ago</th>
                                        <th>2da Ago</th>                                    
                                     </tr>
                             </thead>
                                      <tbody>
                             
                                <?php
                                
                               $num=0;
                               $numero = $s->num_rows();
                               
                               $consultorios0101 = 0;
                               $consultorios0102 = 0;
                               $consultorios0201 = 0;
                               $consultorios0202 = 0;
                               $consultorios0301 = 0;
                               $consultorios0302 = 0;
                               $consultorios0401 = 0;
                               $consultorios0402 = 0;
                               $consultorios0501 = 0;
                               $consultorios0502 = 0;
                               $consultorios0601 = 0;
                               $consultorios0602 = 0;
                               $consultorios0701 = 0;
                               $consultorios0702 = 0;
                               $consultorios0801 = 0;
                               $consultorios0802 = 0;
                                                              
                               $consulta0101 = 0;
                               $consulta0102 = 0;
                               $consulta0201 = 0;
                               $consulta0202 = 0;
                               $consulta0301 = 0;
                               $consulta0302 = 0;
                               $consulta0401 = 0;
                               $consulta0402 = 0;
                               $consulta0501 = 0;
                               $consulta0502 = 0;
                               $consulta0601 = 0;
                               $consulta0602 = 0;
                               $consulta0701 = 0;
                               $consulta0702 = 0;
                               $consulta0801 = 0;
                               $consulta0802 = 0;
                               
                               foreach ($s->result()as $r){
                                $num=$num+1;
                                $consul=$s->num_rows($r);
                                
                                
                               ?>
                               
                                <tr>
                                <td style="text-align: center;"><?php echo $num?></td>
                                <td style="text-align: center"><?php echo $r->suc.' '.$r->nombre?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0101, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0102, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0201, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0202, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0301, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0302, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0401, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0402, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0501, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0502, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0601, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0602, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0701, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0702, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0801, 0)?></td>
                                <td style="text-align: left"><?php echo number_format($r->consultas0802, 0)?></td>
                                </tr>
                               <?php 
                                                                                           
                                                                                            
                               if($r->consultas0101 > 0)
                               {
                                $consultorios0101 = $consultorios0101 + 1;
                               }
                               
                               if($r->consultas0102 > 0)
                               {
                                $consultorios0102 = $consultorios0102 + 1;
                               }
                               if($r->consultas0201 > 0)
                               {
                                $consultorios0201 = $consultorios0201 + 1;
                               }
                               
                               if($r->consultas0202 > 0)
                               {
                                $consultorios0202 = $consultorios0202 + 1;
                               }
                               
                               if($r->consultas0301 > 0)
                               {
                                $consultorios0301 = $consultorios0301 + 1;
                               }
                               
                               if($r->consultas0302 > 0)
                               {
                                $consultorios0302 = $consultorios0302 + 1;
                               }
                               
                               if($r->consultas0401 > 0)
                               {
                                $consultorios0401 = $consultorios0401 + 1;
                               }
                               
                               if($r->consultas0402 > 0)
                               {
                                $consultorios0402 = $consultorios0402 + 1;
                               }
                               
                               if($r->consultas0501 > 0)
                               {
                                $consultorios0501 = $consultorios0501 + 1;
                               }
                               
                               if($r->consultas0502 > 0)
                               {
                                $consultorios0502 = $consultorios0502 + 1;
                               }
                               
                               if($r->consultas0601 > 0)
                               {
                                $consultorios0601 = $consultorios0601 + 1;
                               }
                               
                               if($r->consultas0602 > 0)
                               {
                                $consultorios0602 = $consultorios0602 + 1;
                               }
                               
                               if($r->consultas0701 > 0)
                               {
                                $consultorios0701 = $consultorios0701 + 1;
                               }
                               
                               if($r->consultas0702 > 0)
                               {
                                $consultorios0702 = $consultorios0702 + 1;
                               }
                               
                               if($r->consultas0801 > 0)
                               {
                                $consultorios0801 = $consultorios0801 + 1;
                               }
                               
                               if($r->consultas0802 > 0)
                               {
                                $consultorios0802 = $consultorios0802 + 1;
                               }
                               
                                                              
                               $consulta0101= $consulta0101+$r->consultas0101;
                               $consulta0102= $consulta0102+$r->consultas0102;
                               $consulta0201= $consulta0201+$r->consultas0201;
                               $consulta0202= $consulta0202+$r->consultas0202;
                               $consulta0301= $consulta0301+$r->consultas0301;
                               $consulta0302= $consulta0302+$r->consultas0302;
                               $consulta0401= $consulta0401+$r->consultas0401;
                               $consulta0402= $consulta0402+$r->consultas0402;
                               $consulta0501= $consulta0501+$r->consultas0501;
                               $consulta0502= $consulta0502+$r->consultas0502;
                               $consulta0601= $consulta0601+$r->consultas0601;
                               $consulta0602= $consulta0602+$r->consultas0602;
                               $consulta0701= $consulta0701+$r->consultas0701;
                               $consulta0702= $consulta0702+$r->consultas0702;
                               $consulta0801= $consulta0801+$r->consultas0801;
                               $consulta0802= $consulta0802+$r->consultas0802;                        
                              
                                 } 
                                 
                              
                               
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: right" >TOTAL DE CONSULTORIOS</td>                                                            
                              <td style="text-align: left"><?php echo number_format($consultorios0101, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0102, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0201, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0202, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0301, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0302, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0401, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0402, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0501, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0502, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0601, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0602, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0701, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0702, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0801, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consultorios0802, 0)?></td>
                              </tr>
                              <tr>
                              <td colspan="2" style="text-align: right">TOTAL DE CONSULTAS</td>                              
                              <td style="text-align: left"><?php echo number_format($consulta0101, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0202, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0101, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0202, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0301, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0302, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0401, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0402, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0501, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0502, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0601, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0602, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0701, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0702, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0801, 0)?></td>
                              <td style="text-align: left"><?php echo number_format($consulta0802, 0)?></td>
                              </tr>
                             </tfoot>
                         </table>                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>