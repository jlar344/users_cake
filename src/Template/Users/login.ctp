<div class="row justify-content-center">
    <div class="col-md-5 col-xs-10">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <?= $this->Form->create(null) ?>
                            <fieldset>
                                <legend>Inicio de sesión</legend>
                                <div class="form-group">
                                    <?= $this->Form->control('username', ['label' => 'Nombre de usuario', 'class' => 'form-control form-control-user', 'placeholder' => 'Ingrese su nombre de usuario']); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->control('password', ['label' => 'Contraseña', 'class' => 'form-control form-control-user', 'placeholder' => 'Ingrese su contraseña de usuario']); ?>
                                </div>
                            </fieldset>
                            <div style="text-align:right;" class="pt-5">
                                <?= $this->Form->button('Ingresar', ['class' => 'btn btn-primary']) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>