<?php

namespace App\Http\Controllers;

use Spipu\Html2Pdf\Html2Pdf;
use Illuminate\Support\Str;

class PdfController extends Controller {
    public $pdfBase64;

    public function __construct($html) {
        $this->html = $html;
        $this->generatePDF();
    }

    private function generatePDF() {
        $this->render_signatures();
        ob_start();
        require storage_path('app/template/template.php');
        $html = ob_get_clean();
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->writeHTML($html ,false);
        $pdfVar = $html2pdf->output('test.pdf', 'S');
        $this->pdfBase64 = base64_encode($pdfVar);
    }

    private function render_signatures() {
    }

    private function cleanHtml($html) {
        $html = Str::replace('<figure class="table">','',$html);
        $html = Str::replace('</figure>','',$html);
        return $html;
    }
}
