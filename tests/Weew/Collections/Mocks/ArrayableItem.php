<?php

declare(strict_types=1);

namespace Tests\Weew\Collections\Mocks;

use Weew\Contracts\IArrayable;

class ArrayableItem implements IArrayable
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function toArray(): array
    {
        return ['id' => $this->id];
    }
}
