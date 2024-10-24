<?php

declare(strict_types=1);

namespace Weew\Collections;

interface ItemsHolderInterface
{
    public function getItems(): array;

    public function setItems(array $items): void;
}
