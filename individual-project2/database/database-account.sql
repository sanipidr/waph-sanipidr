create database waph_dilip;

CREATE USER 'dilip'@'localhost' IDENTIFIED BY '12345';
GRANT ALL ON waph_dilip.* TO 'dilip'@'localhost';
