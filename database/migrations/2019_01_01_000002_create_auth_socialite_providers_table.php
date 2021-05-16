<?php declare(strict_types=1);

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateAuthSocialiteProvidersTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see \Arcanesoft\Foundation\Authorization\Models\SocialiteProvider
 */
class CreateAuthSocialiteProvidersTable extends Migration
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

        $this->setTable(Auth::table('socialite-providers', 'socialite_providers', false));
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
            $table->unsignedBigInteger('user_id')->index();
            $table->string('provider_type', 50);
            $table->text('provider_id');
            $table->text('token')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'provider_type']);
        });
    }
}
