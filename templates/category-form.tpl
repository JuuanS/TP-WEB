{include file='templates/header.tpl' activeLink='categorias'}

<div class="container">
    <div class="mt-5 mb-5 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h1>{$title}</h1>
            </div>
        </div>
        <div class="row mt-4 mb-4 d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="row">
                    {if $mode === 'create'}
                    <form action="insertar-categoria" method="POST" class="my-4">
                        {else}
                        <form action="actualizar-categoria/{$category->categoryID}" method="PUT" class="my-4">
                            {/if}
                            <div class="row mt-3 d-flex justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="categoryName">Nombre Categoria</label>
                                        {if $mode === 'create'}
                                        <input type="text" class="form-control" id="categoryName" name="categoryName"
                                            placeholder="Nombre Categoria" required>
                                        {else}
                                        <input type="text" class="form-control" id="categoryName" name="categoryName"
                                            placeholder="Nombre Categoria" value="{$category->categoryName}" required>
                                        {/if}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {if $error}
                                <div class="alert alert-danger mt-3">
                                    {$error}
                                </div>
                                {/if}
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <a type="button" class="btn btn-danger me-2" href="categorias">Cancelar</a>
                                    {if $mode === 'create'}
                                    <button type="submit" class="btn btn-primary ms-2">Crear</button>
                                    {else}
                                    <button type="submit" class="btn btn-primary ms-2">Guardar</button>
                                    {/if}
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

{include file='templates/footer.tpl'}