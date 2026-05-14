<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Module extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
        ];
    }

    // =========================================================================
    // RELATIONSHIPS
    // =========================================================================

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function quiz(): HasOne
    {
        return $this->hasOne(Quiz::class);
    }

    // =========================================================================
    // HELPERS
    // =========================================================================

    /**
     * Check if all lessons in this module are completed by a user.
     */
    public function isCompletedBy(User $user): bool
    {
        $totalLessons = $this->lessons()->count();
        if ($totalLessons === 0) return false;

        $completedLessons = $user->lessonProgress()
            ->whereIn('lesson_id', $this->lessons()->pluck('id'))
            ->count();

        return $completedLessons >= $totalLessons;
    }

    /**
     * Get progress percentage for a user.
     */
    public function progressFor(User $user): float
    {
        $totalLessons = $this->lessons()->count();
        if ($totalLessons === 0) return 0;

        $completedLessons = $user->lessonProgress()
            ->whereIn('lesson_id', $this->lessons()->pluck('id'))
            ->count();

        return round(($completedLessons / $totalLessons) * 100);
    }
}
