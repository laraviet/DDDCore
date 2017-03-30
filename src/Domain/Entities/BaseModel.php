<?php

namespace Laraviet\DDDCore\Domain\Entities;

use LaravelArdent\Ardent\Ardent;

class BaseModel extends Ardent
{
    public $autoPurgeRedundantAttributes = true;
    public $autoHashPasswordAttributes = true;
    public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called
}