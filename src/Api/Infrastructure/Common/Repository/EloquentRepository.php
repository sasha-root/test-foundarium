<?php declare(strict_types=1);

namespace Api\Infrastructure\Common\Repository;

use Api\Domain\Common\Model\PaginationFilter;
use Api\Domain\Common\Repository\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements BaseRepository
{
    protected Model $model;

    protected bool $withoutGlobalScopes = false;

    protected array $with = [];

    public function __construct()
    {
        $this->model = new ($this->getModelClass());
    }

    public function with(array $with = []): BaseRepository
    {
        $this->with = $with;
        return $this;
    }

    public function withoutGlobalScopes(): BaseRepository
    {
        $this->withoutGlobalScopes = true;
        return $this;
    }

    public function findOneById(int $id): ?Model
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findOneBy(array $criteria): ?Model
    {
        if (!$this->withoutGlobalScopes) {
            return $this->model
                ->with($this->with)
                ->where($criteria)
                ->orderByDesc('created_at')
                ->first();
        }

        return $this->model
            ->with($this->with)
            ->withoutGlobalScopes()
            ->where($criteria)
            ->orderByDesc('created_at')
            ->first();
    }

    public function findByFilters(PaginationFilter $paginationFilter, ?array $orderBy = null): LengthAwarePaginator
    {
        $queryBuilder = $this->model->with($this->with);
        if ($orderBy) {
            $queryBuilder->orderBy(...$orderBy);
        }
        return $queryBuilder->paginate(perPage: $paginationFilter->getLimit(), page: $paginationFilter->getPage());
    }

    public function store(Model $model): Model
    {
        $model->save();
        return $model->fresh();
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    abstract protected function getModelClass(): string;
}
