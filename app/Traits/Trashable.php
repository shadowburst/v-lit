<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Trait Trashable
 */
trait Trashable
{
    use SoftDeletes;

    /**
     * Boot the Trashable trait for a class.
     */
    public static function bootTrashable(): void {}

    /**
     * Initialize the Trashable trait for an instance.
     */
    public function initializeTrashable(): void
    {
        if (! isset($this->casts['deleted_at'])) {
            $this->casts['deleted_at'] = 'datetime';
        }
        if (! in_array('trashable', $this->appends)) {
            $this->appends[] = 'trashable';
        }
        if (! in_array('is_trashed', $this->appends)) {
            $this->appends[] = 'is_trashed';
        }
    }

    /**
     * Indicates that the model can be soft deleted.
     */
    public function trashable(): Attribute
    {
        return Attribute::get(fn (): bool => true);
    }

    /**
     * Gets if the model's trashed.
     */
    public function isTrashed(): Attribute
    {
        return Attribute::get(fn (): bool => $this->trashed());
    }
}
