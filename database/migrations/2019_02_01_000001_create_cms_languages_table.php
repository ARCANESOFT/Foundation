<?php declare(strict_types=1);

use Arcanesoft\Foundation\Cms\Cms;
use Arcanesoft\Foundation\Cms\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateCmsLanguagesTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see \Arcanesoft\Foundation\Cms\Models\Language
 */
class CreateCmsLanguagesTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * CreateCmsLanguagesTable constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(Cms::table('languages', 'languages', false));
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
        $this->createSchema(function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->timestamps();
            $table->timestamp('activated_at')->nullable();

            $table->index(['code']);
        });
    }
}
