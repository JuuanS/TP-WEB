{include file='templates/header.tpl'}

<div class="mt-5 p-4">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <h1>{$title}</h1>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <img class="card-img-top" src="{BASE_URL}/assets/images/default_image.png" alt="Default Image">
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-start align-items-baseline">
                <h2>{$movie->title}</h2>
                <div class="pt-3 mx-3 vertical-separator"></div>
                <h4>{$movie->categoryName}</h4>
            </div>
            <p>{$movie->description}</p>
        </div>
        {if $userRole === "ADMIN"}
        <div class="col-md-2 d-flex align-items-start justify-content-end">
            <a type="button" class="btn btn-success" href="editar-pelicula/{$movie->movieID}">Editar</a>
        </div>
        {/if}
    </div>
    <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-center">
            <a type="button" class="btn btn-primary" href="peliculas">Volver</a>
        </div>
    </div>
</div>

{include file='templates/footer.tpl'}