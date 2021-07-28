<?php

declare(strict_types=1);

use Arcanesoft\Foundation\Cms\Cms;
use Arcanesoft\Foundation\Cms\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Kalnoy\Nestedset\NestedSet;

/**
 * Class     CreateCmsCategoriesTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateCmsCategoriesTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * CreateCmsCategoriesTable constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(Cms::table('categories', 'categories'));
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
            $table->string('slug');
            $table->json('name');
            $table->json('description')->nullable();
            NestedSet::columns($table);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['slug']);
        });
    }
}
