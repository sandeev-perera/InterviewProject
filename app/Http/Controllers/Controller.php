<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;



abstract class Controller
{
    protected function storeFile($file, $folder, $filePath): bool{
   if (!$file || !$filePath) {
        return false;
    } 
    $fileName = basename($filePath);

    // Store file 'storage/app/public/uploads/{folder}`
    $file->storeAs("uploads/{$folder}", $fileName, 'public');
    return true;
}

    protected function getfilepath($file, $folder){
        if(!$file){
            return null;
        }
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $filePath = "uploads/{$folder}/{$fileName}";
        return $filePath; 
    }

    protected function redirectWithSuccess($route, $successMessage){
        return redirect()->route($route)->with('success', $successMessage);
    }

    protected function redirectWithError($route, $errorMessage){
        return redirect()->route($route)->with('error', $errorMessage);
    }
}
