<?php

declare(strict_types=1);

use Arcanesoft\Foundation\Cms\Cms;
use Arcanesoft\Foundation\Cms\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateCmsCategorizablesTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateCmsCategorizablesTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * CreateCmsCategorizablesTable constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(Cms::table('categorizables', 'categorizables', false));
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
            $table->foreignId('category_id');
            $table->morphs('categorizable');
            $table->timestamp('created_at')->nullable();

            $table->unique(
                ['category_id', 'categorizable_id', 'categorizable_type'],
                'categorizables_ids_type_unique'
            );
        });
    }
}
