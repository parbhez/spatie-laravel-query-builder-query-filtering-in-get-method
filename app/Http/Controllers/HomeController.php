<?php

namespace App\Http\Controllers;

use FilterData;
use App\Models\Guardian;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use DB;

class HomeController extends Controller
{
    public $data = [];

    public function show_content()
    {
        $users = DB::table('users')->get();
        $guardians = Guardian::leftJoin('users','users.id','=','guardians.user_id')
        ->get(['guardians.*','users.username']);

        return view('show-content',compact('guardians','users'));
    }

    public function show_filter_data(Request $request)
    {
        $data = $_GET;

        $users = DB::table('users')->get();

        $guardians = QueryBuilder::for(Guardian::class)
                    ->leftJoin('users','users.id','=','guardians.user_id')
                    ->allowedFilters(['name','email',AllowedFilter::exact('user_id')])
                    ->defaultSort('name')
                    ->allowedFields(['guardians.*','users.username'])
                    ->get();

           //return $guardians;

           return view('show-content',compact('guardians','users','data'));

    }

    public function name_auto_suggestion(Request $request)
    {
        if($request->get('name'))
        {
            $query = $request->get('name');
            $data = DB::table('guardians')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:absolute;z-index:1;">';
            foreach($data as $row)
            {
            $output .= '
            <li id="li_name"><a href="#">'.$row->name.'</a></li>
            ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function email_auto_suggestion(Request $request)
    {
        if($request->get('email'))
        {
            $query = $request->get('email');
            $data = DB::table('guardians')
            ->where('email', 'LIKE', "%{$query}%")
            ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:absolute;z-index:1;">';
            foreach($data as $row)
            {
            $output .= '
            <li id="li_email"><a href="#">'.$row->email.'</a></li>
            ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }


    public function index(){

        return view('test');
    }

    // GET = /users?filter[name]=john&filter[email]=gmail
   // http://127.0.0.1:8000/search?_token=K1HxLpepCTjBdc9a4sVsrI6owF5SJHKfOZRWrs7T
   //http://127.0.0.1:8000/search?name=Masud+Parbhez&email=amorchakma%40adventist.org.bd

    public function search(Request $request)
    {
          $users = QueryBuilder::for(Guardian::class)
                    ->allowedFilters(['name', 'email'])
                    ->get();

           echo view('show',compact('users'));

    }



}
