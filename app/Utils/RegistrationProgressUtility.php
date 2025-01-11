<?php

declare(strict_types=1);

namespace App\Utils;

use Illuminate\Database\Eloquent\Collection;

class RegistrationProgressUtility
{
	public static function getCandidateProgress(array|null $progresses): ?array
	{
		if (empty($progresses)) {
			$progresses = [];
		}
		$templates = config('data.registration_processes.candidate');
		$keys = \Arr::pluck($templates, 'key');
		foreach ($keys as $key) {
			if (!\array_key_exists($key, $progresses)) {
				if (\App\Models\Candidate::PROGRESS_RIGHT_TO_WORK_PROOFS === $key) {
					$progresses[$key] = \App\Models\Candidate::PROGRESS_STATUS_LOCKED;
				} elseif (\App\Models\Candidate::PROGRESS_FINANCIAL_INFORMATION === $key) {
					$progresses[$key] = \App\Models\Candidate::PROGRESS_STATUS_LOCKED;
				} else {
					$progresses[$key] = \App\Models\Candidate::PROGRESS_STATUS_NO_INFO;
				}
			}
		}
		
		return $progresses;
	}
	
	public static function getMostProgressedContractProgress(Collection $candidateJobs): string
	{
		$mostProgressedContractProgress = \App\Models\CandidateJob::PROGRESS_STATUS_LOCKED;
		foreach ($candidateJobs as $candidateJob) {
			$candidateJobProgresses = self::getCandidateJobProgress($candidateJob->progresses);
			$contractProgress = \Arr::get($candidateJobProgresses, \App\Models\CandidateJob::PROGRESS_CONTRACTS);
			if ($contractProgress && \App\Models\CandidateJob::PROGRESS_STATUS_ORDER[$contractProgress] && \App\Models\CandidateJob::PROGRESS_STATUS_ORDER[$contractProgress] > \App\Models\CandidateJob::PROGRESS_STATUS_ORDER[$mostProgressedContractProgress]) {
				$mostProgressedContractProgress = $contractProgress;
			}
		}
		
		return $mostProgressedContractProgress;
	}
	
	public static function getCandidateJobProgress(array|null $progresses): ?array
	{
		if (empty($progresses)) {
			$progresses = [];
		}
		$templates = config('data.registration_processes.candidate_job');
		$keys = \Arr::pluck($templates, 'key');
		foreach ($keys as $key) {
			if (!\array_key_exists($key, $progresses)) {
				if (\App\Models\CandidateJob::PROGRESS_CONTRACTS === $key) {
					$progresses[$key] = \App\Models\CandidateJob::PROGRESS_STATUS_LOCKED;
				} else {
					$progresses[$key] = \App\Models\CandidateJob::PROGRESS_STATUS_NO_INFO;
				}
			}
		}
		
		return $progresses;
	}
}
