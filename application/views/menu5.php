              <ul class="sidebar-menu">
              
                  <li class="sub-menu" id="menu_pedido">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Pedido</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_pedido_com_pedido"><?php echo anchor('pedido/com_pedido', 'Generar un pedido por clave'); ?></li>
                          <li id="menu_pedido_com_pedido_his"><?php echo anchor('pedido/com_pedido_his', 'Orden de compra'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_pedido_far">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Pedido_Farmacia</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_pedido_far_pedido_far"><?php echo anchor('pedido/pedido_far', 'Generar un pedido a Farmacia'); ?></li>
                          <li id="menu_pedido_far_pedido_far_his"><?php echo anchor('pedido/pedido_far_his', 'Historico pedido a Farmacia'); ?></li>
                          
                      </ul>
                  </li>
                 <li class="sub-menu" id="menu_inv_control_espe">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Inventario</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_esp_control_inv"><?php echo anchor('inv_control_espe/esp_control_inv', 'Inventario de Controlados y especialidad'); ?></li>
                      </ul>
                  </li>   
                  
              </ul>