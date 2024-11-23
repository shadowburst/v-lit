<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Gate;
use ReflectionClass;

trait HasAuthorize
{
    /**
     * Boot the HasAuthorize trait for a class.
     */
    public static function bootHasAuthorize(): void {}

    /**
     * Initialize the HasAuthorize trait for an instance.
     */
    public function initializeHasAuthorize(): void
    {
        if (! in_array('authorize', $this->appends)) {
            $this->appends[] = 'authorize';
        }
    }

    /**
     * Loads all authorizations on to the model.
     */
    protected function authorize(): Attribute
    {
        return Attribute::get(
            function (): array {
                $actions = [];

                $policy = Gate::getPolicyFor($this);

                if (! $policy) {
                    return $actions;
                }

                $methods = (new ReflectionClass($policy))->getMethods();
                foreach ($methods as $method) {
                    $param = $method->getParameters()[1] ?? null;
                    if ($param?->getType() == static::class) {
                        $action = $method->getName();
                        $actions[$action] = Gate::check($action, $this);
                    }
                }

                return $actions;
            }
        );
    }
}
