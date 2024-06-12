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
            CREATE FUNCTION ketKategori(kat VARCHAR(4))
            RETURNS varchar(30)
            BEGIN
                IF kat = "M" THEN
                    RETURN "Modal Barang";
                ELSEIF kat = "A" THEN
                    RETURN "Alat";
                ELSEIF kat = "BHP" THEN
                    RETURN "Bahan Habis Pakai";
                ELSEIF kat = "BTHP" THEN
                    RETURN "Bahan Tidak Habis Pakai";
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS ketKategori');
    }
};
