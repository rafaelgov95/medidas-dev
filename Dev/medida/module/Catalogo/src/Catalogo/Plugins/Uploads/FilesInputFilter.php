<?php
namespace Catalogo\Plugins\Uploads;

use Zend\Filter\File\RenameUpload;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\Validator\File\Size;

/**
 * Class FilesInputFilter
 */
class FilesInputFilter extends InputFilter
{
    const FILE = 'file';

    public function __construct(FilesOptions $options)
    {
        $input = new FileInput(self::FILE);
        $input->getValidatorChain()->attach(new Size(['max' => $options->getMaxSize()]));
        $input->getFilterChain()->attach(new RenameUpload([
            'overwrite'         => false,
            'use_upload_name'   => false,
            'target'            => $options->getBasePath()
        ]));

        $this->add($input);
    }
}
