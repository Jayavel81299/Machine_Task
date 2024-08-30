<?php

if (!function_exists('RoleChecking')) {

    function RoleChecking($roles, $route)
    {
        $permissions = [
            'admin' => ['dashboard', 'create', 'edit', 'update', 'delete', 'show', 'index', 'getMembers'],
            'project_manager' => ['dashboard','create', 'update', 'getMembers', 'index'],
            'team_member' => ['dashboard','show', 'getMembers', 'index'],
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
