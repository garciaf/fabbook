<?php
namespace FBK\ZipBundle\Compressor;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Zip {
    protected $zip;
    protected $archive_directory;
    protected $fileName;
    public function __construct($archive_directory) {
        $this->archive_directory = $archive_directory;
        $this->zip = new \ZipArchive();
    }
    public function getFileName(){
        return $this->fileName;
    }
    public function setFileName($fileName){
        $this->fileName = $fileName;
    }
    public function getAbsolutePath(){
        return sprintf("%s/%s",$this->archive_directory,$this->getFileName());
    }
    public function create($fileName){
        $this->setFileName($fileName);
        if ($this->zip->open($this->getAbsolutePath(), \ZipArchive::CREATE) == true) {
            return $this;
        }else{
            throw new Exception("Can't create zip archive");
        }
    }
    
    public function addFile($filePath, $targetPath = null) {
        $this->zip->addFile($filePath, $targetPath);
    }
    public function close(){
        $this->zip->close();
    }
    public function getResponse(){
        $response = new Response();
        return $this->setResponseHeaders($response);
    }
    protected function setResponseHeaders(Response $response)
    {
        $response->headers->set('Cache-Control', 'public');
        $response->headers->set('Content-Type', "application/octet-stream");
        $d = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $this->getFileName());
        $response->headers->set('Content-Disposition', $d);
	$response->setContent(file_get_contents($this->getAbsolutePath()));
        return $response;
    }
}
