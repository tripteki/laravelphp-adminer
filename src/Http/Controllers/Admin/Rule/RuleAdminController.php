<?php

namespace Tripteki\Adminer\Http\Controllers\Admin\Rule;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Tripteki\Helpers\Contracts\AuthModelContract;
use Tripteki\ACL\Contracts\Repository\Admin\IACLRoleRepository as IACLRuleRoleRepository;
use Tripteki\ACL\Contracts\Repository\IACLRepository as IACLRuleUserRepository;
use Tripteki\Adminer\Http\Requests\Admin\Rules\RuleValidation;
use Tripteki\Adminer\Http\Controllers\Controller;

class RuleAdminController extends Controller
{
    /**
     * @var \Tripteki\ACL\Contracts\Repository\Admin\IACLRoleRepository
     */
    protected $ruleRoleAdminRepository;

    /**
     * @var \Tripteki\ACL\Contracts\Repository\IACLRepository
     */
    protected $ruleUserAdminRepository;

    /**
     * @param \Tripteki\ACL\Contracts\Repository\Admin\IACLRoleRepository $ruleRoleAdminRepository
     * @param \Tripteki\ACL\Contracts\Repository\IACLRepository $ruleUserAdminRepository
     * @return void
     */
    public function __construct(IACLRuleRoleRepository $ruleRoleAdminRepository, IACLRuleUserRepository $ruleUserAdminRepository)
    {
        $this->ruleRoleAdminRepository = $ruleRoleAdminRepository;
        $this->ruleUserAdminRepository = $ruleUserAdminRepository;
    }

    /**
     * @OA\Put(
     *      path="/admin/rules/{context}/{object}",
     *      tags={"Admin Rule"},
     *      summary="rule",
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="context",
     *          schema={"type": "string", "enum": {"grant_permissions_to_role", "revoke_permissions_from_role", "grant_roles_to_user", "revoke_roles_from_user"}},
     *          description="Rule's Context."
     *      ),
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="object",
     *          description="Rule's Object."
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="rules",
     *                      type="array",
     *                      @OA\Items(type="string"),
     *                      description="Rule's Rules."
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
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found."
     *      )
     * )
     *
     * @param \Tripteki\Adminer\Http\Requests\Admin\Rules\RuleValidation $request
     * @param string $context
     * @param string $object
     * @return \Illuminate\Http\JsonResponse
     */
    public function rule(RuleValidation $request, $context, $object)
    {
        $form = $request->validated();
        $data = [];
        $statecode = 202;

        if ($context == RuleValidation::GRANT_PERMISSIONS_TO_ROLE || $context == RuleValidation::REVOKE_PERMISSIONS_FROM_ROLE) {

            $this->ruleRoleAdminRepository->forRole($object);

            foreach ($form["rules"] as $rule) {

                if ($context == RuleValidation::GRANT_PERMISSIONS_TO_ROLE) {

                    $data[] = $this->ruleRoleAdminRepository->grant($rule);

                } else if ($context == RuleValidation::REVOKE_PERMISSIONS_FROM_ROLE) {

                    $data[] = $this->ruleRoleAdminRepository->revoke($rule);
                }
            }

        } else if ($context == RuleValidation::GRANT_ROLES_TO_USER || $context == RuleValidation::REVOKE_ROLES_FROM_USER) {

            $this->ruleUserAdminRepository->setUser(app(AuthModelContract::class)->findOrFail($object));

            foreach ($form["rules"] as $rule) {

                if ($context == RuleValidation::GRANT_ROLES_TO_USER) {

                    $data[] = $this->ruleUserAdminRepository->grantAs($rule);

                } else if ($context == RuleValidation::REVOKE_ROLES_FROM_USER) {

                    $data[] = $this->ruleUserAdminRepository->revokeAs($rule);
                }
            }
        }

        if ($data) {

            $statecode = 201;
        }

        return iresponse($data, $statecode);
    }
};
