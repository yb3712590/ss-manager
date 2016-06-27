CREATE TABLE `user` (
  port int(11) NOT NULL,
  uname varchar(20) NOT NULL,
  upasswd varchar(32) NOT NULL,
  ss_passwd int(8) unsigned default NULL,
  email varchar(100) NOT NULL,
  active int(11) default NULL,
  utype int(11) default NULL,
  upload int(11) default NULL,
  download int(11) default NULL,
  transfer_limit int(11) default NULL,
  exp date default NULL,
  PRIMARY KEY  (port),
  UNIQUE KEY uname (uname),
  UNIQUE KEY email (email)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
