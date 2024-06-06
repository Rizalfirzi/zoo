<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{ 
    public function aksesUserManagement($userId, $permissionName, $hakaksesName)
    {
        $roleUser = DB::table('role_has_user')->where('user_id', $userId)->first();
        $roleId = $roleUser->role_id;
        $aksesAllowed = auth()->user()->can($permissionName);
        $results = DB::table('hakakses_permission')
            ->join('permissions', 'hakakses_permission.permission_id', '=', 'permissions.id')
            ->join('hakakses', 'hakakses_permission.hakakses_id', '=', 'hakakses.id')
            ->select('permissions.name as permission_name', 'hakakses.name as hakakses_name')
            ->where('permissions.name', $aksesAllowed ? $permissionName : '')
            ->where('hakakses_permission.role_id', $roleId)
            ->get();
        if ($aksesAllowed && $results->contains('hakakses_name', $hakaksesName)) {
            return true;
        }
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $hakAksesIndex = $this->aksesUserManagement($user->id, 'User Management', 'read');
        $hakAksesCreate = $this->aksesUserManagement($user->id, 'User Management', 'create');
        $hakAksesUpdate = $this->aksesUserManagement($user->id, 'User Management', 'update');
        $hakAksesDelete = $this->aksesUserManagement($user->id, 'User Management', 'delete');

        if ($hakAksesIndex || $hakAksesCreate || $hakAksesUpdate || $hakAksesDelete )
        {

            if ($request->ajax()) {
                $data = DB::select("SELECT * from users WHERE name <> 'Super Admin'");
                $dataTable = DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('roles', function ($row) {
                        $btn = '';
                        $data = DB::select("SELECT b.name FROM role_has_user a
                            LEFT JOIN roles b ON a.role_id = b.id WHERE user_id = ?", [$row->id]);
                        foreach ($data as $val) {
                            $btn .= '<span class="badge badge-soft-primary">'. $val->name .'</span>';
                        }
                        return $btn;
                    });
                    $dataTable->addColumn('action', function ($row) {
                        $user = Auth::user();
                        $hakAksesUpdate = $this->aksesUserManagement($user->id, 'User Management', 'update');
                        $hakAksesDelete = $this->aksesUserManagement($user->id, 'User Management', 'delete');
                        $btn = '';
                        if ($hakAksesUpdate && $hakAksesDelete)
                        {
                            $btn = '<div class="d-flex">
                                <a href="' . route('settings.user.edit', [$row->id]) . '" title="Edit" class="btn btn-icon btn-primary btn-active-color-warning btn-sm me-1">
                                    <i class="ri-pencil-fill"></i>
                                </a>
                                <button type="submit" id="' . $row->id . '" title="Delete" class="delete btn btn-icon btn-danger btn-active-color-danger btn-sm">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>';
                        } elseif ($hakAksesUpdate) {
                                $btn = '<div class="justify-content-end">
                                <a href="' . route('settings.user.edit', [$row->id]) . '" title="Edit" class="btn btn-icon btn-primary btn-active-color-warning btn-sm me-1">
                                    <i class="ri-pencil-fill"></i>
                                </a>
                            </div>';
                        } elseif ($hakAksesDelete) {
                                $btn = '<div class="justify-content-end">
                                <button type="submit" id="' . $row->id . '" title="Delete" class="delete btn btn-icon btn-danger btn-active-color-danger btn-sm">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>';
                        }
                        return $btn;
                    });
                return $dataTable->rawColumns(['action', 'roles'])->make(true);
            }
            return view('user_management.user.index', compact('hakAksesIndex','hakAksesCreate','hakAksesUpdate','hakAksesDelete'));
        } else {
           return abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }


    public function create()
    {
        $user = Auth::user();
        $hakAksesCreate = $this->aksesUserManagement($user->id, 'User Management', 'create');

        if (!$hakAksesCreate) {
            return abort(403, 'Anda tidak memiliki izin');
        }
        return view('user_management.user.form',[
            'data' => new User(),
            'roles' => DB::select("SELECT * from roles WHERE name <> 'Super Admin'"),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $hakAksesCreate = $this->aksesUserManagement($user->id, 'User Management', 'create');

        if (!$hakAksesCreate) {
            return abort(403, 'Anda tidak memiliki izin');
        }

        $rules = [
            'name' => ['required', 'string', 'unique:users'],
            'description' => ['nullable', 'string'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required'],
            'role' => ['required'],
        ];

        $text = [
            'name.required' => 'Kolom nama tidak boleh kosong',
            'name.unique' => 'Kolom nama sudah ada',
            'email.email' => 'Format email tidak valid',
            'email.required' => 'Kolom email tidak boleh kosong',
            'email.unique' => 'Kolom email sudah ada',
            'password.required' => 'Kolom password tidak boleh kosong',
            'role.required' => 'Kolom role tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        DB::beginTransaction();
        try {
            $name = $request->input('name');
            $password = $request->input('password');
            $confirm_password = $request->input('confirm_password');
            $email = $request->input('email');
            $role = $request->input('role');
            if ($password !== $confirm_password) {
                return response()->json(['success' => 0, 'text' => 'Password tidak cocok'], 422);
            }

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->email_verified_at = now();
            $user->save();
            $user->assignRole([$role]);

            DB::commit();
            $status = 'success';
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            $status = $errorMessage;
        }

        return response()->json(['text' => $status], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $hakAksesEdit = $this->aksesUserManagement($user->id, 'User Management', 'update');

        if (!$hakAksesEdit) {
            return abort(403, 'Anda tidak memiliki izin');
        }
        $roles = DB::select("SELECT roles.name FROM roles WHERE name <> 'Super Admin'");
        $data = User::findOrFail($id);
        return view('user_management.user.form',[
            'data' => $data,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $hakAksesUpdate = $this->aksesUserManagement($user->id, 'User Management', 'update');

        if (!$hakAksesUpdate) {
            return abort(403, 'Anda tidak memiliki izin');
        }
        $id = $request->input('id');
        $user_management = User::findOrFail($id);

        $rules = [
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required'],
        ];
        
        if ($request->name != $user_management->name) {
            $rules['name'][] = 'unique:users';
        }
        if ($request->email != $user_management->email) {
            $rules['email'][] = 'unique:users';
        }
        

        $text = [
            'name.required' => 'Kolom nama tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'email.required' => 'Kolom email tidak boleh kosong',
            'password.required' => 'Kolom password tidak boleh kosong',
            'role.required' => 'Kolom role tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        DB::beginTransaction();
        try {
            
            $name = $request->input('name');
            $password = $request->input('password');
            $confirm_password = $request->input('confirm_password');
            $email = $request->input('email');
            $role = $request->input('role');
            if ($password !== $confirm_password) {
                return response()->json(['success' => 0, 'text' => 'Password tidak cocok'], 422);
            }

            
            $user_management->name = $name;
            $user_management->email = $email;
            $user_management->password = $password;
            $user_management->email_verified_at = now();
            $user_management->update();
            $user_management->syncRoles([$role]);

            DB::commit();
            $status = 'success';
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            $status = $errorMessage;
        }

        return response()->json(['text' => $status], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $hakAksesDelete = $this->aksesUserManagement($user->id, 'User Management', 'delete');

        if (!$hakAksesDelete) {
            return abort(403, 'Anda tidak memiliki izin');
        }
        $id = $request->id;

        $user = User::findOrFail($id);
        if (!$user) {
            return response()->json(['text' => 'Data tidak ditemukan'], 404);
        }
        $simpan = $user->delete();
        $user->syncRoles([]);
        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Dihapus'], 400);
        }
    }
}
