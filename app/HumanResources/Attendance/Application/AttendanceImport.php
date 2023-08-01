<?php

namespace App\HumanResources\Attendance\Application;

use App\HumanResources\Attendance\Domain\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AttendanceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Attendance([
            'employee_id' => $row['employee_id'] ?? null,
            'location_id' => $row['location_id'] ?? null,
            'date' => isset($row['date']) ? Date::excelToDateTimeObject($row['date']) : null,
            'time_in' => isset($row['time_in']) ? Date::excelToDateTimeObject($row['time_in']) : null,
            'time_out' => isset($row['time_out']) ? Date::excelToDateTimeObject($row['time_out']) : null,
        ]);
    }
}




?>