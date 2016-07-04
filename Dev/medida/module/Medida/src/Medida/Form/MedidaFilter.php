<?php
/**
 * Created by PhpStorm.
 * User: walmirlsj
 * Date: 05/07/15
 * Time: 14:48
 */

namespace Medida\Form;

use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\Validator\File\MimeType;
use Zend\Validator\File\Size;

class MedidaFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'files',
            'required' => false,
            'validators' => array(
                array(
                    'name' => 'Zend\Validator\File\MimeType',
                    'options' => array(
                        'mimeType' => 'application/pdf'
                    )
                )
            ),
            'filters' => array(
                array(
                    'name' => 'Zend\Filter\File\RenameUpload',
                    'options' => array(
                        'target' => './public/img/tmp',
                        'randomize' => true,
                        'use_upload_extension' => true,
                        'use_upload_name' => true
                    )
                )
            )
        ));


    }

}
