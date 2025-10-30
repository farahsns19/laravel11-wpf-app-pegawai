<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('email', 100);
            $table->string('nomor_telepon', 15);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->date('tanggal_masuk');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            //     // Tambahkan foreign key ke tabel master
            //     $table->unsignedBigInteger('departemen_id');
            //     $table->unsignedBigInteger('jabatan_id');

            $table->timestamps();

            //     $table->foreign('departemen_id')->references('id')->on('departments')->onDelete('cascade');
            //     $table->foreign('jabatan_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
