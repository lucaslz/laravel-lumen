<?php

namespace App\Models;

trait ClassMetadataInfo
{
    public function hasField(string $field): bool
    {
        return in_array($field, $this->getFields());
    }

    public function hasAssociation()
    {

    }

    private function getFields()
    {
        return array_unique(array_merge($this->hidden, $this->fillable));
    }
}