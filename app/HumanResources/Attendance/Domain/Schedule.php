<?php

namespace App\HumanResources\Attendance\Domain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\HumanResources\Attendance\Domain\Employee;
use App\HumanResources\Attendance\Domain\Shift;

class Schedule extends Model
{
    use HasFactory;


    protected $fillable = ['employee_id', 'shift_id', 'start_date', 'end_date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

}
