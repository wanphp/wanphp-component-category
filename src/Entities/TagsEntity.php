<?php
/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2020/12/7
 * Time: 13:53
 */

namespace Wanphp\Components\Category\Entities;


use JsonSerializable;
use Wanphp\Libray\Mysql\EntityTrait;

/**
 * Class Tags
 * @package Wanphp\Components\Category\Entities
 * @OA\Schema(schema="newTag",title="新建标签",required={"name","code"})
 */
class TagsEntity implements JsonSerializable
{
  use EntityTrait;

  /**
   * @DBType({"key":"PRI","type":"smallint NOT NULL AUTO_INCREMENT"})
   * @var integer|null
   */
  private ?int $id;
  /**
   * 分组,如：article,link
   * @DBType({"key":"MUL","type":"varchar(20) NOT NULL DEFAULT ''"})
   * @var string
   */
  private string $code;
  /**
   * @DBType({"type":"varchar(30) NOT NULL DEFAULT ''"})
   * @OA\Property(description="标签名称")
   * @var string
   */
  private string $name;
  /**
   * @DBType({"type":"smallint(6) NOT NULL DEFAULT 0"})
   * @OA\Property(description="排序")
   * @var integer
   */
  private int $sortOrder;
}

/**
 * @OA\Schema(
 *   schema="Tags",title="标签",
 *   type="object",
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/newTag"),
 *       @OA\Schema(
 *           @OA\Property(property="id",format="int32", type="integer", description="标签ID")
 *       )
 *   }
 * )
 */
