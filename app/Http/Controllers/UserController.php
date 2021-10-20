<?php

namespace App\Http\Controllers;

use datatables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller {
    /**
     * All User
     */
    public function index() {
        // check ajax request by yjra datatable
        if( request() -> ajax() ){

            return datatables()->of(User::latest()->get())->addColumn('action', function($data){
                $output = '<a title="Edit" edit_id="'.$data['id'].'" href="#" data-toggle="modal" class="btn btn-sm btn-info edit_user"><i class="fas fa-edit text-white"></i></a>
                <a title="Delete" delete_id="'.$data['id'].'" href="#" class="btn btn-sm btn-danger delete_user"><i class="fas fa-trash text-white"></i></a>';
                return $output;
            })->rawColumns(['action'])->make(true);

        }


        return view('backend.admin.all-user');
    }

    /**
     * User add
     */
    public function userAdd( Request $request ) {

        User::create( [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ] );

        return "User added Successfully";

    }

    /**
     * User Edit
     */
    public function userEdit($id){
        $data = User::findOrFail($id);
        return $data;
    }

    /**
     * User update
     */
    public function userUpdate( Request $request ) {
        $user = User::findOrFail($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();

        return "User update Successfully";
    }

    /**
     * User delete
     */
    public function userDelete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return "User delete Successfully";
    }
}
