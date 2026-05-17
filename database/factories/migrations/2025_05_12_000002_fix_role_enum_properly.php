<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Ubah enum column menjadi varchar terlebih dahulu
        DB::statement("ALTER TABLE users MODIFY role VARCHAR(50)");
        
        // Step 2: Update semua empty/invalid role menjadi 'santri'
        DB::statement("UPDATE users SET role = 'santri' WHERE role = '' OR role = 'mahasiswa'");
        
        // Step 3: Ubah kembali ke enum dengan nilai yang valid
        DB::statement("ALTER TABLE users MODIFY role ENUM('santri', 'staf') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY role VARCHAR(50)");
        DB::statement("UPDATE users SET role = 'mahasiswa' WHERE role = 'santri'");
        DB::statement("ALTER TABLE users MODIFY role ENUM('mahasiswa', 'staf') NOT NULL");
    }
};
