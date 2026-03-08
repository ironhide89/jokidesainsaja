<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage; // Tambahkan di bagian atas file

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
        // Mengambil portofolio milik user yang login
        // $portfolios = Auth::user()->portfolios()->latest()->get();
        
        return view('user.portofolios');
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

}