<?php

namespace App\ApiResource;

use App\Dto\Output\RankingOutput;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\RankingController;
use ApiPlatform\Metadata\GetCollection;

#[ApiResource(
    shortName: 'Rankings',
    operations: [
        new GetCollection(
            uriTemplate: '/rankings',
            controller: RankingController::class,
            paginationEnabled: false
        )
    ],
    output: RankingOutput::class
)]
class RankingResource {}
