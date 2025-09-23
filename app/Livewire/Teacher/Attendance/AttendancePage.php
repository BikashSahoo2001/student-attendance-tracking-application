<?php

namespace App\Livewire\Teacher\Attendance;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use Carbon\Carbon;
use Livewire\Component;

class AttendancePage extends Component
{

    public $year, $month, $grade;

    public $students = [];

    public $attendance = [];

    public $grades = [];

    public function mount() {
        $this->grades = Grade::all();
    }

    public function fetchStudents() {
        if( $this->year && $this->month && $this->grade) {

            $this->students = Student::where('grade_id', $this->grade)->get();

            //generate days in a month
            foreach( $this->students as $student) {
                foreach( range(1,Carbon::create( $this->year, $this->month)->daysInMonth) as $day) {
                    $date = Carbon::create( $this->year, $this->month, $day )->format('Y-m-d');
                    $this->attendance[$student->id][$day] = Attendance::where('student_id', $student->id)
                                                            ->whereDate('date', $date)
                                                            ->value('status') ?? 'present'; 
                                                          
                }
            }
            
        }
    }
    public function render()
    {
        return view('livewire.teacher.attendance.attendance-page',[
            'daysInMonth' => Carbon::create( $this->year, $this->month)->daysInMonth
        ]);
    }
}
