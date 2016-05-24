              <ul class="sidebar-menu">
              <li class="sub-menu" id="menu_evaluacion">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Catalogo</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_evaluacion_eval_cedis"><?php echo anchor('evaluacion/eval_cedis', 'Nivel de Faltantes'); ?></li>
                          <li id="menu_evaluacion_eval_cedis"><?php echo anchor('evaluacion/eval_cedis_pro', 'Estadistica de productos'); ?></li>
                          <li id="menu_evaluacion_eval_cedis"><?php echo anchor('evaluacion/eval_cedis_compra', 'Estadistica de compra'); ?></li>
                      </ul>
                  </li>
              <li class="sub-menu" id="menu_inventario">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Inventario</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_inventario_almacen"><?php echo anchor('inventario/almacen_det/alm', 'Almacen'); ?></li>
                          <li id="menu_inventario_inv_sucursal"><?php echo anchor('inventario/inv_sucursal', 'Sucursales'); ?></li>
                          <li id="menu_Inventarios_inv_sucursal"><?php echo anchor('inventario/inv_sucursal_descon', 'Inventario Sucursal Descontinuados'); ?></li>
                          <li id="menu_inv_inventario_tod"><?php echo anchor('inventario/mes_tod','Hist.Mensual'); ?></li>
                          <li id="menu_inventario_gral"><?php echo anchor('inventario/inv_gral','Inv General'); ?></li>
                          <li id="menu_esp_control_inv"><?php echo anchor('inventario/busqueda', 'Busqueda'); ?></li>
                          <li id="menu_esp_control_inv"><?php echo anchor('inventario/caducidad', 'Caducidad SEGPOP'); ?></li>
                          <li id="menu_inventario_devolucion"><?php echo anchor('inventario/devolucion_sucursales', 'Claves permitidas a devoluci&oacute;n'); ?></li>
                          <li id="menu_inventario_devolucion"><?php echo anchor('inventario/s_devolucion_autorizada', 'Seguimiento Devolucion'); ?></li>
                          
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_desplazamientos">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Desplazamientos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_desplazamientos"><?php echo anchor('desplazamientos/a_desplaza_paquetes', 'Desplazamiento de paquetes'); ?></li>
                          <li id="menu_desplazamientos_s_desplaza_ofertas_gen"><?php echo  anchor('desplazamientos/s_desplaza_ofertas_gen', 'Desplazamiento Ofertas Catalogo DOctor Ahorro'); ?></li>
                          <li id="menu_desplazamientos_s_desplaza_ofertas_gen_in"><?php echo  anchor('desplazamientos/s_desplaza_ofertas_gen_in', 'Desplazamiento Productos con Insentivos'); ?></li>
                          <li id="menu_desplazamientos_a_desplaza_optimo_venta"><?php echo  anchor('desplazamientos/a_desplaza_optimo_venta', 'Desplazamiento optimo contra venta'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_orden">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Orden</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li id="menu_orden_orden_s_pre_orden"><?php echo anchor('orden/s_pre_orden', 'Pre-Orden'); ?></li>
                          <li id="menu_orden_orden_s_pre_orden"><?php echo anchor('orden/s_orden_especial_sec', 'Orden Especial'); ?></li>
                          <li id="menu_orden_orden_s_orden_historico"><?php echo anchor('orden/s_orden_historico', 'Orden Historica'); ?></li>
                          <li id="menu_orden_orden_s_busca_orden"><?php echo anchor('orden/s_busca_orden', 'Busca Orden'); ?></li>
                          <li id="menu_orden_orden_s_busca_producto_orden"><?php echo anchor('orden/s_busca_producto_orden', 'Busca Producto en Orden'); ?></li>
                          <li id="menu_orden_orden_s_orden_historico"><?php echo anchor('orden/s_orden_his_global', 'Orden Historica Global'); ?></li>
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_entradas_reportes">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Entradas reportes</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                         <li id="menu_almacenes"><?php echo anchor('entradas/alma', 'Almacenes'); ?></li>
                          <li id="menu_entradas_almacen_cedis"><?php echo anchor('entradas/busca_entrada_cedis', 'Busca Entradas CEDIS, Farmabodega, Metro'); ?></li>
                          <li id="menu_entradas_almacen_segpop"><?php echo anchor('entradas/busca_entrada_segpop', 'Busca Entradas SEGPOP'); ?></li>
                      
                      </ul>
                  </li>
                  <li class="sub-menu" id="menu_salidas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Salidas</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                         <li id="menu_salidas"><?php echo anchor('salidas/s_salidas_esp', 'TRASPASOS Y PEDIDOS A MODULOS'); ?></li>
                      </ul>
                  </li>
                  
                  <li class="sub-menu" id="menu_ofertas">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>Ofertas para genericos</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                         <li id="menu_ofertas_a_ofertas_gen"><?php echo anchor('ofertas/a_ofertas_gen', 'Ofertas Activas'); ?></li>
                         <li id="menu_ofertas_a_ofertas_gen_cad"><?php echo anchor('ofertas/a_ofertas_gen_cad', 'Ofertas Caducadas'); ?></li>
                      </ul>
                  </li>   
                  
              </ul>