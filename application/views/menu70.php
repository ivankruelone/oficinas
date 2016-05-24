              <ul class="sidebar-menu">
              <li class="sub-menu" id="menu_juridico">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Juridico</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_juridico_rentas_mes"><?php echo anchor('juridico/rentas_mes_genera', 'Generar rentas mensuales'); ?></li>
                          <li id="menu_juridico_rentas_mes_historico"><?php echo anchor('juridico/rentas_mes_historico_rentadas', 'Historico Locales rentados '); ?></li>
                          <li id="menu_juridico_rentas_mes_historico"><?php echo anchor('juridico/rentas_mes_historico_propios', 'Historico Locales propios '); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_deuda">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Deudas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_deuda_rentas_deuda_ren"><?php echo anchor('juridico/rentas_deuda/2', 'Deuda de rentas '); ?></li>
                          <li id="menu_deuda_rentas_deuda_ren"><?php echo anchor('juridico/rentas_deuda/1', 'Deuda de rentas locales propios'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_catalogo">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_catalogo_rentas"><?php echo anchor('juridico/rentas', 'Agregar Arrendadores'); ?></li>
                          <li id="menu_catalogo_rentas_farmacia"><?php echo anchor('juridico/rentas_farmacia', 'Arrendadores de farmacias'); ?></li>
                          <li id="menu_catalogo_rentas_cerradas"><?php echo anchor('juridico/rentas_cerradas', 'Arrendadores Suc Cerradas'); ?></li>
                      </ul>
                  </li>
                
              
              </ul>
               