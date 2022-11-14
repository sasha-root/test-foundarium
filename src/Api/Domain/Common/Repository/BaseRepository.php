<?php declare(strict_types=1);

namespace Api\Domain\Common\Repository;

use Api\Domain\Common\Model\PaginationFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface BaseRepository
{
    /**
     * Set the relationships of the query.
     *
     * @param array $with
     * @return BaseRepository
     */
    public function with(array $with = []): BaseRepository;

    /**
     * Set withoutGlobalScopes attribute to true and apply it to the query.
     *
     * @return BaseRepository
     */
    public function withoutGlobalScopes(): BaseRepository;

    /**
     * Find a resource by id.
     *
     * @param int $id
     * @return Model|null
     * @throws ModelNotFoundException
     */
    public function findOneById(int $id): ?Model;

    /**
     * Find a resource by key value criteria.
     *
     * @param array $criteria
     * @return Model|null
     * @throws ModelNotFoundException
     */
    public function findOneBy(array $criteria): ?Model;

    /**
     * Search All resources by spatie query builder.
     *
     * @param PaginationFilter $paginationFilter
     * @param array|null $orderBy
     * @return LengthAwarePaginator
     */
    public function findByFilters(PaginationFilter $paginationFilter, array $orderBy = null): LengthAwarePaginator;

    /**
     * Save a resource.
     *
     * @param Model $model
     * @return Model
     */
    public function store(Model $model): Model;

    /**
     * Delete a resource.
     *
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool;
}
