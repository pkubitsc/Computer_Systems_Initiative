USE haloc;

-- Drop all tables if they exist to make a clean slate
DROP TABLE IF EXISTS Following;
DROP TABLE IF EXISTS Post_Hashtags;
DROP TABLE IF EXISTS PostLikes;
DROP TABLE IF EXISTS Hashtags;
DROP TABLE IF EXISTS Posts;
DROP TABLE IF EXISTS Users;

CREATE TABLE `Users` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_name` varchar(25) DEFAULT NULL,
  `FirstName` varchar(128) NOT NULL,
  `LastName` varchar(128) NOT NULL,
  `Password` binary(32) NOT NULL,
  `Session_id` varchar(40) NOT NULL,
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `User_name` (`User_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci;


CREATE TABLE `Posts` (
  `Post_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL DEFAULT '0',
  `Parent_id` int(11) NOT NULL DEFAULT '0',
  `Post_content` varchar(200) NOT NULL,
  `Post_likes` int(11) NOT NULL DEFAULT '0',
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Post_id`),
  FOREIGN KEY (`User_id`)
	REFERENCES `Users` (`User_id`)
	ON DELETE CASCADE
	ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci;


CREATE TABLE `PostLikes` (
  `Post_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`Post_id`)
	REFERENCES `Users` (`User_id`)
	ON DELETE CASCADE
	ON UPDATE NO ACTION,
  FOREIGN KEY (`Post_id`)
	REFERENCES `Posts` (`Post_id`)
	ON DELETE CASCADE
	ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci;


CREATE TABLE `Hashtags` (
  `Hashtag_id` int(11) NOT NULL AUTO_INCREMENT,
  `Hashtag` varchar(200) NOT NULL,
  PRIMARY KEY (`Hashtag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci;


CREATE TABLE `Post_Hashtags` (
  `Hashtag_id` int(11) NOT NULL,
  `Post_id` int(11) NOT NULL,
  FOREIGN KEY (`Hashtag_id`)
	REFERENCES `Hashtags` (`Hashtag_id`)
	ON DELETE CASCADE
	ON UPDATE NO ACTION,
  FOREIGN KEY (`Post_id`)
	REFERENCES `Posts` (`Post_id`)
	ON DELETE CASCADE
	ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci;


CREATE TABLE `Following` (
  `Following_id` int(11) NOT NULL DEFAULT '0',
  `User_id` int(11) NOT NULL,
  `Hashtag_id` int(11) NOT NULL DEFAULT '0',
  FOREIGN KEY (`Hashtag_id`)
	REFERENCES `Hashtags` (`Hashtag_id`)
	ON DELETE CASCADE
	ON UPDATE NO ACTION,
  FOREIGN KEY (`User_id`)
	REFERENCES `Users` (`User_id`)
	ON DELETE CASCADE
	ON UPDATE NO ACTION,
  FOREIGN KEY (`Following_id`)
	REFERENCES `Users` (`User_id`)
	ON DELETE CASCADE
	ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci;


