<?php
/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2021/4/15
 * Time: 10:37
 */

namespace Wanphp\Components\Category\Application;


use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Wanphp\Components\Category\Domain\TagsInterface;

class TagApi extends Api
{
  private TagsInterface $tag;

  public function __construct(TagsInterface $tag)
  {
    $this->tag = $tag;
  }

  /**
   * @return Response
   * @throws Exception
   * @OA\Post(
   *  path="/api/manage/tag",
   *  tags={"Tag"},
   *  summary="新建标签",
   *  operationId="addTag",
   *  security={{"bearerAuth":{}}},
   *   @OA\RequestBody(
   *     description="标签",
   *     required=true,
   *     @OA\MediaType(
   *       mediaType="application/json",
   *       @OA\Schema(ref="#/components/schemas/NewTag")
   *     )
   *   ),
   *  @OA\Response(
   *    response="201",
   *    description="创建成功",
   *    @OA\JsonContent(
   *      allOf={
   *       @OA\Schema(ref="#/components/schemas/Success"),
   *       @OA\Schema(
   *         @OA\Property(property="datas",@OA\Property(property="id",type="integer"))
   *       )
   *      }
   *    )
   *  ),
   *  @OA\Response(response="400",description="请求失败",@OA\JsonContent(ref="#/components/schemas/Error"))
   * )
   * @OA\Put(
   *  path="/api/manage/tag/{id}",
   *  tags={"Tag"},
   *  summary="修改标签",
   *  operationId="editTag",
   *  security={{"bearerAuth":{}}},
   *   @OA\Parameter(
   *     name="id",
   *     in="path",
   *     description="标签ID",
   *     required=true,
   *     @OA\Schema(format="int64",type="integer")
   *   ),
   *   @OA\RequestBody(
   *     description="指定需要更新数据",
   *     required=true,
   *     @OA\MediaType(
   *       mediaType="application/json",
   *       @OA\Schema(ref="#/components/schemas/NewTag")
   *     )
   *   ),
   *  @OA\Response(
   *    response="201",
   *    description="更新成功",
   *    @OA\JsonContent(
   *      allOf={
   *       @OA\Schema(ref="#/components/schemas/Success"),
   *       @OA\Schema(
   *         @OA\Property(property="datas",@OA\Property(property="up_num",type="integer"))
   *       )
   *      }
   *    )
   *  ),
   *  @OA\Response(response="400",description="请求失败",@OA\JsonContent(ref="#/components/schemas/Error"))
   * )
   * @OA\Delete(
   *  path="/api/manage/tag/{id}",
   *  tags={"Tag"},
   *  summary="删除分类",
   *  operationId="delTag",
   *  security={{"bearerAuth":{}}},
   *  @OA\Parameter(
   *    name="id",
   *    in="path",
   *    description="分类ID",
   *    required=true,
   *    @OA\Schema(format="int64",type="integer")
   *  ),
   *  @OA\Response(
   *    response="200",
   *    description="请求成功",
   *    @OA\JsonContent(
   *      allOf={
   *       @OA\Schema(ref="#/components/schemas/Success"),
   *       @OA\Schema(
   *         @OA\Property(property="datas",@OA\Property(property="del_num",type="integer"))
   *       )
   *      }
   *    )
   *  ),
   *  @OA\Response(response="400",description="请求失败",@OA\JsonContent(ref="#/components/schemas/Error"))
   * )
   */
  protected function action(): Response
  {
    switch ($this->request->getMethod()) {
      case 'POST':
        $data = $this->request->getParsedBody();
        $id = $this->tag->insert($data);
        return $this->respondWithData(['id' => $id], 201);
      case 'PUT':
        $data = $this->request->getParsedBody();
        $num = $this->tag->update($data, ['id' => $this->args['id']]);
        return $this->respondWithData(['up_num' => $num], 201);
      case 'DELETE':
        return $this->respondWithData(['del_num' => $this->tag->delete(['id' => $this->args['id']])]);
      default:
        return $this->respondWithError('禁止访问', 403);
    }
  }
}
