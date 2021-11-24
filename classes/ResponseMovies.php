<?php

class ResponseMovies
{
    function __construct(
        public $movies,
        public $collectionSize
    ) {
    }

    function getMovies()
    {
        return $this->movies;
    }

    function getCollectionSize()
    {
        return $this->collectionSize;
    }
}
