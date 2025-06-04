<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PolylinesModel;
use Illuminate\Support\Facades\File;

class PolylinesController extends Controller
{
    protected $polylines;

    public function __construct()
    {
        $this->polylines = new PolylinesModel();
    }

    public function index()
    {
        // Optional: Tampilkan semua polyline
    }

    public function create()
    {
        // Optional: Tampilkan form tambah polyline
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'name' => 'required|unique:polylines,name',
                'description' => 'required',
                'geom_polyline' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:4048',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polyline.required' => 'Location is required',
            ]
        );

        // Buat folder penyimpanan jika belum ada
        if (!is_dir('storage/images')) {
            mkdir('storage/images', 0777, true);
        }

        // Proses unggah gambar
        $name_image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . '_polyline.' . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        }

        // Simpan data
        $data = [
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        if (!$this->polylines->create($data)) {
            return redirect()->route('map')->with('error', 'Failed to add polyline');
        }

        return redirect()->route('map')->with('success', 'Polyline has been added');
    }

    public function show(string $id)
    {
        // Optional: Tampilkan detail polyline
    }

    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Polyline',
            'id' => $id,
        ];

        return view('edit_polyline', $data);
    }

    public function update(Request $request, string $id)
    {
        // Ambil data lama
        $polyline = $this->polylines->find($id);
        if (!$polyline) {
            return redirect()->route('map')->with('error', 'Polylines not found');
        }

        // Validasi input
        $request->validate(
            [
                'name' => 'required|unique:polylines,name,' . $id,
                'description' => 'required',
                'geom_polyline' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:51200',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polyline.required' => 'Geometry is required',
            ]
        );

        $imageDirectory = public_path('storage/images');
        $oldImage = $polyline->image;
        $nameImage = $oldImage; // Default: gunakan gambar lama

        // Proses gambar baru jika ada
        if ($request->hasFile('image')) {
            if (!File::exists($imageDirectory)) {
                File::makeDirectory($imageDirectory, 0777, true);
            }

            // Hapus gambar lama jika ada
            if ($oldImage && file_exists($imageDirectory . '/' . $oldImage)) {
                unlink($imageDirectory . '/' . $oldImage);
            }

            $image = $request->file('image');
            $nameImage = time() . '_polyline.' . strtolower($image->getClientOriginalExtension());
            $image->move($imageDirectory, $nameImage);
        }

        // Data untuk update
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'geom' => $request->geom_polyline,
            'image' => $nameImage,
        ];

        if (!$this->polylines->where('id', $id)->update($data)) {
            return redirect()->route('map')->with('error', 'Failed to update Polylines');
        }

        return redirect()->route('map')->with('success', 'Polylines has been updated');
    }

    public function destroy(string $id)
    {
        $polyline = $this->polylines->find($id);

        if (!$polyline) {
            return redirect()->route('map')->with('error', 'Polyline not found');
        }

        $imagefile = $polyline->image;

        if (!$this->polylines->destroy($id)) {
            return redirect()->route('map')->with('error', 'Failed to delete polyline');
        }

        // Hapus gambar jika ada
        if ($imagefile && file_exists('storage/images/' . $imagefile)) {
            unlink('storage/images/' . $imagefile);
        }

        return redirect()->route('map')->with('success', 'Polyline has been deleted');
    }
}
