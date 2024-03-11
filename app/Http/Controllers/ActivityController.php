<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User; // Asegúrate de importar el modelo User
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = ActivityLog::latest()->paginate(10);

        return view('admin.activity.index', compact('activities'));
    }

    public function show(ActivityLog $activity)
    {
        return view('admin.activity.show', compact('activity'));
    }

    public function userActivities($userId)
    {
        $user = User::findOrFail($userId);
        $activities = $user->activityLogs()->latest()->paginate(10);

        return view('admin.activity.user_activities', compact('user', 'activities'));
    }
}
