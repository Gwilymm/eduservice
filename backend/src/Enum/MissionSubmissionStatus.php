<?php

namespace App\Enum;


enum MissionSubmissionStatus: string
{
	public const APPROVED = 'approved';
	public const REJECTED = 'rejected';
	public const SUBMITTED = 'submitted';
	public const STATUSES = [
		self::APPROVED,
		self::REJECTED,
		self::SUBMITTED,
	];
	case Submitted = 'submitted';
	case Approved = 'approved';
	case Rejected = 'rejected';
}
