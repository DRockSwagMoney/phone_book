CREATE DATABASE phone_book;
CREATE TABLE contact_names (
  id int NOT NULL AUTO_INCREMENT,
  firstname varchar(255),
  lastname varchar(255),
  PRIMARY KEY (id)
);
CREATE TABLE phone_numbers (
  id int NOT NULL AUTO_INCREMENT,
  userid int,
  number varchar(255),
  PRIMARY KEY (id),
  CONSTRAINT fk_userid_number FOREIGN KEY (userid)
  REFERENCES contact_names(id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE emails (
  id int NOT NULL AUTO_INCREMENT,
  userid int,
  email varchar(255),
  PRIMARY KEY (id),
  CONSTRAINT fk_userid_email FOREIGN KEY (userid)
  REFERENCES contact_names(id) ON DELETE CASCADE ON UPDATE CASCADE
);