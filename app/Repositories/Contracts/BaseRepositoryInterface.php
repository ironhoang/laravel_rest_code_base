<?php
declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Dto\CollectionWithCount;
use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryInterface
{
	public function getAll();
	
	public function findById(int $id);
	
	public function create(array $data);
	
	public function update(int $id, array $data);
	
	public function delete(int $id);
	
	public function firstByFilter(array $filter);
	
	public function getByFilter($filter, $order = 'id', $direction = 'asc', $offset = 0, $limit = 20, $before = 0, $after = 0): Collection|iterable;
	
	public function countByFilter($filter): int;
	
	public function getByFilterWithCount(array $filter, array $filterColumns, string $order = 'id', string $direction = 'asc', int $offset = 0, int $limit = 20, int $before = 0, int $after = 0): CollectionWithCount;
}
