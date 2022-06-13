<?php
/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2020/9/25
 * Time: 10:49
 */

namespace Wanphp\Components\Category\Application;

/**
 * @OA\Info(
 *     description="wanphp 分类扩展接口",
 *     version="1.0.0",
 *     title="分类扩展接口"
 * )
 * @OA\Tag(
 *     name="Category",
 *     description="分类"
 * )
 * @OA\Tag(
 *     name="Tag",
 *     description="标签"
 * )
 */

/**
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat="JWT",
 * )
 * @OA\Schema(
 *   title="出错提示",
 *   schema="Error",
 *   type="object"
 * )
 * @OA\Schema(
 *   title="成功提示",
 *   schema="Success",
 *   type="object"
 * )
 */

use Wanphp\Libray\Slim\Action;

abstract class Api extends Action
{

}
