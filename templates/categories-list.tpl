{include file='templates/header.tpl'}

<div class="container">
    <div class="mt-5 mb-5 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h1>{$title}</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6 d-flex justify-content-end">
                <a type="button" class="btn btn-success" href="agregar-categoria">Agregar Categoria</a>
            </div>
        </div>
        <div class="row mt-4 mb-4 d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="row">
                    <ul class="list-group">
                        {foreach from=$categories item=$category}
                        <div class="col-12">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    {$category->categoryName}
                                </div>
                                <div>
                                    <a type="button" class="btn btn-success"
                                        href="editar-categoria/{$category->categoryID}">Editar</a>
                                    <a type="button" class="btn btn-danger ms-1"
                                        href="borrar-categoria/{$category->categoryID}">Eliminar</a>
                                </div>
                            </li>
                        </div>
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