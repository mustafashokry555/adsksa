<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    public $monthMapping = [
        'January' => 1,
        'February' => 2,
        'March' => 3,
        'April' => 4,
        'May' => 5,
        'June' => 6,
        'July' => 7,
        'August' => 8,
        'September' => 9,
        'October' => 10,
        'November' => 11,
        'December' => 12,
    ];
    public function appointment_reports()
    {
        if (Auth::user()->is_admin()) {
            $appointments = Appointment::query()->orderByDesc('id')->get();
            $monthlyReport = $this->monthlyAppointmentReport();
            $months = $this->getMonths();
            $hospitals =  User::where('user_type', 'H')->get();
            return view('admin.reports.appointment_reports', [
                'appointments' => $appointments,
                'monthlyReport' =>  $monthlyReport,
                'months' => $months,
                'hospitals' => $hospitals,

            ]);
        } else {
            abort(401);
        }
    }
    public function income_reports()
    {
        if (Auth::user()->is_admin()) {
            $monthlyReport = $this->monthlyIncomeReport();
            $months = $this->getMonths();
            $hospitals =  User::where('user_type', 'H')->get();
            $doctors = User::query()->where('user_type', 'D')->get();
            return view('admin.reports.income_reports', [
                'doctors' => $doctors,
                'monthlyReport' =>  $monthlyReport[0],
                'months' => $months,
                'totalIncome' => $monthlyReport[1],
                'hospitals' => $hospitals,
            ]);
        } else {
            abort(401);
        }
    }

    public function invoice_reports()
    {
        $monthlyReport = $this->monthlyInvoiceReport();
        $months = $this->getMonths();
        $hospitals =  User::where('user_type', 'H')->get();
        if (Auth::user()->is_admin()) {
            return view('admin.reports.invoice_reports', [
                'invoices' => Appointment::query()->orderByDesc('id')->get(),
                'monthlyReport' =>  $monthlyReport,
                'months' => $months,
                'hospitals' => $hospitals,
            ]);
        } else {
            abort(401);
        }
    }

    public function user_reports()
    {
        if (Auth::user()->is_admin()) {
            return view(
                'admin.reports.user_reports',
                [
                    'patients' => User::query()->where('user_type', 'U')->get(),
                ]
            );
        } else {
            abort(401);
        }
    }
    public function getMonths()
    {
        $firstDayOfCurrentMonth = Carbon::now()->startOfMonth();
        $lastDayOfCurrentMonth = Carbon::now()->lastOfMonth();
        $firstDayOfNextMonth = $firstDayOfCurrentMonth->copy()->addMonth();

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $months = [];
        for ($month = 1; $month <= $currentMonth; $month++) {
            $date = Carbon::create($currentYear, $month, 1);
            $months[] = $date->format('F');
        }
        return $months;
    }
    public function monthlyAppointmentReport()
    {
        $dataForMonth = [];
        $dateRange = [];
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $daysInMonth = Carbon::create($currentYear, $currentMonth)->daysInMonth;

        // Create a mapping of month names to month numbers
        $monthMapping = $this->monthMapping;
        $totalAmount = 0;
        $monthNumber = request()->month ? $monthMapping[request()->month] : Carbon::now()->month;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($currentYear, $monthNumber, $day)->toDateString();
            $dateRange[] = $date;
        }
        foreach ($dateRange as $date) {
            $query = \DB::table('appointments');
            if (Auth::user()->is_hospital()) {
                $query->where('hospital_id', Auth::user()->hospital_id);
            }
            if (request()->month) {

                $query->whereYear('appointment_date', $currentYear)->whereMonth('appointment_date', $monthNumber);
            }

            $dataForDate =  $query->whereDate('appointment_date', $date)
                ->count();
            // $totalAmount += $dataForDate;
            // Set the value to 0 if no data exists
            $dataForMonth[$date] = $dataForDate;
        }
        // dd($dataForMonth );
        return $dataForMonth ?? [];
    }

    public function monthlyInvoiceReport()
    {
        $dataForMonth = [];
        $dateRange = [];
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $daysInMonth = Carbon::create($currentYear, $currentMonth)->daysInMonth;

        // Create a mapping of month names to month numbers
        $monthMapping = $this->monthMapping;
        $totalAmount = 0;
        $monthNumber = request()->month ? $monthMapping[request()->month] : Carbon::now()->month;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($currentYear, $monthNumber, $day)->toDateString();
            $dateRange[] = $date;
        }
        foreach ($dateRange as $date) {
            $query = \DB::table('appointments');
            if (Auth::user()->is_hospital()) {
                $query->where('hospital_id', Auth::user()->hospital_id);
            }
            if (request()->month) {

                $query->whereYear('appointment_date', $currentYear)->whereMonth('appointment_date', $monthNumber);
            }

            $dataForDate =  $query->whereDate('appointment_date', $date)
                ->count();
            // $totalAmount += $dataForDate;
            // Set the value to 0 if no data exists
            $dataForMonth[$date] = $dataForDate;
        }
        // dd($dataForMonth );
        return $dataForMonth ?? [];
    }


    public function monthlyIncomeReport()
    {
        $dataForMonth = [];
        $dateRange = [];
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $daysInMonth = Carbon::create($currentYear, $currentMonth)->daysInMonth;

        // Create a mapping of month names to month numbers
        $monthMapping = $this->monthMapping;
        $totalAmount = 0;
        $monthNumber = request()->month ? $monthMapping[request()->month] : Carbon::now()->month;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($currentYear, $monthNumber, $day)->toDateString();
            $dateRange[] = $date;
        }
        foreach ($dateRange as $date) {
            $query = \DB::table('appointments');
            if (Auth::user()->is_hospital()) {
                $query->where('hospital_id', Auth::user()->hospital_id);
            }
            if (request()->month) {

                $query->whereYear('appointment_date', $currentYear)->whereMonth('appointment_date', $monthNumber);
            }

            $dataForDate =  $query->whereDate('appointment_date', $date)
                ->sum('fee');
            $totalAmount += $dataForDate;
            // Set the value to 0 if no data exists
            $dataForMonth[$date] = $dataForDate ?? 0;
        }
        // dd($dataForMonth );
        return [$dataForMonth ?? [], $totalAmount ?? 0];
    }
}
