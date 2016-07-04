<?php
/**
 * Created by PhpStorm.
 * User: walmirlsj
 * Date: 05/07/15
 * Time: 14:48
 */

namespace Catalogo\Form;

use Zend\InputFilter\InputFilter;

class VeiculoFilter extends InputFilter
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
                        'mimeType' => 'image'
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
//        $this->add(array(
//            'name' => 'nome',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'sobreNome',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'sexo',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'rg',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
////                array(
////                    'name' => 'Between',
////                    'options' => array(
////                        'min' => '1970-01-01',
////                        'max' => date('Y-m-d')
////                    ),
////                )
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'cpf',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'dataNasc',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'telefone',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'celular',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'estado',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'cidade',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'endereco',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'bairro',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));
//
//        $this->add(array(
//            'name' => 'cep',
//            'required' => true,
//            'filters' => array(
//                array('name' => 'StripTags'),
//                array('name' => 'StringTrim'),
//            ),
//            'validators' => array(
//                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Não pode estar em branco')))
//            )
//        ));

    }

}
