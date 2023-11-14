<?php

namespace App\Http\Controllers;



class DashboardController extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->id_role;

        switch ($userRole) {
            case 1:
                return redirect()->route('timlb3.index');
                break;
            case 2:
                return redirect()->route('admin.dashboard');
                break;
            case 3:
                return redirect()->route('tuanrumah.home');
                break;
            case 4:
                return redirect()->route('phr.home');
                break;
            case 5:
                return redirect()->route('admin_duri.dashboard');
                break;
            case 6:
                return redirect()->route('security.home');
                break;
            case 7:
                return redirect()->route('adminpku.dashboard');
                break;
                // Tambahkan case lain sesuai dengan peran pengguna lainnya
            default:
                return redirect()->route('default.dashboard');
        }
    }
}
