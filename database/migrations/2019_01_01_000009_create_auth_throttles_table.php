<?php

declare(strict_types=1);

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreatePermissionRoleTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateAuthThrottlesTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make a migration instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(Auth::table('throttles', 'throttles', false));
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if ( ! Auth::config('throttles.enabled', false))
            return;

        $this->createSchema(function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('type');
            $table->string('ip')->nullable();

            $table->timestamps();
        });
    }
}
