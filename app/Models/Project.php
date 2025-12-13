<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

  public function course()
  {
    return $this->belongsTo(Course::class, 'course_id', 'course_id');
  }

  public function doctor()
  {
    return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
  }

  public function admin()
  {
    return $this->belongsTo(Student::class, 'admin_id', 'student_id');
  }
  public function members()
  {
    return $this->hasMany(ProjectMember::class, 'project_id');
  }
}
