<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Role;

class CheckRoleOrPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $user = $request->user();

        if (!$user) {
            return abort(403, 'Unauthenticated user.');
        }
        
        // Check if the user is an admin
        if ($user && $user->hasRole('Admin')) {
            return $next($request);
        }

        // Get the role name from role_id (assuming role_id is in the users table)
        $roleNames = [
            'Admin',
            'Authenticated',
            'Resident',
            'Security',
            'Staff'
        ];

        $roleName = $user->getRoleNames()->toArray()[0];

        // Define your route-to-permission map
        $routeToPermissionMap = [
            //roles
            'roles' => 'view roles',
            'role.add' => 'create roles',
            'role.store' => 'create roles',
            'role.edit' => 'edit roles',
            'role.update' => 'edit roles',
            'role.destroy' => 'delete roles',

            //users
            'users' => 'view users',
            'user.search' => 'view users',
            'user.add' => 'create users',
            'user.store' => 'create users',
            'user.edit' => 'edit users',
            'user.update' => 'edit users',
            'user.destroy' => 'delete users',

            //building
            'building' => 'view buildings',
            'building.add' => 'create buildings',
            'building.store' => 'create buildings',
            'building.edit' => 'edit buildings',
            'building.update' => 'edit buildings',
            'building.destroy' => 'delete buildings',

            //floor
            'floor.index' => 'view floors',
            'floor.create' => 'create floors',
            'floor.store' => 'create floors',
            'floor.edit' => 'edit floors',
            'floor.update' => 'edit floors',
            'floor.destroy' => 'delete floors',

            //unit
            'unit.index' => 'view units',
            'unit.create' => 'create units',
            'unit.store' => 'create units',
            'unit.edit' => 'edit units',
            'unit.update' => 'edit units',
            'unit.destroy' => 'delete units',

            //residents
            'residents.index' => 'view residents',
            'residents.create' => 'create residents',
            'residents.store' => 'create residents',
            'residents.edit' => 'edit residents',
            'residents.update' => 'edit residents',
            'residents.destroy' => 'delete residents',
            //complaints

            'complaints.user' => 'view own complaints',
            'complaints.index' => 'view All complaints',
            'complaints.create' => 'create complaints',
            'complaints.store' => 'create complaints',
            'complaints.edit' => 'edit complaints',
            'complaints.update' => 'edit complaints',
            'complaints.updateStatus' => 'edit complaints Status',
            'complaints.destroy' => 'delete complaints',

            //notifications
            'notifications.read' => 'view notifications',

            //facilities
            'facilities.index' => 'view facilities',
            'facilities.create' => 'create facilities',
            'facilities.store' => 'create facilities',
            'facilities.edit' => 'edit facilities',
            'facilities.update' => 'edit facilities',
            'facilities.destroy' => 'delete facilities',

            //facility bookings
            'admin.bookings.index' => 'view All bookings',
            'bookings.bookings' => 'view own bookings',
            'bookings.edit' => 'edit bookings',
            'bookings.update' => 'edit bookings',
            'bookings.destroy' => 'delete bookings',

            //permissions
            'permissions.manage' => 'view permissions',
            'permissions.save' => 'manage permissions',
            
            //reports
            'reports.index' => 'view reports',

            //bills
            'bills.index' => 'view bills',
            'bills.pay' => 'pay bills',
            'payment.callback' => 'payment callback',

            //bookings payments
            'bookings.pay' => 'pay bookings',
            'bookings.payment.callback' => 'booking callback',

            // Notices
            'notices.index' => 'view notices',
            'notices.create' => 'create notices',
            'notices.store' => 'create notices',
            'notices.edit' => 'edit notices',
            'notices.update' => 'edit notices',
            'notices.destroy' => 'delete notices',
            'notices.show' => 'view notices',

            // Staff
            'staff.index' => 'view staff',
            'staff.create' => 'create staff',           
            'staff.store' => 'create staff',
            'staff.edit' => 'edit staff',
            'staff.update' => 'edit staff',
            'staff.destroy' => 'delete staff',
            'staff.show' => 'view staff',
        ];

        // Get current route name
        $routeName = $request->route()->getName();
        
        // If the route is listed in the map
        if (array_key_exists($routeName, $routeToPermissionMap)) {
            $requiredPermission = $routeToPermissionMap[$routeName];
            // If user has the permission or the role
            if ($user->hasPermissionTo($requiredPermission) && in_array($user->hasRole($roleName), $roleNames)) {
                return $next($request);
            }

            // If not authorized
            return abort(403, 'You do not have permission to access this page.');
        }

        // If route isn't in the map, just allow access
        return $next($request);

    }
}
