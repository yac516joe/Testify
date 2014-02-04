--
-- Table structure for table `categories_db`
--

CREATE TABLE `categories_db` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `name` varchar(32) collate utf8_unicode_ci NOT NULL,
  `contains` int(6) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories_db`
--

INSERT INTO `categories_db` VALUES(1, 'Notebooks', 3);
INSERT INTO `categories_db` VALUES(2, 'Smartphones', 4);
INSERT INTO `categories_db` VALUES(3, 'Tablets', 4);

--------------------------------------------------------------------
--
-- Table Structure for cuisine_db , the menu database
--

Menu Database - cuisine_db
CREATE TABLE cuisine_db (
  id INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  diner_id INT(3) NOT NULL,
    FOREIGN KEY (diner_id) REFERENCES diner_db(id),
  name VARCHAR (50) NOT NULL,
  category int(6) NOT NULL,
    FOREIGN KEY (category) REFERENCES categories_db(id);
  price FLOAT(4,2) NOT NULL,
  option_vegi BOOL ,
  option_light BOOL ,
  option_hot BOOL 
);

--
--Insert Query example
--

INSERT INTO cuisine_db(
  diner_id,name, type, price, option_vegi, option_light, option_hot
  ) VALUES (
  1,'Cottage Pie2','main',5.99,0,0,0); 

--------------------------------------------------------------------

--
-- Table structure for user_db, the user database
--


CREATE TABLE user_db (
  id INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,
  gender VARCHAR(10) ,
  fname VARCHAR(30) NOT NULL,
  lname VARCHAR(30) NOT NULL,
  join_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--
--Insert Query example
--
 INSERT INTO user_db
 (email,password,gender,fname,lname) 
 VALUES ('admin','admin','Male','Zhou','Jacob'); 

--------------------------------------------------------------------

--
-- Table sturcture of diner_db the diner databse
--

CREATE TABLE diner_db (
  id INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL, 
  location INT(4));

--------------------------------------------------------------------

--
--Rating Database - rating———for collaborative filtering
--

CREATE TABLE rating(user_id INT(3)  NOT NULL,FOREIGN KEY (user_id) REFERENCES user_db(id),cuisine_id INT(3) NOT NULL,FOREIGN KEY (cuisine_id) REFERENCES cuisine_db(id),rating INT NOT NULL,date_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (user_id ,cuisine_id)); 

    CREATE TABLE IF NOT EXISTS `rating_db` (
      `user_id` int(3) NOT NULL,FOREIGN KEY (uc_users) REFERENCES user_db(id),
      `cuisine_id` int(3) NOT NULL,FOREIGN KEY (cuisine_id) REFERENCES cuisine_db(id),
      `rating` decimal(11,2) NOT NULL default '0.00',
      KEY `item_id` (`cuisine_id`),
      KEY `user_id` (`user_id`,`cuisine_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8; 

--    
--Insert Query Example:
--
 INSERT INTO rating (user_id,cuisine_id,rating) values (2,55,4); 

--------------------------------------------------------------------

--
--Visit Record - visit_db
--

CREATE TABLE visit_db (
  id INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
  user_id INT(3) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user_db(id),
  diner_id INT(3) NOT NULL,
    FOREIGN KEY (diner_id) REFERENCES diner_db(id)
); 

--------------------------------------------------------------------

--
--Visit History - history_db
--

CREATE TABLE history_db (
  visit_id INT(3) NOT NULL PRIMARY KEY,
    FOREIGN KEY (visit_id) REFERENCES visit_db(id),
  cuisine_id INT(3) NOT NULL,
    FOREIGN KEY (cuisine_id) REFERENCES cuisine_db(id)
);

--------------------------------------------------------------------

--
--Develop database - dev
--

CREATE TABLE dev(itemID1 int (11) NOT NULL default ’0 ’ , itemID2 int (11) NOT NULL default ’0 ’ , count int (11) NOT NULL default ’0 ’ , sum int(11) NOT NULL default ’0’,PRIMARY KEY ( itemID1 , itemID2 ));

   CREATE TABLE IF NOT EXISTS `slope_one` (
      `item_id1` int(3) NOT NULL, FOREIGN KEY(item_id1) REFERENCES cuisine_db(id),
      `item_id2` int(3) NOT NULL, FOREIGN KEY (item_id2) REFERENCES cuisine_db(id),
      `times` int(11) NOT NULL,
      `rating` decimal(11,2) NOT NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8; 
 
 --------------------------------------------------------------------