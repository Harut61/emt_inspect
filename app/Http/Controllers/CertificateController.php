<?php

namespace App\Http\Controllers;

use App\Rules\CrtFile;
use App\Rules\KeyFile;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public $path = 'cert';
    
    public $hostFile = '/etc/httpd/conf.d/emt-inspect.conf';
    
    public function index() 
    {
        return view('certificate');
    }
    
    public function upload(Request $request) 
    {
        $request->validate([
            'crt' => ['required', new CrtFile],
            'key' => ['required', new KeyFile],
        ]);
        
        $crtPath = $request->file('crt')->storeAs($this->path, $request->file('crt')->getClientOriginalName());
        $keyPath = $request->file('key')->storeAs($this->path, $request->file('key')->getClientOriginalName());
        
        exec('sed -i "4i\    SSLCertificateFile ' . storage_path('app/' . $crtPath) . '" "' . $this->hostFile . '"');
        exec('sed -i "5d" "' . $this->hostFile . '"');
        
        exec('sed -i "5i\    SSLCertificateKeyFile ' . storage_path('app/' . $keyPath) . '" "' . $this->hostFile . '"');
        exec('sed -i "6d" "' . $this->hostFile . '"');
        
        $request->session()->flash('status', 'Certificate files have been uploaded successfully');
        
        return redirect(route('certificate'));
    }
}
