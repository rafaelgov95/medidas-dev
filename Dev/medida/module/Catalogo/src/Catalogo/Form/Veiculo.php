<?php
/**
 * Created by PhpStorm.
 * User: walmirlsj
 * Date: 06/07/15
 * Time: 02:06
 */

namespace Catalogo\Form;

use Zend\Form\Form;
use Zend\I18n\Validator\Alnum;

class Veiculo extends Form
{
    public function __construct(\Doctrine\ORM\EntityManager $em, $options = array())
    {
        parent::__construct('Veiculo', $options); //, $options
        $this->setInputFilter(new VeiculoFilter())
            ->setAttribute('method', 'post')
            ->setAttribute('class', '');


        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);


        $this->add(
            (new \DoctrineModule\Form\Element\ObjectSelect("marca"))
                ->setLabel("Marca")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setOptions(array(
                    'object_manager' => $em,
                    'target_class' => 'Catalogo\Entity\Marca',
                    'property' => 'descricao',
                    'empty_option' => '--- Selecione ---',
                    'is_method' => true,
                    'find_method' => array(
                        'name' => 'findBy',
                        'params' => array(
                            'criteria' => array(),
                            'orderBy' => array(),
                        ),
                    ),
                ))
        );

        $this->add(
            (new \Zend\Form\Element\Text("modelo"))
                ->setLabel("Modelo")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setAttribute('placeholder', 'Exemplo Uno')
        );

        $this->add(
            (new \Zend\Form\Element\Text("versao"))
                ->setLabel("Versão")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setAttribute('placeholder', 'Exemplo 1.0')
        );

        $this->add(
            (new \Zend\Form\Element\Text("ano_modelo"))
                ->setLabel("Ano/Modelo")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setAttribute('placeholder', 'Exemplo 2010/2011')
        );

        $this->add(
            (new \Zend\Form\Element\Text("cor"))
                ->setLabel("Cor")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setAttribute('placeholder', 'Exemplo Prata')
        );

        $this->add(
            (new \Zend\Form\Element\Text("km"))
                ->setLabel("Km")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setAttribute('placeholder', 'exemplo 1000Km')
        );

        $this->add(
            (new \Zend\Form\Element\Text("portas"))
                ->setLabel("Portas")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setAttribute('placeholder', 'Exemplo Completa')
        );

        $this->add(
            (new \Zend\Form\Element\Text("direcao"))
                ->setLabel("Direção")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setAttribute('placeholder', 'Exemplo Hidraulica')
        );

        $this->add(
            (new \Zend\Form\Element\Text("transmissao"))
                ->setLabel("Transmissão")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setAttribute('placeholder', 'Exemplo Automática')
        );

        $this->add(
            (new \Zend\Form\Element\Text("opcionais"))
                ->setLabel("Opcionais")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setAttribute('placeholder', 'Exemplo Completa')
        );

        $this->add(
            (new \Zend\Form\Element\Text("obs"))
                ->setLabel("Observação")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setAttribute('placeholder', 'Pouco uso')
        );

        $this->add(
            (new \Zend\Form\Element\Text("price"))
                ->setLabel("Preço")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setAttribute('placeholder', 'Exemplo 24.900,00')
        );

//        $this->add(
//            (new \Zend\Form\Element\Text("icone"))
//                ->setLabel("Icone")
//                ->setAttribute('class', 'form-control')
//                ->setAttribute('placeholder', 'Exemplo icone')
//        );
//
//        $this->add(
//            (new \Zend\Form\Element\Text("path"))
//                ->setLabel("Path")
//                ->setAttribute('class', 'form-control')
//                ->setAttribute('placeholder', 'Exemplo path')
//        );

        $this->add(
            (new \Zend\Form\Element\File("files"))
                ->setLabel("Imagens")
                ->setAttribute('placeholder', 'Exemplo path')
                ->setAttribute('id', 'uploads')
                ->setAttribute('multiple', true)
                ->setAttribute('class', 'btn btn-primary btn-file')
                ->setAttribute('data-filename-placement', 'inside')
        );

        $this->add(
            (new \Zend\Form\Element\Checkbox("stocked"))
                ->setLabel("Em estoque")
                ->setAttribute('required', true)
                ->setAttribute('class', 'form-control-static checkbox col-md-12')
        );

        $this->add(
            (new \DoctrineModule\Form\Element\ObjectSelect("categoria"))
                ->setLabel("Categoria")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setOptions(array(
                    'object_manager' => $em,
                    'target_class' => 'Catalogo\Entity\Categoria',
                    'property' => 'descricao',
                    'empty_option' => '--- Selecione ---',
                    'is_method' => true,
                    'find_method' => array(
                        'name' => 'findBy',
                        'params' => array(
                            'criteria' => array(),
                            'orderBy' => array(),
                        ),
                    ),
                ))
        );

        $this->add(
            (new \DoctrineModule\Form\Element\ObjectSelect("cliente"))
                ->setLabel("Cliente")
                ->setAttribute('class', 'form-control')
                ->setAttribute('required', true)
                ->setOptions(array(
                    'object_manager' => $em,
                    'target_class' => 'Cliente\Entity\Cliente',
                    'property' => 'nome',
                    'empty_option' => '--- Selecione ---',
                    'is_method' => true,
                    'find_method' => array(
                        'name' => 'findBy',
                        'params' => array(
                            'criteria' => array(),
                            'orderBy' => array(),
                        ),
                    ),
                ))
        );

        $this->add(new \Zend\Form\Element\Csrf("security"));

        $this->add(
            (new \Zend\Form\Element\Submit('submit'))
                ->setAttribute('value', 'Salvar')
                ->setAttribute('class', 'btn btn-primary pull-right')
                ->setAttribute('placeholder', 'Cep')
        );

    }

}

//        $dirdata = './public';
//        //CAPTCHA
//        //criando um objeto Zend_Captcha_Image
//        $captcha = new \Zend\Captcha\Image();
//        // quantidade de letras
//        $captcha->setWordlen(5);
//        // o caminho onde o zend vai armazenar as imagens
//        $captcha->setImgDir($dirdata . '/captcha/img');
//        //especifica a cada quantas vezes o garbage collector vai rodar para eliminar as imagens inválidas
//        $captcha->setGcFreq(10);
//        // tempo de expiração em segundos.
//        $captcha->setSuffix(".jpg");
//        $captcha->setExpiration(60);
//        // tamanho da imagem de captcha
//        $captcha->setHeight(35);
//        // largura da imagem
//        $captcha->setWidth(200);
//        // o nivel das linhas, quanto maior, mais dificil fica a leitura
//        $captcha->setLineNoiseLevel(1);
//        // nivel dos pontos
//        $captcha->setDotNoiseLevel(10);
//        //tamanho da fonte em pixels
//        $captcha->setFontSize(15);
//        //seta o alt da imagem
//        $captcha->setImgAlt("Captcha");
//        //seta a url de onde a imagem sera carregada
//
//        $captcha->setImgUrl('/captcha/img/');
////        var_dump($captcha->getImgUrl());die;
//        // caminho para a fonte a ser usada
//        $captcha->setFont($dirdata .'/captcha/font/arial.ttf');
//
////        $captchaElement = new \Zend\Form\Element\Captcha('captcha', array(
////            'label' => "Digite o código abaixo",
////            'captcha' => array(
////                'captcha' => $captcha,
////            ),
////        ));
////        $this->add($captchaElement);
//        $_captcha = new \Zend\Form\Element\Captcha('captcha');
//        $_captcha->setCaptcha($captcha)
//            ->setLabel('Validação')
//            ->setAttribute('class', '');
//        $this->add($_captcha);