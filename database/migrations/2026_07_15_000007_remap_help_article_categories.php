<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $map = [
            'pengaturan' => 'website',
            'konten' => 'halaman',
            'download' => 'unduhan',
        ];

        foreach ($map as $from => $to) {
            DB::table('help_articles')->where('category', $from)->update(['category' => $to]);
        }
    }

    public function down(): void
    {
        $map = [
            'website' => 'pengaturan',
            'halaman' => 'konten',
            'unduhan' => 'download',
        ];

        foreach ($map as $from => $to) {
            DB::table('help_articles')->where('category', $from)->update(['category' => $to]);
        }
    }
};
