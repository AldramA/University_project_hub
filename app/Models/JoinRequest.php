<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    protected $table = 'join_requests';

    protected $primaryKey = 'request_id';

    protected $fillable = [
        'project_id',
        'student_id',
        'status',
        'requested_at',
        'responded_at',
    ];

    /**
     * Relationship: JoinRequest belongs to a Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    /**
     * Relationship: JoinRequest belongs to a Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }
}
