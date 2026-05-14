<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    protected $fillable = [
        'module_id',
        'title',
        'slug',
        'content',
        'video_url',
        'xp_reward',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'xp_reward' => 'integer',
            'order' => 'integer',
        ];
    }

    // =========================================================================
    // RELATIONSHIPS
    // =========================================================================

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function userProgress(): HasMany
    {
        return $this->hasMany(UserLessonProgress::class);
    }

    // =========================================================================
    // HELPERS
    // =========================================================================

    /**
     * Check if this lesson is accessible by checking if previous lesson is completed.
     */
    public function isAccessibleBy(User $user): bool
    {
        // First lesson in a module is always accessible (if module is accessible)
        if ($this->order <= 1) {
            return $this->module->order <= 1 || $this->isPreviousModuleCompleted($user);
        }

        // Check if previous lesson in same module is completed
        $previousLesson = Lesson::where('module_id', $this->module_id)
            ->where('order', '<', $this->order)
            ->orderBy('order', 'desc')
            ->first();

        return $previousLesson ? $user->hasCompletedLesson($previousLesson) : true;
    }

    /**
     * Check if the previous module is completed.
     */
    private function isPreviousModuleCompleted(User $user): bool
    {
        $previousModule = Module::where('course_id', $this->module->course_id)
            ->where('order', '<', $this->module->order)
            ->orderBy('order', 'desc')
            ->first();

        return $previousModule ? $previousModule->isCompletedBy($user) : true;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
