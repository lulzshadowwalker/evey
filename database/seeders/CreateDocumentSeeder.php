<?php

namespace Database\Seeders;

use App\Models\document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $docs = [
            [
                'title' => 'resume.pdf',
                'user_id' => '1',
                'path' => 'documents/sample-resume.pdf',
            ],      [
                'title' => 'resume.pdf',
                'user_id' => '2',
                'path' => 'documents/sample-resume.pdf',
            ],      [
                'title' => 'resume.pdf',
                'user_id' => '3',
                'path' => 'documents/sample-resume.pdf',
            ],      [
                'title' => 'resume.pdf',
                'user_id' => '4',
                'path' => 'documents/sample-resume.pdf',
            ],
        ];

        foreach ($docs as $key => $doc) {
            document::create($doc);
        }
    }
}
