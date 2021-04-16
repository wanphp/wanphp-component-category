<?php
/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2020/12/16
 * Time: 11:23
 */

namespace Wanphp\Components\Category\Entities;


use JsonSerializable;
use Wanphp\Libray\Mysql\EntityTrait;

/**
 * Class CategoryEntity
 * @package Wanphp\Components\Category\Entities
 * @OA\Schema(schema="NewCategory",title="新建分类", required={"name"})
 */
class CategoryEntity implements JsonSerializable
{
  use EntityTrait;

  /**
   * @DBType({"key":"PRI","type":"smallint(6) NOT NULL AUTO_INCREMENT"})
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
   * @DBType({"key":"MUL","type":"smallint(6) NOT NULL DEFAULT 0"})
   * @OA\Property(description="父类ID")
   * @var integer
   */
  private int $parent_id;
  /**
   * @DBType({"type":"varchar(20) NOT NULL DEFAULT ''"})
   * @OA\Property(description="名称")
   * @var string
   */
  private string $name;
  /**
   * @DBType({"type":"varchar(200) NOT NULL DEFAULT ''"})
   * @OA\Property(description="封面")
   * @var string
   */
  private string $cover;
  /**
   * @DBType({"type":"varchar(300) NOT NULL DEFAULT ''"})
   * @OA\Property(description="分类简介")
   * @var string
   */
  private string $description;
  /**
   * @DBType({"type":"varchar(200) NOT NULL DEFAULT ''"})
   * @var string
   */
  private string $parent_path;
  /**
   * @DBType({"type":"tinyint(4) NOT NULL DEFAULT ''"})
   * @var string
   */
  private string $deep;
  /**
   * @DBType({"type":"smallint(6) NOT NULL DEFAULT 0"})
   * @OA\Property(description="排序")
   * @var integer
   */
  private int $sortOrder;
}
/**
 * @OA\Schema(
 *   schema="CategoryList",
 *   title="分类",
 *   type="object",
 *   allOf={
 *       @OA\Schema(ref="#/components/schemas/NewCategory"),
 *       @OA\Schema(
 *           required={"id"},
 *           @OA\Property(property="id",format="int64", type="integer", description="分类ID")
 *       )
 *   }
 * )
 */
