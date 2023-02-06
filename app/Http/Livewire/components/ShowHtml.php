<?php

namespace App\Http\Livewire\Components;

use App\Http\Controllers\PdfController;
use App\Models\Comments;
use App\Models\Contracts;
use DOMDocument;
use Illuminate\Support\Str;
use Livewire\Component;

class ShowHtml extends Component {

    public $html, $contract_id;
    
    protected $listeners = ['showhtml'];

    public function render() {
        $document = Contracts::find($this->contract_id);
        $html = $this->modifyhtml($document->html);
        return view('livewire.components.show-html', compact('html','document'));
    }

    public function modifyhtml($html) {
        $base = '<div class="justify-start cursor-pointer text-gray-700 hover:text-blue-400 hover:bg-blue-100 rounded-md ';
        $end = '</div>';
        $document = new DOMDocument();
        $document->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $blocks = $document->getElementsByTagName('body')->item(0);
        foreach ($blocks->childNodes as $key => $value) {
            $id = $key + 1;
            $has = (Comments::where('block', $id)->where('contract_id', $this->contract_id)->count() > 0) ? 'bg-blue-100' : '';
            $html = Str::replace($value->nodeValue, $base . $has . '" wire:click="parent_comments(' . ($id) . ')">' . $value->nodeValue . $end, $html);
        }
        $html = Str::replace('&nbsp;','<br>', $html);
        $this->html = $html;
    }

    public function showhtml($contract_id) {
        $this->contract_id = $contract_id;
        $this->render();
    }

    public function parent_comments($bockkey) {
        $this->show_comments = true;
        $this->emit('parent_comments', $bockkey, $this->contract_id);
    }
}