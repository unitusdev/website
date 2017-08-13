SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `unitus` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `unitus`;

CREATE TABLE `tblmarketcap` (
  `moment` datetime NOT NULL,
  `supply` double(25,8) NOT NULL,
  `btc` double(15,8) NOT NULL,
  `usd` double(15,8) NOT NULL
) ENGINE=Aria DEFAULT CHARSET=latin1;

CREATE TABLE `tblmiscdata` (
  `name` varchar(20) NOT NULL,
  `updated` datetime NOT NULL,
  `data` varchar(1024) NOT NULL
) ENGINE=Aria DEFAULT CHARSET=latin1;

INSERT INTO `tblmiscdata` (`name`, `updated`, `data`) VALUES
('uisinfo', '2017-08-13 20:40:02', ''),
('burnt', '2017-08-13 20:40:04', '17025663.06832745');

CREATE TABLE `tblnetworkblocks` (
  `hash` varchar(64) NOT NULL,
  `height` int(10) UNSIGNED NOT NULL,
  `pow_algo` tinyint(3) UNSIGNED NOT NULL,
  `pow_hash` varchar(64) NOT NULL,
  `difficulty` double NOT NULL,
  `time` int(11) NOT NULL,
  `moment` datetime NOT NULL,
  `elapsed` int(11) NOT NULL,
  `algo_elapsed` int(11) NOT NULL,
  `nonce` int(11) NOT NULL,
  `auxpow` tinyint(1) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `coinbase` varchar(256) NOT NULL,
  `pool` varchar(100) NOT NULL
) ENGINE=Aria DEFAULT CHARSET=latin1;

CREATE TABLE `tblpeers` (
  `address` varchar(39) NOT NULL,
  `direction` varchar(10) NOT NULL,
  `version` varchar(15) NOT NULL,
  `lastseen` datetime NOT NULL,
  `connected` tinyint(1) NOT NULL DEFAULT '0',
  `addressType` varchar(4) NOT NULL,
  `addressHex` varchar(32) NOT NULL
) ENGINE=Aria DEFAULT CHARSET=latin1;

CREATE TABLE `tblrewards` (
  `start` int(10) UNSIGNED NOT NULL,
  `end` int(10) UNSIGNED NOT NULL,
  `blockval` decimal(15,8) NOT NULL,
  `startval` decimal(22,8) NOT NULL,
  `blocksat` bigint(20) UNSIGNED NOT NULL,
  `startsat` bigint(20) UNSIGNED NOT NULL
) ENGINE=Aria DEFAULT CHARSET=latin1;

CREATE TABLE `tblxrate` (
  `moment` datetime NOT NULL,
  `exchange` varchar(20) NOT NULL,
  `last` decimal(15,8) NOT NULL,
  `high` decimal(15,8) NOT NULL,
  `low` decimal(15,8) NOT NULL,
  `volume` decimal(15,8) UNSIGNED NOT NULL
) ENGINE=Aria DEFAULT CHARSET=latin1;


ALTER TABLE `tblmarketcap`
  ADD PRIMARY KEY (`moment`);

ALTER TABLE `tblmiscdata`
  ADD PRIMARY KEY (`name`);

ALTER TABLE `tblnetworkblocks`
  ADD PRIMARY KEY (`hash`),
  ADD KEY `height` (`height`,`pow_algo`),
  ADD KEY `time` (`time`);

ALTER TABLE `tblpeers`
  ADD PRIMARY KEY (`address`);

ALTER TABLE `tblrewards`
  ADD PRIMARY KEY (`start`,`end`);

ALTER TABLE `tblxrate`
  ADD PRIMARY KEY (`moment`,`exchange`);
COMMIT;
