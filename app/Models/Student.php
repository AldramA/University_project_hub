<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Student Model
 *
 * Represents a student user in the system. Students can:
 * - Create and manage projects (as admin)
 * - Join existing projects (as member)
 * - View project details and grades
 *
 * @property int $student_id
 * @property string $full_name
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $year (1-4)
 * @property string $department (cs, it, is, ds)
 */
class Student extends Authenticatable
{
  use Notifiable;

  protected $primaryKey = 'student_id';
  public $timestamps = false;

  protected $fillable = [
    'full_name',
    'email',
    'password',
    'phone',
    'year',
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
   * Get projects where this student is the admin.
   */
  public function adminProjects()
  {
    return $this->hasMany(Project::class, 'admin_id', 'student_id');
  }

  /**
   * Get project memberships for this student.
   */
  public function projectMembers()
  {
    return $this->hasMany(ProjectMember::class, 'student_id');
  }

  /**
   * Get join requests made by this student.
   */
  public function joinRequests()
  {
    return $this->hasMany(JoinRequest::class, 'student_id');
  }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

  /**
   * Get human-readable year label.
   */
  public function getYearLabelAttribute(): string
  {
    return match ($this->year) {
      '1' => 'First Year',
      '2' => 'Second Year',
      '3' => 'Third Year',
      '4' => 'Fourth Year',
      default => $this->year,
    };
  }

  /**
   * Get human-readable department label.
   */
  public function getDepartmentLabelAttribute(): string
  {
    return match ($this->department) {
      'cs' => 'Computer Science',
      'it' => 'Information Technology',
      'is' => 'Information Systems',
      'ds' => 'Data Science',
      default => $this->department,
    };
  }
}
