<?php

namespace Catalogo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Http;
use Catalogo\Plugins\Uploads\FilesServiceInterface;
use Zend\XmlRpc\Value\DateTime;

class TesteController extends AbstractActionController
{
    /**
     * @var FilesServiceInterface
     */
    protected $filesService;

    public function __construct(FilesServiceInterface $filesService)
    {
        $this->filesService = $filesService;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function uploadAction()
    {
        $files = $this->params()->fromFiles('files');

//        $files = $this->getRequest()
//            ->getFiles()
//            ->toArray();
//        if (is_array($files))
        $code = $this->filesService->persistFiles($files);
//        else
//            $code = "File not found!";

////        $files->getArray();
//        $hora = new DateTime('now');
//        echo $hora->format('d-m-Y - H:i:s');
//        $file = var_export($files, TRUE);
//        file_put_contents('newfile.log', '1', FILE_APPEND);

        return new JsonModel([
            'code' => $code
        ]);
    }

//    private function persistFiles(array $files)
//    {
//        foreach ($files as $file) {
//            move_uploaded_file($file['tmp_name'], $this->options->getBasePath() . '/' . $file['name']);
//        }
//        return self::CODE_SUCCESS;
//    }
}

