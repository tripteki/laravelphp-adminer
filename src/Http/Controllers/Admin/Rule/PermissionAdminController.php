<?php

namespace Tripteki\Adminer\Http\Controllers\Admin\Rule;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Tripteki\ACL\Contracts\Repository\Admin\IACLPermissionRepository;
use Tripteki\Adminer\Http\Requests\Admin\Rules\Permissions\PermissionShowValidation;
use Tripteki\Adminer\Http\Requests\Admin\Rules\Permissions\PermissionStoreValidation;
use Tripteki\Adminer\Http\Requests\Admin\Rules\Permissions\PermissionDestroyValidation;
use Tripteki\Adminer\Http\Controllers\Controller;

class PermissionAdminController extends Controller
{
    /**
     * @var \Tripteki\ACL\Contracts\Repository\Admin\IACLPermissionRepository
     */
    protected $permissionAdminRepository;

    /**
     * @param \Tripteki\ACL\Contracts\Repository\Admin\IACLPermissionRepository $permissionAdminRepository
     * @return void
     */
    public function __construct(IACLPermissionRepository $permissionAdminRepository)
    {
        $this->permissionAdminRepository = $permissionAdminRepository;
    }

    /**
     * @OA\Get(
     *      path="/admin/rules/permissions",
     *      tags={"Admin Rule Permission"},
     *      summary="Index",
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="limit",
     *          description="Rule Permission's Pagination Limit."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="current_page",
     *          description="Rule Permission's Pagination Current Page."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="order",
     *          description="Rule Permission's Pagination Order."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="filter[]",
     *          description="Rule Permission's Pagination Filter."
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success."
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = [];
        $statecode = 200;

        $data = $this->permissionAdminRepository->all();

        return iresponse($data, $statecode);
    }

    /**
     * @OA\Get(
     *      path="/admin/rules/permissions/{permission}",
     *      tags={"Admin Rule Permission"},
     *      summary="Show",
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="permission",
     *          description="Rule Permission's Permission."
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found."
     *      )
     * )
     *
     * @param \Tripteki\Adminer\Http\Requests\Admin\Rules\Permissions\PermissionShowValidation $request
     * @param string $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(PermissionShowValidation $request, $permission)
    {
        $form = $request->validated();
        $data = [];
        $statecode = 200;

        $data = $this->permissionAdminRepository->get($permission);

        return iresponse($data, $statecode);
    }

    /**
     * @OA\Post(
     *      path="/admin/rules/permissions",
     *      tags={"Admin Rule Permission"},
     *      summary="Store",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="permission",
     *                      type="string",
     *                      description="Rule Permission's Permission."
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created."
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity."
     *      )
     * )
     *
     * @param \Tripteki\Adminer\Http\Requests\Admin\Rules\Permissions\PermissionStoreValidation $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PermissionStoreValidation $request)
    {
        $form = $request->validated();
        $data = [];
        $statecode = 202;

        $data = $this->permissionAdminRepository->rule($form["permission"]);

        if ($data) {

            $statecode = 201;
        }

        return iresponse($data, $statecode);
    }

    /**
     * @OA\Delete(
     *      path="/admin/rules/permissions/{permission}",
     *      tags={"Admin Rule Permission"},
     *      summary="Destroy",
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="permission",
     *          description="Rule Permission's Permission."
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success."
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found."
     *      )
     * )
     *
     * @param \Tripteki\Adminer\Http\Requests\Admin\Rules\Permissions\PermissionDestroyValidation $request
     * @param string $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(PermissionDestroyValidation $request, $permission)
    {
        $form = $request->validated();
        $data = [];
        $statecode = 202;

        $data = $this->permissionAdminRepository->unrule($permission);

        if ($data) {

            $statecode = 200;
        }

        return iresponse($data, $statecode);
    }
};
