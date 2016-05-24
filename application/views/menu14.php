              <ul class="sidebar-menu">
                  <li class="sub-menu" id="menu_catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_Juridico_rentas"><?php echo anchor('juridico/rentas', 'Arrendadores'); ?></li>
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_inv">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>P&L</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_reportes"><?php echo anchor('pl/reporte_pl', 'Ventas Sucursal'); ?></li>
                          <li id="menu_reportes"><?php echo anchor('pl/captura_reporte_pl', 'Captura Sucursal'); ?></li>
                      </ul>
                  </li>
                  
              </ul>