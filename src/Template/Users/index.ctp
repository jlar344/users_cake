<div class="row justify-content-center">
    <div class="col-md-12 col-xs-12">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <h3>Listado de usuarios</h3>
                            <?php if($isAdmin): ?>
                            <div style="right:5%; position: absolute; margin-top: -4%;">
                                <?= $this->Html->link('Nuevo usuario', '/nuevo', ['escape' => false, 'class' => 'btn btn-primary']); ?>
                            </div>
                            <?php endif; ?>
                            <div style="position:absolute; right: 5%;">
                                <?= $this->Form->create(null); ?>
                                <div class="input-group" style="width:300px;">
                                  <input type="text" name="search" class="form-control" aria-describedby="form-search" aria-label="Buscar usuarios" placeholder="Buscar">
                                  <button class="btn btn-outline-secondary" type="submit" id="form-search"><i class="fa fa-search"></i></button>                          
                                </div>
                                <?= $this->Form->end(); ?>
                            </div>
                            <table cellpadding="0" cellspacing="0" class="table" style="text-align:center; margin-top: 60px;">
                                <thead>
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('role_id', 'Perfil <i class="fa fa-sort"></i>', ['escape' => false]) ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('username', 'Usuario <i class="fa fa-sort"></i>', ['escape' => false]) ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('fullname', 'Nombre <i class="fa fa-sort"></i>', ['escape' => false]) ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('active', 'Estado <i class="fa fa-sort"></i>', ['escape' => false]) ?></th>
                                        <th scope="col" class="actions">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $user->has('role') ? $user->role->name : '' ?></td>
                                        <td><?= h($user->username) ?></td>
                                        <td><?= h($user->fullname) ?></td>
                                        <td><i class="fa fa-circle" style="color: <?= $user->active ? 'green':'red' ?>;" title="<?= $user->active ? 'activo':'desactivado' ?>"></i></td>
                                        <td class="actions">
                                            <?= $this->Html->link('<i class="fa fa-eye"></i>', '/ver/'.$user->id, ['escape' => false, 'class' => 'btn btn-sm btn-outline-success']) ?>
                                            <?php if($isAdmin): ?>
                                            <?= $this->Html->link('<i class="fas fa-pen"></i>', '/editar/'.$user->id, ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']) ?>
                                            <?= $this->Form->postLink('<i class="fas fa-retweet"></i>', '/cambiar/'.$user->id, ['confirm' => '¿Está seguro de '.($user->active ? 'desactivar':'activar').' al usuario '. $user->username.'?', 'escape' => false, 'class' => 'btn btn-sm btn-outline-warning']) ?>
                                            <?= $this->Form->postLink('<i class="fas fa-trash"></i>', '/delete/'.$user->id, ['confirm' => '¿Está seguro de eliminar al usuario '. $user->username.'?', 'escape' => false, 'class' => 'btn btn-sm btn-outline-danger']) ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if(!count($users)): ?>
                                        <tr>
                                            <td colspan="5" align="center">No hay datos que mostrar</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <div>
                                    <nav aria-label="page navigation">
                                        <ul class="pagination justify-content-center">
                                            <?php
                                            $this->Paginator->templates([
                                                'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                                'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                                'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                                'current' => '<li class="page-item active"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                                'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                                                'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>'
                                            ]);?>

                                            <?= $this->Paginator->prev('<ant') ?>
                                            <?= $this->Paginator->numbers() ?>
                                            <?= $this->Paginator->next('sig>') ?>
                                        </ul>
                                        <p><?= $this->Paginator->counter(__('Pág {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}} total')) ?></p>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
