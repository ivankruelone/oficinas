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
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/s_oferta_genericos', 'Productos Ofertados'); ?></li>
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/s_cat_naturistas', 'Productos Naturistas'); ?></li>
                          <li id="menu_catalogos_descontin"><?php echo anchor('catalogos/descontin', 'Genericos Descontinuados'); ?></li>
                          <li id="menu_catalogos_genericos_venta"><?php echo anchor('catalogos/a_cat_fanasa_activos', 'Catalogo de FANASA'); ?></li>
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
                  <li class="sub-menu" id="menu_finanzas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Finanzas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_finanzas_s_proyeccion_venta"><?php echo anchor('finanzas/s_proyeccion_v', 'Evaluacion Venta'); ?></li>
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
                          <li id="menu_ventas_s_ventas_comparativas_historicas_nac"><?php echo anchor('ventas/s_ventas_aaa_mes', 'Ventas Comparativas'); ?></li>  
                          <li id="menu_ventas_s_descuentos_mes"><?php echo anchor('ventas/s_descuentos_mes', 'Descuentos, Optimos y Ventas'); ?></li>
                          <li id="menu_ventas_s_ventas_captura_nac"><?php echo anchor('ventas/ticket_por_mes', 'Tickets por sucursal'); ?></li>
                      </ul>
                  </li>
                   <li class="sub-menu" id="menu_Inventarios">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Inventarios</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_Inventarios_inv_sucursal"><?php echo anchor('inventario/inv_sucursal', 'Inventario Sucursal'); ?></li>
                          <li id="menu_Inventarios_inv_sucursal"><?php echo anchor('inventario/inv_sucursal_descon', 'Inventario Sucursal Descontinuados'); ?></li>
                          <li id="menu_Inventarios_insumos_s_inv_insumos_medicos"><?php echo anchor('insumos/s_inv_insumos_medicos', 'Inventario Insumos Sucursal'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_insumos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Pedido</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_insumos"><?php echo anchor('pedido/s_val_pedido_ins_his_glo', 'Folios de pedidos globales'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_desplazamientos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Desplazamiento</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_desplazamientos_a_desplaza_paquetes"><?php echo anchor('desplazamientos/a_desplaza_paquetes', 'Desplazamiento de paquetes'); ?></li>  
                          <li id="menu_desplazamientos_s_nivel_surtido"><?php echo  anchor('desplazamientos/s_nivel_surtido', 'Nivel de surtido'); ?></li>
                          <li id="menu_desplazamientos_s_desplaza_ofertas_gen"><?php echo  anchor('desplazamientos/s_desplaza_ofertas_gen', 'Desplazamiento Ofertas Catalogo DOctor Ahorro'); ?></li>
                          <li id="menu_desplazamientos_s_desplaza_ofertas_gen_in"><?php echo  anchor('desplazamientos/s_desplaza_ofertas_gen_in', 'Desplazamiento Productos con Insentivos'); ?></li>
                          <li id="menu_desplazamientos_s_desplaza_fenix"><?php echo  anchor('desplazamientos/s_desplaza_fenix', 'Desplazamiento Fenix'); ?></li>
                          <li id="menu_desplazamientos_a_desplaza_fenix_contado_pat"><?php echo anchor('desplazamientos/a_desplaza_fenix_contado_pat', 'Desplazamientos venta_contado'); ?></li>
                          
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_evaluacion">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Checklist</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_evaluacion"><?php echo anchor('checklist/periodos_evaluados_reg', ' Checklist Evaluados '); ?></li>
                      </ul>
                  </li>
                 <li class="sub-menu" id="menu_devolucion">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Devolucion</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_devolucion_s_devolucion_ctl"><?php echo anchor('devolucion/s_devolucion_ctl', 'Devolucion'); ?></li>
                          
                      </ul>
                  </li> 
              </ul>