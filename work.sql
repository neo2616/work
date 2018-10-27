/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : work

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-08-14 21:34:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for w_answer
-- ----------------------------
DROP TABLE IF EXISTS `w_answer`;
CREATE TABLE `w_answer` (
  `a_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_hidden` char(5) DEFAULT 'T',
  `is_comment` char(5) DEFAULT 'T',
  `mg_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for w_huashu
-- ----------------------------
DROP TABLE IF EXISTS `w_huashu`;
CREATE TABLE `w_huashu` (
  `huashu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `mg_id` int(11) DEFAULT '0',
  PRIMARY KEY (`huashu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_huashu
-- ----------------------------
INSERT INTO `w_huashu` VALUES ('1', '您好，您加我是想了解学习网赚吗？', '2018-08-13 19:03:25', '1');
INSERT INTO `w_huashu` VALUES ('2', '我们团队主要是利用彩票计划公式赚钱的，采用合理的倍投方式按照群计划购买国家正规的彩票赚钱，有兴趣加入我们吗？', '2018-08-13 19:04:32', '1');
INSERT INTO `w_huashu` VALUES ('3', '我们团队是操作国家地方福利彩票的哦，你对彩票有接触过或者有什么误解吗 有误解的话你要把问题提出来，我给你讲解，不然误解一直存在的。', '2018-08-13 19:04:37', '1');
INSERT INTO `w_huashu` VALUES ('4', '嗯，您会不会觉得彩票中奖率低？想中很难，会不赚钱？', '2018-08-13 19:06:34', '1');
INSERT INTO `w_huashu` VALUES ('5', '简单说：就是只需要一部手机，在网上彩票站投注，在结合我们的网赚技巧，每天盈利本金的20%，30%是很轻松的。', '2018-08-13 19:10:22', '1');
INSERT INTO `w_huashu` VALUES ('6', '亲，我们团队提供预测结果大小来进行投注，不是让你乱买的，是有计划的买，有计划的盈利，前期不需要您任何投资的。', '2018-08-13 19:10:29', '1');
INSERT INTO `w_huashu` VALUES ('7', '亲，我们的网赚项目需要理性投资的。我先教你我们项目基本的赚钱技巧，然后我拉你进群观摩，可以接受的话，我再教你怎么操作！', '2018-08-13 19:10:36', '1');
INSERT INTO `w_huashu` VALUES ('8', '首先需要注册一个账号，注册好了先不要充值，我先教你最基本的盈利操作可以接受吗亲？', '2018-08-13 19:10:45', '1');
INSERT INTO `w_huashu` VALUES ('9', '那你可以按照我的操作步骤来。先注册会员账号，我教你看计划，教你操作，开始你先不用投资，觉得赚钱再操作，不赚钱就不操作，对你没有一点损失对吧？', '2018-08-13 19:10:51', '1');
INSERT INTO `w_huashu` VALUES ('10', 'www.6f100.com，复制这个网址直接到浏览器打开注册，请使用本机浏览器或谷歌浏览器打开，不要使用微信直接打开。', '2018-08-13 19:10:58', '1');
INSERT INTO `w_huashu` VALUES ('11', '注册好联系我，我教你下一步操作', '2018-08-13 19:11:05', '1');
INSERT INTO `w_huashu` VALUES ('12', '亲，麻烦把你的账号发给我一下哦，我好给你做备注。', '2018-08-13 19:11:13', '1');
INSERT INTO `w_huashu` VALUES ('13', '您自己尝试了就知道了，如果是诈骗的，您在正规渠道上看得到我们吗？您认为我们花了这么大广告，骗您10元，能干吗呢，机会是您自己去尝试和把握的，我们又不强求你去玩，是看你自己，我又不强求你，我带你是赚钱，而不是求你明白吗亲？', '2018-08-13 19:11:20', '1');
INSERT INTO `w_huashu` VALUES ('14', '这是群里计划老师发的计划表，大就是买大，小就是买小，一倍就是投注一元，三倍就是投注三元，以此类推哦，能明白吗？', '2018-08-13 19:11:27', '1');
INSERT INTO `w_huashu` VALUES ('15', '（五期倍投表）这个是我们团队五期盈利倍投计划表，你可以看看，不懂问我哦', '2018-08-13 19:11:35', '1');
INSERT INTO `w_huashu` VALUES ('16', '不要在乎1期2期3期不中，我们本金是5期，倍数越高赚的越多，5期内中奖是几乎没有风险的。', '2018-08-13 19:11:42', '1');
INSERT INTO `w_huashu` VALUES ('17', '会员进群观察找你充值，一定要问 是否已经学会？是否看得懂如何操作 如何赚钱盈利？确定之后告诉他再让他充值。', '2018-08-13 19:11:48', '1');
INSERT INTO `w_huashu` VALUES ('18', '亲你需要充值投注才能盈利哦，最低充值10元，最低投注1元，最低出款100元哦', '2018-08-13 19:11:55', '1');
INSERT INTO `w_huashu` VALUES ('19', '现在商家新人平台有活动，我建议你充值100元送18元，可以跟上我们五期计划，我们五期计划中奖率有89%呢', '2018-08-13 19:12:01', '1');
INSERT INTO `w_huashu` VALUES ('20', '前面几期计划本金都是送的18元，等于是用别人送的钱来赚钱，前面几期中奖是不需要自己本金的，如果觉得赚不到钱，你可以把100元本金提现哦，你一分钱也不会亏对吧？', '2018-08-13 19:12:08', '1');


-- ----------------------------
-- Table structure for w_manager
-- ----------------------------
DROP TABLE IF EXISTS `w_manager`;
CREATE TABLE `w_manager` (
  `mg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mg_name` char(30) DEFAULT '',
  `password` varchar(70) DEFAULT '',
  `role_id` int(11) DEFAULT '0',
  `sesstion_id` varchar(70) DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` char(10) DEFAULT 'OFF',
  `login_ip` varchar(20) DEFAULT '',
  `last_login_time` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT '',
  `desc` text,
  PRIMARY KEY (`mg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_manager
-- ----------------------------
INSERT INTO `w_manager` VALUES ('1', 'admin123', '$2y$10$L2emKEO6s00Jxsvk8Vd4hO/y1gYPmCtHZueXVj7iblbqhOupS7qsG', null, '', '2018-08-01 15:26:47', '2018-08-14 12:38:15', null, 'on', '127.0.0.1', '2018-08-10 17:30:54', 'jwWSxlID2MuDErvgv7Le1YCWoT91I4fEbokLuwAgc1A1jY3TpZLnlG5MY6Uj', '我是root管理员ok');

-- ----------------------------
-- Table structure for w_note
-- ----------------------------
DROP TABLE IF EXISTS `w_note`;
CREATE TABLE `w_note` (
  `note_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gf_counts` int(255) DEFAULT '0',
  `rg_counts` int(255) DEFAULT '0',
  `rg_platform` char(15) DEFAULT '',
  `money_in_counts` int(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_submit` enum('0','1') DEFAULT '0',
  `wx_id` int(11) DEFAULT '0',
  `mg_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


-- Table structure for w_permission
-- ----------------------------
DROP TABLE IF EXISTS `w_permission`;
CREATE TABLE `w_permission` (
  `ps_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ps_name` varchar(20) DEFAULT '',
  `ps_pid` int(11) DEFAULT '0',
  `ps_c` varchar(32) DEFAULT '',
  `ps_a` varchar(32) DEFAULT '',
  `ps_route` varchar(100) DEFAULT '',
  `ps_level` enum('0','1','2') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ps_id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_permission
-- ----------------------------
INSERT INTO `w_permission` VALUES ('101', '笔记相关', '0', '', '', '', '0', '2018-08-08 19:20:58', null, null);
INSERT INTO `w_permission` VALUES ('102', '问题和话术', '0', '', '', '', '0', null, '2018-08-08 22:09:33', null);
INSERT INTO `w_permission` VALUES ('103', '权限管理', '0', '', '', '', '0', null, null, null);
INSERT INTO `w_permission` VALUES ('104', '微信管理', '101', 'Weixin', 'index', '/weixin/index', '1', null, '2018-08-10 16:24:57', null);
INSERT INTO `w_permission` VALUES ('105', '开始笔记', '101', 'Note', 'index', '/note/index', '1', '2018-08-08 19:21:07', '2018-08-10 14:24:33', null);
INSERT INTO `w_permission` VALUES ('106', '查看提交信息', '101', 'Checknote', 'index', '/checknote/index', '1', null, '2018-08-12 20:55:35', null);
INSERT INTO `w_permission` VALUES ('107', '问题管理', '102', 'Question', 'index', '/question/index', '1', '2018-08-08 19:21:10', '2018-08-09 13:38:19', null);
INSERT INTO `w_permission` VALUES ('108', '话术列表', '102', 'HuaShu', 'index', '/huashu/index', '1', null, '2018-08-08 22:14:21', null);
INSERT INTO `w_permission` VALUES ('109', '用户列表', '103', 'Manager', 'index', '/manager/index', '1', '2018-08-08 22:09:02', '0000-00-00 00:00:00', null);
INSERT INTO `w_permission` VALUES ('110', '角色列表', '103', 'Role', 'index', '/role/index', '1', '2018-08-08 19:21:12', null, null);
INSERT INTO `w_permission` VALUES ('111', '权限列表', '103', 'Permission', 'index', '/permission/index', '1', null, '2018-08-09 13:47:28', null);
INSERT INTO `w_permission` VALUES ('112', '管理员列表的显示', '109', 'Manager', 'index', '/manager/index', '2', '2018-08-08 21:03:29', '2018-08-08 22:08:51', '2018-08-08 22:08:51');
INSERT INTO `w_permission` VALUES ('113', '管理员ajax分页查询', '109', 'Manager', 'ajax', '/manager/ajax', '2', '2018-08-08 21:05:42', '2018-08-08 21:05:42', null);
INSERT INTO `w_permission` VALUES ('114', '管理员添加页面显示', '109', 'Manager', 'getmanagerview', '/manager/getmanagerview', '2', '2018-08-08 21:11:42', '2018-08-08 21:11:42', null);
INSERT INTO `w_permission` VALUES ('115', '管理员数据保存', '109', 'Manager', 'storemanager', '/manager/storemanager', '2', '2018-08-08 21:12:06', '2018-08-09 13:37:51', null);
INSERT INTO `w_permission` VALUES ('116', '管理员删除', '109', 'Manager', 'delmanager', '/manager/delmanager', '2', '2018-08-08 21:15:46', '2018-08-08 21:15:46', null);
INSERT INTO `w_permission` VALUES ('117', '管理员状态', '109', 'Manager', 'setstatus', '/manager/setstatus', '2', '2018-08-08 21:16:15', '2018-08-08 21:16:15', null);
INSERT INTO `w_permission` VALUES ('118', '管理员编辑页面显示', '109', 'Manager', 'geteditmanagerview', '/manager/geteditmanagerview', '2', '2018-08-09 13:40:20', '2018-08-09 13:40:29', null);
INSERT INTO `w_permission` VALUES ('119', '管理员编辑保存数据', '109', 'Manager', 'editemanager', '/manager/editemanager', '2', '2018-08-09 13:40:56', '2018-08-09 13:40:56', null);
INSERT INTO `w_permission` VALUES ('120', '用户密码修改', '109', 'Manager', 'resetuser', '/manager/resetuser', '2', '2018-08-09 13:41:18', '2018-08-09 13:45:27', null);
INSERT INTO `w_permission` VALUES ('121', '保存编辑权限', '111', 'Permission', 'editpermission', '/permission/editpermission', '2', '2018-08-09 13:41:53', '2018-08-09 22:16:48', null);
INSERT INTO `w_permission` VALUES ('122', '显示添加权限', '111', 'Permission', 'getpermissionview', '/permission/getpermissionview', '2', '2018-08-09 13:42:20', '2018-08-09 13:42:45', null);
INSERT INTO `w_permission` VALUES ('123', '添加权限数据保存', '111', 'Permission', 'storepermission', '/permission/storepermission', '2', '2018-08-09 13:43:18', '2018-08-09 13:43:27', null);
INSERT INTO `w_permission` VALUES ('124', '删除权限数据', '111', 'Permission', 'delpermission', '/permission/delpermission', '2', '2018-08-09 13:43:50', '2018-08-09 13:45:12', null);
INSERT INTO `w_permission` VALUES ('125', '显示编辑权限视图', '111', 'Permission', 'getstorepermissionview', '/permission/getstorepermissionview', '2', '2018-08-09 13:44:42', '2018-08-09 13:45:03', null);
INSERT INTO `w_permission` VALUES ('126', '角色删除', '110', 'Role', 'del', 'role/del', '2', '2018-08-09 13:48:32', '2018-08-09 13:48:32', null);
INSERT INTO `w_permission` VALUES ('127', '显示角色添加', '110', 'Role', 'getroleview', '/role/getroleview', '2', '2018-08-09 13:48:54', '2018-08-10 20:18:30', null);
INSERT INTO `w_permission` VALUES ('128', '角色添加数据处理', '110', 'Role', 'storerole', '/role/storerole', '2', '2018-08-09 13:49:14', '2018-08-10 20:18:55', null);
INSERT INTO `w_permission` VALUES ('129', '权限分配页面显示', '110', 'Role', 'fp_permission', '/role/fp_permission', '2', '2018-08-09 13:49:21', '2018-08-09 18:55:44', null);
INSERT INTO `w_permission` VALUES ('130', '权限分配保存', '110', 'Role', 'fp_savepermission', '/role/fp_savepermission', '2', '2018-08-09 18:56:14', '2018-08-09 19:12:08', null);
INSERT INTO `w_permission` VALUES ('131', '显示编辑话术页面', '108', 'HuaShu', 'getedit', '/huashu/getedit', '2', '2018-08-09 18:57:57', '2018-08-13 19:35:31', null);
INSERT INTO `w_permission` VALUES ('132', '微信快捷添加', '104', 'Weixin', 'add_wxs', '/weixin/add_wxs', '2', '2018-08-10 17:49:25', '2018-08-11 17:13:01', null);
INSERT INTO `w_permission` VALUES ('133', '微信信息删除', '104', 'Weixin', 'del_wx', '/weixin/del_wx', '2', '2018-08-10 19:54:16', '2018-08-10 19:54:16', null);
INSERT INTO `w_permission` VALUES ('134', '微信编辑页面', '104', 'Weixin', 'geteditwxview', '/weixin/geteditwxview', '2', '2018-08-10 20:15:41', '2018-08-10 20:37:55', null);
INSERT INTO `w_permission` VALUES ('135', '微信编辑保存', '104', 'Weixin', 'storeeditwx', '/weixin/storeeditwx', '2', '2018-08-10 22:01:52', '2018-08-10 22:01:52', null);
INSERT INTO `w_permission` VALUES ('136', '微信分页', '104', 'Weixin', 'paginate', '/weixin/paginate', '2', '2018-08-11 13:43:41', '2018-08-11 13:43:58', null);
INSERT INTO `w_permission` VALUES ('137', '添加单笔记', '105', 'Note', 'addnote', '/note/addnote', '2', '2018-08-11 17:14:35', '2018-08-11 17:14:35', null);
INSERT INTO `w_permission` VALUES ('138', '保存笔记数据', '105', 'Note', 'savenote', '/note/savenote', '2', '2018-08-11 20:39:16', '2018-08-11 20:39:43', null);
INSERT INTO `w_permission` VALUES ('139', '自动加载未提交笔记', '105', 'Note', 'loading', '/note/loading', '2', '2018-08-11 21:10:47', '2018-08-11 21:10:47', null);
INSERT INTO `w_permission` VALUES ('140', '编辑笔记数据', '104', 'Note', 'editnote', '/note/editnote', '2', '2018-08-12 18:20:40', '2018-08-12 18:20:40', null);
INSERT INTO `w_permission` VALUES ('141', '提交笔记数据', '104', 'Note', 'tjnote', '/note/tjnote', '2', '2018-08-12 19:59:18', '2018-08-12 19:59:18', null);
INSERT INTO `w_permission` VALUES ('142', '获取提交笔记数据', '106', 'Checknote', 'datainit', '/checknote/datainit', '2', '2018-08-13 12:26:54', '2018-08-13 12:28:11', null);
INSERT INTO `w_permission` VALUES ('143', '退回提交', '106', 'Checknote', 'tuihui', '/checknote/tuihui', '2', '2018-08-13 15:25:34', '2018-08-13 15:25:34', null);
INSERT INTO `w_permission` VALUES ('144', '显示话术页面', '108', 'HuaShu', 'getadd', '/huashu/getadd', '2', '2018-08-13 18:13:08', '2018-08-13 18:13:08', null);
INSERT INTO `w_permission` VALUES ('145', '保存话术', '108', 'HuaShu', 'savehuashu', '/huashu/savehuashu', '2', '2018-08-13 18:48:48', '2018-08-13 18:48:48', null);
INSERT INTO `w_permission` VALUES ('146', '保存编辑话术', '108', 'HuaShu', 'updatehuashu', '/huashu/updatehuashu', '2', '2018-08-13 19:53:24', '2018-08-13 19:53:24', null);
INSERT INTO `w_permission` VALUES ('147', '问题添加显示', '107', 'Question', 'getaddview', '/question/getaddview', '2', '2018-08-14 12:38:54', '2018-08-14 13:26:45', null);
INSERT INTO `w_permission` VALUES ('148', '问题创建', '107', 'Question', 'createquestion', '/question/createquestion', '2', '2018-08-14 14:04:56', '2018-08-14 14:04:56', null);
INSERT INTO `w_permission` VALUES ('149', '显示回答问题页面', '107', 'Question', 'getanswerview', '/question/getanswerview', '2', '2018-08-14 15:19:41', '2018-08-14 15:19:41', null);
INSERT INTO `w_permission` VALUES ('150', '保存答案', '107', 'Question', 'createanswer', '/question/createanswer', '2', '2018-08-14 15:32:56', '2018-08-14 15:32:56', null);

-- ----------------------------
-- Table structure for w_question
-- ----------------------------
DROP TABLE IF EXISTS `w_question`;
CREATE TABLE `w_question` (
  `q_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `mg_id` int(11) DEFAULT '0',
  `is_hidden` char(5) DEFAULT 'T',
  `is_comment` char(5) DEFAULT 'T',
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_question
-- ----------------------------

-- ----------------------------
-- Table structure for w_question_answer
-- ----------------------------
DROP TABLE IF EXISTS `w_question_answer`;
CREATE TABLE `w_question_answer` (
  `q_a_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`q_a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_question_answer


-- ----------------------------
-- Table structure for w_role
-- ----------------------------
DROP TABLE IF EXISTS `w_role`;
CREATE TABLE `w_role` (
  `role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) DEFAULT '',
  `ps_ids` text,
  `ps_ca` text,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_role
-- ----------------------------
INSERT INTO `w_role` VALUES ('30', '主管', '101,104,132,133,134,135,136,140,141,105,137,138,139,106,142,102,107,147,148,149,150,108,131,144,145,146', 'Weixin-index,Note-index,Checknote-index,Question-index,HuaShu-index,HuaShu-getedit,Weixin-add_wxs,Weixin-del_wx,Weixin-geteditwxview,Weixin-storeeditwx,Weixin-paginate,Note-addnote,Note-savenote,Note-loading,Note-editnote,Note-tjnote,Checknote-datainit,HuaShu-getadd,HuaShu-savehuashu,HuaShu-updatehuashu,Question-getaddview,Question-createquestion,Question-getanswerview,Question-createanswer', '2018-08-06 20:12:49', '2018-08-14 15:33:10', null);
INSERT INTO `w_role` VALUES ('31', '用户组一', '101,104,132,133,134,135,136,140,141,105,137,138,139,106,142,143,102,107,147,148,149,150,108,131,144,145,146', 'Weixin-index,Note-index,Checknote-index,Question-index,HuaShu-index,HuaShu-getedit,Weixin-add_wxs,Weixin-del_wx,Weixin-geteditwxview,Weixin-storeeditwx,Weixin-paginate,Note-addnote,Note-savenote,Note-loading,Note-editnote,Note-tjnote,Checknote-datainit,Checknote-tuihui,HuaShu-getadd,HuaShu-savehuashu,HuaShu-updatehuashu,Question-getaddview,Question-createquestion,Question-getanswerview,Question-createanswer', '2018-08-06 20:12:52', '2018-08-14 15:33:03', null);
INSERT INTO `w_role` VALUES ('32', '用户组二', '', '', '2018-08-06 20:15:29', '2018-08-06 21:55:12', null);

-- ----------------------------
-- Table structure for w_status
-- ----------------------------
DROP TABLE IF EXISTS `w_status`;
CREATE TABLE `w_status` (
  `status_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of w_status
-- ----------------------------
INSERT INTO `w_status` VALUES ('1', '正常');
INSERT INTO `w_status` VALUES ('2', '冻结');
INSERT INTO `w_status` VALUES ('3', '停用');

-- ----------------------------
-- Table structure for w_weixin
-- ----------------------------
DROP TABLE IF EXISTS `w_weixin`;
CREATE TABLE `w_weixin` (
  `wx_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wx_name` varchar(10) DEFAULT '',
  `mg_id` int(11) DEFAULT '0',
  `wx_status` enum('冻结','停用','正常') DEFAULT '正常',
  `desc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`wx_id`),
  UNIQUE KEY `wx_name` (`wx_name`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- ----------------------------

