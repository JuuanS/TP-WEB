{include file='templates/header.tpl' activeLink='categorias'}

<div class="container">
    <div class="mt-5 mb-5 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h1>{$title}</h1>
            </div>
        </div>
        <div class="row mt-4 mb-4 d-flex justify-content-center align-items-center">
            <div class="col-md-12">
                <form action="registrar-usuario" method="POST" class="my-4">
                    <div class="row mt-3 d-flex justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="userName">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="userName" name="userName"
                                    placeholder="Nombre de Usuario" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Contraseña" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {* {if $error}
                            <div class="alert alert-danger mt-3">
                                {$error}
                            </div>
                        {/if} *}
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 d-flex justify-content-center mt-4">
                            <a type="button" class="btn btn-danger me-2" href="login">Cancelar</a>
                            <button type="submit" class="btn btn-primary ms-2">Crear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{include file='templates/footer.tpl'}