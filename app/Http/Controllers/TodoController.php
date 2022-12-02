<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Http\Reuquest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function register()
    {
    return view('register');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('login');
    }

    public function create(){
        return view('create');
    }

    public function registerAccount(Request $request)   
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|:dns',
            'username' => 'required|min:4|max:8',
            'password' => 'required|min:4',
            'name' => 'required|min:3',

        ]);
        //input ke db
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/')->with('success', 'berhasil menambahkan akun! silahkan login');

    }

    public function auth(Request $request){
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ],[
            'username.exist' => 'username ini belum diisi',
            'username.required' => 'username harus diisi',
            'password.required' => 'password harus diisi',
        ]);
// 
        // dd($request->all());

        $user = $request->only('username', 'password');
        // dd(Auth::attempt($user));
        if (Auth::attempt($user)) {
            return redirect()->route('todo.io')->with('deleted', 'Berhasil Login');

        }else {
            return redirect()->back()->with('error', 'Gagal login, silahkan cek dan coba lagi!');
        }
    }



    public function home()
    {
        // ambil data dari table todos dengan model Todo
        // all() fungsinya untuk mengambil semuda di table
        // where fungsinya filter data di database (coloum, perbandingan, value)
        $todos = Todo::where('user_id', '=', Auth::user()->id)->get();
        // kirim data yang sudah diambil ke file blade / ke file yang menampilkan halaman
        // kirim melalui compact()
        // isi compact sesuaikan dengan nama
        return view('todo', compact('todos'));
    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
            $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5',
        ],[
            'title.required' => 'tittle ini harus diisi',
            'date.required' => 'tanggal harus diisi',
            'description.required' => 'deskripsi ini harus diisix'
        ]
    );

        // mengirim data ke database table todos dengan model Todo 
        // ''  = nama column di table db
        // $request-> = value attribute name pada input
        // kenapa yang dikirim 5 data? karena table pada db todos membutuhkan 6 column input
        // salah satunya column 'done_time' yang tipenya nullable, karena nullable jadi ga perlu dikirim nilai
        // 'user_id' untuk memberi tahu data todo ini milik siapa, diambil melalui fitur Auth
        // 'status' tipenya boolean, 0 = belum dikerjakan, 1 = sudah dikerjakan (todonya)
        Todo::create([
            'title' =>$request->title,
            'date' =>$request->date,
            'description' =>$request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);

        //kalau berhasil diarahin ke halaman todo awal dengan pemberitahuan 
        return redirect()->route('todo.io')->with('deleted', 'berhasil menambahkan data Todo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan halaman input form edit 
        //mengabil data satu baris ketika coloum id pada baris tersebut sama
        $todo= Todo::find($id);
        //kirim data yang diambil ke file blade dengan compact 
        return view('edit', compact('todo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5',
        ]);

        Todo::where('id', $id)->update([
            'title' =>$request->title,
            'date' =>$request->date,
            'description' =>$request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/todo/')->with('deleted', "data todo berhasil diedit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghapus data di database 
        // fillter / cari data yang mau dihapus baru di jalankan perintah hapusnya 
        
        $todos=Todo::findOrFail($id);
        $todos->delete();
        return redirect ('/todo')->with('deleted', 'Berhasil Menghapus Data Todo!');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect ('/');
    }

    public function updateComplated(Todo $todo,$id)
    {
        Todo::where('id', '=', $id)->update([
            'status' => 1,
            'done_date' => \Carbon\Carbon::now(),
        ]);
        return redirect()->back()->with('done', 'Todo telah selesai dikerjakan!');
    }

    
}
