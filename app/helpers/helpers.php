<?php


use App\Models\Admin;
use App\Models\User;
use App\Services\FileService;

if (!function_exists('app_name')) {
    function app_name()
    {
        return config('app.name');
    }
}

if (!function_exists('getAdminTitle')) {
    function getAdminTitle(): string
    {
        return config('project.project_title') . ' | ' . config('project.admin_title');
    }
}

if (!function_exists('is_active_route')) {
    function is_active_route($routeNames, $activeClass = 'active')
    {
        foreach ((array)$routeNames as $routeName) {
            if (request()->routeIs($routeName)) {
                return $activeClass;
            }
        }
        return '';
    }
}

if (!function_exists('storage_asset')) {
    function storage_asset(string $path): string
    {
        return url('storage/' . ltrim($path, '/'));
    }
}

if (!function_exists('get_user_full_name')) {
    function get_user_full_name(?int $userId = null): string
    {
        $user = $userId ? User::find($userId) : null;
        if (!$user) {
            return '-';
        }
        return trim($user->first_name . ' ' . $user->last_name) ?: '-';
    }
}

if (!function_exists('get_admin_full_name')) {
    function get_admin_full_name(?int $adminId = null): string
    {
        $user = $adminId ? Admin::find($adminId) : auth()->user();
        if (!$user) {
            return 'مهمان';
        }
        return trim($user->first_name . ' ' . $user->last_name) ?: 'مهمان';
    }
}

if (!function_exists('getAdminAvatarUrl')) {
    function getAdminAvatarUrl(?Admin $admin = null): string
    {
        $admin ??= auth('admin')->user();
        return app(FileService::class)->getFirstFileUrl(
            $admin,
            'assets/admin/images/faces/DefaultAvatar.jpg'
        );
    }
}

if (!function_exists('getUserAvatarUrl')) {
    function getUserAvatarUrl(?User $user = null): string
    {
        $user ??= auth()->user();
        return app(FileService::class)->getFirstFileUrl(
            $user,
            'assets/admin/images/faces/DefaultAvatar.jpg'
        );
    }
}





if (!function_exists('getModelImageUrl')) {
    function getModelImageUrl($model, string $defaultPath, int $index = 0): string
    {
        return app(FileService::class)->getModelImageUrl($model, $defaultPath, $index);
    }
}



