              <ul class="sidebar-menu">
              
              <li class="sub-menu" id="menu_inventario">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Inventario</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_inventario_almacen"><?php echo anchor('inventario/almacen', 'Almacen'); ?></li>
                          <li id="menu_inventario_inv_sucursal"><?php echo anchor('inventario/inv_sucursal', 'Sucursales'); ?></li>
                          <li id="menu_inv_inventario_tod"><?php echo anchor('inventario/mes_tod','Hist.Mensual'); ?></li>
                          <li id="menu_inventario_gral"><?php echo anchor('inventario/inv_gral','Inv General'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_orden">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Orden</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_orden_busca_orden"><?php echo anchor('inventario/busca_orden', 'Busca Orden'); ?></li>
                      </ul>
                  </li>
                  
              </ul>