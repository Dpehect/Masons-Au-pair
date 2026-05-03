<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Application;
use Livewire\WithPagination;

class ApplicationManager extends Component
{
    use WithPagination;

    public $search = '';

    public function approve($applicationId)
    {
        $application = Application::find($applicationId);
        $application->update(['status' => 'completed']);
        session()->flash('message', 'Application approved successfully.');
    }

    public function reject($applicationId)
    {
        $application = Application::find($applicationId);
        $application->update(['status' => 'rejected']);
        session()->flash('message', 'Application rejected.');
    }

    public function render()
    {
        return view('livewire.admin.application-manager', [
            'applications' => Application::whereHas('user', function($query) {
                $query->where('email', 'like', '%'.$this->search.'%');
            })->paginate(10),
        ]);
    }
}
