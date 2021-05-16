<?php declare(strict_types=1);

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateAuthAdminRolePivotTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see  \Arcanesoft\Foundation\Authorization\Models\Pivots\AdministratorRole
 */
class CreateAuthAdministratorRolePivotTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * CreateAuthRoleUserPivotTable constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(Auth::table('administrator-role', 'administrator_role', false));
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
            $table->unsignedBigInteger('administrator_id');
            $table->unsignedInteger('role_id');
            $table->timestamp('created_at')->nullable();

            $table->primary(['administrator_id', 'role_id']);
        });
    }
}
