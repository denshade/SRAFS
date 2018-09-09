
CREATE DATABASE `srafs` /*!40100 DEFAULT CHARACTER SET utf8 */;



CREATE TABLE `standardelements` (
  `elementid` int(11) NOT NULL AUTO_INCREMENT,
  `standardid` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`elementid`),
  UNIQUE KEY `elementid_UNIQUE` (`elementid`),
  KEY `standardid_idx` (`standardid`),
  CONSTRAINT `standardid` FOREIGN KEY (`standardid`) REFERENCES `standardversion` (`standardid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `standardversion` (
  `standardid` int(11) NOT NULL,
  `standardname` varchar(255) NOT NULL,
  `version` varchar(45) NOT NULL,
  `description` mediumtext,
  PRIMARY KEY (`standardid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


LOAD  DATA LOCAL INFILE 'C:\\ProgramData\\MySQL\\MySQL Server 5.7\\Uploads\\codes icd10.csv'
INTO TABLE standardelements
IGNORE 1 LINES;
