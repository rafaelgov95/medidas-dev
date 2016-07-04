<?php

namespace User\Form;

use Zend\Form\Form;

class Recover extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct('recover', $options);

        $this->setInputFilter(new RecoverFilter());
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');

//        $id = new \Zend\Form\Element\Hidden('id');
//        $this->add($id);

        $nome = new \Zend\Form\Element\Text("login");
        $nome->setLabel("Login: ")
            ->setAttribute('placeholder', 'Entre com o login')
            ->setAttribute('type', 'text');
        $this->add($nome);

        //CAPTCHA
        $dirdata = './public';
        //criando um objeto Zend_Captcha_Image
        $captcha = new \Zend\Captcha\Image();
        // quantidade de letras
        $captcha->setWordlen(8);
        // o caminho onde o zend vai armazenar as imagens
        $captcha->setImgDir($dirdata . '/captcha/img');
        //especifica a cada quantas vezes o garbage collector vai rodar para eliminar as imagens inválidas
        $captcha->setGcFreq(10);
        // tempo de expiração em segundos.
        $captcha->setSuffix(".jpg");
        $captcha->setExpiration(60);
        // tamanho da imagem de captcha
        $captcha->setHeight(35);
        // largura da imagem
        $captcha->setWidth(200);
        // o nivel das linhas, quanto maior, mais dificil fica a leitura
        $captcha->setLineNoiseLevel(5);
        // nivel dos pontos
        $captcha->setDotNoiseLevel(14);
        //tamanho da fonte em pixels
        $captcha->setFontSize(15);
        //seta o alt da imagem
        $captcha->setImgAlt("Captcha");
        //seta a url de onde a imagem sera carregada

        $captcha->setImgUrl('/captcha/img/');
//        var_dump($captcha->getImgUrl());die;
        // caminho para a fonte a ser usada
        $captcha->setFont($dirdata . '/captcha/font/arial.ttf');

//        $captchaElement = new \Zend\Form\Element\Captcha('captcha', array(
//            'label' => "Digite o código abaixo",
//            'captcha' => array(
//                'captcha' => $captcha,
//            ),
//        ));
//        $this->add($captchaElement);
        $_captcha = new \Zend\Form\Element\Captcha('captcha');
        $_captcha->setCaptcha($captcha)
            ->setLabel('Validação')
            ->setAttribute('class', '');
        $this->add($_captcha);

        $csrf = new \Zend\Form\Element\Csrf("security");

        $this->add($csrf);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Obter nova senha',
                'class' => 'btn btn-primary btn-lg col-xs-12'
            )
        ));


    }

}
