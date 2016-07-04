<?php
namespace Catalogo\Plugins\Uploads;

/**
 * Interface FilesServiceInterface
 */
interface FilesServiceInterface
{
    const CODE_SUCCESS = 'success';
    const CODE_ERROR = 'error';

    /**
     * @return \SplFileInfo[]
     */
    public function getFiles();

    /**
     * @param array $files
     * @return string
     */
    public function persistFiles(array $files);
}
