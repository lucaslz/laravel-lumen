<?php

if (!function_exists('check_correct_url')) {
    
    /**
     * check if the url is correct.
     *
     * @param string $redirect
     * @return void
     */
    function check_correct_url(string $redirect)
    {
        if (strpos($redirect, env('APP_URL')) === false) {
            $urlParsed = parse_url($redirect);
            $redirect = $urlParsed['scheme'] . '://' .$urlParsed['host'] . '/' . env('APP_NAME') . $urlParsed['path'] . '?' . $urlParsed['query'];
        }
        return $redirect;
    }
}

if (!function_exists('link_formatter')) {
        
    /**
    * Format the link.
    *
    * @param string $link
    * @return void
    */
    function link_formatter(string $rel, string $method, string $route)
    {
        return [
            'rel' => strtolower($rel),
            'method' => strtoupper($method),
            'href' => $route
        ];
    }
}