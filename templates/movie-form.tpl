{include file='templates/header.tpl'}

<div class="container">
    <div class="mt-5 mb-5 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h1>{$title}</h1>
            </div>
            <div class="row"></div>
            {if $mode === 'create'}
                <form action="insertar" method="POST" class="my-4">
                {else}
                    <form action="actualizar/{$movie->movieID}" method="PUT" class="my-4">
                    {/if}
                    <div class="row mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Titulo</label>
                                    {if $mode === 'create'}
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Titulo"
                                            required>
                                    {else}
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Titulo"
                                            value="{$movie->title}" required>
                                    {/if}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category">Categoria</label>
                                    <select id="category" name="category" class="form-control" required>
                                        <option value="null">Seleccione</option>
                                        {if $mode === 'create'}
                                            {foreach from=$categories item=$category}
                                                <option value="{$category->categoryID}">{$category->categoryName}</option>
                                            {/foreach}
                                        {else}
                                            {foreach from=$categories item=$category}
                                                <option value="{$category->categoryID}"
                                                    selected="{$category->categoryID === $movie->categoryID}">
                                                    {$category->categoryName}</option>
                                            {/foreach}
                                        {/if}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    {if $mode === 'create'}
                                        <textarea id="description" name="description" class="form-control" rows="4"
                                            placeholder="Descripción" maxlength="1000" required></textarea>
                                    {else}
                                        <textarea id="description" name="description" class="form-control" rows="4"
                                            placeholder="Descripción" maxlength="1000"
                                            required>{$movie->description}</textarea>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                    {if $error}
                        <div class="alert alert-danger mt-3">
                            {$error}
                        </div>
                    {/if}
                    <div class="row mt-4">
                        <div class="col-md-12 d-flex justify-content-center">
                            <a type="button" class="btn btn-danger me-2" href="peliculas">Cancelar</a>
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
{include file='templates/footer.tpl'}