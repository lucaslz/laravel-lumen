<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

if (!function_exists('repository_injection')) {
    
    /**
     * Resolve the injection repository.
     *
     * @param mixed $model
     * @return mixed
     */
    function repository_injection(string $repository)
    {
        if (interface_exists($repository)) {
            return app($repository);
        }

        throw new App\Repository\Exceptions\RepositoryNotDefined("Repository ${repository} not defined");
    }
}