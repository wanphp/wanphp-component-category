<?php
/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2020/12/16
 * Time: 11:21
 */

namespace Wanphp\Components\Category\Domain;


use Wanphp\Libray\Mysql\BaseInterface;

interface TagsInterface extends BaseInterface
{
  const TABLENAME = "tags";
}
