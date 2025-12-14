<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Course Model
 *
 * Represents an academic course in the system.
 * Courses are taught by doctors and can have multiple projects.
 *
 * @property int $course_id
 * @property string $course_name
 * @property string $course_code
 * @property int $doctor_id
 */
class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'course_id';

    protected $fillable = [
        'course_name',
        'course_code',
        'doctor_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get the doctor teaching this course.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
    }

    /**
     * Get all projects in this course.
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'course_id', 'course_id');
    }
}
