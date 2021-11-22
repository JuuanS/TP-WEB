{literal}
    <section id="template-users-list">
        <div class="container">
            <div class="mt-5 mb-5 p-4">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <h1>{{title}}</h1>
                    </div>
                </div>
                <div class="row mt-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="col-md-10">
                        <div class="row">
                            <ul class="list-group" v-if="users && users.length > 0">
                                <li v-for="user in users"
                                    class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        {{user.userName}} - {{user.email}}
                                        <span class="admin" v-if="user.roleName === 'ADMIN'">{{user.roleName}}</span>
                                    </div>
                                    <div>
                                        <button :id="'btn-add_' + user.userID" v-if="user.roleName !== 'ADMIN'" type="button"
                                            class="btn btn-success">
                                            Convertir en Admin
                                        </button>
                                        <button :id="'btn-remove_' + user.userID"
                                            v-if="user.isLoggedUser != 1 && user.roleName === 'ADMIN'" type="button"
                                            class="btn btn-warning ms-1">
                                            Quitar permiso de Admin
                                        </button>
                                        <button :id="'btn-delete_' + user.userID" v-if="user.isLoggedUser != 1" type="button"
                                            class="btn btn-danger ms-1">
                                            Eliminar
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="alert alert-danger mt-3" v-if="error">
                                {{error}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{/literal}