<?php

declare(strict_types=1);

namespace App\Utils;

use App\Http\Resources\Resource;

class SortUtility
{
	public static function sort(Resource $x, Resource $y, string $sortKey): int
	{
		if ($x[$sortKey] === $y[$sortKey]) {
			return 0;
		}
		
		return ($x[$sortKey] < $y[$sortKey]) ? -1 : 1;
	}
}
