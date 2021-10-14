{include 'header.tpl'}

<div class="mt-5 w-25 mx-auto">
    <div class="row">
        <div class="col-12">

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="verify" class="login-form">
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" required class="form-control" id="email" name="email"
                        aria-describedby="emailHelp">
                </div>
                <div class="form-group mb-3">
                    <label for="password">Constraseña</label>
                    <input type="password" required class="form-control" id="password" name="password">
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