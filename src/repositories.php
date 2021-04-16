<?php
declare(strict_types=1);

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
  $containerBuilder->addDefinitions([
    \Wanphp\Components\Category\Domain\CategoryInterface::class => \DI\autowire(\Wanphp\Components\Category\Repositories\CategoryRepository::class),
    \Wanphp\Components\Category\Domain\TagsInterface::class => \DI\autowire(\Wanphp\Components\Category\Repositories\TagsRepository::class)
  ]);
};
