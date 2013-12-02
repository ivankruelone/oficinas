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
                 <li class="sub-menu" id="menu_procesos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Procesos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                      <li id="menu_procesos_ims"><?php echo anchor('procesos/ims', 'Ims'); ?></li>
                          <li id="menu_procesos_facturas_oficinas"><?php echo anchor('procesos/facturas_oficinas', 'Factura oficinas'); ?></li>
                          <li id="menu_procesos_facturas_pdv"><?php echo anchor('procesos/facturas_pdv', 'Factura pdv'); ?></li>
                          <li id="menu_procesos_pro_inv"><?php echo anchor('procesos/pro_inv', 'Inventario'); ?></li>
                          <li id="menu_procesos_pro_ent_sal"><?php echo anchor('procesos/pro_ent_sal', 'Entra-sal'); ?></li>
                          <li id="menu_procesos_desplaza_segpop"><?php echo anchor('procesos/desplaza_segpop', 'Desplazamientos segpop'); ?></li>
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
                  
                  <li class="sub-menu" id="menu_orden">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Reportes</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_orden"><?php echo anchor('reportes/reporte', 'Poliza de inventario'); ?></li>
                          <li id="menu_inv_inventario_tod"><?php echo anchor('inventario/mes_tod','TODOS'); ?></li>
                      </ul>
                  </li>
                  
              </ul>