<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Event;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Role;
use App\Repositories\Eloquent\UserRepositoryEloquent as UserRepo;
use App\Repositories\Eloquent\UserRoleRepositoryEloquent as UserRoleRepo;
use App\Repositories\Eloquent\RoleRepositoryEloquent as RoleRepo;
use App\Events\UserConfigured;

class UserController extends Controller
{
    protected $user;
    protected $userRole;
    protected $role;

    /**
     * Create a new user controller instance.
     *
     * @param UserRepo     $user     user repository eloquen instance
     * @param UserRoleRepo $userRole user role repository eloquen instance
     * @param RoleRepo     $role     role repository eloquen instance
     */
    public function __construct(UserRepo $user, UserRoleRepo $userRole, RoleRepo $role)
    {
        $this->user = $user;
        $this->userRole = $userRole;
        $this->role = $role;
    }
    /**
     * Get all activated users.
     *
     * @return \Illuminate\Http\Response;
     */
    public function member()
    {
        $data['members'] = $this->user->having('activated', \Config::get('common.ACTIVATED'));

        return view('backend.users.members')->with($data);
    }

    /**
     * Ban an account. (soft deleting)
     *
     * @param int $id the user's id
     *
     * @return \Illuminate\Http\Response
     */
    public function ban($id)
    {
        $result = $this->user->delete($id);
        if (!$result) {
            return redirect()->back()->withErrors(trans('backend.users.members.ban_fails'));
        }
        // Event::fire(new PostDeleted($id));
        return redirect()->back()->withMessage(trans('backend.users.members.ban_success'));
    }

    /**
     * Set/unset mod and admin permission.
     *
     * @param in      $id      the user's id
     * @param Request $request the request
     *
     * @return \Illuminate\Http\Response
     */
    public function config($id, Request $request)
    {
        $user = $this->user->find($id);
        if (!$user) {
            return redirect()->back()->withErrors(trans('backend.users.members.cog_fails'));
        }
        Event::fire(new UserConfigured($id));
        $this->setRole($id, $request);
        return redirect()->back()->withMessage(trans('backend.users.members.cog_success', ['user' => $user->name]));
    }

    /**
     * Do seting role job.
     *
     * @param int     $id      user's id
     * @param Request $request the request
     *
     * @return void
     */
    protected function setRole($id, Request $request)
    {
        $roles = $this->role->all();
        foreach ($roles as $role) {
            if ($request->has(strtolower($role->name))) {
                $this->userRole->create([
                    'user_id' => $id,
                    'role_id' => $role->id
                ]);
            }
        }
    }
}
