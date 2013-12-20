              <ul class="sidebar-menu">
                  
                  <li class="sub-menu" id="menu_empleados">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Empleados</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_empleados_directivos_plantilla"><?php echo anchor('directivos/plantilla', 'Personal Activo'); ?></li>
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
                  
                  <li class="sub-menu" id="menu_inv">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Inventario</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                           <li id="menu_procesos_pro_ent_sal"><?php echo anchor('procesos/pro_ent_sal', 'Entra-sal'); ?></li> 
                           <li id="menu_inv_inventario"><?php echo anchor('inventario/mes', 'Sucursales'); ?></li>
                           <li id="menu_inv_inventario_tod"><?php echo anchor('inventario/mes_tod','TODOS'); ?></li>
                      </ul>
                  </li>
                  
                  
              </ul>