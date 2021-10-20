<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
     /**
     * All User
     */
    public function index() {
        // check ajax request by yjra datatable
        if( request() -> ajax() ){

            return datatables()->of(Book::latest()->get())->addColumn('action', function($data){
                $output = '<a title="Edit" edit_id="'.$data['id'].'" href="#" data-toggle="modal" class="btn btn-sm btn-info edit_book"><i class="fas fa-edit text-white"></i></a>
                <a title="Delete" delete_id="'.$data['id'].'" href="#" class="btn btn-sm btn-danger delete_book"><i class="fas fa-trash text-white"></i></a>';
                return $output;
            })->rawColumns(['action'])->make(true);

        }


        return view('backend.book.all-book');
    }

    /**
     * User add
     */
    public function bookAdd( Request $request ) {

        Book::create( [
            'user_id'  => Auth::id(),
            'name'     => $request->name,
            'slug'     => Str::slug($request->name),
        ] );

        return "Book added Successfully";

    }

    /**
     * Book Edit
     */
    public function bookEdit($id){
        $data = Book::findOrFail($id);
        return $data;
    }

    /**
     * Book update
     */
    public function bookUpdate( Request $request ) {
        $book = Book::findOrFail($request->id);

        $book->user_id = Auth::id();
        $book->name = $request->name;
        $book->update();

        return "Book update Successfully";
    }

    /**
     * Book delete
     */
    public function bookDelete($id){
        $book = Book::findOrFail($id);
        $book->delete();
        return "Book delete Successfully";
    }
}
