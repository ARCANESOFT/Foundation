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

    Arcanesoft\Foundation\Authorization\Events\Users\RetrievedUser::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Users\CreatingUser::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Users\CreatedUser::class       => [],
    Arcanesoft\Foundation\Authorization\Events\Users\UpdatingUser::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Users\UpdatedUser::class       => [],
    Arcanesoft\Foundation\Authorization\Events\Users\SavingUser::class        => [],
    Arcanesoft\Foundation\Authorization\Events\Users\SavedUser::class         => [],
    Arcanesoft\Foundation\Authorization\Events\Users\DeletingUser::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Users\DeletedUser::class       => [],
    Arcanesoft\Foundation\Authorization\Events\Users\ForceDeletedUser::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Users\RestoringUser::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Users\RestoredUser::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Users\ReplicatingUser::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Users\ActivatingUser::class    => [],
    Arcanesoft\Foundation\Authorization\Events\Users\ActivatedUser::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Users\DeactivatingUser::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Users\DeactivatedUser::class   => [],

    // Attributes

    Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatingEmail::class    => [
        Arcanesoft\Foundation\Authorization\Listeners\Users\ResetEmailVerification::class,
    ],
    Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatedEmail::class     => [
        Arcanesoft\Foundation\Authorization\Listeners\Users\NotifyEmailUpdated::class,
    ],
    Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatingPassword::class => [],
    Arcanesoft\Foundation\Authorization\Events\Users\Attributes\UpdatedPassword::class  => [],

    // Two Factor Authentication

    Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\EnablingAuthentication::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\EnabledAuthentication::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\DisablingAuthentication::class => [],
    Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\DisabledAuthentication::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\GeneratingRecoveryCode::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\GeneratedRecoveryCode::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\ReplacingRecoveryCode::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Users\Authentication\TwoFactor\ReplacedRecoveryCode::class    => [],

    /* -----------------------------------------------------------------
     |  Auth - Administrators
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Authorization\Events\Administrators\RetrievedAdministrator::class    => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\CreatingAdministrator::class     => [
        Arcanesoft\Foundation\Authorization\Listeners\Administrators\GeneratesUuid::class
    ],
    Arcanesoft\Foundation\Authorization\Events\Administrators\CreatedAdministrator::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\UpdatingAdministrator::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\UpdatedAdministrator::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\SavingAdministrator::class       => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\SavedAdministrator::class        => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\DeletingAdministrator::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\DeletedAdministrator::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\ForceDeletedAdministrator::class => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\RestoringAdministrator::class    => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\RestoredAdministrator::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\ReplicatingAdministrator::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\ActivatingAdministrator::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\ActivatedAdministrator::class    => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\DeactivatingAdministrator::class => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\DeactivatedAdministrator::class  => [],

    // Roles
    Arcanesoft\Foundation\Authorization\Events\Administrators\Roles\AttachingRole::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Roles\AttachedRole::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Roles\DetachingRole::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Roles\DetachedRole::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Roles\DetachingRoles::class => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Roles\DetachedRoles::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Roles\SyncingRoles::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Roles\SyncedRoles::class    => [],

    // Attributes
    Arcanesoft\Foundation\Authorization\Events\Administrators\Attributes\UpdatingEmail::class => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Attributes\UpdatedEmail::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Attributes\UpdatingPassword::class => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Attributes\UpdatedPassword::class  => [],

    // Two Factor Authentication

    Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\EnablingAuthentication::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\EnabledAuthentication::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\DisablingAuthentication::class => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\DisabledAuthentication::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\GeneratingRecoveryCode::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\GeneratedRecoveryCode::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\ReplacingRecoveryCode::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Administrators\Authentication\TwoFactor\ReplacedRecoveryCode::class    => [],

    /* -----------------------------------------------------------------
     |  Auth - Roles
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Authorization\Events\Roles\RetrievedRole::class => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\CreatingRole::class  => [
        Arcanesoft\Foundation\Authorization\Listeners\Roles\GeneratesUuid::class,
    ],
    Arcanesoft\Foundation\Authorization\Events\Roles\CreatedRole::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\UpdatingRole::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\UpdatedRole::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\SavingRole::class    => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\SavedRole::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\DeletingRole::class  => [
        Arcanesoft\Foundation\Authorization\Listeners\Roles\DetachPermissions::class,
        Arcanesoft\Foundation\Authorization\Listeners\Roles\DetachAdmins::class,
    ],
    Arcanesoft\Foundation\Authorization\Events\Roles\DeletedRole::class   => [],

    // Administrators
    Arcanesoft\Foundation\Authorization\Events\Roles\Administrators\AttachingAdministrator::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Administrators\AttachedAdministrator::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Administrators\DetachingAdministrator::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Administrators\DetachedAdministrator::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Administrators\DetachingAllAdministrators::class => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Administrators\DetachedAllAdministrators::class  => [],

    // Permissions
    Arcanesoft\Foundation\Authorization\Events\Roles\Permissions\AttachingPermission::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Permissions\AttachedPermission::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Permissions\DetachingPermission::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Permissions\DetachedPermission::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Permissions\SyncingPermissions::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Permissions\SyncedPermissions::class       => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Permissions\DetachingAllPermissions::class => [],
    Arcanesoft\Foundation\Authorization\Events\Roles\Permissions\DetachedAllPermissions::class  => [],

    /* -----------------------------------------------------------------
     |  Auth - Permissions
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Authorization\Events\Permissions\RetrievedPermission::class => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\CreatingPermission::class  => [
        Arcanesoft\Foundation\Authorization\Listeners\Permissions\GeneratesUuid::class,
    ],
    Arcanesoft\Foundation\Authorization\Events\Permissions\CreatedPermission::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\UpdatingPermission::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\UpdatedPermission::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\SavingPermission::class    => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\SavedPermission::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\DeletingPermission::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\DeletedPermission::class   => [],

    // Roles
    Arcanesoft\Foundation\Authorization\Events\Permissions\Roles\AttachingRole::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\Roles\AttachedRole::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\Roles\DetachingRole::class     => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\Roles\DetachedRole::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\Roles\SyncedRoles::class       => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\Roles\SyncingRoles::class      => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\Roles\DetachingAllRoles::class => [],
    Arcanesoft\Foundation\Authorization\Events\Permissions\Roles\DetachedAllRoles::class  => [],

    /* -----------------------------------------------------------------
     |  Sessions
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Authorization\Events\Sessions\RetrievedSession::class => [],
    Arcanesoft\Foundation\Authorization\Events\Sessions\CreatingSession::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Sessions\CreatedSession::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Sessions\UpdatingSession::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Sessions\UpdatedSession::class   => [],
    Arcanesoft\Foundation\Authorization\Events\Sessions\SavingSession::class    => [],
    Arcanesoft\Foundation\Authorization\Events\Sessions\SavedSession::class     => [
        Arcanesoft\Foundation\Authorization\Listeners\Sessions\UpdateUserLastActivity::class,
    ],
    Arcanesoft\Foundation\Authorization\Events\Sessions\DeletingSession::class  => [],
    Arcanesoft\Foundation\Authorization\Events\Sessions\DeletedSession::class   => [],

    /* -----------------------------------------------------------------
     |  Auth - Socialite
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Authorization\Events\Socialite\UserRegistered::class => [
        Arcanesoft\Foundation\Authorization\Listeners\Socialite\ActivateUser::class,
    ],

];
