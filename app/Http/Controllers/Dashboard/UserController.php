<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $perPage = request('per_page') ?? 10;
        $orderBy = request('sort_by') ?? 'created_at';
        $orderDir = request('sort_dir') ?? 'desc';
        $keyword = request('keyword') ?? '';
        $query = User::orderBy($orderBy, $orderDir);
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        }
        return $query->paginate($perPage);
    }
}
