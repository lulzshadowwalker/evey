<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;

class DocumentsController extends Controller
{
    public static function add(User $user, string $title, string $path)
    {
        $doc = new Document();
        $doc->path = $path;
        $doc->title = $title;

        $user->documents()->save($doc);
    }
}
