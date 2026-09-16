<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'customer');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->withCount('orders')->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function toggleBlock(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Tidak dapat memblokir akun admin.');
        }

        $user->update(['is_blocked' => !$user->is_blocked]);

        $message = $user->is_blocked ? 'Akun berhasil diblokir.' : 'Akun berhasil dibuka blokirnya.';

        return back()->with('success', $message);
    }
}

