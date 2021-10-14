<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{BASE_URL}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="">Movie Tracker</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex w-100">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="">Peliculas</a>
                        </li>
                        {if isset($smarty.session.USER_ID) && $smarty.session.USER_ROLE === 'ADMIN'}
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="categorias">Categorias</a>
                            </li>
                        {/if}
                    

                        <li class="nav-item ms-auto  d-flex justify-content-center align-items-center">
                            {if isset($smarty.session.USER_ID)}
                                <div>
                                    {$smarty.session.USER_EMAIL}
                                </div>
                                <a class="nav-link btn btn-primary text-white ms-3" href="logout">Cerrar Sesión</a>
                            {else}
                                <a class="nav-link btn btn-primary text-white" href="login">Ingresar</a>
                            {/if}
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

{* <div class="{$containerClass}"> *}