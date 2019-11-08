-- Adminer 4.7.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `ocr`;
CREATE DATABASE `ocr` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ocr`;

DROP TABLE IF EXISTS `acteur`;
CREATE TABLE `acteur` (
                          `id_acteur` int(11) NOT NULL AUTO_INCREMENT,
                          `acteur` varchar(100) NOT NULL,
                          `description` longtext NOT NULL,
                          `logo` varchar(250) NOT NULL,
                          PRIMARY KEY (`id_acteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `acteur` (`id_acteur`, `acteur`, `description`, `logo`) VALUES
(1,	'Formation&co',	'Formation&co est une association française présente sur tout le territoire.\r\nNous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.\r\nNotre proposition : \r\n- un financement jusqu’à 30 000€ ;\r\n- un suivi personnalisé et gratuit ;\r\n- une lutte acharnée contre les freins sociétaux et les stéréotypes.\r\n\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.\r\nVous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.',	'formation_co.png'),
(2,	'Protectpeople',	'Protectpeople finance la solidarité nationale.\r\nNous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.\r\n\r\nChez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.\r\nProectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.\r\nNous garantissons un accès aux soins et une retraite.\r\nChaque année, nous collectons et répartissons 300 milliards d’euros.\r\nNotre mission est double :\r\nsociale : nous garantissons la fiabilité des données sociales ;\r\néconomique : nous apportons une contribution aux activités économiques.',	'protectpeople.png'),
(3,	'Dsa France',	'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.\r\nNotre philosophie : s’adapter à chaque entreprise.\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises.',	'Dsa_france.png'),
(4,	'CDE',	'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. \r\nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.',	'CDE.png');

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
                        `id_post` int(11) NOT NULL AUTO_INCREMENT,
                        `id_user` int(11) NOT NULL,
                        `id_acteur` int(11) NOT NULL,
                        `date_add` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
                        `post` longtext NOT NULL,
                        PRIMARY KEY (`id_post`),
                        KEY `id_user` (`id_user`),
                        KEY `id_acteur` (`id_acteur`),
                        CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
                        CONSTRAINT `post_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id_user` int(11) NOT NULL AUTO_INCREMENT,
                         `nom` varchar(50) NOT NULL,
                         `prenom` varchar(50) NOT NULL,
                         `username` varchar(50) NOT NULL,
                         `password` varchar(50) NOT NULL,
                         `question` varchar(50) NOT NULL,
                         `reponse` varchar(50) NOT NULL,
                         PRIMARY KEY (`id_user`),
                         UNIQUE KEY `login` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
                        `id_vote` int(11) NOT NULL AUTO_INCREMENT,
                        `id_user` int(11) NOT NULL,
                        `id_acteur` int(11) NOT NULL,
                        `vote` tinyint(1) NOT NULL,
                        PRIMARY KEY (`id_vote`),
                        UNIQUE KEY `id_user_id_acteur` (`id_user`,`id_acteur`),
                        KEY `id_vote` (`id_vote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2019-11-08 10:49:02
