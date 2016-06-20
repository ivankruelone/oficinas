              <ul class="sidebar-menu">
              
                  <li class="sub-menu" id="menu_catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                      <li id="menu_catalogos_s_cat_genericos_fenix"><?php echo anchor('catalogos/s_cat_genericos_fenix', 'Genericos Fenix'); ?></li>
                          <li id="menu_catalogos_mercadotecnia_busqueda1"><?php echo anchor('mercadotecnia/busqueda1', 'Buscar_producto con costos'); ?></li>
                          <li id="menu_catalogos_solo_busqueda"><?php echo anchor('mercadotecnia/solo_busqueda', 'Buscar Productos'); ?></li>
                          <li id="menu_catalogos_productos"><?php echo anchor('mercadotecnia/productos', 'Catalogo de Productos'); ?></li>
                          <li id="menu_catalogos_provedor"><?php echo anchor('mercadotecnia/provedor', 'Catalogo de Provedor'); ?></li>
                          <li id="menu_catalogos_laboratorios"><?php echo anchor('mercadotecnia/laboratorios', 'Catalogo de Laboratorios'); ?></li>
                          <li id="menu_catalogos_catalogos_costos_mayoristas"><?php echo anchor('catalogos/costos_mayoristas', 'Costos Mayoristas'); ?></li>
                          
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_licita">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Licitacion</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_licita_licita_s_licita_p"><?php echo anchor('licita/s_licita_p', 'Generar Licitacion'); ?></li>
                          <li id="menu_licita_licita_s_licita_historico"><?php echo anchor('licita/s_licita_historico', 'Historico Licitacion'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_compra">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Compras</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_compra_s_factura_central"><?php echo anchor('backoffice/a_solo_facturas', 'Facturas-Mayoristas'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_ofertas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Ofertas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_ofertas_s_cap_ofe_lab"><?php echo anchor('ofertas/s_cap_ofe_lab', 'Cap.Ofertas'); ?></li>
                          <li id="menu_ofertas_s_ofertas_lab"><?php echo anchor('ofertas/s_ofertas_periodo', 'Ofertas_laboratorios'); ?></li>
                          <li id="menu_ofertas_s_ofe_val"><?php echo anchor('ofertas/s_ofe_val', 'Ofertas Val. Suc'); ?></li>
                          <li id="menu_ofertas_s_ofe_val"><?php echo anchor('ofertas/s_ofertas_corta_caducidad', 'Ofertas Corta Caducidad'); ?></li>
                          <li id="menu_ofertas_s_ofe_val"><?php echo anchor('ofertas/s_ofertas_corta_caducidad_his', 'Ofertas Corta Caducidad Historico'); ?></li>
                          <li id="menu_ofertas_a_bloqueo_t"><?php echo anchor('ofertas/a_bloqueo_t', 'Bloqueo Transfer'); ?></li>
                      </ul>
                  </li>
                   <li class="sub-menu" id="menu_orden">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Orden de compra</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_orden_s_orden_especial"><?php echo anchor('orden/s_orden_especial', 'Generar Orden de compra'); ?></li>
                          <li id="menu_orden_s_orden_especial_his"><?php echo anchor('orden/s_orden_especial_his', 'Historico de Orden'); ?></li>
                          
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_inventario">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Pedido</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                      <li id="menu_pedidos"><?php echo anchor('pedido/ped_esp_sucur_fen', 'Pedidos Fenix'); ?></li>
                      <li id="menu_pedidos"><?php echo anchor('pedido/generar_pedido_f', 'Generar Pedido Fenix'); ?></li>
                      </ul>
                  </li>

                  <li class="sub-menu" id="menu_inventario">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Inventario</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                      <li id="menu_catalogo_catalogos_costos_mayoristas"><?php echo anchor('mercadotecnia/buscar_exist_med', 'Buscar Existencia Productos'); ?></li>
                 <!--        <li id="menu_inventario_inv"><?php //echo anchor('inventario/s_inv_metro', 'Inv Metro'); ?></li> -->

                      </ul>
                  </li>
                   
                  
                  <li class="sub-menu" id="menu_mer_reporte">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Reportes</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_mer_reporte_prom"><?php echo anchor('reportes/mer_reporte_prom', 'Claves en promocion'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_inv">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>P&L</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_reportes"><?php echo anchor('pl/captura_reporte_pl', 'Captura Sucursal'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_desplazamientos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Desplazamiento</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_desplazamientos_s_diarias"><?php echo anchor('desplazamientos/s_diarias', 'Desplazamiento Diarias'); ?></li>
                           
                          
                          <li id="menu_desplazamientos_a_desplaza_fenix_contado_pat"><?php echo anchor('desplazamientos/a_desplaza_fenix_contado_pat', 'Desplazamientos venta_contado'); ?></li>
                          <li id="menu_desplazamientos_a_desplaza_mes_contado_fanasa"><?php echo anchor('desplazamientos/a_desplaza_mes_contado_fanasa', 'Desplazamientos venta_contado FANASA'); ?></li>
                      </ul>
                  </li>  


              </ul>