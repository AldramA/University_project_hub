<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Project Model
 *
 * Represents an academic project in the system.
 * Projects are created by students and supervised by doctors.
 *
 * Status values:
 * - not_graded: Project has not been evaluated yet
 * - submitted: Project has been submitted for review
 * - needs_work: Project needs revisions
 *
 * @property int $project_id
 * @property string $project_name
 * @property string $description
 * @property string|null $project_link
 * @property string|null $github_link
 * @property int $course_id
 * @property int $doctor_id
 * @property int $admin_id
 * @property string $status
 * @property float|null $grade
 * @property string|null $feedback
 */
class Project extends Model
{
  use HasFactory;

  protected $primaryKey = 'project_id';

  protected $fillable = [
    'project_name',
    'description',
    'project_link',
    'github_link',
    'course_id',
    'doctor_id',
    'admin_id',
    'status',
    'grade',
    'feedback',
  ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

  /**
   * Get the course this project belongs to.
   */
  public function course()
  {
    return $this->belongsTo(Course::class, 'course_id', 'course_id');
  }

  /**
   * Get the doctor supervising this project.
   */
  public function doctor()
  {
    return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
  }

  /**
   * Get the student who created/administers this project.
   */
  public function admin()
  {
    return $this->belongsTo(Student::class, 'admin_id', 'student_id');
  }

  /**
   * Get all members of this project.
   */
  public function members()
  {
    return $this->hasMany(ProjectMember::class, 'project_id', 'project_id');
  }

  /**
   * Get all comments on this project.
   */
  public function comments()
  {
    return $this->hasMany(Comment::class, 'project_id', 'project_id');
  }

  /**
   * Get all join requests for this project.
   */
  public function joinRequests()
  {
    return $this->hasMany(JoinRequest::class, 'project_id', 'project_id');
  }
}
