<?php

use Illuminate\Support\Str;

/**
 * Helper functions created specifically for this site are stored
 * in this file when it does not make sense to create a class.
 */

/**
 * Set active link on side navigation.
 *
 * @param string
 * @param string
 *
 * @return string
 */
function setActive($path, $active = 'active')
{
    return Request::is($path.'*') ? $active : '';
}

/**
 * Create a model's slug.
 *
 * @param $model
 * @param string $title
 * @return string
 */
function makeSlugFromTitle($model, $title)
{
    $slug = Str::slug($title);

    $count = $model::whereRaw("alias RLIKE '^{$slug}(-[0-9]+)?$'")->count();

    return $count ? "{$slug}-{$count}" : $slug;
}

/**
 * Construct a route/url from a model and slug.
 *
 * @param $type
 * @param string $slug
 * @return string
 * @internal param string $model
 */
function makeRouteFromSlug($type, $slug)
{
    $route = '';

    switch ($type) {
        case 'sermons':
            $route = 'sermons.show';
            break;
        case 'blog':
            $route = 'blog.show';
            break;
        case 'read':
            $route = 'read.show';
            break;
        case 'worship':
            $route = 'songs.show';
            break;
        case 'series':
            $route = 'series.show';
            break;
        default:
            $route = $type;
    }

    return route($route, $slug);
}
