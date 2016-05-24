              <ul class="sidebar-menu">
              <?php $id_plaza=$this->session->userdata('id_plaza');?>
                  <li class="sub-menu" id="menu_catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/genericos_venta', 'Genericos'); ?></li>
                          <li id="menu_catalogos_genericos_oferta"><?php echo anchor('catalogos/genericos_oferta', 'Ofertas para Doctor Ahorro'); ?></li>
                          <li id="menu_catalogos_descontin"><?php echo anchor('catalogos/descontin', 'Genericos Descontinuados'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_recursos_humanos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Movimientos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_recursos_humanos_s_cap_mov"><?php echo anchor('recursos_humanos/s_cap_mov', 'Cap.Movimientos'); ?></li>
                          <li id="menu_recursos_humanos_s_cap_mov_his"><?php echo anchor('recursos_humanos/s_cap_mov_his', 'Movimientos Capturados'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_empleados">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Empleados</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_Empleados_plantilla_s"><?php echo anchor('empleados/plantilla_s/'.$id_plaza, 'Plantilla'); ?></li>
                      </ul>
                  </li>  
  
                  <li class="sub-menu" id="menu_ventas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Ventas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_ventas_s_ventas_diarias_bor"><?php echo anchor('ventas/s_ventas_diarias_bor', 'Borrar ventas diarias'); ?></li>
                          <li id="menu_ventas_s_depositos_diarios_bor"><?php echo anchor('ventas/s_depositos_diarios_bor', 'Borrar depositos diarios'); ?></li>  
                          <li id="menu_ventas_ventas_cortes_ger"><?php echo anchor('ventas/s_ventas_cortes_ger', 'Ventas cortes Sucursal'); ?></li>
                          <li id="menu_ventas_s_ventas_compara_mes_ger"><?php echo anchor('ventas/s_ventas_compara_mes_ger', 'Venta Comparativa'); ?></li>
                          <li id="menu_ventas_s_s_ventas_capturadas_ger"><?php echo anchor('ventas/s_ventas_capturadas_ger', 'Ventas Capturadas'); ?></li>
                          <li id="menu_ventas_s_ventas_comparativas_historicas_ger"><?php echo anchor('ventas/s_ventas_comparativas_historicas_ger', 'Ventas Historicas'); ?></li>
                          <li id="menu_ventas_s_estadistica_ventas_ger"><?php echo anchor('ventas/s_estadistica_ventas_ger', 'Estadistica de Ventas'); ?></li>
                      </ul>
                  </li>
                   <li class="sub-menu" id="menu_entradas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Entradas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_entradas_facturas_gg"><?php echo  anchor('entradas/facturas_gg/0', 'Facturas '); ?></li>
                          <li id="menu_entradas_facturas_gg"><?php echo  anchor('entradas/facturas_gg/1', 'Facturas Locales'); ?></li>
                          
                          
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_desplazamientos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Desplazamiento</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                      <li id="menu_ventas_s_estadistica_ventas_reg"><?php echo anchor('ventas/s_estadistica_ventas_reg', 'E'); ?></li>
                          <li id="menu_desplazamientos_s_nivel_surtido"><?php echo  anchor('desplazamientos/s_nivel_surtido', 'Nivel de surtido'); ?></li>
                          <li id="menu_desplazamientos_s_desplaza_fenix"><?php echo  anchor('desplazamientos/s_desplaza_fenix', 'Desplazamiento Fenix'); ?></li>
                          <li id="menu_desplazamientos_s_optimo_excel_ger"><?php echo  anchor('desplazamientos/s_optimo_excel_ger', 'Optimos Doctor Ahorro'); ?></li>
                      </ul>
                  </li>
                  
                  
                  
              </ul>