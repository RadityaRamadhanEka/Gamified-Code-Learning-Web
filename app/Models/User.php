<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'xp',
        'level',
        'avatar_url',
        'current_streak',
        'last_activity_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_activity_date' => 'date',
            'xp' => 'integer',
            'level' => 'integer',
            'current_streak' => 'integer',
        ];
    }

    // =========================================================================
    // RELATIONSHIPS
    // =========================================================================

    public function lessonProgress(): HasMany
    {
        return $this->hasMany(UserLessonProgress::class);
    }

    public function quizAttempts(): HasMany
    {
        return $this->hasMany(UserQuizAttempt::class);
    }

    // =========================================================================
    // GAMIFICATION LOGIC
    // =========================================================================

    /**
     * Add XP and auto-recalculate level.
     * Formula: level = floor(xp / 500) + 1
     */
    public function addXp(int $amount): void
    {
        $this->increment('xp', $amount);
        $this->refresh();

        $newLevel = (int) floor($this->xp / 500) + 1;
        if ($newLevel !== $this->level) {
            $this->update(['level' => $newLevel]);
        }
    }

    /**
     * Update daily streak tracking.
     */
    public function updateStreak(): void
    {
        $today = Carbon::today();
        $lastActivity = $this->last_activity_date;

        if ($lastActivity && $lastActivity->isYesterday()) {
            $this->increment('current_streak');
        } elseif (!$lastActivity || !$lastActivity->isToday()) {
            $this->update(['current_streak' => 1]);
        }

        $this->update(['last_activity_date' => $today]);
    }

    /**
     * Check if user has completed a specific lesson (anti-cheat).
     */
    public function hasCompletedLesson(Lesson $lesson): bool
    {
        return $this->lessonProgress()->where('lesson_id', $lesson->id)->exists();
    }

    /**
     * Check if user has attempted a specific quiz.
     */
    public function hasAttemptedQuiz(Quiz $quiz): bool
    {
        return $this->quizAttempts()->where('quiz_id', $quiz->id)->exists();
    }

    /**
     * Get the best quiz attempt score.
     */
    public function bestQuizScore(Quiz $quiz): ?int
    {
        return $this->quizAttempts()
            ->where('quiz_id', $quiz->id)
            ->max('score');
    }

    /**
     * Calculate user's progress percentage for a course.
     */
    public function courseProgress(Course $course): float
    {
        $totalLessons = $course->modules()->withCount('lessons')->get()->sum('lessons_count');
        if ($totalLessons === 0) return 0;

        $completedLessons = $this->lessonProgress()
            ->whereHas('lesson.module', fn($q) => $q->where('course_id', $course->id))
            ->count();

        return round(($completedLessons / $totalLessons) * 100);
    }

    /**
     * Get count of completed lessons.
     */
    public function completedLessonsCount(): int
    {
        return $this->lessonProgress()->count();
    }

    /**
     * Check if user can access a course based on level.
     */
    public function canAccessCourse(Course $course): bool
    {
        return $this->level >= $course->min_level_required;
    }
}
