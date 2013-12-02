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
                  <li class="sub-menu" id="menu_valida_precio">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Validar Precios</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_inventario_valida_precio_precios_mal"><?php echo anchor('pedido/precios_mal', 'Precios'); ?></li>
                          <li id="menu_inventario_valida_precio_precios_mal_his"><?php echo anchor('pedido/precios_mal_his', 'Precios Validados'); ?></li>
                      </ul>
                  </li> 
                  
              </ul>