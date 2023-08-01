<?php


namespace App\HumanResources\Attendance\Domain;

use Illuminate\Database\Eloquent\Model;
use App\HumanResources\Attendance\Domain\Employee;
class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'location_id',
        'date',
        'time_in',
        'time_out'
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }


}

?>