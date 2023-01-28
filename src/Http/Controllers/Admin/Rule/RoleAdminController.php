<?php

namespace Tripteki\Adminer\Http\Controllers\Admin\Rule;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Tripteki\ACL\Contracts\Repository\Admin\IACLRoleRepository;
use Tripteki\Adminer\Http\Requests\Admin\Rules\Roles\RoleShowValidation;
use Tripteki\Adminer\Http\Requests\Admin\Rules\Roles\RoleStoreValidation;
use Tripteki\Adminer\Http\Requests\Admin\Rules\Roles\RoleDestroyValidation;
use Tripteki\Adminer\Http\Controllers\Controller;

class RoleAdminController extends Controller
{
    /**
     * @var \Tripteki\ACL\Contracts\Repository\Admin\IACLRoleRepository
     */
    protected $roleAdminRepository;

    /**
     * @param \Tripteki\ACL\Contracts\Repository\Admin\IACLRoleRepository $roleAdminRepository
     * @return void
     */
    public function __construct(IACLRoleRepository $roleAdminRepository)
    {
        $this->roleAdminRepository = $roleAdminRepository;
    }

    /**
     * @OA\Get(
     *      path="/admin/rules/roles",
     *      tags={"Admin Rule Role"},
     *      summary="Index",
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="limit",
     *          description="Rule Role's Pagination Limit."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="current_page",
     *          description="Rule Role's Pagination Current Page."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="order",
     *          description="Rule Role's Pagination Order."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="filter[]",
     *          description="Rule Role's Pagination Filter."
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

        $data = $this->roleAdminRepository->all();

        return iresponse($data, $statecode);
    }

    /**
     * @OA\Get(
     *      path="/admin/rules/roles/{role}",
     *      tags={"Admin Rule Role"},
     *      summary="Show",
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="role",
     *          description="Rule Role's Role."
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
     * @param \Tripteki\Adminer\Http\Requests\Admin\Rules\Roles\RoleShowValidation $request
     * @param string $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RoleShowValidation $request, $role)
    {
        $form = $request->validated();
        $data = [];
        $statecode = 200;

        $data = $this->roleAdminRepository->get($role);

        return iresponse($data, $statecode);
    }

    /**
     * @OA\Post(
     *      path="/admin/rules/roles",
     *      tags={"Admin Rule Role"},
     *      summary="Store",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="role",
     *                      type="string",
     *                      description="Rule Role's Role."
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
     * @param \Tripteki\Adminer\Http\Requests\Admin\Rules\Roles\RoleStoreValidation $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleStoreValidation $request)
    {
        $form = $request->validated();
        $data = [];
        $statecode = 202;

        $data = $this->roleAdminRepository->rule($form["role"]);

        if ($data) {

            $statecode = 201;
        }

        return iresponse($data, $statecode);
    }

    /**
     * @OA\Delete(
     *      path="/admin/rules/roles/{role}",
     *      tags={"Admin Rule Role"},
     *      summary="Destroy",
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="role",
     *          description="Rule Role's Role."
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
     * @param \Tripteki\Adminer\Http\Requests\Admin\Rules\Roles\RoleDestroyValidation $request
     * @param string $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RoleDestroyValidation $request, $role)
    {
        $form = $request->validated();
        $data = [];
        $statecode = 202;

        $data = $this->roleAdminRepository->unrule($role);

        if ($data) {

            $statecode = 200;
        }

        return iresponse($data, $statecode);
    }
};
