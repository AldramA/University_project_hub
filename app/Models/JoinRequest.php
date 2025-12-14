<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * JoinRequest Model
 *
 * Represents a student's request to join a project.
 * The project admin can approve or reject these requests.
 *
 * Status values:
 * - pending: Request is awaiting admin response
 * - approved: Request has been approved, student is now a member
 * - rejected: Request has been rejected
 *
 * @property int $request_id
 * @property int $project_id
 * @property int $student_id
 * @property string $status
 * @property \DateTime|null $responded_at
 */
class JoinRequest extends Model
{
    use HasFactory;

    protected $table = 'join_requests';
    protected $primaryKey = 'request_id';

    protected $fillable = [
        'project_id',
        'student_id',
        'status',
        'responded_at',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get the project this request is for.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    /**
     * Get the student who made this request.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
