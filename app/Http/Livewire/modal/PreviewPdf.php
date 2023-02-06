<?php

namespace App\Http\Livewire\modal;

use App\Http\Controllers\PdfController;
use App\Models\Templates;
use Livewire\Component;

class PreviewPdf extends Component {
    public $open = false;
    public $template;

    protected $listeners = ['genPreview'];

    public function render() {
        return view('livewire.modal.preview-pdf');
    }

    public function genPreview($id, $vars) {
        $this->open = true;
        $this->template = Templates::find($id);
        $this->template->vars = $vars;
        $prev = new PdfController($this->template);
        $this->emit('show_pdf',  $prev->pdfBase64);
    }
}
