<?php

namespace App\Enum;


enum MissionSubmissionStatus: string
{
	case Submitted = 'submitted';
	case Approved = 'approved';
	case Rejected = 'rejected';
}
