<?php

return [

    /* -----------------------------------------------------------------
     |  Core - UI
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Core\Events\UI\SidebarToggled::class  => [
        Arcanesoft\Foundation\Core\Listeners\UI\PersistToggledSidebar::class,
    ],
    Arcanesoft\Foundation\Core\Events\UI\SkinModeToggled::class => [
        Arcanesoft\Foundation\Core\Listeners\UI\PersistToggledSkinMode::class,
    ],

    /* -----------------------------------------------------------------
     |  Auth - Users
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Auth\Events\Users\RetrievedUser::class     => [],
    Arcanesoft\Foundation\Auth\Events\Users\CreatingUser::class      => [],
    Arcanesoft\Foundation\Auth\Events\Users\CreatedUser::class       => [],
    Arcanesoft\Foundation\Auth\Events\Users\UpdatingUser::class      => [],
    Arcanesoft\Foundation\Auth\Events\Users\UpdatedUser::class       => [],
    Arcanesoft\Foundation\Auth\Events\Users\SavingUser::class        => [],
    Arcanesoft\Foundation\Auth\Events\Users\SavedUser::class         => [],
    Arcanesoft\Foundation\Auth\Events\Users\DeletingUser::class      => [],
    Arcanesoft\Foundation\Auth\Events\Users\DeletedUser::class       => [],
    Arcanesoft\Foundation\Auth\Events\Users\ForceDeletedUser::class  => [],
    Arcanesoft\Foundation\Auth\Events\Users\RestoringUser::class     => [],
    Arcanesoft\Foundation\Auth\Events\Users\RestoredUser::class      => [],
    Arcanesoft\Foundation\Auth\Events\Users\ReplicatingUser::class   => [],
    Arcanesoft\Foundation\Auth\Events\Users\ActivatingUser::class    => [],
    Arcanesoft\Foundation\Auth\Events\Users\ActivatedUser::class     => [],
    Arcanesoft\Foundation\Auth\Events\Users\DeactivatingUser::class  => [],
    Arcanesoft\Foundation\Auth\Events\Users\DeactivatedUser::class   => [],

    // Attributes

    Arcanesoft\Foundation\Auth\Events\Users\Attributes\UpdatingEmail::class    => [
        Arcanesoft\Foundation\Auth\Listeners\Users\ResetEmailVerification::class,
    ],
    Arcanesoft\Foundation\Auth\Events\Users\Attributes\UpdatedEmail::class     => [
        Arcanesoft\Foundation\Auth\Listeners\Users\NotifyEmailUpdated::class,
    ],
    Arcanesoft\Foundation\Auth\Events\Users\Attributes\UpdatingPassword::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\Attributes\UpdatedPassword::class  => [],

    // Two Factor Authentication

    Arcanesoft\Foundation\Auth\Events\Users\Authentication\TwoFactor\EnablingAuthentication::class  => [],
    Arcanesoft\Foundation\Auth\Events\Users\Authentication\TwoFactor\EnabledAuthentication::class   => [],
    Arcanesoft\Foundation\Auth\Events\Users\Authentication\TwoFactor\DisablingAuthentication::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\Authentication\TwoFactor\DisabledAuthentication::class  => [],
    Arcanesoft\Foundation\Auth\Events\Users\Authentication\TwoFactor\GeneratingRecoveryCode::class  => [],
    Arcanesoft\Foundation\Auth\Events\Users\Authentication\TwoFactor\GeneratedRecoveryCode::class   => [],
    Arcanesoft\Foundation\Auth\Events\Users\Authentication\TwoFactor\ReplacingRecoveryCode::class   => [],
    Arcanesoft\Foundation\Auth\Events\Users\Authentication\TwoFactor\ReplacedRecoveryCode::class    => [],

    /* -----------------------------------------------------------------
     |  Auth - Administrators
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Auth\Events\Administrators\RetrievedAdministrator::class    => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\CreatingAdministrator::class     => [
        Arcanesoft\Foundation\Auth\Listeners\Administrators\GeneratesUuid::class
    ],
    Arcanesoft\Foundation\Auth\Events\Administrators\CreatedAdministrator::class      => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\UpdatingAdministrator::class     => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\UpdatedAdministrator::class      => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\SavingAdministrator::class       => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\SavedAdministrator::class        => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\DeletingAdministrator::class     => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\DeletedAdministrator::class      => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\ForceDeletedAdministrator::class => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\RestoringAdministrator::class    => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\RestoredAdministrator::class     => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\ReplicatingAdministrator::class  => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\ActivatingAdministrator::class   => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\ActivatedAdministrator::class    => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\DeactivatingAdministrator::class => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\DeactivatedAdministrator::class  => [],

    // Roles
    Arcanesoft\Foundation\Auth\Events\Administrators\Roles\AttachingRole::class  => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Roles\AttachedRole::class   => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Roles\DetachingRole::class  => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Roles\DetachedRole::class   => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Roles\DetachingRoles::class => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Roles\DetachedRoles::class  => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Roles\SyncingRoles::class   => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Roles\SyncedRoles::class    => [],

    // Attributes
    Arcanesoft\Foundation\Auth\Events\Administrators\Attributes\UpdatingEmail::class => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Attributes\UpdatedEmail::class  => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Attributes\UpdatingPassword::class => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Attributes\UpdatedPassword::class  => [],

    // Two Factor Authentication

    Arcanesoft\Foundation\Auth\Events\Administrators\Authentication\TwoFactor\EnablingAuthentication::class  => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Authentication\TwoFactor\EnabledAuthentication::class   => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Authentication\TwoFactor\DisablingAuthentication::class => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Authentication\TwoFactor\DisabledAuthentication::class  => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Authentication\TwoFactor\GeneratingRecoveryCode::class  => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Authentication\TwoFactor\GeneratedRecoveryCode::class   => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Authentication\TwoFactor\ReplacingRecoveryCode::class   => [],
    Arcanesoft\Foundation\Auth\Events\Administrators\Authentication\TwoFactor\ReplacedRecoveryCode::class    => [],

    /* -----------------------------------------------------------------
     |  Auth - Roles
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Auth\Events\Roles\RetrievedRole::class => [],
    Arcanesoft\Foundation\Auth\Events\Roles\CreatingRole::class  => [
        Arcanesoft\Foundation\Auth\Listeners\Roles\GeneratesUuid::class,
    ],
    Arcanesoft\Foundation\Auth\Events\Roles\CreatedRole::class   => [],
    Arcanesoft\Foundation\Auth\Events\Roles\UpdatingRole::class  => [],
    Arcanesoft\Foundation\Auth\Events\Roles\UpdatedRole::class   => [],
    Arcanesoft\Foundation\Auth\Events\Roles\SavingRole::class    => [],
    Arcanesoft\Foundation\Auth\Events\Roles\SavedRole::class     => [],
    Arcanesoft\Foundation\Auth\Events\Roles\DeletingRole::class  => [
        Arcanesoft\Foundation\Auth\Listeners\Roles\DetachPermissions::class,
        Arcanesoft\Foundation\Auth\Listeners\Roles\DetachAdmins::class,
    ],
    Arcanesoft\Foundation\Auth\Events\Roles\DeletedRole::class   => [],

    // Administrators
    Arcanesoft\Foundation\Auth\Events\Roles\Administrators\AttachingAdministrator::class     => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Administrators\AttachedAdministrator::class      => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Administrators\DetachingAdministrator::class     => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Administrators\DetachedAdministrator::class      => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Administrators\DetachingAllAdministrators::class => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Administrators\DetachedAllAdministrators::class  => [],

    // Permissions
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\AttachingPermission::class     => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\AttachedPermission::class      => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\DetachingPermission::class     => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\DetachedPermission::class      => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\SyncingPermissions::class      => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\SyncedPermissions::class       => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\DetachingAllPermissions::class => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\DetachedAllPermissions::class  => [],

    /* -----------------------------------------------------------------
     |  Auth - Permissions
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Auth\Events\Permissions\RetrievedPermission::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\CreatingPermission::class  => [
        Arcanesoft\Foundation\Auth\Listeners\Permissions\GeneratesUuid::class,
    ],
    Arcanesoft\Foundation\Auth\Events\Permissions\CreatedPermission::class   => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\UpdatingPermission::class  => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\UpdatedPermission::class   => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\SavingPermission::class    => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\SavedPermission::class     => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\DeletingPermission::class  => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\DeletedPermission::class   => [],

    // Roles
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\AttachingRole::class     => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\AttachedRole::class      => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\DetachingRole::class     => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\DetachedRole::class      => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\SyncedRoles::class       => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\SyncingRoles::class      => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\DetachingAllRoles::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\DetachedAllRoles::class  => [],

    /* -----------------------------------------------------------------
     |  Sessions
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Auth\Events\Sessions\RetrievedSession::class => [],
    Arcanesoft\Foundation\Auth\Events\Sessions\CreatingSession::class  => [],
    Arcanesoft\Foundation\Auth\Events\Sessions\CreatedSession::class   => [],
    Arcanesoft\Foundation\Auth\Events\Sessions\UpdatingSession::class  => [],
    Arcanesoft\Foundation\Auth\Events\Sessions\UpdatedSession::class   => [],
    Arcanesoft\Foundation\Auth\Events\Sessions\SavingSession::class    => [],
    Arcanesoft\Foundation\Auth\Events\Sessions\SavedSession::class     => [
        Arcanesoft\Foundation\Auth\Listeners\Sessions\UpdateUserLastActivity::class,
    ],
    Arcanesoft\Foundation\Auth\Events\Sessions\DeletingSession::class  => [],
    Arcanesoft\Foundation\Auth\Events\Sessions\DeletedSession::class   => [],

    /* -----------------------------------------------------------------
     |  Auth - Socialite
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Auth\Events\Socialite\UserRegistered::class => [
        Arcanesoft\Foundation\Auth\Listeners\Socialite\ActivateUser::class,
    ],

];
