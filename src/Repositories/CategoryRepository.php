<?php
/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2020/12/16
 * Time: 11:35
 */

namespace Wanphp\Components\Category\Repositories;


use Wanphp\Libray\Mysql\BaseRepository;
use Wanphp\Libray\Mysql\Database;
use Wanphp\Components\Category\Domain\CategoryInterface;
use Wanphp\Components\Category\Entities\CategoryEntity;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
  public function __construct(Database $database)
  {
    parent::__construct($database, self::TABLENAME, CategoryEntity::class);
  }
}
