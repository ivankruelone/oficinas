              <ul class="sidebar-menu">
                  <li class="sub-menu" id="menu_catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_Juridico_rentas"><?php echo anchor('juridico/rentas', 'Arrendadores'); ?></li>
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/genericos_venta', 'Genericos'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_empleados">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Empleados</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_Empleados_plantilla"><?php echo anchor('empleados/plantilla', 'Plantilla'); ?></li>
                          <li id="menu_Empleados_estatus"><?php echo anchor('empleados/estatus', 'Tiempo en Sucursal'); ?></li>
                          <li id="menu_recursos_humanos_s_cap_mov"><?php echo anchor('recursos_humanos/s_cap_mov', 'Cap.Movimientos'); ?></li>
                          <li id="menu_recursos_humanos_s_cap_mov_his"><?php echo anchor('recursos_humanos/s_cap_mov_his', 'Movimientos Capturados'); ?></li>
                      </ul>
                  </li>  

                  <li class="sub-menu" id="menu_ventas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Ventas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_ventas_s_ventas_comparativas_historicas_nac"><?php echo anchor('ventas/s_ventas_comparativas_historicas_nac', 'Ventas Historicas'); ?></li>
                          <li id="menu_ventas_s_ventas_comparativas_historicas_nac"><?php echo anchor('ventas/ventas_tickets', 'Ventas TICKETS'); ?></li>
                      </ul>
                  </li>
                 <li class="sub-menu" id="menu_finanzas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Finanzas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_finanzas_s_proyeccion_v"><?php echo anchor('finanzas/s_proyeccion_v', 'Evaluacion Venta'); ?></li>
                      </ul>
                  </li>
                  
              </ul>