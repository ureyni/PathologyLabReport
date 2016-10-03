<?php

use Dompdf\Dompdf;

class PdfConverter {

    private $pdfhome = '';

    public function __construct($options) {
        if (is_array($options)) {
            if (isset($options['pdfhome'])) {
                if (!file_exists($options['pdfhome']))
                    mkdir($options['pdfhome']);
                $this->pdfhome = $options['pdfhome'];
            }
        }
    }

    /* create pdf file from html 

     * @param string html
     * @return boolean
     * 
     */

    public function dopdf($html = 'Welcome Dom Pdf') {
        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';
        // reference the Dompdf namespace
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        // $dompdf->stream('/tmp/dompdf.pdf');
        $output = $dompdf->output();
        $pdfFilename = $this->pdfhome . DIRECTORY_SEPARATOR . sha1(uniqid()) . ".pdf";
        
        if (file_put_contents($pdfFilename, $output) != 0)
            return $pdfFilename;
        else
            return false;
    }

}

?>