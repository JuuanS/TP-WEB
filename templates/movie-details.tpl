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
                    src="{if $movie->imageUrl !== ''}{$movie->imageUrl}{else}{BASE_URL}/assets/images/default_image.png{/if}"
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
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="feedback-box">
                    <ul class="nav nav-tabs" id="movie-feedback-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="comments-tab" data-bs-toggle="tab"
                                data-bs-target="#comments" type="button" role="tab" aria-controls="comments"
                                aria-selected="true">Comentarios</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="votes-tab" data-bs-toggle="tab" data-bs-target="#votes"
                                type="button" role="tab" aria-controls="votes" aria-selected="false">Votos</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="comments" role="tabpanel"aria-labelledby="comments-tab">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, sed laudantium? Asperiores ex dicta officiis accusamus dolorum! Similique praesentium aut nulla quia minus totam, molestiae autem pariatur, incidunt accusantium ad?
                        </div>
                        <div class="tab-pane fade" id="votes" role="tabpanel" aria-labelledby="votes-tab">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 d-flex justify-content-center">
                <a type="button" class="btn btn-primary" href="peliculas">Volver</a>
            </div>
        </div>
    </div>
</div>
{include file='templates/footer.tpl'}