<?php

namespace App\Http\Controllers;

use App\Models\AccountList;
use App\Models\Announcement;
use App\Models\AttendanceEmployee;
use App\Models\Employee;
use App\Models\Event;
use App\Models\LandingPageSection;
use App\Models\Meeting;
use App\Models\Job;
use App\Models\Payees;
use App\Models\Payer;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Utility;
use App\Models\Leave;
use App\Models\SaturationDeduction;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentDate = date('Y-m-d');
        $currentNumericDay = date('N'); // Numeric day of the week (1 for Monday, 2 for Tuesday, etc.)
        $timezone = env('TIMEZONE');
        date_default_timezone_set($timezone ?? 'Asia/Dubai');
        $currentTime = date("H:i:s");
        
        $notClockIn = AttendanceEmployee::where('date', '=', $currentDate)->get()->pluck('employee_id');
        
        $notClockIns = Employee::whereNotIn('id', $notClockIn)->get();
        
       
            // dd($notClockIns);
        if ($currentNumericDay != 6 && $currentNumericDay != 7 && $currentTime >= '12:00:00') {
           
            foreach($notClockIns as $row)
            {
               $leaves = Leave::where('employee_id', $row->id)
                        ->where('start_date', '>=', $currentDate)
                        ->where('end_date', '<=', $currentDate)
                        ->where('status', 'Approved')
                        ->get();
                
                    if ($leaves->isEmpty()) {
                        $existingDeduction = SaturationDeduction::where('employee_id', $row->id)
                            ->whereDate('created_at', $currentDate)
                            ->first();
                        
                         if (!$existingDeduction) {
                                $saturationdeduction                   = new SaturationDeduction;
                                $saturationdeduction->employee_id      = $row->id;
                                $saturationdeduction->deduction_option = 1;
                                $saturationdeduction->title            = "Auto Deduction Against Unpaid Leave";
                                $saturationdeduction->type             = "fixed";
                                $saturationdeduction->amount           = 100;
                                $saturationdeduction->created_by       = \Auth::user()->creatorId();
                                $saturationdeduction->save();
                         }
                    }
            }
        }

        if(Auth::check())
        {
            $user = Auth::user();
            if($user->type == 'employee')
            {

                $emp = Employee::where('user_id', '=', $user->id)->first();

                $announcements = Announcement::orderBy('announcements.id', 'desc')
                ->take(5)
                ->leftJoin('announcement_employees', 'announcements.id', '=', 'announcement_employees.announcement_id')
                ->where('announcement_employees.employee_id', '=', $emp->id)
                ->orWhere(function ($q) {
                    $q->whereIn('announcements.department_id', [0])
                        ->whereIn('announcements.employee_id', [0]);
                })
                ->select('announcements.*') // Select the created_by column from the announcements table
                ->get();

                $employees = Employee::get();
                // $meetings  = Meeting::orderBy('meetings.id', 'desc')->take(5)->leftjoin('meeting_employees', 'meetings.id', '=', 'meeting_employees.meeting_id')->where('meeting_employees.employee_id', '=', $emp->id)->orWhere(
                //     function ($q){
                //         $q->where('meetings.department_id', '["0"]')->where('meetings.employee_id', '["0"]'); 
                //     }
                // )->get();
                $meetings = Meeting::orderBy('meetings.id', 'desc')->take(5)
                    ->leftjoin('meeting_employees', 'meetings.id', '=', 'meeting_employees.meeting_id')
                    ->where(function ($q) use ($emp) {
                        $q->where('meeting_employees.employee_id', '=', $emp->id)
                            ->orWhere('meetings.created_by', '=', $emp->user_id)
                            ->orWhere(function ($q) {
                                $q->where('meetings.department_id', '["0"]')
                                    ->where('meetings.employee_id', '["0"]');
                            });
                    })
                    ->select('meetings.*', 'meetings.created_by')
                    ->get();



                $events    = Event::select('events.*','events.id as event_id_pk','event_employees.*')
                ->leftjoin('event_employees', 'events.id', '=', 'event_employees.event_id')
                ->where('event_employees.employee_id', '=', $emp->id)
                ->orWhere(
                    function ($q){
                        $q->where('events.department_id', '["0"]')->where('events.employee_id', '["0"]');
                    }
                )->get();
                
                $arrEvents = [];
                foreach($events as $event)
                {

                    $arr['id']              = $event['id'];
                    $arr['title']           = $event['title'];
                    $arr['start']           = $event['start_date'];
                    $arr['end']             = $event['end_date'];
                    $arr['className']       = $event['color'];
                    // $arr['borderColor']     = "#fff";
                    $arr['url']             = route('eventsshow', (!empty($event['event_id_pk'])) ? $event['event_id_pk'] : '' );
                    // $arr['textColor']       = "white";

                    $arrEvents[] = $arr;
                }
                $users          =User::all();
                $date               = date("Y-m-d");
                $time               = date("H:i:s");
                $employeeAttendance = AttendanceEmployee::orderBy('id', 'desc')->where('employee_id', '=', !empty(\Auth::user()->employee) ? \Auth::user()->employee->id : 0)->where('date', '=', $date)->first();

                $officeTime['startTime'] = Utility::getValByName('company_start_time');
                $officeTime['endTime']   = Utility::getValByName('company_end_time');

                return view('dashboard.dashboard', compact('arrEvents', 'announcements', 'employees','users', 'meetings', 'employeeAttendance', 'officeTime'));
            }
            else
            {
                $events    = Event::where('created_by', '=', \Auth::user()->creatorId())->get();
                $arrEvents = [];

                foreach($events as $event)
                {
                    $arr['id']    = $event['id'];
                    $arr['title'] = $event['title'];
                    $arr['start'] = $event['start_date'];
                    $arr['end']   = $event['end_date'];

                    $arr['className'] = $event['color'];
                    // $arr['borderColor']     = "#fff";
                    // $arr['textColor']       = "white";
                    $arr['url']             = route('event.edit', $event['id']);

                    $arrEvents[] = $arr;
                }



                $announcements = Announcement::where('end_date', '>=', now())->orderBy('announcements.id', 'desc')->take(5)->get();


                $emp           = User::where('type', '=', 'employee')->where('created_by', '=', \Auth::user()->creatorId())->get();
                $countEmployee = count($emp);

                $user      = User::where('type', '!=', 'employee')->where('created_by', '=', \Auth::user()->creatorId())->get();
                $countUser = count($user);

                $countTicket      = Ticket::where('created_by', '=', \Auth::user()->creatorId())->count();
                $countOpenTicket  = Ticket::where('status', '=', 'open')->where('created_by', '=', \Auth::user()->creatorId())->count();
                $countCloseTicket = Ticket::where('status', '=', 'close')->where('created_by', '=', \Auth::user()->creatorId())->count();

                $currentDate = date('Y-m-d');

                $employees     = User::where('type', '=', 'employee')->where('created_by', '=', \Auth::user()->creatorId())->get();
                $countEmployee = count($employees);
                $notClockIn    = AttendanceEmployee::where('date', '=', $currentDate)->get()->pluck('employee_id');
                
                $users          =User::all();
                $notClockIns    = Employee::where('created_by', '=', \Auth::user()->creatorId())->whereNotIn('id', $notClockIn)->get();
                $accountBalance = AccountList::where('created_by', '=', \Auth::user()->creatorId())->sum('initial_balance');
                
                $activeJob   = Job::where('status', 'active')->where('created_by', '=', \Auth::user()->creatorId())->count();
                $inActiveJOb = Job::where('status', 'in_active')->where('created_by', '=', \Auth::user()->creatorId())->count();

                $totalPayee = Payees::where('created_by', '=', \Auth::user()->creatorId())->count();
                $totalPayer = Payer::where('created_by', '=', \Auth::user()->creatorId())->count();

                $meetings = Meeting::limit(5)->get();
                $date               = date("Y-m-d");
                $time               = date("H:i:s");
                $employeeAttendance = AttendanceEmployee::orderBy('id', 'desc')->where('employee_id', '=', !empty(\Auth::user()->employee) ? \Auth::user()->employee->id : 0)->where('date', '=', $date)->first();

                $officeTime['startTime'] = Utility::getValByName('company_start_time');
                $officeTime['endTime']   = Utility::getValByName('company_end_time');

                return view('dashboard.dashboard', compact('arrEvents', 'announcements', 'employees','employeeAttendance','officeTime','users' ,'activeJob','inActiveJOb','meetings', 'countEmployee', 'countUser', 'countTicket', 'countOpenTicket', 'countCloseTicket', 'notClockIns', 'countEmployee', 'accountBalance', 'totalPayee', 'totalPayer'));
            }
        }
        else
        {
            if(!file_exists(storage_path() . "/installed"))
            {
                header('location:install');
                die;
            }
            else
            {
                $settings = Utility::settings();
                if($settings['display_landing_page'] == 'on')
                {
                    $get_section = LandingPageSection::orderBy('section_order', 'ASC')->get();
                    return view('layouts.landing',compact('get_section'));
                }
                else
                {
                    return redirect('login');
                }

            }
        }
    }

    public function getOrderChart($arrParam)
    {
        $arrDuration = [];
        if($arrParam['duration'])
        {
            if($arrParam['duration'] == 'week')
            {
                $previous_week = strtotime("-2 week +1 day");
                for($i = 0; $i < 14; $i++)
                {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);
                    $previous_week                              = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }

        $arrTask          = [];
        $arrTask['label'] = [];
        $arrTask['data']  = [];
        foreach($arrDuration as $date => $label)
        {

            $data               = Order::select(\DB::raw('count(*) as total'))->whereDate('created_at', '=', $date)->first();
            $arrTask['label'][] = $label;
            $arrTask['data'][]  = $data->total;
        }

        return $arrTask;
    }
}
