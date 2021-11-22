<section id="template-comments">
    <input id="movie" name="movie-id" type="number" value="{$movie->movieID}" hidden>
    <div class="row mt-3">
        <div class="col-md-12">
            <div>
                <ul class="nav nav-tabs" id="movie-feedback-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="comments-tab" data-bs-toggle="tab"
                            data-bs-target="#comments" type="button" role="tab" aria-controls="comments"
                            aria-selected="true">Comentarios</button>
                    </li>
                </ul>
                <div class="tab-content" id="comment-tab-content">
                    <div class="tab-pane fade show active" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row align-items-center">
                                <label for="votes-search">Votos:</label>
                                <select id="votes-search" name="votes-search" class="form-control ms-2">
                                    <option value="">Seleccione:</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button id="search-by-vote" type="button"
                                    class="btn btn-sm btn-outline-primary ms-4">Buscar</button>
                            </div>
                            <div>
                                {literal}
                                    <button id="sort-date" type="button" class="btn btn-sm btn-outline-dark me-1">
                                        Ordenar por fecha
                                        <svg v-if="orderDate && orderDate === 'desc'" xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-sort-up"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707V12.5zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                                        </svg>
                                        <svg v-if="orderDate && orderDate === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-sort-down"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293V2.5zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                                        </svg>
                                    </button>
                                    <button id="sort-votes" type="button" class="btn btn-sm btn-outline-dark me-3">
                                        Ordenar por votos
                                        <svg v-if="orderVotes && orderVotes === 'desc'" xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-sort-up"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707V12.5zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                                        </svg>
                                        <svg v-if="orderVotes && orderVotes === 'asc'" xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-sort-down"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293V2.5zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                                        </svg>
                                    </button>
                                {/literal}
                                {if isset($smarty.session.USER_ID)}
                                    {literal}
                                        <button id="show-add-comment" type="button"
                                            class="btn btn-sm btn-outline-success">Agregar
                                            Comentario</button>
                                    {/literal}
                                {/if}
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                {literal}
                                    <ul class="list-group" v-if="comments && comments.length > 0">
                                        <li v-for="comment in comments" class="list-group-item">
                                            <span class="fw-600">{{comment.userName}}</span> -
                                            {{new Date(comment.commentDate).toLocaleString()}}
                                            <div>
                                                {{comment.comment}}
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                Voto: {{comment.vote}}/5
                                            {/literal}
                                            {if isset($smarty.session.USER_ROLE) && $smarty.session.USER_ROLE === 'ADMIN'}
                                                {literal}
                                                    <button type="button" :id="'btn-delete_' + comment.commentID"
                                                        class="btn btn-sm btn-outline-danger btn-delete">Eliminar</i></button>
                                                {/literal}
                                            {/if}
                                        </div>
                                    </li>
                                </ul>
                                <div v-else>
                                    <div v-if="searchResponse" class="alert alert-info mt-3">
                                        No se encontraron comentarios.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {literal}
        <div class="row mt-3" v-if="showAddForm">
        {/literal}
        <div class="col-md-12">
            <div class="feedback-box">
                <div class="row">
                    <h5>Agregar Comentario</h5>
                </div>
                <form id="form-add-comment">
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="vote">Voto</label>
                                <select id="vote" name="vote" class="form-control" required>
                                    <option value="">Seleccione:</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label for="comment">Comentario</label>
                                <textarea id="comment" name="comment" class="form-control" rows="4"
                                    placeholder="Comentario" maxlength="1000" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center mt-4">
                            <button id="hide-add-comment" type="button"
                                class="btn btn-outline-danger me-1">Cancelar</i></button>
                            <button id="confirm-add-comment" type="submit"
                                class="btn btn-outline-dark ms-1">Comentar</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>