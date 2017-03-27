/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.5.20-log : Database - db_javalearning
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_javalearning` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_javalearning`;

/*Table structure for table `tb_class` */

DROP TABLE IF EXISTS `tb_class`;

CREATE TABLE `tb_class` (
  `cno` char(10) NOT NULL,
  `classname` varchar(30) DEFAULT NULL,
  `cdate` date DEFAULT NULL,
  `coursename` varchar(20) DEFAULT NULL,
  `tno` char(10) DEFAULT NULL,
  PRIMARY KEY (`cno`),
  KEY `fk_tno1` (`tno`),
  CONSTRAINT `fk_tno1` FOREIGN KEY (`tno`) REFERENCES `tb_teacher` (`tno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_class` */

insert  into `tb_class`(`cno`,`classname`,`cdate`,`coursename`,`tno`) values ('0011602','软件1602','2017-03-21','Java','07002'),('0011603','计科1603','2017-03-21','Java','07002'),('20130701','13级计算机1班','2013-09-01','JAVA','07001'),('20130702','13级计算机2班','2013-09-01','JAVA','07001'),('20140701','14级计算机1班','2014-09-01','JAVA','07002'),('20150701','15级计算机1班','2015-09-01','JAVA','07003');

/*Table structure for table `tb_plate` */

DROP TABLE IF EXISTS `tb_plate`;

CREATE TABLE `tb_plate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '版主',
  `plate_name` varchar(20) DEFAULT NULL COMMENT '版块名',
  `class_id` int(11) DEFAULT NULL COMMENT '班级id',
  `class_name` varchar(25) DEFAULT NULL COMMENT '班级名',
  `time` int(11) DEFAULT NULL COMMENT '创建日期',
  `posts_count` int(11) DEFAULT NULL COMMENT '帖子条数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='版块表';

/*Data for the table `tb_plate`  */

insert  into `tb_plate`(`id`,`uid`,`plate_name`,`class_id`,`class_name`,`time`,`posts_count`) values (1,7002,'课堂提问',11602,'软件1602',1490109654,0),(2,7002,'课堂问答',11602,'软件1602',1490198303,0),(3,7001,'作业提问',20130701,'13级计算机1班',1490364157,0),(4,7001,'课程提问',20130702,'13级计算机2班',1490364165,0),(5,7001,'体育',20130701,'13级计算机1班',1490364183,0),(6,7002,'计算机培训',20130701,'13级计算机1班',1490408812,0);

/*Table structure for table `tb_posts` */

DROP TABLE IF EXISTS `tb_posts`;

CREATE TABLE `tb_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL COMMENT '帖子标题',
  `content` text COMMENT '帖子内容',
  `post_time` int(11) DEFAULT NULL COMMENT '发布时间',
  `from_uid` int(11) DEFAULT NULL COMMENT '发布者ID',
  `from_uname` varchar(25) DEFAULT NULL COMMENT '发布者名',
  `role_id` tinyint(4) DEFAULT NULL COMMENT '发布者类型1:学生 2:教师',
  `reply_count` int(11) DEFAULT NULL COMMENT '回复条数',
  `plate_id` int(11) DEFAULT NULL COMMENT '所属版块ID',
  `plate_name` varchar(25) DEFAULT NULL COMMENT '所属版块名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='帖子表';

/*Data for the table `tb_posts` */

insert  into `tb_posts`(`id`,`title`,`content`,`post_time`,`from_uid`,`from_uname`,`role_id`,`reply_count`,`plate_id`,`plate_name`) values (1,'昨天作业问题','错了好多啊！',1490371369,7001,'张华',2,3,3,'作业提问'),(4,'休息','水电发电股份的规范化',1490498263,7001,'张华',2,3,5,'体育'),(5,'系统错误','双方的首发东莞分行国际',1490511010,7001,'张华',2,1,5,'体育');

/*Table structure for table `tb_private_message` */

DROP TABLE IF EXISTS `tb_private_message`;

CREATE TABLE `tb_private_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `from_uid` int(11) DEFAULT NULL COMMENT '发送者ID',
  `from_role` int(11) DEFAULT NULL COMMENT '发送者类型1：学生 2：教师',
  `from_name` varchar(25) DEFAULT NULL COMMENT '发送者',
  `to_uid` int(11) DEFAULT NULL COMMENT '接收者ID',
  `to_role` int(11) DEFAULT NULL COMMENT '接收类型1：学生 2：教师',
  `send_time` int(11) DEFAULT NULL COMMENT '发送时间',
  `status` tinyint(4) DEFAULT NULL COMMENT '信息状态1：用户未查看 2:用户已查看',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='私信(站内信)表';

/*Data for the table `tb_private_message` */

insert  into `tb_private_message`(`id`,`title`,`content`,`from_uid`,`from_role`,`from_name`,`to_uid`,`to_role`,`send_time`,`status`) values (1,'放假通知','豆腐干大概电话费基金会法规和法国恢复减肥减肥',7001,2,'张华',1407001,1,1490511631,2),(2,'考试通知','该放就放赶紧赶紧放假放假',7001,2,'张华',1507002,1,1490511897,2),(4,'回复','老师，教师节快乐！',1407001,1,'王丽莎',7001,2,1490512403,2),(5,'休息','下课了，老师',1407001,1,'王丽莎',7001,2,1490512421,2);

/*Table structure for table `tb_reply` */

DROP TABLE IF EXISTS `tb_reply`;

CREATE TABLE `tb_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COMMENT '回复内容',
  `post_id` int(11) DEFAULT NULL COMMENT '回复帖子ID',
  `uid` int(11) DEFAULT NULL COMMENT '回复者ID',
  `uname` varchar(25) DEFAULT NULL COMMENT '回复者名',
  `reply_time` int(11) DEFAULT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='回复表';

/*Data for the table `tb_reply` */

insert  into `tb_reply`(`id`,`content`,`post_id`,`uid`,`uname`,`reply_time`) values (1,'呵呵呵呵呵额呵呵',1,7001,'张华',1490460174),(2,'梵蒂冈豆腐干',1,7001,'张华',1490460238),(3,'准备睡觉了，呵呵呵！',2,7001,'张华',1490460302),(4,'看，凯莉克莱克森',1,7001,'张华',1490460397),(5,'的方式广泛大概后风格和法国恢复感觉',2,7001,'张华',1490460410),(9,'的规定发给对方对方好过',4,7001,'张华',1490498272),(10,'废钢价格将会根据规划',4,7001,'张华',1490498280),(11,'尽快修复问题',5,1407001,'王丽莎',1490512364);

/*Table structure for table `tb_student` */

DROP TABLE IF EXISTS `tb_student`;

CREATE TABLE `tb_student` (
  `sno` char(10) NOT NULL,
  `sname` varchar(20) DEFAULT NULL,
  `ssex` char(2) DEFAULT NULL,
  `semail` varchar(30) DEFAULT NULL,
  `cno` char(10) DEFAULT NULL,
  `sdept` varchar(20) DEFAULT NULL,
  `spassword` char(20) DEFAULT NULL,
  `sbirth` date DEFAULT NULL,
  `remark` char(2) DEFAULT NULL,
  PRIMARY KEY (`sno`),
  KEY `fk_cno` (`cno`),
  CONSTRAINT `fk_cno` FOREIGN KEY (`cno`) REFERENCES `tb_class` (`cno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_student` */

insert  into `tb_student`(`sno`,`sname`,`ssex`,`semail`,`cno`,`sdept`,`spassword`,`sbirth`,`remark`) values ('1307001','刘丽','女','47485@126.com','0011602','信息学院','liuli',NULL,'0'),('1307002','李菲','女','limchristina@163.com','0011603','信息学院','lifei',NULL,NULL),('1307003','刘小刚','男','43658@qq.com','0011603','信息学院','liuxiaogang',NULL,NULL),('1407001','王丽莎','女','45768@qq.com','20130701','信息学院','wanglisha',NULL,NULL),('1507002','陈小兵','男','961@qq.com','20130701','信息学院','chenxiaobing',NULL,NULL);

/*Table structure for table `tb_teacher` */

DROP TABLE IF EXISTS `tb_teacher`;

CREATE TABLE `tb_teacher` (
  `tno` char(10) NOT NULL COMMENT '教师编号',
  `tname` varchar(20) DEFAULT NULL COMMENT '姓名',
  `tsex` char(2) DEFAULT NULL COMMENT '性别',
  `tdept` varchar(20) DEFAULT NULL COMMENT '所在院系',
  `temail` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `tpassword` char(20) DEFAULT NULL COMMENT '密码',
  `admin` varchar(2) DEFAULT NULL COMMENT '是否是管理员1：是 0：不是',
  PRIMARY KEY (`tno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tb_teacher` */

insert  into `tb_teacher`(`tno`,`tname`,`tsex`,`tdept`,`temail`,`tpassword`,`admin`) values ('07001','张华','女','信息学院','12345@126.com','zhanghua','0'),('07002','李勇','男','信息学院','961028029@qq.com','liyong','1'),('07003','王敏','女','信息学院','123@163.com','wangmin','0');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
