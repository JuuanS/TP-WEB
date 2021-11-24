<section id="template-movie-list">
    <div class="container">
        <div class="mt-5 mb-5 p-4">
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
                                <a type="button" class="btn btn-outline-success" href="agregar-pelicula">Agregar
                                    Pelicula</a>
                            </div>
                        {/if}
                    </div>
                    {literal}
                        <form id="search-movie-form" v-on:submit.prevent="handleOnSearch">
                        {/literal}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title">Titulo</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Titulo">
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
                                <button type="submit" class="btn btn-outline-primary">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    {literal}
                        <div class="row" v-if="movies && movies.length > 0">
                            <div v-for="movie in movies"
                                class="col-xl-3 col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center my-3">
                                <div class="card" style="width: 18rem;">
                                    <div v-if="movie && movie.imageUrl && movie.imageUrl.length > 0">
                                        <img class="card-img-top" :src="movie.imageUrl" alt="Default Image" width="286px"
                                            height="286px">
                                    </div>
                                    <div v-else>
                                    {/literal}
                                    <img class="card-img-top" src="{BASE_URL}/assets/images/default_image.png"
                                        alt="Default Image" width="286px" height="286px">
                                </div>
                                {literal}
                                    <div class="card-body">
                                        <h5 class="card-title">{{movie.title}}</h5>
                                        <h6 class="card-title">{{movie.categoryName}}</h6>
                                        <div class="card-text description-container">
                                            {{movie.description}}
                                        </div>
                                    </div>
                                    <div class="card-body d-flex justify-content-evenly align-items-end">
                                        <a type="button" class="btn btn-outline-dark"
                                            :href="'pelicula/' + movie.movieID">Ver
                                            Detalle</a>
                                    {/literal}
                                    {if $userRole === 'ADMIN'}
                                        {literal}
                                            <a type="button" class="btn btn-outline-danger"
                                                :href="'borrar/' + movie.movieID">Eliminar</a>
                                        {/literal}
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                    {literal}
                        <div v-else>
                            <div v-if="searchResponse" class="alert alert-info mt-3">
                                No se encontraron peliculas.
                            </div>
                        </div>
                    {/literal}
                </div>
            </div>
            <div class="row">
                {literal}
                    <div class="btn-group-pagination my-4">
                        <button id="btn-pag-previous" class="btn btn-outline-dark me-3" type="button"
                            v-on:click="handlePreviousPage">Anterior</button>
                        <div class="current-page-container">
                            <span id="current-page"></span>
                        </div>
                        <button id="btn-pag-next" class="btn btn-outline-dark ms-3" type="button"
                            v-on:click="handleNextPage">Siguiente</button>
                    </div>
                {/literal}
            </div>
        </div>
    </div>
</section>