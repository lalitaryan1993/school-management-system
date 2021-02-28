<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeLeave extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }
    public function purpose()
    {
        return $this->belongsTo(LeavePurpose::class, 'leave_purpose_id', 'id');
    }

}
