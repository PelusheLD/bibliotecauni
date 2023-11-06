<div class="modal fade" id="nuevaContrasenaModal" tabindex="-1" role="dialog" aria-labelledby="nuevaContrasenaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevaContrasenaModalLabel">Nueva Contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="actualizar-contrasena.php" method="post">
                    <input type="hidden" name="correo" value="<?php echo $correo; ?>">
                    <input type="hidden" name="cedula" value="<?php echo $cedula; ?>">
                    <div class="form-group">
                        <label for="nuevaContrasena">Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="nuevaContrasena" name="nuevaContrasena" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                </form>
            </div>
        </div>
    </div>
</div>