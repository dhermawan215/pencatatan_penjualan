<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        return \view('pages.admin_users.index');
    }

    public function userData(Request $request)
    {
        $requestall = $request->all();

        $columnsdb = [
            'id',
            'id',
            'name',
            'email',
        ];

        //datatable request
        $draw = $requestall['draw'];
        $offset = $requestall['start'] ? $requestall['start'] : 0;
        $limit = $requestall['length'] ? $requestall['length'] : 5;
        $search = $requestall['search']['value'];
        $direction =  $requestall['order'][0]['dir'];
        $orderBy = $columnsdb[$requestall['order'][0]['column']];

        $searchName = $requestall['columns'][2]['search']['value'];
        $searchEmail = $requestall['columns'][3]['search']['value'];

        $query = User::select('*');
        $query->where('roles', '=', 1);

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        if ($searchName) {
            $query->where('name', $searchName);
        }

        if ($searchEmail) {
            $query->where('email', $searchName);
        }

        $recordsFiltered = $query->count();
        $res_data = $query
            ->skip($offset)
            ->take($limit)
            ->orderBy($orderBy, $direction)
            ->get();
        $recordsTotal = $res_data->count();

        $data = [];
        $i = $offset + 1;

        if ($res_data->isEmpty()) {
            $data['cbox'] = '';
            $data['rnum'] = '';
            $data['name'] = "Data Kosong";
            $data['email'] = "Data Kosong";

            $arr[] = $data;
        } else {
            foreach ($res_data as $key => $value) {
                $data['cbox'] = '<div class="d-flex"><button type="button" class="btndel btn btn-sm btn-danger" id="btndeletes" data-id="' . $value->id . '">Delete</button><a href="' . \route('admin_user_update_pwd', base64_encode($value->id)) . '" class="text-primary me-2 ms-2" title="Update Password"><i class="fas fa-edit"></i></a ></div>';
                $data['rnum'] = $i;
                $data['name'] = $value->name;
                $data['email'] = $value->email;
                $arr[] = $data;
                $i++;
            }
        }
        return \response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
        ]);
    }

    public function register(Request $request)
    {
        $requestall = $request->all();
        $requestall['roles'] = 1;

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors()->all(), 403);
        }

        unset($requestall['_token']);

        $user = User::create([
            'name' => $requestall['name'],
            'email' => $requestall['email'],
            'password' => Hash::make($requestall['password']),
            'roles' => $requestall['roles']
        ]);

        if ($user) {
            return \response()->json(["success" => \true], 200);
        } else {
            return \response()->json(["success" => \false], 500);
        }
    }

    public function updatePassword($id)
    {
        $ids = \base64_decode($id);
        $user = User::findOrFail($ids);

        return \view('pages.admin_users.edit', ['data' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $requestall = $request->all();
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return \response()->json($validator->errors()->all(), 403);
        }

        unset($requestall['method']);
        unset($requestall['_token']);

        $update = $user->update([
            'password' => Hash::make($requestall['password'])
        ]);

        if ($update) {
            return \response()->json(["success" => \true], 200);
        } else {
            return \response()->json(["success" => \false], 500);
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $delete = $user->delete();

        if ($delete) {
            return \response()->json(["success" => \true], 200);
        } else {
            return \response()->json(["success" => \false], 500);
        }
    }
}
