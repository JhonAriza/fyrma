<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;
use Rootsoft\IPFS\Clients\IPFSClient;

class TestGcpStorage extends Component
{
    use WithFileUploads; 
    public $file;

    public function render()
    {
        return view('livewire.test-gcp-storage');
    }


    public function loadFile() {

        $ipfs = new IPFSClient('35.224.0.215', 80);
        
        // $client = new IPFSClient('127.0.0.1', 5001);
        $response = $ipfs->add(Storage::get('livewire-tmp/test.pdf'), 'test.png', ['pin' => true]);
        // $contents = $ipfs->pin($response['Hash']);
        // $contents = $client->cat('QmNZdYefySKuzF37CWjR8vZ319gYToS61r3v3sRwApXgaY');
        dd($response);
        // $fileHash = IPFS::add($collectible->get(), $fileName, ['only-hash' => true])['Hash'];


        dd($ipfs);
        
        // $this->validate([
        //     'file' => 'mimes:pdf', // 1MB Max
        // ]);
 
        // $disk = Storage::disk('gcs');
        // $disk->put('test1', $this->file);

        // dd($disk);
    }
}
