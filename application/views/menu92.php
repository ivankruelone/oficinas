              <ul class="sidebar-menu">
              <?php $id_plaza=$this->session->userdata('id_plaza');
                    $id=$this->session->userdata('id');
              
              ?>
                  
                  <li class="sub-menu" id="menu_mer_reporte">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Mis Pendientes</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                         
                          <li id="menu_mer_pendientes"><?php echo anchor('pendientes/listado_personal', 'Concentrado de Pendientes'); ?></li>
                          <li id="menu_mer_pendientes"><?php echo anchor('pendientes/listado_validados_per/', 'Concentrado de Pendientes Validados'); ?></li>
                      </ul>
                  </li>
                  <?php
	                   if($id == 65)  {
                    ?>
                  <li class="sub-menu" id="menu_ventas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Ventas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_ventas_ventas_cortes_ger"><?php echo anchor('ventas/ventas_tickets', 'Tickets x Sucursal'); ?></li>
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_reportes">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Reportes</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_reportes"><?php echo anchor('reportes/salidas_equipos', 'Salidas de Equipos'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('reportes/salidas_equipos1', 'Salidas de Accesorios'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('reportes/entradas_equipos', 'Entradas de Equipos'); ?></li>  
                          <li id="menu_reportes"><?php echo anchor('reportes/bitacora', 'Reporte de Bit&aacute;cora'); ?></li>
                      </ul>
                  </li>
                  
                  <?php
	               }
                    ?>
                    
                  <?php
	                   if($id == 111)  {
                    ?>
                  <li class="sub-menu" id="menu_pendientes">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Pendientes Areas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_pendientes_activo_r"><?php echo anchor('pendientes/activo_r', 'Pendientes'); ?></li>
                          <li id="menu_pendientes"><?php echo anchor('pendientes/activo_r_val', 'Concentrado de Pendientes Liberados'); ?></li>
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_mer_reporte1">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Reportes</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_mer_pendientes"><?php echo anchor('reportes/equipo', 'Compra de Equipo'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('reportes/entradas_equipos', 'Entradas de Equipos'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('reportes/salidas_equipos', 'Salidas de Equipos'); ?></li>
                      </ul>
                  </li>
                  
                  <?php
	               }
                    ?>  
                 <li class="sub-menu" id="catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="catalogos_s_empleado_correo"><?php echo anchor('catalogos/s_empleados_correo', 'Correos_empleados'); ?></li>
                          <li id="catalogos_s_sucursal"><?php echo anchor('catalogos/s_sucursal', 'Sucursales Activas'); ?></li>
                      </ul>
                  </li>

                  
              </ul>