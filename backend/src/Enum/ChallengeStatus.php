<?php

namespace App\Enum;

enum ChallengeStatus: string
{
	case Created = 'created';
	case Active = 'active';
	case Paused = 'paused';
	case Completed = 'completed';
}
