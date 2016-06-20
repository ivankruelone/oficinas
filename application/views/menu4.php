              <ul class="sidebar-menu">
              
              <li class="sub-menu" id="menu_inventario">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Inventario</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_inventario_almacen"><?php echo anchor('inventario/invChetumal', 'Almacen'); ?></li>
                          <li id="menu_inventario_inv_sucursal"><?php echo anchor('inventario/inv_sucursal', 'Sucursales'); ?></li>
                          <li id="menu_inv_inventario_tod"><?php echo anchor('inventario/mes_tod','Hist.Mensual'); ?></li>
                          <li id="menu_inventario_gral"><?php echo anchor('inventario/inv_gral','Inv General'); ?></li>
                          <li id="menu_esp_control_inv"><?php echo anchor('inventario/busqueda', 'Busqueda'); ?></li>
                          <li id="menu_esp_control_inv"><?php echo anchor('inventario/caducidad', 'Caducidad'); ?></li>
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_orden">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Orden</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_orden"><?php echo anchor('orden/a_orden_segpop', 'Captura Orden'); ?></li>
                          <li id="menu_orden"><?php echo anchor('orden/a_orden_segpop_esp', 'Captura Orden Especialidad'); ?></li>
                          <li id="menu_orden"><?php echo anchor('orden/a_orden_segpop_his_esp', 'Historico de Orden'); ?></li>
                          <li id="menu_orden"><?php echo anchor('orden/a_orden_segpop_his_global', 'Historico de Orden Global'); ?></li>
                          <li id="menu_orden"><?php echo anchor('orden/a_orden_segpop_nivel_s_prv', 'Nivel de surtido por Proveedor'); ?></li>
                          <li id="menu_orden"><?php echo anchor('orden/a_orden_mes_glo', 'Orden de Compra Mensual General'); ?></li>
                      </ul>
                  </li> 
              
                  
              </ul>