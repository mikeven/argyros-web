/*
SQLyog Community v10.2 
MySQL - 5.7.11 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `countries` (
	`id` int (10),
	`code` varchar (6),
	`name` varchar (765),
	`phone_code` varchar (15),
	`created_at` timestamp ,
	`updated_at` timestamp ,
	`manufacture` tinyint (1)
); 
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('1','AR','Argentina','54',NULL,NULL,'1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('2','BO','Bolivia','591',NULL,'2017-09-19 10:09:24','1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('3','BR','Brasil','55',NULL,NULL,'0');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('4','CA','Canadá','1',NULL,'2017-09-18 15:25:11','0');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('5','CL','Chile','56',NULL,NULL,'0');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('6','CO','Colombia','57',NULL,'2017-10-13 13:11:34','1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('7','CR','Costa Rica','506',NULL,NULL,'0');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('8','CW','Curaçao','599',NULL,NULL,'0');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('9','EC','Ecuador','593',NULL,'2017-09-19 10:00:48','0');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('10','SV','El Salvador','503',NULL,'2017-09-19 10:00:49','1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('11','US','Estados Unidos','1',NULL,'2017-09-19 10:00:49','1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('12','GT','Guatemala','502',NULL,'2017-09-19 10:00:50','1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('13','HT','Haití','509',NULL,'2017-09-19 10:00:51','1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('14','HN','Honduras','504',NULL,'2017-09-19 10:00:51','1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('15','JM','Jamaica','1',NULL,'2017-09-19 10:00:53','1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('16','MX','México','52',NULL,NULL,'0');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('17','NI','Nicaragua','505',NULL,NULL,'0');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('18','PA','Panamá','507',NULL,'2017-09-19 10:01:03','1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('19','PY','Paraguay','595',NULL,NULL,'0');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('20','PE','Perú','51',NULL,'2017-09-19 10:09:29','1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('21','DO','República Dominicana','1',NULL,'2017-09-19 10:09:27','1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('22','UY','Uruguay','598',NULL,NULL,'0');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('23','VE','Venezuela','58',NULL,NULL,'0');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('24','CN','China','86',NULL,NULL,'1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('25','IT','Italia','39',NULL,NULL,'1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('26','PT','Portugal','351',NULL,NULL,'1');
insert into `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) values('27','TH','Tailandia','66',NULL,NULL,'1');
