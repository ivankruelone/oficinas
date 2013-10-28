              <ul class="sidebar-menu">
                  <li class="sub-menu" id="menu_catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
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
                      </ul>
                  </li>  

                  <li class="sub-menu" id="menu_ventas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Ventas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_ventas_ventas_cortes"><?php echo anchor('ventas/ventas_cortes', 'Ventas cortes'); ?></li>
                          <li id="menu_ventas_ventas_cortes_ger"><?php echo anchor('ventas/ventas_cortes_ger', 'Ventas cortes Gerente'); ?></li>
                      </ul>
                  </li>
                 <li class="sub-menu" id="menu_entradas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Entradas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_entradas_facturas"><?php echo anchor('entradas/facturas', 'Facturas x imagen'); ?></li>
                          <li id="menu_entradas_facturas_g"><?php echo anchor('entradas/facturas_g/0', 'Facturas x Gerente '); ?></li>
                          <li id="menu_entradas_facturas_g"><?php echo anchor('entradas/facturas_g/1', 'Facturas Locales '); ?></li>
                      </ul>
                  </li> 
                  <li class="sub-menu" id="menu_inv">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Inventario</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_inv_inventario"><?php echo anchor('inventario/mes', 'Inventario'); ?></li>
                          
                      </ul>
                  </li>
                  
              </ul>