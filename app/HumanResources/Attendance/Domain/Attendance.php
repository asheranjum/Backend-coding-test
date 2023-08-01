<?php


namespace App\HumanResources\Attendance\Domain;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'location_id',
        'date',
        'time_in',
        'time_out'
    ];
}

?>