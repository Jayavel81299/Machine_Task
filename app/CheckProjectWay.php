<?php

namespace App;
use App\Models\User;
trait CheckProjectWay
{
    public function typeRole()
    {
        $managers = User::where('role', 'project_manager')->select('id', 'name')->get();
        return $managers;
    }
}
