<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $targetDirectory;
    private $slugger;

    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $uploadedFile)
    {
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename  = $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

        try {
            $uploadedFile->move($this->getTargetDirectory(), $newFilename);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $newFilename;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
