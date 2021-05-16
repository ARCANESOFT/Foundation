<?php declare(strict_types=1);

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreatePermissionsTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see  \Arcanesoft\Foundation\Authorization\Models\Permission
 */
class CreateAuthPermissionsTable extends Migration
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

        $this->setTable(Auth::table('permissions', 'permissions', false));
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
            $table->unsignedInteger('group_id')->default(0);
            $table->string('ability')->unique();
            $table->string('category')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamp('created_at')->nullable();

            $table->index(['uuid', 'ability']);
        });
    }
}
