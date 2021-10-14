{include file="header.tpl" containerClass="container login-container"}

<div class="mt-5 mx-auto">
    <div class="row">
        <div class="col-12 mt-4 d-flex justify-content-center">
            <h3>Login</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <form method="POST" action="verify" class="login-form">
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" required class="form-control" id="email" name="email"
                        aria-describedby="emailHelp" placeholder="Email">
                </div>
                <div class="form-group mb-4">
                    <label for="password">Constraseña</label>
                    <input type="password" required class="form-control" id="password" name="password" placeholder="Constraseña">
                </div>

                {if $error}
                <div class="alert alert-danger mt-3">
                    {$error}
                </div>
                {/if}

                <button type="submit" class="btn btn-primary mb-3">Entrar</button>
            </form>
        </div>
    </div>
</div>

{include file='footer.tpl'}