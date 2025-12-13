<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    protected $table = 'project_members';

    protected $primaryKey = 'member_id';

    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'student_id',
        'role',
        'join_status',
        'joined_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
