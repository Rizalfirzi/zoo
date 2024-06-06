<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

use function PHPSTORM_META\type;

class PermissionController extends Controller
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
        $hakAksesIndex = $this->aksesUserManagement($user->id, 'Menu Management', 'read');
        $hakAksesCreate = $this->aksesUserManagement($user->id, 'Menu Management', 'create');
        $hakAksesUpdate = $this->aksesUserManagement($user->id, 'Menu Management', 'update');
        $hakAksesDelete = $this->aksesUserManagement($user->id, 'Menu Management', 'delete');

        if ($hakAksesIndex || $hakAksesCreate || $hakAksesUpdate || $hakAksesDelete )
        {

            if ($request->ajax()) {
                $data = Permission::orderBy('group', 'ASC')
                ->get();
                $dataTable = DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $user = Auth::user();
                        $hakAksesUpdate = $this->aksesUserManagement($user->id, 'Menu Management', 'update');
                        $hakAksesDelete = $this->aksesUserManagement($user->id, 'Menu Management', 'delete');
                        $btn = '';
                        if ($hakAksesUpdate && $hakAksesDelete)
                        {
                            $btn = '<div class="justify-content-end">
                                <button type="submit" id="' . $row->id . '" title="Delete" class="delete btn btn-icon btn-danger btn-active-color-danger btn-sm">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>';
                            $btn = '<div class="d-flex">
                                <a href="' . route('settings.permission.edit', [$row->id]) . '" title="Edit" class="btn btn-icon btn-primary btn-active-color-warning btn-sm me-1">
                                    <i class="ri-pencil-fill"></i>
                                </a>
                            </div>';
                            // <button type="submit" id="' . $row->id . '" title="Delete" class="delete btn btn-icon btn-danger btn-active-color-danger btn-sm">
                            //         <i class="ri-delete-bin-line"></i>
                            //     </button>
                        } elseif ($hakAksesUpdate) {
                                $btn = '<div class="justify-content-end">
                                <a href="' . route('settings.permission.edit', [$row->id]) . '" title="Edit" class="btn btn-icon btn-primary btn-active-color-warning btn-sm me-1">
                                    <i class="ri-pencil-fill"></i>
                                </a>
                            </div>';
                        } 
                        // elseif ($hakAksesDelete) {
                        //         $btn = '<div class="justify-content-end">
                        //         <button type="submit" id="' . $row->id . '" title="Delete" class="delete btn btn-icon btn-danger btn-active-color-danger btn-sm">
                        //             <i class="ri-delete-bin-line"></i>
                        //         </button>
                        //     </div>';
                        // }
                        return $btn;
                    });
                return $dataTable->rawColumns(['action'])->make(true);
            }
            return view('user_management.menu.index', compact('hakAksesIndex','hakAksesCreate','hakAksesUpdate','hakAksesDelete'));
        } else {
           return abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    } 

    public function create()
    {
        $user = Auth::user();
        $hakAksesCreate = $this->aksesUserManagement($user->id, 'Menu Management', 'create');

        if (!$hakAksesCreate) {
            return abort(403, 'Anda tidak memiliki izin');
        } 

        return view('user_management.menu.form',[
            'data' => new Permission(),
            'roles' => Role::whereNot('name', 'Super Admin')->get(),
            'groups' => Permission::where('type', 'dropdown')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $hakAksesCreate = $this->aksesUserManagement($user->id, 'Menu Management', 'create');

        if (!$hakAksesCreate) {
            return abort(403, 'Anda tidak memiliki izin');
        } 

        $rules = [
            'name' => ['required', 'string', 'unique:permissions'],
            'guard_name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'route' => ['unique:permissions'],
            'level' => ['required'],
            'position' => ['required'],
            'roles' => ['required'],
        ];
        
        $validasi = Validator::make($request->all(), $rules);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }
        try {
            $permission = new Permission();
            $superadmin = Role::where('name', 'Super Admin')->first();
            $level = intval($request->level);
            $permission->name = $request->name;
            $permission->route = $request->route ? $request->route : 'default';
            $permission->guard_name = 'web';
            $permission->icon = $request->icon;
            $permission->level = $level;
            $permission->position = $request->position;
            if($level == 2){
                $permission->group = $request->menu_group_id;
            }
            $permission->type = $request->type;
            $permission->description = $request->description;
            $permission->assignRole($superadmin);
            if (!blank($request->roles)) {
                $permission->assignRole($request->roles);
            }
            $permission->save();

            $hakaksesIds = DB::table('hakakses')->pluck('id');
            $permissions = Permission::where('name', $permission->name)->get();
            foreach ($permissions as $permission_pimpinan) {
                // $request->roles->givePermissionTo($permission_pimpinan->name);
                foreach ($hakaksesIds as $hakaksesId) {
                    DB::table('hakakses_permission')->insert([
                        'permission_id' => $permission_pimpinan->id,
                        'hakakses_id' => $hakaksesId,
                        'role_id' => $superadmin->id,
                    ]);
                }
            }

            if($level == 1){
                $permission->group = $permission->id;
            }
            $save = $permission->save();
            
            if($save){
                return response()->json(['text' => 'Success'], 200);
            }else{
                return response()->json(['text' => 'Failed'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['text' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user_management.menu.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $hakAksesUpdate = $this->aksesUserManagement($user->id, 'Menu Management', 'update');

        if (!$hakAksesUpdate) {
            return abort(403, 'Anda tidak memiliki izin');
        } 

        $data = Permission::findOrFail($id);
        return view('user_management.menu.form',[
            'data' => $data,
            'roles' => Role::whereNot('name', 'Super Admin')->get(),
            'groups' => Permission::where('type', 'dropdown')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $permission = Permission::findOrFail($id);
        $user = Auth::user();
        $hakAksesUpdate = $this->aksesUserManagement($user->id, 'Menu Management', 'update');

        if (!$hakAksesUpdate) {
            return abort(403, 'Anda tidak memiliki izin');
        } 
        $rules = [
            'name' => ['required', 'string'],
            'guard_name' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'level' => ['required'],
            'position' => ['required'],
            'roles' => ['required'],
        ];

        if ($request->name != $permission->name) {
            $rules['name'][] = 'unique:users';
        }

        $validasi = Validator::make($request->all(), $rules);

        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }
        try {
            $superadmin = Role::where('name', 'Super Admin')->first();
            if ($permission) {

                $level = intval($request->level);
                $permission->name = $request->name;
                $permission->route = $request->route ? $request->route : 'default';
                $permission->guard_name = 'web';
                $permission->icon = $request->icon;
                $permission->position = $request->position;
                $permission->level = $level;
                if($level == 2){
                    $permission->group = $request->menu_group_id;
                }
                $permission->type = $request->type;
                $permission->description = $request->description;
                
                if (!blank($request->roles)) {
                    $permission->syncRoles($request->roles);
                }
                
                $permission->assignRole([$superadmin]);
                $permission->save();
                
                if($level == 1){
                    $permission->group = $permission->id;
                }
                $save = $permission->save();
                if($save){
                    return response()->json(['text' => 'Success'], 200);
                }else{
                    return response()->json(['text' => 'Failed'], 200);
                }
            }
            return response()->json(['text' => 'Data Berhasil Disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['text' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $hakAksesDelete = $this->aksesUserManagement($user->id, 'Menu Management', 'delete');

        if (!$hakAksesDelete) {
            return abort(403, 'Anda tidak memiliki izin');
        } 

        $id = $request->id;
        $permission = Permission::findOrFail($id);
        if (!$permission) {
            return response()->json(['text' => 'Data tidak ditemukan'], 404);
        }
        if ($permission->delete()) {
            return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Dihapus'], 400);
        }

    }
}
