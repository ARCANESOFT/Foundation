<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Concerns;

use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * Trait     WithPagination
 *
 * @package  Arcanesoft\Foundation\Views\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait WithPagination
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The selected pagination's page.
     *
     * @var int
     */
    public $page = 1;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Initialize the component with pagination.
     */
    public function initializeWithPagination()
    {
        $this->page = $this->resolvePage();

        Paginator::currentPageResolver(function () {
            return $this->page;
        });

        Paginator::defaultView($this->paginationView());
    }

    /**
     * Get the pagination view.
     *
     * @return string
     */
    public function paginationView(): string
    {
        return 'foundation::_components.datatable.pagination';
    }

    /**
     * Get the previous page.
     */
    public function previousPage(): void
    {
        $this->page = $this->page - 1;
    }

    /**
     * Get the next page.
     */
    public function nextPage(): void
    {
        $this->page = $this->page + 1;
    }

    /**
     * Go the to page.
     *
     * @param  int  $page
     */
    public function gotoPage($page): void
    {
        $this->page = $page;
    }

    /**
     * Reset the page.
     */
    public function resetPaginationPage(): void
    {
        $this->page = 1;
    }

    /**
     * The "page" query string item should only be available from within the original component mount run.
     *
     * @return int
     */
    public function resolvePage(): int
    {
        return (int) request()->query('page', $this->page);
    }

    /**
     * Convert into a pagination object.
     *
     * @param  \Illuminate\Support\Collection|iterable  $items
     * @param  array                                    $options
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function convertToPagination($items, array $options = []): LengthAwarePaginatorContract
    {
        return new LengthAwarePaginator(
            $items->forPage($this->page, $this->perPage),
            $items->count(),
            $this->perPage,
            $this->page,
            $options
        );
    }
}
