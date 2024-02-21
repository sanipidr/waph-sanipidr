create table users(
  username varchar(50) PRIMARY KEY,
  Password varchar(100) NOT NULL);
INSERT INTO users(username,Password) VALUES ('dilip',md5('dilip@123'));