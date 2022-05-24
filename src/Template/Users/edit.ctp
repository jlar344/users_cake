<div class="row justify-content-center">
    <div class="col-md-10 col-xs-10">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <?= $this->Form->create($user) ?>
                            <fieldset>
                                <legend>Editar información del usuario</legend>
                                <div style="right:5%; position: absolute; margin-top: -4%;">
                                    <?= $this->Html->link('Volver', '/', ['escape' => false, 'class' => 'btn btn-primary']); ?>
                                </div>
                                <?php
                                    echo $this->Form->control('role_id', ['label' => 'Perfil del usuario', 'options' => $roles, 'empty' => 'Seleccione el perfil del usuario', 'class' => 'form-control']);
                                    echo $this->Form->control('username', ['label' => 'Nombre de usuario', 'class' => 'form-control', 'placeholder' => 'Escriba el nombre de usuario']);
                                    echo $this->Form->control('password', ['label' => 'Contraseña', 'class' => 'form-control', 'placeholder' => 'Escriba la contraseña del usuario']);
                                    echo $this->Form->control('confirm_password', ['label' => 'Repetir contraseña', 'class' => 'form-control', 'placeholder' => 'Escriba nuevamente la contraseña del usuario', 'type' => 'password']);
                                    echo $this->Form->control('fullname', ['label' => 'Nombre completo', 'class' => 'form-control', 'placeholder' => 'Escriba el nombre completo del usuario']);
                                ?>
                            </fieldset>
                            <div style="text-align:right;" class="pt-5">
                                <?= $this->Form->button('Modificar', ['class' => 'btn btn-primary']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var csrf = "<?= $this->request->getCookie('csrfToken')?>";
</script>
<?= $this->Html->script('validator-user'); ?>