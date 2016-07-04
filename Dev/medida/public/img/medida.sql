-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 20-Out-2015 às 10:45
-- Versão do servidor: 5.5.44-0+deb8u1
-- PHP Version: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dev-medida`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `medida`
--

CREATE TABLE IF NOT EXISTS `medida` (
`id` int(11) NOT NULL,
  `oficio` varchar(45) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `acusado` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `telr` varchar(20) NOT NULL,
  `telc` varchar(20) NOT NULL,
  `estado` varchar(60) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `rua` varchar(45) NOT NULL,
  `file` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medida`
--

INSERT INTO `medida` (`id`, `oficio`, `nome`, `acusado`, `data`, `telr`, `telc`, `estado`, `cidade`, `bairro`, `rua`, `file`, `created_at`, `updated_at`) VALUES
(1, '1910/2015', 'Marcia Aparecida Barbosa Torresani', 'Wilson José Esterce dos Santos', '2015-10-06 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Vila Bela', 'Rua João Feliciano Bazerra, 224', '/img/1910 2015_56167399d511f.pdf', '2015-10-08 10:46:01', '2015-10-16 20:53:30'),
(2, '1912/2015', 'Vera Lúcia Gomes', 'José Salvador da Silva Filho', '2015-10-06 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Cohab', 'Rua Juscelino K, 110', '/img/1912 2015_56167445bc082.pdf', '2015-10-08 10:48:53', '2015-10-13 18:05:11'),
(3, '1914/2015', 'Celia Regina Nunes de Souza', 'Sérgio Adriano de Souza Nogueira', '2015-10-06 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'Rua Maria Gomes,181', '/img/1914 2015_5616748af231f.pdf', '2015-10-08 10:50:02', '2015-10-16 21:00:20'),
(4, '1880/2015', 'Paula Heloisa Gomes', 'Divino Aparecido Da Silva', '2015-09-29 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Centro', 'Rua Olegário B. da Silveira, 775', '/img/1880 2015_5617cf529aaf5.pdf', '2015-10-09 11:29:38', '2015-10-09 11:29:38'),
(6, '1884/2015', 'Olimpia Ferreira Pedroso', 'Adival Ferreira Pedroso', '2015-09-29 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Centro', 'Rua Viriato Bandeira, 190', '/img/1884 2015_5617d031a5a7a.pdf', '2015-10-09 11:33:21', '2015-10-13 18:03:29'),
(7, '1882/2015', 'Nadir Mateus Basílio', 'Juscelino Brito de Oliveira', '2015-09-29 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Nova Coxim', 'Velha Estrada,276', '/img/1882 2015_5617d0975efe5.pdf', '2015-10-09 11:35:03', '2015-10-09 11:35:03'),
(8, '1785/2015', 'Luciene Ferreira Alvarenga', 'Aramar Andrade dos Santos', '2015-09-14 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Piracema', 'Rua Nioaque, 414', '/img/1785 2015_5617d0f04590d.pdf', '2015-10-09 11:36:32', '2015-10-09 11:36:32'),
(9, '1818/2015', 'Genilce Malheiros Lemos', 'Daniel de Arruda', '2015-09-17 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Vila Bela', 'Rua Azaleia, 439', '/img/1818 2015_5617d14dd885d.pdf', '2015-10-09 11:38:05', '2015-10-09 11:38:05'),
(10, '1768/2015', 'Mirely Thaize Zorrilha Camposano', 'David Alexandre Morais de Souza', '2015-09-11 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Mendes Mourao', 'Rua Andre Magro', '/img/1768 2015_5617d1c5c8045.pdf', '2015-10-09 11:40:05', '2015-10-09 11:40:05'),
(11, '1783/2015', 'Marilda Barbosa Figueiredo', 'Antonio Pereira Bezerra', '2015-09-14 00:00:00', '(00)0000-0000', '(67)9952-5233', 'MS', 'Coxim', 'Jardim das Estrelas', 'Rua Vênus , 90', '/img/1783 2015_5617d23eefb39.pdf', '2015-10-09 11:42:06', '2015-10-09 11:42:06'),
(12, '1770/2015', 'Maria Helena da Silva', 'Ari Ubirajara Alves Flores', '2015-09-11 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Piracema', 'Fazenda Barra da Fortaleza', '/img/1770 2015_5617d334ebd29.pdf', '2015-10-09 11:46:12', '2015-10-09 11:46:12'),
(13, '1819/2015', 'Silvania Barbosa dos Santos', 'Fabio Gonçalves Sena', '2015-09-17 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Vila Bela', 'Rua Arara Azul, 200', '/img/1819 2015_5617d3832ab64.pdf', '2015-10-09 11:47:31', '2015-10-09 11:47:31'),
(14, '1819/2015', 'Silvania Barbosa dos Santos', 'Fabio Gonçalves Sena', '2015-09-17 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Vila Bela', 'Rua Arara Azul, 200', '/img/1819 2015_5617d3fb16c16.pdf', '2015-10-09 11:49:31', '2015-10-09 11:49:31'),
(15, '1850/2015', 'Ivanete Alves dos Santos', 'Vilson Bergo dos Santos', '2015-09-23 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Assent. Apos PRF Irma Laurina', 'Zona rual', '/img/1850 2015_5617d45a2b12c.pdf', '2015-10-09 11:51:06', '2015-10-09 11:51:06'),
(16, '1852/2015', 'Renata Cristina Ricci', 'Vagner Silva Santos', '2015-09-23 00:00:00', '(00)0000-0000', '(67)9630-5904', 'MS', 'Coxim', 'Centro', 'Rua Goias, 22', '/img/1852 2015_5617d4d3ae770.pdf', '2015-10-09 11:53:07', '2015-10-09 11:53:07'),
(17, '1854/2015', 'Luana Patricia Gama Ferreira', 'Efraim da Silva Santos', '2015-09-23 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Prox. Post. Recreio', 'Fz Santa Ana ', '/img/1854 2015_5617d5a83e362.pdf', '2015-10-09 11:56:40', '2015-10-09 11:56:40'),
(18, '1858/2015', 'Odete Ribeiro', 'Thiago Ribeiro', '2015-09-23 00:00:00', '(00)0000-0000', '(67)9975-4029', 'MS', 'Coxim', 'Sr.Divino', 'Rua Presidente Vargas, 456', '/img/1858 2015_5617d5ff21661.pdf', '2015-10-09 11:58:07', '2015-10-09 11:58:07'),
(19, '1856/2015', 'Karolina de Melo Tinoco', 'Elson Rodruigues de Souza', '2015-09-23 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Jardim Europa', 'Rua Projetada 7', '/img/1856 2015_5617d65dbded0.pdf', '2015-10-09 11:59:41', '2015-10-09 11:59:41'),
(21, '1731/2015', 'Tatiane de Moraes', 'Paulo Sergio de Brito Vargas', '2015-09-10 00:00:00', '(00) 0000-0000', '(00) 0000-0000', 'MS', 'Coxim', 'Val.Taquari', 'Rua 13, Nº2', '/img/17312015_561d25ea4e9f2.pdf', '2015-10-13 12:40:26', '2015-10-13 12:40:26'),
(23, '0745/2015', 'Carmencita Vendruscolo', 'Luiz Augusto Dechandt', '2015-04-29 00:00:00', '(00) 0000-0000', '(00) 0000-0000', 'MS', 'Coxim', 'Flávio Garcia', 'Av.Virg. Ferreira, Nº500', '/img/745 2015_5620fca70632a.pdf', '2015-10-16 10:33:27', '2015-10-16 10:33:27'),
(24, '1152/2015', 'Flávia Ferreira da Silva', 'Gilmario Santos Souza', '2015-07-15 00:00:00', '(00) 0000-0000', '(67) 8404-4340', 'MS', 'Alcinópolis', 'Centro', 'R: Lino Doming. de O., Nº182', '/img/1152 2015_5620fe8a5e247.pdf', '2015-10-16 10:41:30', '2015-10-16 10:42:07'),
(25, '0252/2015', 'Katia Marrani Alves', 'Raimundo Alves Filho', '2015-02-05 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Flavio Garcia', 'Av.Presi. Costa e Silv. Nº325', '/img/252 2015_5620ff4fad135.pdf', '2015-10-16 10:44:47', '2015-10-16 10:44:47'),
(29, '0364/2015', 'Luzinete Aparecida Arruda dos Reis', 'Cleberson Lopes da Silva', '2015-03-04 00:00:00', '(00)0000-0000', '(67)9803-9898', 'MS', 'Coxim', 'Centro', 'Rua Miranda Reis, 113', '/img/364 2015_5620ffa615aa2.pdf', '2015-10-16 10:46:14', '2015-10-16 10:51:36'),
(30, '0250/2015', 'Fernanda Maria de O. Machado', 'Handerson Cândido Ferreira', '2015-02-05 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Flavio Garcia', 'Oscar Serrou Camy, Nº354', '/img/250 2015_5620ffaa57e2e.pdf', '2015-10-16 10:46:18', '2015-10-16 10:46:18'),
(31, '1159/2015', 'Camila Steffany Marcelino Avalos', 'Claudio Roverto Soares da Silva', '2015-06-17 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Centro', 'R Marcio Lima Nantes, Nº38', '/img/1159 2015_5621003018369.pdf', '2015-10-16 10:48:32', '2015-10-16 10:48:32'),
(32, '0944/2015', 'Maria de Lourdes Morais Leite', 'Claudionor de Oliveira', '2015-03-26 00:00:00', '(00)0000-0000', '(67) 9930-2022', 'MS', 'Coxim', 'Senhor Divino', 'Rua Orquídea, 70', '/img/944 2015_5621003270656.pdf', '2015-10-16 10:48:34', '2015-10-16 10:51:52'),
(33, '0527/2015', 'Marinalva Rodrigues de Matos', 'Valdino Aparecido dos Santos', '2015-03-30 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Senhor Divino', 'Rua dos Torquatos, 209', '/img/527 2015_562100aad99d0.pdf', '2015-10-16 10:50:34', '2015-10-16 11:05:01'),
(34, '1380/2015', 'Rosa Andreia Oliveira de lima e Debora Mayara Oliveira de Lima', 'Oilson Alfredo dos Santos Paes', '2015-07-22 00:00:00', '(00)0000-0000', '(67) 9954-8469', 'MS', 'Coxim', 'Mangabeira', 'Rua Projetada, 15', '/img/1380 2015_5621019564009.pdf', '2015-10-16 10:54:29', '2015-10-16 10:54:29'),
(35, '0139/2015', 'Rosilda de Souza Anjos', 'Edilson Clementino Furtado', '2015-01-22 00:00:00', '(00)0000-0000', '(67)9954-1579', 'MS', 'Coxim', 'Flavio Garcia', 'Rua Afonso Costa Campos, 1235', '/img/139 2015_5621025097f39.pdf', '2015-10-16 10:57:36', '2015-10-16 10:57:36'),
(36, '0255/2015', 'Luzia Ochber', 'Robson de Paula Cordeiro', '2015-02-06 00:00:00', '(00)0000-0000', '(00)0000-0000', 'Mato Grosso do Sul', 'Coxim', 'Santo Andre', 'Rua Andre Magro, 412', '/img/255 2015_5621029d7ecc6.pdf', '2015-10-16 10:58:53', '2015-10-16 10:58:53'),
(37, '0441/2015', 'Vilma da Silva Almeida', 'Leandro Rodrigues Paulino de Assunção', '2015-03-16 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Senhor Divino', '', '/img/441 2015_5621030771fbf.pdf', '2015-10-16 11:00:39', '2015-10-16 11:00:39'),
(38, '1119/2015', 'Ana Paula Filha', 'Celso Santana da Silva', '2015-06-11 00:00:00', '(00)0000-0000', '67 9923-8555', 'MS', 'Coxim', 'Vila Bela', 'R: Samanbaia, 152', '/img/1119 2015_5621031b6e214.pdf', '2015-10-16 11:00:59', '2015-10-16 11:00:59'),
(39, '0438/2015', 'Gicelle do Rocio Ferreira', 'José Paulino da Mota', '2015-03-16 00:00:00', '(00)0000-0000', '(67) 9833-5025', 'MS', 'Coxim', 'Nova Coxim', 'Rua Três, 13', '/img/438 2015_5621036e0067d.pdf', '2015-10-16 11:02:22', '2015-10-16 11:02:22'),
(40, '1163/2015', 'Liliam Fernandes da Silva', 'Leomar Rodrigues Borges', '2015-06-17 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: Serafim de Oliveira, 168', '/img/1163 2015_56210374658f9.pdf', '2015-10-16 11:02:28', '2015-10-16 11:51:12'),
(42, '0362/2015', 'Cristiana da Conceição', 'Cinei Diego Jesus Nunes', '2015-03-04 00:00:00', '(00)0000-0000', '(67) 9607-5322', 'MS', 'Coxim', 'Nova Coxim', 'Rua Fortaleza, 14', '/img/362 2015_562103c9386d8.pdf', '2015-10-16 11:03:53', '2015-10-16 11:03:53'),
(43, '0234/2015', 'Queure Oliveira Neves Silva', 'Valdemir Oliveira da Silva', '2015-02-03 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Altos de São Pedro', 'Rua Alagoas, 136', '/img/234 2015_5621040d75ae9.pdf', '2015-10-16 11:05:01', '2015-10-16 11:05:01'),
(44, '0366/2015', 'Ana Paula Inacio de Souza', 'Renato de Souza Melo', '2015-03-04 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Piracema', 'Rua Três Lagoas, 11', '/img/366 2015_5621044e75e8b.pdf', '2015-10-16 11:06:06', '2015-10-16 11:06:06'),
(45, '0142/2015', 'Inêz de Proença Ferreira', 'Cassemiro Ferreira', '2015-01-22 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Senhor Divino', 'Rua Dersul, 422', '/img/142 2015_562104982c247.pdf', '2015-10-16 11:07:20', '2015-10-16 11:07:20'),
(46, '0236/2015', 'Ana Aparecida de Mendonça', 'José Avelino de Souza', '2015-02-03 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Piracema', 'Rua ferreira 227', '/img/236 2015_562104d70fe94.pdf', '2015-10-16 11:08:23', '2015-10-16 11:08:23'),
(47, '1166/2015', 'Leila Neubert Vieira', 'Paulo Nunes Vieira', '2015-06-17 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Alcinopolis', 'Centro', 'Av. Lino Domingos de Oliveira, 1154', '/img/1166 2015_562106f840368.pdf', '2015-10-16 11:17:28', '2015-10-16 11:17:28'),
(48, '1059/2015', 'Arieli Messias da Silva', 'Kaio Henrique de Oliveira', '2015-06-02 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Santa Maria', 'Rua Mercio Portela Lima, 117', '/img/1059 2015_56210741e3cf7.pdf', '2015-10-16 11:18:41', '2015-10-16 11:18:41'),
(49, '1276/2015', 'Juliana da Silva', 'José Carlos Pereira da Silva', '2015-07-03 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Senhor Divino', 'Rua dos Torquatos, 331', '/img/1276 2015_56210786e1e69.pdf', '2015-10-16 11:19:50', '2015-10-16 11:19:50'),
(50, '1262/2015', 'Erotildes dos Santos Jesus', 'Jair dos Santos Fonseca', '2015-07-03 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Vila Bela ', 'Rua Tom Jobim, 118', '/img/1262 2015_562107c8d1f5b.pdf', '2015-10-16 11:20:56', '2015-10-16 11:20:56'),
(51, '0385/2015', 'Márcia Patricia Amaro de Souza', 'Magno Rufino de O.', '2015-03-06 00:00:00', '(00)0000-0000', '67 98649767', 'MS', 'Coxim', 'Centro', 'R: Anjo Pivo, 61 ', '/img/385 2015_5621092594232.pdf', '2015-10-16 11:26:45', '2015-10-16 11:26:45'),
(52, '1006/2015', 'Alice Coelho da Silva e Outro', 'Salvador Teodoro da Silva Filho', '2015-05-28 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Nova Coxim', 'R: Nova Alvorada, 33', '/img/1006 2015_562109efac569.pdf', '2015-10-16 11:30:07', '2015-10-16 11:30:07'),
(53, '0867/2015', 'Claudenice de Souza Nunes', 'Arthur Cristino Rodrigues Da Silva', '2015-05-12 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: Dom João Sexto, 59', '/img/867 2015_56210a46b137e.pdf', '2015-10-16 11:31:34', '2015-10-16 11:31:34'),
(54, '1264/2015', 'Ivone Coutinho Queiroz Freitas', 'Custódio da Silva Freitas ', '2015-07-03 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Santa Maria', 'Luiz Martins da Cunha, 65', '/img/1264 2015_56210a914a38c.pdf', '2015-10-16 11:32:49', '2015-10-16 11:32:49'),
(55, '1004/2015', 'Ivete Lima Borges', 'Paulo Menezes Nascimento', '2015-05-28 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: Pedro Pedrossian, 630', '/img/1004 2015_56210a975ba50.pdf', '2015-10-16 11:32:55', '2015-10-16 11:32:55'),
(56, '0981/2015', 'Vanessa da Silva', 'Silvio Santos de Oliveira', '2015-05-25 00:00:00', '(00)0000-0000', '(67) 9809-5596', 'MS', 'Coxim', 'Vila Bela', 'Rua Manacá, ---', '/img/981 2015_56210af25c165.pdf', '2015-10-16 11:34:26', '2015-10-16 11:34:26'),
(57, '0742/2015', 'Jurdelina Aparecida de Assis Araújo', 'Gabriel Venancio Ferreira', '2015-04-29 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: Antônio Ries Coelho, 998', '/img/724 2015_56210af44ab0d.pdf', '2015-10-16 11:34:28', '2015-10-16 11:34:28'),
(58, '0984/2015', 'Walquiria de Souza Quadros', 'Israel Silva de Oliveira', '2015-05-25 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Aquidauana', 'Guanandy', 'Rua Quintino Bocaiuva, 286', '/img/984 2015_56210b504d173.pdf', '2015-10-16 11:36:00', '2015-10-16 11:36:00'),
(59, '0481/2015', 'Rafaela Ferreira Teixeira', 'Maicon Douglas Ferreira de Souza', '2015-03-25 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Centro', 'R: Rio Grande do sul, 51', '/img/481 2015_56210b58ac886.pdf', '2015-10-16 11:36:08', '2015-10-16 11:36:08'),
(60, '0986/2015', 'Alciria França de Souza', 'José Aparecido de Assis', '2015-05-25 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Alcinópolis', 'Estrala Dalva - Cohab III', 'Travessa 91, 195', '/img/986 2015_56210bbe9b072.pdf', '2015-10-16 11:37:50', '2015-10-16 11:37:50'),
(61, '0580/2015', 'Maria Abadia da Silva Oliveira', 'Carlos Alberto Feitosa Gino', '2015-04-08 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Mendes Mourao', 'R: Andre Magro "Frent. do Merc"', '/img/580 2015_56210bdd29584.pdf', '2015-10-16 11:38:21', '2015-10-16 20:48:53'),
(62, '0541/2015', 'Jessica Vasques Roman', 'Inacio de Melo Silva', '2015-04-01 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Mendes Mourão', 'Rua Coronel Mariano, ---', '/img/541 2015_56210c15d160d.pdf', '2015-10-16 11:39:17', '2015-10-16 11:39:17'),
(63, '0724/2015', 'Marleide da Silva Amauacas', 'Rubens Oliveira Brito', '2015-04-24 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Val.Taquari', 'R: Um, "em Frent. do Campo"', '/img/724 2015_56210c41b7c59.pdf', '2015-10-16 11:40:01', '2015-10-16 11:40:01'),
(64, '0525/2015', 'Jarraira Larissa Machado de Souza', 'André Luiz Souza Batista', '2015-03-30 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Pequi II', 'Rua cmbará, 49', '/img/525 2015_56210c605290e.pdf', '2015-10-16 11:40:32', '2015-10-16 11:40:32'),
(65, '0904/2015', 'Daiane de Oliveira Rosendo', 'Ismael Ferreira Junior', '2015-05-13 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Morad. Alt. S. Pedro', 'R: Acre ,285', '/img/904 2015_5626321461db0.pdf', '2015-10-20 10:22:44', '2015-10-20 10:52:41'),
(66, '1430/2015', 'Jucemeire Paes Gracinho', 'Marcio Gaspar de Oliveira', '2015-08-03 00:00:00', '(00) 0000- 0000', '(00) 0000- 0000', 'MS', 'Coxim', 'Mangabeira', 'R: José Pereira da Silva,1257', '/img/1430 2015_562638ad49b00.pdf', '2015-10-20 10:50:53', '2015-10-20 10:50:53'),
(67, '1406/2015', 'Odete Ribeiro', 'Thiago Ribeiro', '2015-07-24 00:00:00', '(00)0000- 0000', '(00)0000- 0000', 'MS', 'Coxim', 'Senhor Divino', 'Getulio Vargas, 456', '/img/1406 2015_5626390e7e1fa.pdf', '2015-10-20 10:52:30', '2015-10-20 10:52:30'),
(68, '1404/2015', 'Ana Paula Inacio de Souza', 'Rosicleia de Souza Melo', '2015-07-24 00:00:00', '(00)0000-0000', '(00)0000- 0000', 'MS', 'Coxim', 'Piracema', 'Rua Três Lagoas, 11', '/img/1404 2015_56263973a6603.pdf', '2015-10-20 10:54:11', '2015-10-20 10:54:11'),
(69, '0577/2015', 'Cleonice Lopes da Silva', 'Eurico Miranda de Souza', '2015-04-08 00:00:00', '00 0000-0000', '00 0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: P. Pedrossian, 882', '/img/577 2015_562639870794f.pdf', '2015-10-20 10:54:31', '2015-10-20 10:54:31'),
(70, '1350/2015', 'Patricia Souza Escobar', 'Jean Oliveira Cabral', '2015-07-15 00:00:00', '(00)0000-0000', '(67)9633-4805', 'MS', 'Coxim', 'Vale do Taquari', 'Rua 04, ----', '/img/1350 2015_562639cddb5d1.pdf', '2015-10-20 10:55:41', '2015-10-20 10:55:41'),
(71, '0499/2015', 'Reijane Cristina de Oliveira', 'Francisco Ferreira de Oliveira', '2015-03-26 00:00:00', '00 0000-0000', '00 0000-0000', 'MS', 'Coxim', 'Santo André', 'R: 26 de Dezembro, 60', '/img/499 2015_562639e2711f9.pdf', '2015-10-20 10:56:02', '2015-10-20 10:56:02'),
(72, '0503/2015', 'Clemilda Rosa Roman', 'Edivalter Estulano', '2015-03-26 00:00:00', '00 0000-0000', '00 0000-0000', 'MS', 'Coxim', 'Centro', 'R: João Pessoa ,003', '/img/503 2015_56263a276008e.pdf', '2015-10-20 10:57:11', '2015-10-20 10:57:11'),
(73, '1325/2015', 'Luciene Maria Dias Batista', 'João Joaquim Alberto', '2015-07-13 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Pequi I e II', 'Rua Jatobá, 99', '/img/1325 2015_56263a2cdd9bf.pdf', '2015-10-20 10:57:16', '2015-10-20 10:57:16'),
(74, '0269/2015', 'Rosa de Alcântara Souza', 'Antonio Carlos de Souza', '2015-02-11 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: Sanesul, 180', '/img/269 2015_56263a8394ab0.pdf', '2015-10-20 10:58:43', '2015-10-20 10:58:43'),
(75, '1412/2015', 'Eliomar Mendonça da Silva', 'Antonio Carlos de Oliveira Groff', '2015-07-27 00:00:00', '(00)0000-0000', '(67)9678-2786', 'MS', 'Coxim', 'Santo André', 'Av. Presidente Vargas, 280', '/img/1412 2015_56263aa0b7f2a.pdf', '2015-10-20 10:59:12', '2015-10-20 10:59:12'),
(76, '1537/2015', 'Veronildes Batista dos Santos', 'Eloy Schimanski dos Santos', '2015-08-12 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Vila São Paulo', 'Rua Dourados, 161', '/img/1537 2015_56263ae0c1003.pdf', '2015-10-20 11:00:16', '2015-10-20 11:00:16'),
(77, '1479/2015', 'Maria Luzinete de Almeida', 'Claudecir de Oliveira', '2015-08-07 00:00:00', '(67)3291-1452', '(00)0000-0000', 'MS', 'Coxim', '---------------', 'Rua Carlos Garcia de Queiroz, 470', '/img/1479 2015_56263b234bca5.pdf', '2015-10-20 11:01:23', '2015-10-20 11:01:23'),
(78, '0274/2015', 'OdeteRibeiro', 'Thiago Ribeiro', '2015-02-11 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Flavio Garcia', 'R: Afon. Const. Camp. "Quartinhos"', '/img/274 2015_56263b360c8dc.pdf', '2015-10-20 11:01:42', '2015-10-20 11:01:42'),
(79, '1449/2015', 'Valdirene Pereira da Costa', 'Alex Sandro da Silva', '2015-08-04 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Nova Coxim', 'Av. Principe da Paz, ----', '/img/1449 2015_56263b595d1a3.pdf', '2015-10-20 11:02:17', '2015-10-20 11:02:17'),
(80, '0087/2015', 'Ludicéia Moraes de Brito', 'Luiz Carlos Guilherme', '2015-01-16 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Vila Bela', 'R: Das Margaridas,49', '/img/87 2015_56263b8c918af.pdf', '2015-10-20 11:03:08', '2015-10-20 11:03:08'),
(81, '1429/2015', 'Poliana Tome de Souza', 'Alessandro Delgado Correia', '2015-08-03 00:00:00', '(00)0000-0000', '(67)9812-5961', 'MS', 'Coxim', 'Vila Bela', 'Rua Girassol,----', '/img/1429 2015_56263ba12cb29.pdf', '2015-10-20 11:03:29', '2015-10-20 11:03:29'),
(82, '0072/2015', 'Solange Oliveira de Jesus', 'Wainerson Diego Duarte Ribas', '2015-01-15 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: das Rosas,79', '/img/72 2015_56263bd08ecb9.pdf', '2015-10-20 11:04:16', '2015-10-20 11:04:16'),
(83, '1433/2015', 'Leidivna de Souza Castro', 'Ronivaldo Oliveira Barbosa', '2015-08-03 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Vila Bela', 'Rua Frei Cirino João Primom, 1343', '/img/1433 2015_56263be8d139e.pdf', '2015-10-20 11:04:40', '2015-10-20 11:04:40'),
(84, '0035/2015', 'Maria Inez Barreto', 'Miguel Santana Cunha', '2015-01-13 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: Carlos Garcia de Queiroz,79', '/img/35 2015_56263c1a05d46.pdf', '2015-10-20 11:05:30', '2015-10-20 11:05:30'),
(85, '1423/2015', 'Ana Paula Arcanjo Ribas', 'Zenilton Alvice Rodrigues', '2015-07-31 00:00:00', '(67)3291-2601', '(00)0000-0000', 'MS', 'Coxim', 'Pequi I e II', 'Rua Embauba, 43', '/img/1423 2015_56263c462f284.pdf', '2015-10-20 11:06:14', '2015-10-20 11:06:14'),
(86, '0199/2015', 'Nadir Mateus Basílio', 'Juscelino de Tal', '2015-01-29 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Nova Coxim', 'Valha Estrada,276', '/img/199 2015_56263c59d92ed.pdf', '2015-10-20 11:06:33', '2015-10-20 11:06:33'),
(87, '1425/2015', 'Andreia Ramos dos Santos', 'Moises Pereira da Silva', '2015-07-31 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Senhor Divino', 'Rua Daniel Cesário, 10', '/img/1425 2015_56263c7ce15e8.pdf', '2015-10-20 11:07:08', '2015-10-20 11:07:08'),
(88, '1581/2015', 'Silvana Troche', 'Divino de Oliveira Domingues', '2015-08-17 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Senhor Divino', 'Rua Couto Pontes, 294', '/img/1581 2015_56263cb82e04b.pdf', '2015-10-20 11:08:08', '2015-10-20 11:08:08'),
(89, '0196/2015', 'Ana Mara Costa Freistas', 'Júlio Braz Nogueira', '2015-01-29 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Jardim Aeroporto', 'Av.Gen. Mend. de Morais,1164', '/img/196 2015_56263cb843e2e.pdf', '2015-10-20 11:08:08', '2015-10-20 11:08:08'),
(90, '1576/2015', 'Danielle Patricia de Morais Fontoura', 'Adinilson Barbosa da Silva', '2015-08-17 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Previsul', 'Rua do Tamarindo, 05', '/img/1576 2015_56263cee1e2b1.pdf', '2015-10-20 11:09:02', '2015-10-20 11:09:02'),
(91, '0332/2015', 'Eleniede Peixoto de Moura', 'Fernando Augusto Bataglin', '2015-02-24 00:00:00', '(00)0000-0000', '(67)9997-0021', 'MS', 'Coxim', 'Zona Rural', '----', '/img/332 2015_56263d0657eac.pdf', '2015-10-20 11:09:26', '2015-10-20 11:09:26'),
(92, '0094/2015', 'Julia de Souza Pereira', 'Edilson Pereira', '2015-01-19 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: Couto Pontes,121', '/img/94 2015_56263d418b67b.pdf', '2015-10-20 11:10:25', '2015-10-20 11:10:25'),
(93, '0306/2015', 'Castorina Vitoria F. Monteiro', 'Nilton Siabra e outro', '2015-02-19 00:00:00', '(00)0000-0000', '(67)9877-9748', 'MS', 'Coxim', 'Centro', 'R: Marechal Deodoro,30', '/img/306 2015_56263da808eea.pdf', '2015-10-20 11:12:08', '2015-10-20 11:12:08'),
(94, '1605/2015', 'Andreia Mendes Nogueira', 'Fabio Augusto Moraes da Silva', '2015-08-20 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Santa Maria', 'Rua dos Castilhos, 113', '/img/1605 2015_56263ea745eee.pdf', '2015-10-20 11:16:23', '2015-10-20 11:16:23'),
(95, '0786/2015', 'Cecilia Aparecida Wisenfad Neris', 'João Paulo Ferreira da Silva', '2015-05-05 00:00:00', '(00)0000-0000', '(67) 9865-0645', 'MS', 'Coxim', 'Sr.Divino', 'R: Luiz Martins da Cunha, 676', '/img/786 2015_56263fad387a3.pdf', '2015-10-20 11:20:45', '2015-10-20 11:20:45'),
(96, '0456/2015', 'Priscila Paloma de Souza', 'Weliton Ferreira Costa', '2015-05-18 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Nova Coxim', 'R: SãoJorge, ao lado do nº135', '/img/456 20150001_562640183391d.pdf', '2015-10-20 11:22:32', '2015-10-20 11:22:32'),
(97, '0678/2015', 'Fátima Aparecida de Moraes Brito', 'José Luiz da Silva Lima', '2015-04-17 00:00:00', '(00)0000-0000', '(67)9847-4767', 'MS', 'Coxim', 'Vila Bela', 'R: Herve Mendes Fontouram,----', '/img/678 2015_5626408ec680a.pdf', '2015-10-20 11:24:30', '2015-10-20 11:24:30'),
(98, '1665/2015', 'Marcia da Silva alves', 'Divino Manoel de Oliveira', '2015-08-31 00:00:00', '(00)0000-0000', '(67)8454-4721', 'MS', 'Alcinópolis', '-----', 'Av.Adolfo Alves Carneiro,646', '/img/1665 2015_5626411ac590d.pdf', '2015-10-20 11:26:50', '2015-10-20 11:26:50'),
(99, '1645/2015', 'Leila Neubert Vieira', 'Paulo Nunes Vieira', '2015-08-26 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Alcinópolis', 'Centro', 'Av.Lino Domingos de O, 1154', '/img/1645 2015_5626419105fab.pdf', '2015-10-20 11:28:49', '2015-10-20 11:28:49'),
(100, '1643/2015', 'Kely Arraes Torres', 'André Paiva Lopes', '2015-08-26 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: Dersul,309', '/img/1643 2015_562641e2d23d3.pdf', '2015-10-20 11:30:10', '2015-10-20 11:30:10'),
(101, '1633/2015', 'Leandra Batista do Nascimento', 'Marcelo Santana da Silva', '2015-08-24 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: Presidente G. Vargas,213', '/img/1633 2015_5626422f3439e.pdf', '2015-10-20 11:31:27', '2015-10-20 11:31:27'),
(102, '1624/2015', 'Silvia Rodrigues Mariano da Silva', 'Bruno Mariano da Silva', '2015-08-24 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Santo André', 'Av. Presidente Vargas,1991', '/img/1624 2015_5626429f4b645.pdf', '2015-10-20 11:33:19', '2015-10-20 11:33:19'),
(103, '1627/2015', 'Michel Regina Ferreira', 'Rafael Ferreira De O.', '2015-08-24 00:00:00', '(00)0000-0000', '(67)9665-6084', 'MS', 'Coxim', 'Nova Coxim', 'Valha Estrada,1963', '/img/1627 2015_562642f68e7a2.pdf', '2015-10-20 11:34:46', '2015-10-20 11:34:46'),
(104, '1622/2015', 'Raquel Pinheiro Barriveira', 'João Rocha de Macedo', '2015-08-24 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: Cohab,283', '/img/1622 2015_5626433b76764.pdf', '2015-10-20 11:35:55', '2015-10-20 11:35:55'),
(105, '0307/2015', 'Castorina Vitoria F. Monteiro', 'Ozir Araujo Saldias', '2015-02-19 00:00:00', '(00)0000-0000', '(67)9877-9748', 'MS', 'Coxim', 'Centro', 'R: Marechal Deodoro,30', '/img/307 2015_562644c947b2f.pdf', '2015-10-20 11:42:33', '2015-10-20 11:42:33'),
(106, '0312/2015', 'Maria de Lourdes de Almeida Cruz', 'Lourival', '2015-02-20 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: P. Pedrossian, ----', '/img/312 2015_56264540cb387.pdf', '2015-10-20 11:44:32', '2015-10-20 11:44:32'),
(107, '0338/2015', 'Ivanessa de Souza Borges', 'Elton Barbosa Faustino', '2015-02-25 00:00:00', '(67) 3291-3602', '(00)0000-0000', 'MS', 'Alcinópolis', 'Centro', 'Av.Averaldo F. Barbosa, 349', '/img/338 2015_56264645a8d86.pdf', '2015-10-20 11:48:53', '2015-10-20 11:48:53'),
(108, '0341/2015', 'Lidiana Ríbolis e outro', 'Silvano de Souza', '2015-02-25 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Centro', 'R:dos Carvalhos, 54', '/img/341 2015_5626468726434.pdf', '2015-10-20 11:49:59', '2015-10-20 11:49:59'),
(109, '0324/2015', 'Silvana Oliveira Garcia', 'Willian Douglas V. da Silva', '2015-02-23 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Vila Bela', 'Rua Margarida,109', '/img/324 2015_562646cc2560f.pdf', '2015-10-20 11:51:08', '2015-10-20 11:51:08'),
(110, '1682/2015', 'Maria Lopes de Almeida', 'Osmar Lopes de Almeida', '2015-02-02 00:00:00', '(00)0000-0000', '(67)9633-6244', 'MS', 'Coxim', 'Vila Bela', 'R: Travessa Turquesa,152', '/img/1682 2015_56264721a7893.pdf', '2015-10-20 11:52:33', '2015-10-20 11:52:33'),
(111, '0862/2015', 'Meire Miranda de Morais', 'Jose Roberto da Silva', '2015-05-12 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: Frei Cirino João Primon,1611', '/img/862 2015_5626477797619.pdf', '2015-10-20 11:53:59', '2015-10-20 11:53:59'),
(112, '0902/2015', 'Ana Carolina Gomes Gonçalves', 'Emerson Vais dos Santos', '2015-05-13 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Centro', 'R: Projeto02,18', '/img/902 2015_562647bd959f5.pdf', '2015-10-20 11:55:09', '2015-10-20 11:55:09'),
(113, '0592/2015', 'Tamires Fernanda Lucas Ribeiro', 'Alex Alves de Araújo ', '2015-04-09 00:00:00', '(00)0000-0000', '(67)9803-8231', 'MS', 'Coxim', 'Vila Bela', 'R: Narciso,239', '/img/592 2015_5626488af01bd.pdf', '2015-10-20 11:58:34', '2015-10-20 11:58:34'),
(114, '0680/2015', 'Adilene Casimiro dos Reis', 'José Henrique Casimiro da Silva', '2015-04-17 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: dos Barros,103', '/img/680 2015_562648da4cdc6.pdf', '2015-10-20 11:59:54', '2015-10-20 11:59:54'),
(115, '1670/2015', 'Valdirene Pereira da Costa', 'Alex Sandro da Silva', '2015-10-14 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Piracema', 'R: Três Lagoas,904', '/img/1670 2015_56264c85c2126.pdf', '2015-10-20 12:15:33', '2015-10-20 12:15:33'),
(116, '1967/2015', 'Vanessa Ramos Pinto', 'Dionei Santa Cruz', '2015-10-14 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Vila Bela', 'R: Frei Cirino João Primon,1414', '/img/1967 2015_56264cd975238.pdf', '2015-10-20 12:16:57', '2015-10-20 12:16:57'),
(117, '1973/2015', 'Sirley Alves Dias', 'Monoel Darc Alves de Oliveira', '2015-10-14 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Pequi I e II', 'R: Cambará,166', '/img/1973 2015_56264d1aa04bf.pdf', '2015-10-20 12:18:02', '2015-10-20 12:18:02'),
(118, '1953/2015', 'Eliomar Umbelino de Souza', 'Valdinei Teodoro da Silva e Outro', '2015-10-14 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Alcinópolis', 'Centro', 'Av. Lino Domingos de O.,131', '/img/1953 2015_56264d88ea50b.pdf', '2015-10-20 12:19:52', '2015-10-20 12:19:52'),
(119, '1964/2015', 'Patricia Ferreira de O.', 'Fabio de Moura', '2015-10-14 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Mendes Mourão', 'R: Frederico Lemos Arruda,320', '/img/1964 2015_56264ddd5a25b.pdf', '2015-10-20 12:21:17', '2015-10-20 12:21:17'),
(120, '0701/2015', 'Wechellen Edith Delgado Lopes', 'Domingos Neves Sanches', '2015-04-22 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Vale do Taquari', 'R: Três,43', '/img/701 2015_56264e3c4f501.pdf', '2015-10-20 12:22:52', '2015-10-20 12:22:52'),
(121, '1933/2015', 'Leidiana Gonçalves De Almeida', 'Jeremias Viana Ferreira', '2014-10-09 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Sr.Divino', 'R: José de Oliveira,90', '/img/1933 2015_56265264588a7.pdf', '2015-10-20 12:40:36', '2015-10-20 12:40:36'),
(122, '1930/2015', 'Patricia Cristina do Nasc. Pereira', 'Maureci Padovan', '2014-10-08 00:00:00', '(00)0000-0000', '(67)9803-0760', 'MS', 'Coxim', 'Nova Coxim', 'Av. Campo Grande,560', '/img/1930 2015_562652d65d273.pdf', '2015-10-20 12:42:30', '2015-10-20 12:44:50'),
(123, '1901/2015', 'Josiane Miranda Reis Simião', 'Gean Clay Bell', '2014-10-02 00:00:00', '(00)0000-0000', '(00)0000-0000', 'MS', 'Coxim', 'Centro', 'R: Pereira Gomes,127', '/img/1901 2015_5626531ea1e6f.pdf', '2015-10-20 12:43:42', '2015-10-20 12:44:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medida`
--
ALTER TABLE `medida`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medida`
--
ALTER TABLE `medida`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=124;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
