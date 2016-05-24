              <ul class="sidebar-menu">
              
              <li class="sub-menu" id="menu_salidas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Salidas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                         <li id="menu_salidas"><?php echo anchor('salidas/a_salida_segpop', 'Salidas Segpop'); ?></li>                           
                         <li id="menu_salidas"><?php echo anchor('salidas/s_salidas_esp', 'TRASPASOS Y PEDIDOS A MODULOS'); ?></li>
                      </ul>
                  </li>
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
                          <li id="menu_esp_control_inv"><?php echo anchor('inv_control_espe/esp_control_inv', 'Inventario de Controlados y especialidad'); ?></li>
                          <li id="menu_esp_control_inv"><?php echo anchor('inventario/busqueda', 'Busqueda'); ?></li>
                          <li id="menu_esp_control_inv"><?php echo anchor('inventario/caducidad', 'Caducidad'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_valida_precio">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Validar Precios</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_inventario_valida_precio_precios_mal"><?php echo anchor('pedido/precios_mal', 'Precios'); ?></li>
                          <li id="menu_inventario_valida_precio_precios_mal_his"><?php echo anchor('pedido/precios_mal_his', 'Precios Validados'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_catalogos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogo</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_catalogo_catalogos_control_espe"><?php echo anchor('catalogos/control_especial', 'Controlados y Especialidad'); ?></li>
                          <li id="menu_catalogo_catalogos_causes"><?php echo anchor('catalogos/causes', 'Causes'); ?></li>
                          <li id="menu_catalogo_catalogos_costos_mayoristas"><?php echo anchor('catalogos/costos_mayoristas', 'Costos Mayoristas'); ?></li>
                          
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_evaluacion">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Evaluacion</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_evaluacion_eval_cedis"><?php echo anchor('evaluacion/eval_cedis', 'Clasificacion'); ?></li>
                          <li id="menu_evaluacion_eval_cedis_gral"><?php echo anchor('evaluacion/eval_cedis_gral', 'Clasificacion General'); ?></li>
                      </ul>
                  </li> 

              <li class="sub-menu" id="menu_compra">
                      <a href="javascript:;" class="">
                          <i class="icon-money"></i>
                          <span>Compra</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_compra_s_factura_central"><?php echo anchor('backoffice/a_solo_facturas', 'Facturas-Mayoristas'); ?></li>  
                          <li id="menu_compra_s_pago_mayoristas"><?php echo anchor('compra/s_pago_mayoristas', 'Pago-Mayoristas'); ?></li>
                          <li id="menu_compra_s_pago_mayoristas"><?php echo anchor('compra/s_compras_ventas', 'compra-ventas'); ?></li>
                          <li id="menu_orden"><?php echo anchor('orden/a_orden_segpop_his_global', 'Historico de Orden Global SEGPOP'); ?></li>
                          <li id="menu_orden"><?php echo anchor('orden/a_orden_segpop_nivel_s_prv', 'Nivel de surtido por Proveedor SEGPOP'); ?></li>
                          <li id="menu_orden"><?php echo anchor('orden/a_orden_segpop_nivel_prv_rango', 'Nivel de surtido por Proveedor Por Fecha'); ?></li>
                          
                          
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_ofertas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Ofertas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_ofertas_s_ofertas_lab"><?php echo anchor('ofertas/s_ofertas_periodo', 'Ofertas_laboratorios'); ?></li>
                          <li id="menu_ofertas_s_ofe_val"><?php echo anchor('ofertas/s_ofe_val', 'Ofertas Val. Suc'); ?></li>
                          
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
                  
                  <li class="sub-menu" id="menu_inv">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Requisiciones</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_pendientes"><?php echo anchor('requisiciones/pendientes', 'Requisiciones pendientes'); ?></li>
                          <li id="menu_requisiciones"><?php echo anchor('requisiciones/requisiciones_aprobadas', 'Requisiciones aprobadas'); ?></li>
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_inv">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Entradas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_almacenes"><?php echo anchor('entradas/alma', 'Almacenes'); ?></li>
                      </ul>
                  </li>

              <li class="sub-menu" id="menu_inventario">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Maestro</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_inventario_almacen"><?php echo anchor('maestro/muestra_secuencia', 'Secuencia'); ?></li>
                          <li id="menu_inventario_almacen"><?php echo anchor('maestro/muestra_gobierno', 'Gobierno'); ?></li>
                          <li id="menu_inventario_almacen"><?php echo anchor('maestro/muestra_linea', 'Linea'); ?></li>
                          <li id="menu_inventario_almacen"><?php echo anchor('maestro/muestra_sublinea', 'Sublinea'); ?></li>
                          <li id="menu_inventario_almacen"><?php echo anchor('maestro/muestra_laboratorio', 'Laboratorio'); ?></li>
                          <li id="menu_inventario_almacen"><?php echo anchor('maestro/muestra_proveedor', 'Proveedor'); ?></li>
                          <li id="menu_inventario_almacen"><?php echo anchor('maestro/muestra_producto', 'Producto'); ?></li>
                      </ul>
                  </li>
                <li class="sub-menu" id="menu_contabilidad">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Contabilidad</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_contabilidad_s_depositos"><?php echo anchor('contabilidad/s_depositos', 'Depositos'); ?></li>
                          <li id="menu_finanzas_s_proyeccion_venta"><?php echo anchor('finanzas/s_proyeccion_v', 'Evaluacion Venta'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_desplazamientos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Desplazamiento</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_desplazamientos_a_desplaza_fenix_contado_pat"><?php echo anchor('desplazamientos/a_desplaza_fenix_contado_pat', 'Desplazamientos venta_contado'); ?></li>
                          <li id="menu_desplazamientos_a_desplaza_optimo_venta"><?php echo  anchor('desplazamientos/a_desplaza_optimo_venta', 'Desplazamiento optimo contra venta'); ?></li>
                      </ul>
                  </li>
              </ul>