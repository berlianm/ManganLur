<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function registrasi()
    {
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'unique' => ':attribute sudah terdaftar',
            'same' => ':attribute tidak sama',
            'regex' => ':attribute harus menggunakan gmail.com'
        ];

        $this->validate(
            request(),
            [
                'nama' => 'required',
                'username' => 'required|min:5|max:12',
                'email' => [
                    'required',
                    'email',
                    'unique:users',
                    'regex:/@gmail\.com$/i'
                ],
                'role' => 'required',
                'password' => 'required|min:5|max:12',
                'password_confirmation' => 'required|same:password'
            ],
            $pesan
        );

        $user = User::create(
            [
                'name' => request('nama'),
                'username' => request('username'),
                'email' => request('email'),
                'role' => request('role'),
                'password' => bcrypt(request('password'))
            ]
        );

        return redirect('/login')->with('success', 'Berhasil Registrasi');
    }
}
