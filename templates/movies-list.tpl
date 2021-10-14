{include file='templates/header.tpl'}

<div class="mt-5 p-4">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <h1>{$title}</h1>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h4>Filtro</h4>
                </div>
                {if $userRole === 'ADMIN'}
                <div class="col-md-6  d-flex justify-content-end">
                    <a type="button" class="btn btn-success" href="agregar-pelicula">Agregar Pelicula</a>
                </div>
                {/if}
            </div>
            <form action="busqueda" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Titulo">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="category">Categoria</label>
                            <select class="form-control" id="category" name="category">
                                <option value="{null}">Seleccione</option>
                                {foreach from=$categories item=$category}
                                <option value="{$category->categoryID}">{$category->categoryName}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="row">
                {foreach from=$movies item=$movie}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center my-3">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{BASE_URL}/assets/images/default_image.png" alt="Default Image">
                        <div class="card-body">
                            <h5 class="card-title">{$movie->title}</h5>
                            <h6 class="card-title">{$movie->categoryName}</h6>
                            <div class="card-text description-container">
                                {$movie->description}
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-evenly align-items-end">
                            <a type="button" class="btn btn-primary" href="detalle/{$movie->movieID}">Ver Detalle</a>
                            {if $userRole === 'ADMIN'}
                            <a type="button" class="btn btn-danger" href="borrar/{$movie->movieID}">Eliminar</a>
                            {/if}
                        </div>
                    </div>
                </div>
                {/foreach}
            </div>
        </div>
    </div>
</div>

{include file='templates/footer.tpl'}