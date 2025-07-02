<?php

if (!function_exists('isActive')) {
    function isActive($routeName)
    {
        return request()->routeIs($routeName) ? 'active' : '';
    }
}

if(!function_exists('menuOpen')){
    function menuOpen($routeName)
    {
        return request()->routeIs($routeName) ? 'menu-open' : '';
    }
}
