<?php
/**
 * Created by PhpStorm.
 * User: 火子 QQ：284503866.
 * Date: 2021/4/14
 * Time: 9:59
 */

namespace Wanphp\Components\Category\Application;


use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Wanphp\Components\Category\Domain\CategoryInterface;

class CategoryApi extends Api
{
  /**
   * @var CategoryInterface
   */
  private CategoryInterface $category;

  public function __construct(CategoryInterface $category)
  {
    $this->category = $category;
  }

  /**
   * @return Response
   * @throws Exception
   * @OA\Post(
   *  path="/admin/category",
   *  tags={"Category"},
   *  summary="新建分类",
   *  operationId="addCategory",
   *  security={{"bearerAuth":{}}},
   *   @OA\RequestBody(
   *     description="分类",
   *     required=true,
   *     @OA\MediaType(
   *       mediaType="application/json",
   *       @OA\Schema(ref="#/components/schemas/newCategory")
   *     )
   *   ),
   *  @OA\Response(
   *    response="201",
   *    description="创建成功",
   *    @OA\JsonContent(
   *      allOf={
   *       @OA\Schema(ref="#/components/schemas/Success"),
   *       @OA\Schema(
   *         @OA\Property(property="id",type="integer")
   *       )
   *      }
   *    )
   *  ),
   *  @OA\Response(response="400",description="请求失败",@OA\JsonContent(ref="#/components/schemas/Error"))
   * )
   * @OA\Put(
   *  path="/admin/category/{id}",
   *  tags={"Category"},
   *  summary="修改分类",
   *  operationId="editCategory",
   *  security={{"bearerAuth":{}}},
   *   @OA\Parameter(
   *     name="id",
   *     in="path",
   *     description="分类ID",
   *     required=true,
   *     @OA\Schema(format="int64",type="integer")
   *   ),
   *   @OA\RequestBody(
   *     description="指定需要更新数据",
   *     required=true,
   *     @OA\MediaType(
   *       mediaType="application/json",
   *       @OA\Schema(ref="#/components/schemas/newCategory")
   *     )
   *   ),
   *  @OA\Response(
   *    response="201",
   *    description="更新成功",
   *    @OA\JsonContent(
   *      allOf={
   *       @OA\Schema(ref="#/components/schemas/Success"),
   *       @OA\Schema(
   *         @OA\Property(property="upNum",type="integer")
   *       )
   *      }
   *    )
   *  ),
   *  @OA\Response(response="400",description="请求失败",@OA\JsonContent(ref="#/components/schemas/Error"))
   * )
   * @OA\Delete(
   *  path="/admin/category/{id}",
   *  tags={"Category"},
   *  summary="删除分类",
   *  operationId="delCategory",
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
   *         @OA\Property(property="delNum",type="integer")
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
        if (isset($data['parentId']) && $data['parentId'] > 0) {
          $data['parentPath'] = $this->category->get('parentPath[JSON]', ['id' => $data['parentId']]);
          $data['parentPath'][] = $data['parentId'];
          $data['deep'] = count($data['parentPath']);
        } else {
          $data['parentPath'] = [];
          $data['deep'] = 0;
        }
        $id = $this->category->insert($data);
        return $this->respondWithData(['id' => $id], 201);
      case 'PUT':
        $id = $this->args['id'];
        if ($id > 0) {
          $data = $this->request->getParsedBody();
          if (isset($data['parentId']) && $data['parentId'] > 0) {
            $parentPath = $this->category->get('parentPath[JSON]', ['id' => $data['parentId']]);
            $parentPath[] = $data['parentId'];
            $data['parentPath'] = $parentPath;
            $data['deep'] = count($parentPath);
          } else {
            $data['parentId'] = 0;
            $data['parentPath'] = '';
            $data['deep'] = 0;
          }

          $num = $this->category->update($data, ['id' => $id]);
          if ($num > 0) {
            //更新子分类,父路径
            $parentId = $this->category->get('parentId', ['id' => $id]);
            if ($data['parentId'] != $parentId) $this->upChild($id);
          }
          return $this->respondWithData(['upNum' => $num], 201);
        } else {
          return $this->respondWithError('ID有误', 403);
        }
      case 'DELETE':
        return $this->respondWithData(['delNum' => $this->category->delete(['id' => $this->args['id']])]);
      default:
        return $this->respondWithError('禁止访问', 403);
    }
  }

  /**
   * @param $id
   * @throws Exception
   */
  private function upChild($id)
  {
    $data['parentPath'] = $this->category->get('parentPath[JSON]', ['id' => $id]);
    $data['parentPath'][] = $id;
    $data['deep'] = count($data['parentPath']);
    $child = $this->category->select('id', ['parentId' => $id]);
    if ($child) {
      $this->category->update($data, ['id' => $child]);
      foreach ($child as $id) $this->upChild($id);
    }
  }
}
