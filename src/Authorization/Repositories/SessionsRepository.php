<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Repositories;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Models\Session;

/**
 * Class     SessionsRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SessionsRepository extends AbstractRepository
{
    /**
     * @inheritDoc
     */
    public static function modelClass(): string
    {
        return Auth::model('session', Session::class);
    }

    /**
     * Find a session by id.
     *
     * @param  string       $id
     *
     * @return \Arcanesoft\Foundation\Authorization\Models\Session|mixed|null
     */
    public function firstByIdOrFail(string $id)
    {
        return $this->query()->where('id', $id)->firstOrFail();
    }
}
