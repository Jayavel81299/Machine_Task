<?php

if (!function_exists('RoleChecking')) {

    function RoleChecking($roles, $route)
    {
        $permissions = [
            'admin' => ['dashboard', 'create', 'edit', 'update', 'destroy', 'show', 'index', 'getmembers', 'store'],
            'project_manager' => ['dashboard','create', 'update', 'edit', 'getmembers', 'index', 'store', 'show'],
            'team_member' => ['dashboard','show', 'index'],
        ];
        $routeParts = explode('.', $route);
        $action = end($routeParts);
        $roles = is_array($roles) ? $roles : [$roles];
        foreach ($roles as $role) {

            if (isset($permissions[$role]) && in_array($action, $permissions[$role])) {
                return true; 
            }
        }
        return false; 
    }
    
    
}
