<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Controllers;

use Arcanedev\LaravelImpersonator\Contracts\Impersonator;
use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Http\Datatables\UsersDatatable;
use Arcanesoft\Foundation\Authorization\Http\Requests\Users\{CreateUserRequest, UpdateUserRequest};
use Arcanesoft\Foundation\Authorization\Models\User;
use Arcanesoft\Foundation\Authorization\Policies\UsersPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\UsersRepository;
use Arcanesoft\Foundation\Support\Traits\HasNotifications;

/**
 * Class     UsersController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasNotifications;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('foundation::authorization.users');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Users'), 'admin::authorization.users.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * List all the users.
     *
     * @param  bool  $trash
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(bool $trash = false)
    {
        $this->authorize(UsersPolicy::ability('index'));

        return $this->view('authorization.users.index', compact('trash'));
    }

    /**
     * Datatable api response.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Http\Datatables\UsersDatatable  $datatable
     *
     * @return \Arcanesoft\Foundation\Authorization\Http\Datatables\UsersDatatable
     */
    public function datatable(UsersDatatable $datatable)
    {
        $this->authorize(UsersPolicy::ability('index'));

        return $datatable;
    }

    /**
     * List all the deleted users.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function metrics()
    {
        $this->authorize(UsersPolicy::ability('metrics'));

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.authorization.users');

        return $this->view('authorization.users.metrics');
    }

    /**
     * Create a new user.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $this->authorize(UsersPolicy::ability('create'));

        $this->addBreadcrumb(__('New User'));

        return $this->view('authorization.users.create');
    }

    /**
     * Persist the new user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Http\Requests\Users\CreateUserRequest  $request
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository           $usersRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request, UsersRepository $usersRepo)
    {
        $this->authorize(UsersPolicy::ability('create'));

        $user = $usersRepo->createOne($request->validated());

        static::notifySuccess(
            'User Created',
            'A new user has been successfully created!'
        );

        return redirect()->route('admin::authorization.users.show', [$user]);
    }

    /**
     * Show the user's details.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User  $user
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        $this->authorize(UsersPolicy::ability('show'), [$user]);

        $this->addBreadcrumbRoute(__("User's details"), 'admin::authorization.users.show', [$user]);

        return $this->view('authorization.users.show', compact('user'));
    }

    /**
     * Edit the user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User  $user
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $this->authorize(UsersPolicy::ability('update'), [$user]);

        $this->addBreadcrumbRoute(__('Edit User'), 'admin::authorization.users.edit', [$user]);

        return $this->view('authorization.users.edit', compact('user'));
    }

    /**
     * Update the user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User                            $user
     * @param  \Arcanesoft\Foundation\Authorization\Http\Requests\Users\UpdateUserRequest  $request
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository           $usersRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, UpdateUserRequest $request, UsersRepository $usersRepo)
    {
        $this->authorize(UsersPolicy::ability('update'), [$user]);

        $usersRepo->updateOne($user, $request->validated());

        static::notifySuccess(
            'User Updated',
            'The user has been successfully updated!'
        );

        return redirect()->route('admin::authorization.users.show', [$user]);
    }

    /**
     * Activate/Deactivate the user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User                   $user
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository  $usersRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(User $user, UsersRepository $usersRepo)
    {
        $this->authorize(UsersPolicy::ability('activate'), [$user]);

        $usersRepo->toggleActive($user);

        static::notifySuccess(
            'User Activated',
            'The user has been successfully activated!'
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Activate/Deactivate the user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User                   $user
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository  $usersRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate(User $user, UsersRepository $usersRepo)
    {
        $this->authorize(UsersPolicy::ability('deactivate'), [$user]);

        $usersRepo->deactivateOne($user);

        static::notifySuccess(
            'User Deactivated',
            'The user has been successfully deactivated!'
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Delete a user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User                   $user
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository  $usersRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(User $user, UsersRepository $usersRepo)
    {
        $this->authorize(UsersPolicy::ability($user->trashed() ? 'force-delete' : 'delete'), [$user]);

        $usersRepo->deleteOne($user);

        static::notifySuccess(
            'User Deleted',
            'The user has been successfully deleted!'
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Restore a deleted user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User                   $user
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository  $usersRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(User $user, UsersRepository $usersRepo)
    {
        $this->authorize(UsersPolicy::ability('restore'), [$user]);

        $usersRepo->restoreOne($user);

        static::notifySuccess(
            'User Restored',
            'The user has been successfully restored!'
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Impersonate a user.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User                $user
     * @param  \Arcanedev\LaravelImpersonator\Contracts\Impersonator  $impersonator
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function impersonate(User $user, Impersonator $impersonator)
    {
        $this->authorize(UsersPolicy::ability('impersonate'), [$user]);

        if ($impersonator->start(Auth::admin(), $user, 'web')) {
            return redirect()->route('public::index'); // TODO: Extract the route name into a config
        }

        $this->notifyError(
            'Impersonation Not Allowed',
            "You're not allowed to impersonate this user"
        );

        return redirect()->back();
    }
}
