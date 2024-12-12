<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = [];
        $orangtuaIds = []; // Array baru untuk menyimpan ID dari tabel orangtuas

        $userIds['admin'] = DB::table('users')->insertGetId([
            'name' => 'Administrator',
            'username' => 'admin_user',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'userType' => 'admin',
            'password' => Hash::make('adminPassword123'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userIds['guru'] = [];
        $guruNames = ['Budi Suryono', 'Siti Aisyah', 'Rudi Hartono'];

        foreach ($guruNames as $guruName) {
            $userIds['guru'][] = DB::table('users')->insertGetId([
                'name' => $guruName,
                'username' => strtolower(str_replace(' ', '_', $guruName)),
                'email' => strtolower(str_replace(' ', '_', $guruName)) . '@school.com',
                'email_verified_at' => now(),
                'userType' => 'guru',
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $userIds['ortu'] = [];
        $ortuNames = ['Siti Rahmawati', 'Ali Farhan', 'Dewi Lestari'];

        foreach ($ortuNames as $index => $ortuName) {
            $userIds['ortu'][] = DB::table('users')->insertGetId([
                'name' => $ortuName,
                'username' => strtolower(str_replace(' ', '_', $ortuName)),
                'email' => strtolower(str_replace(' ', '_', $ortuName)) . '@example.com',
                'email_verified_at' => now(),
                'userType' => 'ortu',
                'password' => Hash::make('ortuPassword123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach ($userIds['guru'] as $index => $guruId) {
            DB::table('gurus')->insert([
                [
                    'name' => $guruNames[$index],
                    'user_id' => $guruId,
                    'NIP' => 'G' . str_pad($guruId, 10, '0', STR_PAD_LEFT),
                    'email' => strtolower(str_replace(' ', '_', $guruNames[$index])) . '@school.com',
                    'alamat' => 'Jalan Guru No. ' . ($index + 1),
                    'no_telp' => '08123456789' . $index,
                    'role' => $index % 2 === 0 ? 'bk' : 'walikelas',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        // Seeder untuk orangtua dan menyimpan ID-nya
        foreach ($userIds['ortu'] as $index => $ortuId) {
            $orangtuaIds[] = DB::table('orangtuas')->insertGetId([
                'name' => $ortuNames[$index],
                'user_id' => $ortuId,
                'NIK' => 'NIK' . str_pad($ortuId, 16, '0', STR_PAD_LEFT),
                'email' => strtolower(str_replace(' ', '_', $ortuNames[$index])) . '@example.com',
                'alamat' => 'Jalan Ortu No. ' . ($index + 1),
                'no_telp' => '08234567890' . $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('data_sekolahs')->insert([
            [
                'nama_sekolah' => 'Sekolah Dasar 1',
                'NPSN' => '12345678',
                'alamat' => 'Jalan Sekolah No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('tahun_ajarans')->insert([
            [
                'tahun_ajaran' => '2023/2024',
                'semester' => 'Ganjil',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('kelas')->insert([
            [
                'nama_kelas' => '6A',
                'jurusan' => 'IPA',
                'tahun_ajaran' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $siswaNames = ['Andi Setiawan', 'Beni Kusuma', 'Citra Dewi'];
        foreach ($siswaNames as $index => $siswaName) {
            DB::table('siswas')->insert([
                [
                    'user_id' => DB::table('users')->insertGetId([
                        'name' => $siswaName,
                        'username' => strtolower(str_replace(' ', '_', $siswaName)),
                        'email' => strtolower(str_replace(' ', '_', $siswaName)) . '@student.com',
                        'email_verified_at' => now(),
                        'userType' => 'siswa',
                        'password' => Hash::make('siswaPassword123'),
                        'remember_token' => Str::random(10),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]),
                    'nama' => $siswaName,
                    'NISN' => 'NISN' . str_pad($index + 1, 10, '0', STR_PAD_LEFT),
                    'kelas_id' => 1,
                    'email' => strtolower(str_replace(' ', '_', $siswaName)) . '@student.com',
                    'alamat' => 'Alamat ' . $siswaName,
                    'no_telp' => '0812345678' . $index,
                    'orangtua_id' => $orangtuaIds[0], // Menggunakan ID dari tabel orangtuas
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        DB::table('wali_kelas')->insert([
            [
                'user_id' => $userIds['guru'][0],
                'guru_id' => 1,
                'kelas_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('prestasis')->insert([
            [
                'siswa_id' => 1,
                'nama_prestasi' => 'Juara 1 Lomba Sains',
                'lv_prestasi' => 'Provinsi',
                'tanggal_prestasi' => now(),
                'keterangan' => 'Lomba Sains Tingkat Provinsi',
                'input_data' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('pelanggarans')->insert([
            [
                'siswa_id' => 1,
                'pelanggaran' => 'Terlambat Masuk Kelas',
                'point' => 1,
                'tanggal_melanggar' => now(),
                'kategori' => 'Disiplin',
                'input_data' => 'Guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
