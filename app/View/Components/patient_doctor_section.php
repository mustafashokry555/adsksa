<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class patient_doctor_section extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $doctors = User::query()->where('user_type', 'D')->take('8')->inRandomOrder()->get();
        return view('components.patient_doctor_section', compact('doctors'));
    }
}
