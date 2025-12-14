<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Doctor Model
 *
 * Represents a faculty member (doctor) in the system. Doctors can:
 * - View their assigned courses and projects
 * - Add comments to projects
 * - Update project status
 * - Grade projects and provide feedback
 *
 * @property int $doctor_id
 * @property string $full_name
 * @property string $email
 * @property string $password
 * @property string $department
 */
class Doctor extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'doctor_id';

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'department',
    ];

    protected $hidden = [
        'password',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get courses assigned to this doctor.
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'doctor_id', 'doctor_id');
    }

    /**
     * Get projects supervised by this doctor.
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'doctor_id', 'doctor_id');
    }

    /**
     * Get comments made by this doctor.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'doctor_id', 'doctor_id');
    }
}
