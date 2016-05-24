              <ul class="sidebar-menu">
              <?php $id_plaza=$this->session->userdata('id_plaza');?>
                  
                  <li class="sub-menu" id="catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="catalogos_s_empleado_correo"><?php echo anchor('catalogos/s_empleados_correo', 'Correos_empleados'); ?></li>
                          <li id="catalogos_s_sucursal"><?php echo anchor('catalogos/s_sucursal', 'Sucursales Activas'); ?></li>
                          <li id="menu_catalogos"><?php echo anchor('catalogos/s_cat_insumos_dep', 'Catalogos de Insumos'); ?></li>
                      </ul>
                  </li>
                  <?php if($this->session->userdata('id') == 111){?>
                  <li class="sub-menu" id="menu_insumos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Insumos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_insumos"><?php echo anchor('insumos/s_ped_insumos', 'Agrega Pedido Insumos'); ?></li>
                          
                      </ul>
                  </li>
                  <?php }?>
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
                  
                                    
              </ul>