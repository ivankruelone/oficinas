              <ul class="sidebar-menu">
                  <li class="sub-menu" id="menu_catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/genericos_venta', 'Genericos'); ?></li>
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/s_cat_naturistas', 'Productos Naturistas'); ?></li>
                      </ul>
                  </li>   
                  <li class="sub-menu" id="menu_tarjetas">
                      <a href="javascript:;" class="">
                          <i class="icon-credit-card"></i>
                          <span>Tarjetas Cliente Pref.</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_tarjetas"><?php echo anchor('tarjetas/agrega_tarjetas', 'Agregar tarjetas'); ?></li>
                          <li id="menu_tarjetas"><?php echo anchor('tarjetas/tarjetas_historicas', 'Tarjetas historicas'); ?></li>  
                          <li id="menu_tarjetas_concentrado"><?php echo anchor('ventas/ventas_tcp_mes', 'Relacion TCP Excel'); ?></li>
                          <li id="menu_tarjetas_empleado"><?php echo anchor('ventas/ventas_tarjetas_mes', 'Tarjetas x Empleado'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_ventas">
                      <a href="javascript:;" class="">
                          <i class="icon-credit-card"></i>
                          <span>Ventas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_ventas"><?php echo anchor('ventas/s_ventas_compara_mes_nac_det', 'Ventas Mensuales'); ?></li>
                          <li id="menu_ventas_s_ventas_capturadas_sec"><?php echo anchor('ventas/s_ventas_capturadas_sec', 'Ventas Capturadas'); ?></li>
                          
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_depositos">
                      <a href="javascript:;" class="">
                          <i class="icon-credit-card"></i>
                          <span>Depositos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_depositos_ventas_s_depositos"><?php echo anchor('ventas/s_depositos', 'Depositos Mensuales'); ?></li>
                          
                          
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_salud">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Salud para Todos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_salud_reporte"><?php echo anchor('spt/reporte', 'Consulta Salud Para Todos'); ?></li>
                          <li id="menu_salud_consulta_comparativo"><?php echo anchor('spt/consulta_comparativo', 'Consultorios'); ?></li>
                          <li id="menu_salud_depositos"><?php echo anchor('spt/depositos', 'Depositos'); ?></li>
                          <li id="menu_salud_ventas_reporte"><?php echo anchor('spt/ventas_reporte', 'Ventas'); ?></li>
                          <li id="menu_salud_ejercicio"><?php echo anchor('spt/ejercicio', 'Ejercicio Medico'); ?></li>
                          <li id="menu_salud_codigo"><?php echo anchor('spt/codigo', 'Codigo de Vestir'); ?></li>
                          <li id="menu_salud_consultas_dia"><?php echo anchor('spt/consultas_dia', 'Consultas y Servicios'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('spt/reporte_med_nov15', 'Reporte Medicos Noviembre 2015'); ?></li>
                          <li id="menu_saluds_ventas_comparativas_historicas_nac"><?php echo anchor('ventas/s_ventas_comparativas_historicas_nac', 'Meta'); ?></li>
                      </ul>
                  </li>
                    
              </ul>