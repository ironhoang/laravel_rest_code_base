<?php

namespace App\Repositories;

use App\Models\Base;
use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Utils\StringUtility;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class BaseRepository implements BaseRepositoryInterface
{
	protected array $querySearchTargets = [];
	
	
	public function getAll()
	{
		return $this->getBaseQuery()->all();
	}
	
	public function getBaseQuery(): Base|Builder|EloquentBuilder
	{
		return $this->getBlankModel();
	}
	
	public function getBlankModel(): Base|Builder|EloquentBuilder
	{
		return new Base();
	}
	
	public function findById(int $id)
	{
		return $this->getBaseQuery()->find($id);
	}
	
	public function create(array $data)
	{
		return $this->getBaseQuery()->create($data);
	}
	
	public function update(int $id, array $data)
	{
		$user = $this->getBaseQuery()->find($id);
		if ($user) {
			$user->update($data);
			return $user;
		}
		return null;
	}
	
	public function delete(int $id)
	{
		$user = $this->getBaseQuery()->find($id);
		if ($user) {
			return $user->delete();
		}
		return false;
	}
	
	public function firstByFilter($filter)
	{
		$query = $this->buildQueryByFilter($this->getBaseQuery(), $filter);
		
		return $query->first();
	}
	
	protected function buildQueryByFilter($query, array $filter)
	{
		$tableName = $this->getBlankModel()->getTable();
		
		$query = $this->queryOptions($query);
		
		if (\count($this->querySearchTargets) > 0 && \array_key_exists('query', $filter)) {
			$searchWords = Arr::get($filter, 'query', []);
			if (!empty($searchWords)) {
				$query = $this->buildLikeQuery($query, $searchWords);
			}
			unset($filter['query']);
		}
		
		foreach ($filter as $column => $value) {
			if (\is_array($value)) {
				$query = $query->whereIn($tableName . '.' . $column, $value);
			} else {
				$query = $query->where($tableName . '.' . $column, $value);
			}
		}
		
		return $query;
	}
	
	protected function queryOptions($query)
	{
		return $query;
	}
	
	protected function buildLikeQuery($query, array|string $searchWords, array $targetColumns = [])
	{
		if (empty($targetColumns)) {
			$targetColumns = $this->querySearchTargets;
		}
		$searchWords = StringUtility::filterSearchQuery($searchWords);
		$likeCondition = $this->getLikeCondition();
		if (!empty($searchWords)) {
			foreach ($searchWords as $searchWord) {
				if (!empty($searchWord)) {
					$query = $query->where(function ($q) use ($searchWord, $targetColumns, $likeCondition): void {
						foreach ($targetColumns as $index => $target) {
							if (0 === $index) {
								$q = $q->where($target, $likeCondition, '%' . $searchWord . '%');
							} else {
								$q = $q->orWhere($target, $likeCondition, '%' . $searchWord . '%');
							}
						}
					});
				}
			}
		}
		
		return $query;
	}
	
	protected function getLikeCondition(): string
	{
		return config('database.connections.' . config('database.default') . '.like_condition');
	}
	
	public function getByFilter($filter, $order = 'id', $direction = 'asc', $offset = 0, $limit = 20, $before = 0, $after = 0): Collection|iterable
	{
		$query = $this->buildQueryByFilter($this->getBaseQuery(), $filter);
		$query = $this->setBefore($query, $order, $direction, $before);
		$query = $this->setAfter($query, $order, $direction, $after);
		$query = $this->buildOrder($query, $filter, $order, $direction);
		
		return $query->skip($offset)->take($limit)->get();
	}
	
	protected function setBefore(Builder|Base|EloquentBuilder $query, string $order, string $direction, mixed $before): Builder|Base|EloquentBuilder
	{
		if (0 === $before) {
			return $query;
		}
		
		return $query->where($order, 'desc' === $direction ? '>' : '<', $before);
	}
	
	protected function setAfter(Builder|Base|EloquentBuilder $query, string $order, string $direction, mixed $after): Builder|Base|EloquentBuilder
	{
		if (0 === $after) {
			return $query;
		}
		
		return $query->where($order, 'desc' === $direction ? '<' : '>', $after);
	}
	
	protected function buildOrder(Builder|Base|EloquentBuilder $query, array $filter, string $order = null, string $direction = null): Builder|Base|EloquentBuilder
	{
		if (!empty($order)) {
			$direction = empty($direction) ? 'asc' : $direction;
			$query = $query->orderBy($order, $direction);
		}
		if ($order == 'id') {
			return $query;
		}
		
		return $query->orderBy('id');
	}
	
	public function countByFilter($filter): int
	{
		$query = $this->buildQueryByFilter($this->getBaseQuery(), $filter);
		
		return $query->count();
	}
	
	public function getByFilterWithCount(array $filter, array $filterColumns, string $order = 'id', string $direction = 'asc', $perPage = 10)
	{
		$query = $this->buildQueryByFilter($this->getBaseQuery(), $filter);
		foreach ($filterColumns as $filterColumn) {
			if (\Arr::exists($filter, $filterColumn)) {
				$searchWords = \Arr::get($filter, $filterColumn);
				$query = $this->buildLikeQueryByFilterColumn($query, $searchWords, $filterColumn);
				unset($filter[$filterColumn]);
			}
		}
		$query = $this->buildOrder($query, $filter, $order, $direction);
		$items = $query->get();
		$count = $query->count();
		
		if ($count > $perPage) {
			return $query->paginate($perPage);
		} else {
			return $items;
		}
	}
	
	protected function buildLikeQueryByFilterColumn(Builder|Base|EloquentBuilder $query, array|string $searchWords, $filterColumn): Builder|Base|EloquentBuilder
	{
		$searchWords = StringUtility::filterSearchQuery($searchWords);
		$likeCondition = $this->getLikeCondition();
		if (!empty($searchWords)) {
			$query = $query->where(function ($q) use ($searchWords, $filterColumn, $likeCondition): void {
				foreach ($searchWords as $index => $searchWord) {
					if (!empty($searchWord)) {
						if (0 === $index) {
							$q = $q->where($filterColumn, $likeCondition, '%' . $searchWord . '%');
						} else {
							$q = $q->orWhere($filterColumn, $likeCondition, '%' . $searchWord . '%');
						}
					}
				}
			});
		}
		
		return $query;
	}
	
	public function getModelClassName(): string
	{
		$model = $this->getBlankModel();
		
		return \get_class($model);
	}
}
