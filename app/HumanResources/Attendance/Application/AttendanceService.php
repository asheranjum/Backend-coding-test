<?php


namespace App\HumanResources\Attendance\Application;

use App\HumanResources\Attendance\Domain\Attendance;
use App\HumanResources\Attendance\Domain\Schedule;
use Carbon\Carbon;

class AttendanceService
{

    public function calculateWorkingHours($id)
    {

        $attendances = Attendance::with('employee')->where('employee_id', $id)->get();
        // $schedules = Schedule::with('shift')->where('employee_id', $id)->get();

        $totalHours = 0;
        $attendanceData = [];
        foreach ($attendances as $attendance) {
            $timeIn = Carbon::parse($attendance->time_in);
            $timeOut = Carbon::parse($attendance->time_out);
            $hours = $timeOut->diffInHours($timeIn);
            $totalHours += $hours;

            $attendanceData[] = [
                'Name' => $attendance->employee->name,
                'checkin' => $timeIn->format('H:i:s'),
                'checkout' => $timeOut->format('H:i:s'),
                'total_working_hours' => $hours
            ];
        }

        return [
            'employee_id' => $id,
            'total_working_hours' => $totalHours,
            'attendance_data' => $attendanceData,
            // 'schedules' => $schedules
        ];
    
        
    }
    
    public function AllEmpcalculateWorkingHours()
    {
        $attendances = Attendance::with('employee')->get();

        $totalHours = 0;
        $attendanceData = [];
        foreach ($attendances as $attendance) {
            $timeIn = Carbon::parse($attendance->time_in);
            $timeOut = Carbon::parse($attendance->time_out);
            $hours = $timeOut->diffInHours($timeIn);
            $totalHours += $hours;

            $attendanceData[] = [
                'Name' => $attendance->employee->name,
                'checkin' => $timeIn->format('H:i:s'),
                'checkout' => $timeOut->format('H:i:s'),
                'total_working_hours' => $hours
            ];
        }

        return [
            'total_working_hours' => $totalHours,
            'attendance_data' => $attendanceData
        ];
    }
}


?>