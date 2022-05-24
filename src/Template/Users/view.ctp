<div class="row justify-content-center">
    <div class="col-md-10 col-xs-10">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <h3>Información de usuario</h3>
                            <div style="right:5%; position: absolute; margin-top: -4%;">
                                <?= $this->Html->link('Volver', '/', ['escape' => false, 'class' => 'btn btn-primary']); ?>
                            </div>
                            <table class="table" style="margin-top: 30px;">
                                <tr>
                                    <th scope="row">Perfil</th>
                                    <td><?= $user->has('role') ? $user->role->name:'' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nombre de usuario</th>
                                    <td><?= h($user->username) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nombre completo</th>
                                    <td><?= h($user->fullname) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Registrado</th>
                                    <td><?= h($user->created) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Última modificación</th>
                                    <td><?= h($user->modified) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Estado</th>
                                    <td><?= $user->active ? 'Activado' : 'Desactivado'; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
