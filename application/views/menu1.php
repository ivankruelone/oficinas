              <ul class="sidebar-menu">
              
                  <li class="sub-menu" id="menu_catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_catalogos_genericos"><?php echo anchor('catalogos/genericos', 'Genericos'); ?></li>
                          <li id="menu_catalogos_seguro_popular"><?php echo anchor('catalogos/seguro_popular', 'Seguros Populares'); ?></li>
                          <li id="menu_catalogos_especialidad"><?php echo anchor('catalogos/especialidad', 'Especialidad'); ?></li>
                      </ul>
                  </li>

                  
                <li class="sub-menu" id="menu_pedido">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Pedido</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_pedido_generar"><?php echo anchor('pedido/generar', 'Generar'); ?></li>
                          <li id="menu_pedido_pedidos"><?php echo anchor('pedido/pedidos', 'Pedidos'); ?></li>
                          <li id="menu_pedido_orden_compra"><?php echo anchor('pedido/pedido_compra', 'Por prv'); ?></li>
                          <li id="menu_pedido_precios"><?php echo anchor('pedido/precios', 'Autorizar precios'); ?></li>
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_orden">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>orden</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_orden"><?php echo anchor('orden/orden_compra', 'Trabaja orden'); ?></li>
                          <li id="menu_orden_historico"><?php echo anchor('orden/historico', 'Historico'); ?></li>
                          
                      </ul>
                  </li>
                  
              </ul>