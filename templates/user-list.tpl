{include file='templates/header.tpl' activeLink='usuarios'}

<div class="container">
    <div class="mt-5 mb-5 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h1>{$title}</h1>
            </div>
        </div>
        <div class="row mt-4 mb-4 d-flex justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="row">
                    <ul class="list-group">
                        {foreach from=$users item=$user}
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    {$user->userName} - {$user->email}{if $user->roleName eq 'ADMIN'} | <span
                                        class="admin">{$user->roleName}</span>{/if}
                                </div>
                                <div>
                                    {if $user->roleName neq 'ADMIN'}
                                        <a type="button" class="btn btn-success"
                                            href="dar-permiso/{$user->userID}">Convertir en Admin</a>
                                    {/if}
                                    {if $user->userID neq $smarty.session.USER_ID && $user->roleName eq 'ADMIN'}
                                        <a type="button" class="btn btn-warning ms-1"
                                            href="quitar-permiso/{$user->userID}">Quitar permiso de Admin</a>
                                    {/if}
                                    {if $user->userID neq $smarty.session.USER_ID}
                                        <a type="button" class="btn btn-danger ms-1"
                                            href="borrar-usuario/{$user->userID}">Eliminar</a>
                                    {/if}
                                </div>
                            </li>
                        {/foreach}
                    </ul>
                </div>
                <div class="row">
                    {if $error}
                        <div class="alert alert-danger mt-3">
                            {$error}
                        </div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>

{include file='templates/footer.tpl'}