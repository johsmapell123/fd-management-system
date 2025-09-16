<?php

if (! function_exists('dashboard_route')) {
  function dashboard_route($position)
  {
    switch ($position) {
      case 'Admin':
        return route('dashboard.admin');
      case 'Manager':
        return route('dashboard.manager');
      case 'Staff':
        return route('dashboard.staff');
      default:
        return abort(403);
    }
  }
}
