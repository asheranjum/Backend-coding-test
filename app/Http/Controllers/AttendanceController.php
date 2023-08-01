<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\HumanResources\Attendance\Application\AttendanceImport;
use App\HumanResources\Attendance\Application\AttendanceService;

class AttendanceController extends Controller
{
    //

    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }


    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');
        Excel::import(new AttendanceImport, $file);

        return response()->json(['message' => 'Attendance uploaded successfully'], 200);
    }


    public function all()
    {
        $data = $this->attendanceService->AllEmpcalculateWorkingHours();
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = $this->attendanceService->calculateWorkingHours($id);
        return response()->json($data, 200);
    }
}
