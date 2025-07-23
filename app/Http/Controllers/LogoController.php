<?php
// app/Http/Controllers/LogoController.php
namespace App\Http\Controllers;

use App\Models\FinalAnns;
use App\Models\FullAnns;
use App\Models\TbCoverimg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    public function index(Request $request)
{
    $logos = TbCoverimg::orderBy('created_at', 'asc')->paginate(6);
    $full_ann = FullAnns::first();
    $final = FinalAnns::first();
    return view('user.homepage', compact('logos','full_ann','final'));
}

}

