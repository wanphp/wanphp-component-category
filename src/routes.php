<?php
declare(strict_types=1);

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Psr\Http\Server\MiddlewareInterface as Middleware;

return function (App $app, Middleware $PermissionMiddleware, Middleware $OAuthServerMiddleware) {
  $app->group('/api/manage', function (Group $group) {
    //分类
    $group->map(['PUT', 'POST', 'DELETE'], '/category[/{id:[0-9]+}]', \Wanphp\Components\Category\Application\CategoryApi::class);
    //标签
    $group->map(['PUT', 'POST', 'DELETE'], '/tag[/{id:[0-9]+}]', \Wanphp\Components\Category\Application\TagApi::class);
  })->addMiddleware($PermissionMiddleware)->addMiddleware($OAuthServerMiddleware);
};


