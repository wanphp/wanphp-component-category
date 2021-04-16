<?php
/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2020/12/16
 * Time: 11:37
 */

namespace Wanphp\Components\Category\Repositories;


use Wanphp\Libray\Mysql\BaseRepository;
use Wanphp\Libray\Mysql\Database;
use Wanphp\Components\Category\Domain\TagsInterface;
use Wanphp\Components\Category\Entities\TagsEntity;

class TagsRepository extends BaseRepository implements TagsInterface
{
  public function __construct(Database $database)
  {
    parent::__construct($database, self::TABLENAME, TagsEntity::class);
  }
}
