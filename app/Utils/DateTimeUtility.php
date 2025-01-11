<?php

declare(strict_types=1);

namespace App\Utils;

use Illuminate\Support\Carbon;

class DateTimeUtility
{
	public static function normalizeDate(string $date): ?string
	{
		try {
			return Carbon::parse($date)->format('Y-m-d');
		} catch (\Exception $e) {
			return null;
		}
	}
	
	public static function convertTimeToInteger(string $date, string $time): ?int
	{
		try {
			return Carbon::parse($date . ' ' . $time, 'Europe/London')->timestamp;
		} catch (\Exception $e) {
			return null;
		}
	}
	
	public static function normalizeDateArray(array|string $dates): array
	{
		if (!\is_array($dates)) {
			$dates = [$dates];
		}
		$result = [];
		foreach ($dates as $date) {
			if (!empty($date)) {
				try {
					$result[] = Carbon::parse($date)->format('Y-m-d');
				} catch (\Exception $e) {
					// Do nothing ( remove )
				}
			}
		}
		
		return array_unique($result);
	}
	
	public static function isPastDate(Carbon $date): bool
	{
		$now = Carbon::now()->timestamp;
		if ($date->timestamp < $now) {
			return True;
		}
		
		return False;
	}
	
	public static function last24h(): Carbon
	{
		$now = Carbon::now();
		
		return $now->subHours(24);
	}
}
