              <ul class="sidebar-menu">
              
                  <li class="sub-menu" id="menu_catalogo">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_catalogo_productos"><?php echo anchor('mercadotecnia/productos', 'Catalogo de Productos'); ?></li>
                          <li id="menu_catalogo_provedor"><?php echo anchor('mercadotecnia/provedor', 'Catalogo de Provedor'); ?></li>
                          <li id="menu_catalogo_laboratorios"><?php echo anchor('mercadotecnia/laboratorios', 'Catalogo de Laboratorios'); ?></li>
                      </ul>
                  </li>
                   <li class="sub-menu" id="menu_orden">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Orden de compra</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_orden"><?php echo anchor('mercadotecnia/orden', 'Generar'); ?></li>
                          
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_mercadotecnia">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Mercadotecnia</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_mercadotecnia_factura"><?php echo anchor('mercadotecnia/factura', 'Recepcion de mercanc&iacute;a'); ?></li>
                          <li id="menu_mercadotecnia_his_fac"><?php echo anchor('mercadotecnia/his_fac', 'Historico'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_mer_surtido">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Pedido</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_mer_surtido_pedido"><?php echo anchor('mercadotecnia/pedido', 'Pedidos'); ?></li>
                          <li id="menu_mer_surtido_his_sur"><?php echo anchor('mercadotecnia/his_sur', 'Historico'); ?></li>
                      </ul>
                  </li>  
                  <li class="sub-menu" id="menu_mer_inventario">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Inventario</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_mer_inventario_inv"><?php echo anchor('mercadotecnia/mer_inv', 'Inv'); ?></li>
                      </ul>
                  </li>
               
                  
              </ul>