-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Servidor: 72.167.154.32
-- Tiempo de generación: 08-09-2012 a las 15:18:44
-- Versión del servidor: 5.0.92
-- Versión de PHP: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `alsuave`
--
CREATE DATABASE `alsuave` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `alsuave`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueo`
--

CREATE TABLE `bloqueo` (
  `bloqueoId` bigint(20) unsigned NOT NULL auto_increment,
  `bloqueoIp` varchar(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  PRIMARY KEY  (`bloqueoId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `click`
--

CREATE TABLE `click` (
  `clickId` bigint(20) unsigned NOT NULL auto_increment,
  `clickDateTime` datetime NOT NULL,
  `userId` bigint(20) NOT NULL,
  `webId` bigint(20) NOT NULL,
  `logId` bigint(20) NOT NULL,
  `userIp` varchar(20) NOT NULL,
  `navegador` varchar(255) NOT NULL,
  PRIMARY KEY  (`clickId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `css`
--

CREATE TABLE `css` (
  `cssId` bigint(20) unsigned NOT NULL auto_increment,
  `cssName` varchar(100) NOT NULL,
  `cssUrl` varchar(255) NOT NULL,
  PRIMARY KEY  (`cssId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `logId` bigint(20) unsigned NOT NULL auto_increment,
  `userId` bigint(20) NOT NULL,
  `logIp` varchar(20) NOT NULL,
  `lodDate` datetime NOT NULL,
  PRIMARY KEY  (`logId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `menuId` bigint(20) unsigned NOT NULL auto_increment,
  `menuName` varchar(200) NOT NULL,
  `menuPermalink` varchar(255) NOT NULL,
  `menuViewer` int(1) NOT NULL default '1',
  `menuRange` bigint(20) NOT NULL,
  `menuOrden` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`menuId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pys`
--

CREATE TABLE `pys` (
  `pysId` bigint(20) unsigned NOT NULL auto_increment,
  `pysTitle` varchar(255) NOT NULL,
  `pysText` text NOT NULL,
  `pysDateTime` datetime NOT NULL,
  `userId` bigint(20) NOT NULL,
  `pysVisit` bigint(20) NOT NULL,
  PRIMARY KEY  (`pysId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pysr`
--

CREATE TABLE `pysr` (
  `pysrId` bigint(20) unsigned NOT NULL auto_increment,
  `pysrText` text NOT NULL,
  `pysrDateTime` datetime NOT NULL,
  `userId` bigint(20) NOT NULL,
  `pysId` bigint(20) NOT NULL,
  PRIMARY KEY  (`pysrId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rango`
--

CREATE TABLE `rango` (
  `rangoId` bigint(20) unsigned NOT NULL auto_increment,
  `rangoName` varchar(100) NOT NULL,
  `rangoColor` varchar(7) NOT NULL,
  PRIMARY KEY  (`rangoId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `short`
--

CREATE TABLE `short` (
  `shortId` bigint(20) unsigned NOT NULL auto_increment,
  `shortCode` varchar(5) NOT NULL,
  `shortUrl` text NOT NULL,
  `shortDateTime` datetime NOT NULL,
  `userId` bigint(20) NOT NULL,
  PRIMARY KEY  (`shortId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tips`
--

CREATE TABLE `tips` (
  `tipId` bigint(20) NOT NULL auto_increment,
  `tipText` longtext NOT NULL,
  PRIMARY KEY  (`tipId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `userId` bigint(20) unsigned NOT NULL auto_increment,
  `userName` varchar(100) NOT NULL,
  `userPass` varchar(200) NOT NULL,
  `userEmail` varchar(200) NOT NULL,
  `userDate` datetime NOT NULL,
  `userClick` int(11) NOT NULL default '0',
  `userRange` varchar(10) NOT NULL,
  PRIMARY KEY  (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `visitaId` bigint(20) unsigned NOT NULL auto_increment,
  `visitaDateTime` datetime NOT NULL,
  `visitaIp` varchar(20) NOT NULL,
  `visitaNavegador` varchar(255) NOT NULL,
  `visitaSource` varchar(255) NOT NULL,
  `webId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  PRIMARY KEY  (`visitaId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web`
--

CREATE TABLE `web` (
  `webId` bigint(20) unsigned NOT NULL auto_increment,
  `webTitle` varchar(255) NOT NULL,
  `webUrl` varchar(255) NOT NULL,
  `webFeed` varchar(255) NOT NULL,
  `webStatus` int(2) NOT NULL default '1',
  `webDateTime` datetime NOT NULL,
  `userId` bigint(20) NOT NULL,
  PRIMARY KEY  (`webId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
