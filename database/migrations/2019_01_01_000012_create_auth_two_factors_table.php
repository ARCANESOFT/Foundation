<?php declare(strict_types=1);

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateAuthAdministratorsTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see  \Arcanesoft\Foundation\Authorization\Models\TwoFactor
 */
class CreateAuthTwoFactorsTable extends Migration
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

        $this->setTable(Auth::table('two_factors', 'two_factors', false));
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
            $table->morphs('two_factorable');
            $table->text('secret')->nullable();
            $table->text('recovery_codes')->nullable();
            $table->timestamps();

            $table->unique(['two_factorable_type', 'two_factorable_id']);
        });
    }
}
