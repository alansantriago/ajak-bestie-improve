<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserAkunModel;
use App\Models\HakAksesModel;
use Illuminate\Foundation\Auth\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserAkunController extends Controller
{
    public function changeStatus(Request $request)
    {
        try {
            $user = UserAkunModel::find($request->id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $user->status = $request->status;
            $user->save();

            return response()->json(['success' => 'Status Changed Successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to change status: ' . $e->getMessage()], 500);
        }
    }

    public function changeAllStatus()
    {
        try {
            // Menghitung jumlah akun yang aktif
            $userAktif = UserAkunModel::where('role', 'user')->where('status', 1)->count();

            // Jika tidak ada akun yang aktif, aktifkan semua akun
            if ($userAktif == 0) {
                UserAkunModel::where('role', 'user')->update(['status' => '1']);
                return redirect()->back()->with('success', 'Berhasil Mengaktifkan seluruh akun OPD');
            } else {
                // Menonaktifkan semua akun yang aktif
                UserAkunModel::where('role', 'user')->update(['status' => '0']);
                return redirect()->back()->with('success', 'Berhasil menutup seluruh akun OPD');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to change status: ' . $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $userAktif = UserAkunModel::where('role', 'user')->where('status', 1)->count();
        if (auth()->user()->role == "admin") {
            $akun = UserAkunModel::filter(request(['search']))->Where('role', 'user')->orderBy('name', 'ASC')->paginate(25)->withQueryString();
        } elseif (auth()->user()->role == "superadmin") {
            $akun = UserAkunModel::filter(request(['search']))->orderBy('name', 'ASC')->paginate(25)->withQueryString();
        }
        $data = [
            'akun' =>  $akun,
            'active' => 'user',
            'statusAktif' => $userAktif
        ];

        // dd($data);
        return view('admin.user.index', $data);
    }
    public function delete($id)
    {
        $akun = UserAkunModel::Where('id', $id)->first();

        try {
            if ($akun->role == "user") {
                HakAksesModel::find($id)->delete();
            }
            UserAkunModel::find($id)->delete();

            return redirect()->back()->withSuccess('Account has been deleted!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Failed to delete account because data still used!');
        }
    }
    public function create()
    {
        $data = [
            'active' => 'user',
        ];
        return view('admin.user.tambah', $data);
    }
    public function insert(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);
        if ($request->role == 'user') {
            $request->validate([
                'hak_akses' => 'required',
            ], [
                'hak_akses.required' => 'Hak Akses Harus di isi untuk user',
            ]);
        }
        try {
            $id = UserAkunModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(),
                'created_at' => now(),
            ])->id;
            if ($request->role == 'user') {
                HakAksesModel::create([
                    'user_id' => $id,
                    'dinas_id' => $request->hak_akses,
                    'created_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Data Berhasil Tambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Failed to insert because data still wrong!');
        }
    }
    public function update(Request $request, $id)
    {
        $akun = UserAkunModel::Where('id', $id)->first();
        if ($request->email != $akun->email) {
            $validateData = $request->validate([
                'email' => 'required|email|unique:users',
            ]);
        }
        $validateData = $request->validate([
            'name' => 'required',
            'role' => 'required',
        ]);

        if ($request->role == 'user') {
            $request->validate([
                'hak_akses' => 'required',
            ], [
                'hak_akses.required' => 'Hak Akses Harus di isi untuk user',
            ]);
        }
        try {

            if ($request->password != '') {
                UserAkunModel::where('id', $id)->update([
                    'name' => $request->name,
                    'role' => $request->role,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'updated_at' => now(),
                ]);
                if (($request->role == 'user') && ($akun->role == 'user')) {
                    HakAksesModel::where('user_id', $id)->update([
                        'dinas_id' => $request->hak_akses,
                        'updated_at' => now(),
                    ]);
                } elseif (($akun->role == 'user') && (($request->role == 'admin') || ($request->role == 'superadmin'))) {
                    HakAksesModel::find($id)->delete();
                } elseif ((($akun->role == 'admin') || ($akun->role == 'superadmin')) && ($request->role == 'user')) {
                    HakAksesModel::create([
                        'user_id' => $id,
                        'dinas_id' => $request->hak_akses,
                        'created_at' => now(),
                    ]);
                };
            } else {
                UserAkunModel::where('id', $id)->update([
                    'name' => $request->name,
                    'role' => $request->role,
                    'email' => $request->email,
                    'updated_at' => now(),
                ]);
                if (($request->role == 'user') && ($akun->role == 'user')) {
                    HakAksesModel::where('user_id', $id)->update([
                        'dinas_id' => $request->hak_akses,
                        'updated_at' => now(),
                    ]);
                } elseif (($akun->role == 'user') && (($request->role == 'admin') || ($request->role == 'superadmin'))) {
                    HakAksesModel::find($id)->delete();
                } elseif ((($akun->role == 'admin') || ($akun->role == 'superadmin')) && ($request->role == 'user')) {
                    HakAksesModel::create([
                        'user_id' => $id,
                        'dinas_id' => $request->hak_akses,
                        'created_at' => now(),
                    ]);
                };
            };
            return redirect()->back()->withSuccess('User account has been updated!');
        } catch (Exception $e) {
            return redirect()->back()->with('Errors', 'Gagal terrdapat kesalahan sistem');
        }
    }
}
