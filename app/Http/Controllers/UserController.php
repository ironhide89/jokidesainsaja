<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; 
use App\Models\Portofolio; 
use App\Models\PortofolioImage;
use App\Models\Profile;



class UserController extends Controller
{
    /**
     * Menampilkan Dashboard Profil User
     */
    public function dashboard()
    {
        // Eager Loading profile untuk performa lebih cepat
        $user = Auth::user()->load('profile');
        
        return view('user.dashboard', compact('user'));
        // return view('user.dashboard');
    }

    /**
     * Menampilkan Halaman Portofolio
     */
   public function portofolios_user()
    {
        // Mengambil semua portofolio milik user yang sedang login
        // Diurutkan dari yang terbaru (latest)
        $portfolios = Auth::user()->portfolios()->latest()->get();
        
        // Kirim data ke view user/portofolios.blade.php
        return view('user.portofolios', compact('portfolios'));
    }

    /**
     * Update Data Profile Utama (Tentang Saya, Jabatan, Lokasi, Phone)
     */
    public function update_profile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'job_title' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
        ]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'job_title'    => $request->job_title,
                'about'        => $request->about,
                'phone'        => $request->phone,
                'location'     => $request->location,
                'is_published' => $request->has('is_published') ? true : false,
            ]
        );

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update Keahlian (Skills) - Mengolah String menjadi Array JSON
     */
    public function update_skills(Request $request)
    {
        $user = Auth::user();

        // Validasi: Input skills berupa teks dipisah koma (contoh: Laravel, PHP, MySQL)
        $request->validate([
            'skills' => 'required|string',
        ]);

        // Mengubah string menjadi array dan membersihkan spasi kosong
        $skillsArray = array_map('trim', explode(',', $request->skills));

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            ['skills' => $skillsArray]
        );

        return redirect()->back()->with('success', 'Daftar keahlian berhasil diperbarui!');
    }

    /**
     * Menambah Pengalaman Kerja/Pendidikan ke dalam Array JSON
     */
    public function add_experience(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'year'  => 'required|string',
            'pos'   => 'required|string',
            'place' => 'required|string',
        ]);

        // Ambil data lama, jika kosong buat array baru
        $existingExp = $user->profile->experience ?? [];

        // Masukkan data baru ke dalam array
        $existingExp[] = [
            'year'  => $request->year,
            'pos'   => $request->pos,
            'place' => $request->place,
        ];

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            ['experience' => $existingExp]
        );

        return redirect()->back()->with('success', 'Pengalaman berhasil ditambahkan!');
    }

    public function delete_experience($index)
{
    $user = Auth::user();
    $profile = $user->profile;

    if ($profile && $profile->experience) {
        $experience = $profile->experience;

        // Cek apakah index tersebut ada di dalam array
        if (isset($experience[$index])) {
            unset($experience[$index]);
            
            // Re-index array agar tidak ada kunci yang hilang (0, 1, 2...)
            $experience = array_values($experience);

            $profile->update([
                'experience' => $experience
            ]);

            return redirect()->back()->with('success', 'Pengalaman berhasil dihapus!');
        }
    }

    return redirect()->back()->with('error', 'Gagal menghapus data.');
}
public function update_photo(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    $user = Auth::user();
    $profile = $user->profile;

    // 1. Simpan foto baru ke folder storage/app/public/profiles
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('profiles', $filename, 'public');

        // 2. Hapus foto lama jika ada (agar hemat storage)
        if ($profile && $profile->photo) {
            Storage::disk('public')->delete($profile->photo);
        }

        // 3. Update database
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            ['photo' => $path]
        );
    }

    return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
}

public function portofolio_store(Request $request)
{
    $request->validate([
        'images.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi tiap file
    ]);

    // 1. Simpan data utama portofolio
    $portfolio = Portofolio::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'slug' => Str::slug($request->title) . '-' . time(),
        'category' => $request->category,
        'subcategory' => $request->subcategory,
        'description' => $request->description,
    ]);

    // 2. Simpan banyak gambar jika ada
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $path = $file->store('portfolios', 'public');
            $portfolio->images()->create(['image_path' => $path]);
        }
    }

    return redirect()->back()->with('success', 'Karya berhasil dipublish dengan galeri foto!');
}

/**
 * Menghapus Portofolio
 */
public function portofolio_delete($id)
{
    $portfolio = Portofolio::with('images')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    foreach ($portfolio->images as $img) {
    Storage::disk('public')->delete($img->image_path);
    }

    $portfolio->delete(); // Data di tabel portfolio_images otomatis hapus karena onDelete('cascade')
    return redirect()->back()->with('success', 'Karya dan semua file gambarnya berhasil dihapus.');
}

public function portofolio_update(Request $request, $id)
{
    $portfolio = Portofolio::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string',
        'subcategory' => 'required|string',
        'description' => 'required|string',
        'project_url' => 'nullable|url',
        'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    $portfolio->update([
        'title' => $request->title,
        'category' => $request->category,
        'subcategory' => $request->subcategory,
        'description' => $request->description,
        'project_url' => $request->project_url,
    ]);

    // Jika ada unggahan gambar baru
    if ($request->hasFile('images')) {
        // 1. Hapus SEMUA file fisik gambar lama dari storage
        foreach ($portfolio->images as $oldImg) {
            Storage::disk('public')->delete($oldImg->image_path);
        }

        // 2. Hapus SEMUA data gambar lama dari database (tabel portfolio_images)
        $portfolio->images()->delete();

        // 3. Simpan gambar-gambar yang baru diunggah
        foreach ($request->file('images') as $file) {
            $path = $file->store('portfolios', 'public');
            $portfolio->images()->create([
                'image_path' => $path
            ]);
        }
    }

    return redirect()->back()->with('success', 'Karya berhasil diperbarui!');
}


}