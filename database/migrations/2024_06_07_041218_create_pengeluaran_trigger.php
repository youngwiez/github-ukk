<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER pengeluaran_stokminus
        AFTER INSERT ON pengeluaran
        FOR EACH ROW
        BEGIN
            UPDATE barang
            SET barang.stok = barang.stok - NEW.qty_keluar
            WHERE barang.id=NEW.barang_id; 
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS pengeluaran_stokminus');
    }
};
