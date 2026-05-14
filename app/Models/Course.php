<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'color_theme',
        'min_level_required',
        'order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'min_level_required' => 'integer',
            'order' => 'integer',
        ];
    }

    // =========================================================================
    // RELATIONSHIPS
    // =========================================================================

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class)->orderBy('order');
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Scope to only published courses.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope to order courses by their order column.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // =========================================================================
    // HELPERS
    // =========================================================================

    /**
     * Get total lessons count across all modules.
     */
    public function totalLessonsCount(): int
    {
        return $this->modules()->withCount('lessons')->get()->sum('lessons_count');
    }

    /**
     * Get route key name for URL binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
