<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DbFillSeeder extends Seeder
{
    public function run(): void
    { // Caminho para o arquivo SQL
        //$sqlFile = storage_path('app/public/sql_dump.sql');
        $sqlFile = storage_path('app/public/articles_dump.sql');

        // Lê o conteúdo do arquivo
        $sql = File::get($sqlFile);

        // Executa no banco (sem prepared statements)
        DB::unprepared($sql);
    }
}
