<?php
namespace App\Library\Services;


use App\Models\Pastel;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class PastelService
{
    public function storePastelPhoto(Request $request): string
    {
        if (!$request->hasFile('photo')) {
            return 'pastel/pastel_default.jpg';
        }
        $photo = $request->file('photo');

        return $photo->storeAs('pastel', Uuid::uuid4() . '-' . $photo->getClientOriginalName());
    }

    public function deleteOldPhoto(Pastel $pastel): void
    {
        Storage::delete(storage_path('app/' . $pastel->photo));
    }
}
