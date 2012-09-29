<?php
namespace FBK\ZipBundle\Compressor;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use FBK\ZipBundle\Compressor\Exception\ZipException;
class Zip
{
    protected $zip;
    
    protected $archive_directory;
    
    protected $fileName;
    
    public function __construct($archive_directory)
    {
        $this->archive_directory = $archive_directory;
        $this->zip = new \ZipArchive();
    }
    
    public function getFileName()
    {
        return $this->fileName;
    }
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }
    public function getAbsolutePath()
    {
        return sprintf("%s/%s",$this->archive_directory,$this->getFileName());
    }
    public function create($fileName)
    {
        $this->setFileName($fileName);
        if ($this->zip->open($this->getAbsolutePath(), \ZipArchive::CREATE) == true) {
            return $this;
        } else {
            throw new ZipException("Can't create zip archive");
        }
    }

    public function addFile($filePath, $targetPath = null)
    {
        if(is_readable($filePath)){
            $this->zip->addFile($filePath, $targetPath);
        }
        return $this;
    }

    public function open($fileName, $flags = null)
    {
        $this->zip->open($fileName, $flags);
    }

    public function close()
    {
        $this->zip->close();
    }

    public function getResponse()
    {
        if(!is_readable($this->getAbsolutePath())){
            throw new ZipException("Can't read archive filezip");
        }
        $response = new Response();   

        return $this->setResponseHeaders($response);
    }
    public function getContent()
    {
        return file_get_contents($this->getAbsolutePath());
    }
    protected function setResponseHeaders(Response $response)
    {
        $response->headers->set('Cache-Control', 'public');
        $response->headers->set('Content-Type', "application/zip");
        $d = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT, $this->getFileName());
        $response->headers->set('Content-Disposition', $d);
        $response->setContent($this->getContent());

        return $response;
    }
}
