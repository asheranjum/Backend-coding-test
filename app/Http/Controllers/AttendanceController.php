<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\HumanResources\Attendance\Application\AttendanceImport;
use App\HumanResources\Attendance\Domain\Attendance;
use Carbon\Carbon;
class AttendanceController extends Controller
{
    //


    public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xls,xlsx'
    ]);

    $file = $request->file('file');
    Excel::import(new AttendanceImport, $file);

    return response()->json(['message' => 'Attendance uploaded successfully'], 200);
}


public function show($id)
{
    $attendances = Attendance::where('employee_id', $id)->get();

    $totalHours = 0;
    foreach ($attendances as $attendance) {
        $timeIn = Carbon::parse($attendance->time_in);
        $timeOut = Carbon::parse($attendance->time_out);
        $totalHours += $timeOut->diffInHours($timeIn);
    }

    return response()->json([
        'employee_id' => $id,
        'attendances' => $attendances,
        'total_working_hours' => $totalHours
    ], 200);
}


}
