<?php

declare(strict_types=1);

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateAuthAdministratorsTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see  \Arcanesoft\Foundation\Auth\Models\Administrator
 */
class CreateAuthAdministratorsTable extends Migration
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

        $this->setTable(Auth::table('administrators', 'administrators', false));
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
        $this->createSchema(function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('first_name', 30)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('avatar')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamps();
            $table->timestamp('activated_at')->nullable();
            $table->softDeletes();

            $table->index(['uuid', 'email']);
        });
    }
}
