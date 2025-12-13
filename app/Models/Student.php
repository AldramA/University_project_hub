<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
  use Notifiable;

  protected $primaryKey = 'student_id';

  public $timestamps = false;

  public function projectMembers()
  {
    return $this->hasMany(ProjectMember::class, 'student_id');
  }

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
  public function getYearLabelAttribute(): string
  {
    return match ($this->year) {
      '1' => 'First Year',
      '2' => 'Second Year',
      '3' => 'Third Year',
      '4' => 'Fourth Year',
      default => 'Unknown',
    };
  }
  public function getDepartmentLabelAttribute(): string
  {
    return match ($this->department) {
      "cs" => 'Computer Science',
      "it" => 'Information Technology',
      "is" => 'Information Science',
      "ds" => 'Data Science',
      default => 'Unknown',
    };
  }
}
