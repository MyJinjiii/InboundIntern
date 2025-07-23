<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BudgetYear;
use App\Models\ResearchList;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function index()
    {
        $budgetyears = BudgetYear::all();
        return view('admin.dashboard', compact('budgetyears'));
    }

    public function getPrograms($year_id) {
        $programs = ResearchList::where('year_id', $year_id)->get();
        $options = '<option value="">Select Program</option>';
        foreach ($programs as $program) {
            $options .= '<option value="' . $program->id . '">' . $program->program . '</option>';
        }
        return response()->json($options);
    }

    public function getUsers($program_id) {
        $user_info = UserInfo::where('topic_id', $program_id)->get();
        $rows = '';
        $iteration = 1;
        foreach ($user_info as $info) {
            $rows .= '<tr>
                        <td>' . $iteration++ . '</td>
                        <td>' . $info->name . ' ' . $info->surname . '</td>
                        <td>' . $info->email . '</td>
                        <td>' . $info->university . ', ' . $info->faculty . '</td>
                        <td>' . $info->country . '</td>
                        <td>' . $info->study_program . '</td>
                        <td>' . $info->advisor . '</td>
                        <td>' . $info->start_date . ' - ' . $info->ending_date . '</td>
                        <td>' . $info->status . '</td>
                      </tr>';
        }
        return response()->json(['rows' => $rows, 'count' => $user_info->count()]);
    }
  
    public function exportAllStudents()
    {
        // $students = UserInfo::all();
        $students = DB::table('user_infos')
        ->join('research_lists', 'user_infos.topic_id', '=', 'research_lists.id')
        ->join('budget_years', 'research_lists.year_id', '=', 'budget_years.id')
        ->join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
        ->select(
            'user_infos.*', 
            'research_lists.year_id',
            'budget_years.year as budget_year', 
            'user_statuses.status'
        )
        ->get();
    
        return $this->exportToExcel($students, 'all_students.xlsx');
    }

    public function exportStudentsByYear()
    {
        // ดึงข้อมูลนักเรียนพร้อมกับ researchList โดยใช้ join
        $students = DB::table('user_infos')
        ->join('research_lists', 'user_infos.topic_id', '=', 'research_lists.id')
        ->join('budget_years', 'research_lists.year_id', '=', 'budget_years.id')
        ->join('user_statuses', 'user_infos.id', '=', 'user_statuses.info_id')
        ->select(
            'user_infos.*', 
            'research_lists.year_id',
            'budget_years.year as budget_year', 
            'user_statuses.status'
        )
        ->get()
        ->sortBy('year_id');
    
    
        // แยกข้อมูลตามปี
        $yearlyData = $students->groupBy('year_id');
        // สร้างไฟล์ Excel สำหรับแต่ละปี
        foreach ($yearlyData as $year => $data) {
            $filename = 'students_by_year_' . $year . '.xlsx';
            
        }
        return $this->exportToExcel($data, $filename);
    }
    
    // private function exportToCsv($data, $filename)
    // {
    //     $headers = [
    //         'Content-Type'        => 'text/csv',
    //         'Content-Disposition' => "attachment; filename={$filename}",
    //         'Pragma'              => 'no-cache',
    //         'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
    //         'Expires'             => '0',
    //     ];
    
    //     $columns = ['No', 'Name-Surname', 'E-mail', 'Institution', 'Country', 'Program', 'Advisor', 'Time Period', 'Status'];
    
    //     $callback = function () use ($data, $columns) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, $columns);
    
    //         $iteration = 1;
    //         foreach ($data as $row) {
    //             fputcsv($file, [
    //                 $iteration++,
    //                 $row->name . ' ' . $row->surname,
    //                 $row->email,
    //                 $row->university . ', ' . $row->faculty,
    //                 $row->country,
    //                 $row->study_program,
    //                 $row->advisor,
    //                 $row->start_date . ' - ' . $row->ending_date,
    //                 $row->status,
    //             ]);
    //         }
    //         fclose($file);
    //     };
    
    //     return response()->stream($callback, 200, $headers);
    // }
    

    public function exportStudentsByProgram()
    {
        $students = UserInfo::orderBy('topic_id')->get();
        return $this->exportToExcel($students, 'students_by_program.xlsx');
    }

    private function exportToExcel($data, $filename)
    {
        $headers = [
            'Content-Type'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');

            $columns = ['No', 'Name-Surname', 'E-mail', 'Program','Level of Study','Years of Study', 'Institution', 'Country', 'Advisor','internship_duration','Year', 'Time Period', 'Status'];
            fputcsv($file, $columns);

            $iteration = 1;
            foreach ($data as $row) {
                fputcsv($file, [
                    $iteration++,
                    $row->title.''.$row->name . ' ' . $row->surname,
                    $row->email,
                    $row->study_program,
                    $row->level_of_studies,
                    $row->year_of_study,
                    $row->university . ', ' . $row->faculty,
                    $row->country,
                    $row->advisor,
                    $row->internship_duration,
                    $row->budget_year,
                    $row->start_date . ' - ' . $row->ending_date,
                    $row->status,
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}


?>
