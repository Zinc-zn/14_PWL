<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        return 'Halamann daftar foto';
    }

    public function create()
    {
        return 'Halamann form tambah foto';
    }

    public function store(Request $request)
    {
        return 'Proses simpan foto baru';
    }

    public function show(string $id)
    {
        return 'Menampilkan foto dengan id '. $id;
    }

    public function edit(string $id)
    {
        return 'Halaman form edit foto dengan id '.$id;
    }

    public function update(Request $request, string $id)
    {
        return 'Proses update foto dengan id '.$id;
    }

    public function destroy(string $id)
    {
        return 'Proses hapus foto dengan id '.$id;
    }
}
