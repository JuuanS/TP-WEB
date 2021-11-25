{include file='templates/header.tpl' activeLink='peliculas'}

<div class="container">
    <div class="mt-5 mb-5 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h1>{$title}</h1>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <img class="card-img-top"
                    src="{if !empty($movie->imageUrl)}{$movie->imageUrl}{else}{BASE_URL}/assets/images/default_image.png{/if}"
                    alt="Default Image">
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
        {include file='templates/vue/movie-comments.tpl'}
        <script src="js/comments.js"></script>
        <div class="row mt-4">
            <div class="col-md-12 d-flex justify-content-center">
                <a type="button" class="btn btn-primary" href="peliculas">Volver</a>
            </div>
        </div>
    </div>
</div>
{include file='templates/footer.tpl'}