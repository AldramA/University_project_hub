<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * ProjectMember Model
 *
 * Represents a student's membership in a project.
 * Links students to projects they have joined (not as admin).
 *
 * @property int $member_id
 * @property int $project_id
 * @property int $student_id
 * @property string $role (member, etc.)
 * @property string $join_status (approved, pending)
 */
class ProjectMember extends Model
{
    use HasFactory;

    protected $primaryKey = 'member_id';
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'student_id',
        'role',
        'join_status',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get the project this membership belongs to.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    /**
     * Get the student who is a member.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
