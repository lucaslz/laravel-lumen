<?php

namespace App\Http\Resources;

trait ResourceLinks
{
    /**
     * Array of links to add to the resource response.
     * 
     * @var array
     */
    private array $routes = [];

    /**
     * Get the links for the resource.
     *
     * @return array
     */
    public function getLinks()
    {
        $links = [];

        if(!empty($this->routes)) {
            foreach($this->routes as $key => $route) {
                $links[$key] = [
                    'rel' => strtolower($route[0]),
                    'type' => strtoupper($route[0]),
                    'href' => route($route[1]),
                ];
            }
        }

        return $links;
    }
}