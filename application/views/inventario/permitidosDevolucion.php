<table class="table">
    <thead>
        <tr>
            <th>Secuencia</th>
            <th>Descripcion</th>
            <th>Lote</th>
            <th>Caducidad</th>
            <th>Eliminar Devolucion</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($query->result() as $row){ ?>
        <tr>
            <td><?php echo $row->sec; ?></td>
            <td><?php echo $row->susa1; ?></td>
            <td><?php echo $row->lote; ?></td>
            <td><?php echo $row->caducidad; ?></td>
            <td><?php echo anchor('inventario/eliminarDevolucion/'.$row->devolverID, 'Eliminar Devoluci&oacute;n', array('class' => 'eliminar')); ?></td>
        </tr>
        <?php }?>
    </tbody>
</table>