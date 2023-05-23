<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $users =  User::where('power', 'USER')->where(function ($q) use ($request) {
            if ($request->id != null)
                $q->where('id', $request->id);
            if ($request->q != null)
                $q->where('name', 'LIKE', '%' . $request->q . '%')->orWhere('phone', 'LIKE', '%' . $request->q . '%')->orWhereRelation('rate_my', 'stars', 'LIKE', '%' . $request->q . '%')->orWhere('email', 'LIKE', '%' . $request->q . '%');
        })->orderBy('id', 'DESC')->paginate();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate(['name' => "nullable|max:190",
            'phone' => "nullable|max:190",
            'power' => "required|in:ADMIN,USER",
            'role' => "nullable|string",
            'bio' => "nullable|max:5000",
            'email' => "required|unique:users,email",
            'City' => "required|exists:cities,id",
            'password' => "required|min:8|max:190"
        ]);
        $user = User::create(["name" => $request->name,
            "phone" => $request->phone,
            "city_id" => $request->City,
            "power" => $request->power ?? 'USER',
            "role" => $request->role ?? '',
            "bio" => $request->bio,
            "blocked" => $request->blocked,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $user->update([
            'wallet_id' => $user->id
        ]);

        if ($request->hasFile('avatar')) {
            $file = $this->store_file(['source' => $request->avatar,
                'validation' => "image",
                'path_to_save' => '/uploads/users/',
                'type' => 'USER',
                'user_id' => Auth::user()->id,
                'resize' => [500, 1000],
                'small_path' => 'small/',
                'visibility' => 'PUBLIC',
                'file_system_type' => env('FILESYSTEM_DRIVER'),
                /*'watermark'=>true,*/
                'compress' => 'auto'
            ]);
            $user->update(['avatar' => $file['filename']]);
        }

        flash()->success('تم إضافة المستخدم بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        $user = User::findOrFail($user);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate(['name' => "nullable|max:190",
            'phone' => "nullable|max:190",
            'power' => "required|in:ADMIN,USER",
            'role' => "nullable|string",
            'bio' => "nullable|max:5000",
            'blocked' => "required|in:0,1",
            'email' => "required|unique:users,email," . $user->id,
            'password' => "nullable|min:8|max:190"
        ]);
        $user->update(["name" => $request->name,
            "phone" => $request->phone,
            "city_id" => $request->City,
            "power" => $request->power ?? 'USER',
            "role" => $request->role ?? '',
            "bio" => $request->bio,
            "blocked" => $request->blocked,
            "email" => $request->email,

        ]);
        // if ($request->blocked == 1) {
        $user->store ? $user->store()->update(['blocked' => $request->blocked]) : '';
        // }
        if ($request->password != null) {
            $user->update(["password" => Hash::make($request->password)
            ]);
        }
        if ($request->hasFile('avatar')) {
            $file = $this->store_file(['source' => $request->avatar,
                'validation' => "image",
                'path_to_save' => '/uploads/users/',
                'type' => 'USER',
                'user_id' => Auth::user()->id,
                'resize' => [500, 1000],
                'small_path' => 'small/',
                'visibility' => 'PUBLIC',
                'file_system_type' => env('FILESYSTEM_DRIVER'),
                'watermark' => true,
                'compress' => 'auto'
            ]);
            $user->update(['avatar' => $file['filename']]);
        }

        flash()->success('تم تحديث المستخدم بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        flash()->success('تم حذف المستخدم بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.users.index');
    }
}
