-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018-03-11 12:23:17
-- 服务器版本: 5.6.37-log
-- PHP 版本: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `fx_pay`
--

-- --------------------------------------------------------

--
-- 表的结构 `fx_admin`
--

CREATE TABLE IF NOT EXISTS `fx_admin` (
  `adminid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `adminname` varchar(50) NOT NULL COMMENT '管理员账号',
  `password` varchar(50) NOT NULL COMMENT '管理员密码',
  `realname` varchar(50) NOT NULL COMMENT '管理员真实姓名',
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  `email` varchar(50) NOT NULL COMMENT '管理员Email',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0启用 1禁用',
  `savecode` varchar(50) NOT NULL COMMENT '安全码',
  `lastip` varchar(20) NOT NULL COMMENT '最后一次登录IP',
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `fx_admin`
--

INSERT INTO `fx_admin` (`adminid`, `adminname`, `password`, `realname`, `phone`, `email`, `addtime`, `status`, `savecode`, `lastip`) VALUES
(1, 'admin', '172eee54aa664e9dd0536b063796e54e', 'admin', '15515515555', '51125330@qq.com', 0, 0, ',d{5m1TaFdCJ]19', '');

-- --------------------------------------------------------

--
-- 表的结构 `fx_daili`
--

CREATE TABLE IF NOT EXISTS `fx_daili` (
  `dlid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `dlname` varchar(20) NOT NULL COMMENT '代理名称',
  `money` decimal(10,2) NOT NULL COMMENT '每日交易额',
  `fl` decimal(10,2) NOT NULL COMMENT '代理费率 1% 这里填1',
  PRIMARY KEY (`dlid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='代理等级表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fx_daili`
--

INSERT INTO `fx_daili` (`dlid`, `dlname`, `money`, `fl`) VALUES
(1, '一星代理', '10000.00', '0.20'),
(2, '二星代理', '100000.00', '0.50');

-- --------------------------------------------------------

--
-- 表的结构 `fx_dingdan`
--

CREATE TABLE IF NOT EXISTS `fx_dingdan` (
  `ddid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 默认0未支付 1已支付 2扣量订单',
  `ordernum` varchar(32) NOT NULL COMMENT '订单号',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `totalmoney` decimal(10,2) NOT NULL COMMENT '总金额',
  `havemoney` decimal(10,2) NOT NULL COMMENT '获得金额',
  `tz` tinyint(1) NOT NULL DEFAULT '0' COMMENT '通知 默认0未通知 1通知失败 2通知成功',
  `preordernum` varchar(32) NOT NULL COMMENT '渠道订单',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '时间',
  `zjid` int(11) NOT NULL COMMENT '配置中间表id',
  `fl` decimal(10,2) NOT NULL COMMENT '费率',
  `jkstyle` varchar(10) NOT NULL COMMENT '支付通道 wxwap zfbwap',
  `paytime` int(10) NOT NULL COMMENT '支付时间',
  `fj` text NOT NULL COMMENT '附加信息',
  PRIMARY KEY (`ddid`),
  KEY `ordernum` (`ordernum`),
  KEY `userid` (`userid`),
  KEY `jkstyle` (`jkstyle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `fx_dingdan`
--

INSERT INTO `fx_dingdan` (`ddid`, `status`, `ordernum`, `userid`, `totalmoney`, `havemoney`, `tz`, `preordernum`, `addtime`, `zjid`, `fl`, `jkstyle`, `paytime`, `fj`) VALUES
(1, 2, '201710015074666982604', 2017100, '1.00', '0.90', 2, '4200000003201709264262461142', 1507466698, 6, '10.00', 'wxgzh', 1507471811, 'a:5:{s:6:"fxdesc";s:4:"test";s:7:"fxattch";s:6:"mytest";s:11:"fxnotifyurl";s:37:"http://localhost:11001/Test/notifyUrl";s:9:"fxbackurl";s:35:"http://localhost:11001/Test/backUrl";s:4:"fxip";s:7:"0.0.0.0";}'),
(2, 1, '201710015074676266665', 2017100, '1.00', '0.90', 2, '2016071921001003030200089909', 1507467630, 11, '10.00', 'zfbwap', 1507639454, 'a:5:{s:6:"fxdesc";s:4:"test";s:7:"fxattch";s:6:"mytest";s:11:"fxnotifyurl";s:37:"http://localhost:11001/Test/notifyUrl";s:9:"fxbackurl";s:35:"http://localhost:11001/Test/backUrl";s:4:"fxip";s:7:"0.0.0.0";}'),
(3, 0, '201710015083170819473', 2017100, '1.00', '0.90', 0, '', 1508317082, 10, '10.00', 'wxsm', 0, 'a:5:{s:6:"fxdesc";s:4:"test";s:7:"fxattch";s:6:"mytest";s:11:"fxnotifyurl";s:36:"http://localhost:11001/notifyUrl.php";s:9:"fxbackurl";s:34:"http://localhost:11001/backUrl.php";s:4:"fxip";s:7:"0.0.0.0";}'),
(4, 0, '201710015205930988584', 2017100, '1.00', '0.90', 0, '', 1520593098, 7, '10.00', 'wxgzh', 0, 'a:5:{s:6:"fxdesc";s:4:"test";s:7:"fxattch";s:6:"mytest";s:11:"fxnotifyurl";s:41:"http://122.224.34.163:8001/Test/notifyUrl";s:9:"fxbackurl";s:39:"http://122.224.34.163:8001/Test/backUrl";s:4:"fxip";s:14:"117.61.128.200";}'),
(5, 0, '201710015205930997951', 2017100, '1.00', '0.90', 0, '', 1520593099, 7, '10.00', 'wxgzh', 0, 'a:5:{s:6:"fxdesc";s:4:"test";s:7:"fxattch";s:6:"mytest";s:11:"fxnotifyurl";s:41:"http://122.224.34.163:8001/Test/notifyUrl";s:9:"fxbackurl";s:39:"http://122.224.34.163:8001/Test/backUrl";s:4:"fxip";s:14:"117.61.128.200";}'),
(6, 0, '201710015205933793668', 2017100, '1.00', '0.90', 0, '', 1520593380, 11, '10.00', 'zfbwap', 0, 'a:5:{s:6:"fxdesc";s:4:"test";s:7:"fxattch";s:6:"mytest";s:11:"fxnotifyurl";s:41:"http://122.224.34.163:8001/Test/notifyUrl";s:9:"fxbackurl";s:39:"http://122.224.34.163:8001/Test/backUrl";s:4:"fxip";s:14:"117.61.128.200";}'),
(7, 0, '201710015205940578165', 2017100, '1.00', '0.90', 0, '', 1520594058, 11, '10.00', 'zfbwap', 0, 'a:5:{s:6:"fxdesc";s:4:"test";s:7:"fxattch";s:6:"mytest";s:11:"fxnotifyurl";s:41:"http://122.224.34.163:8001/Test/notifyUrl";s:9:"fxbackurl";s:39:"http://122.224.34.163:8001/Test/backUrl";s:4:"fxip";s:14:"117.61.128.200";}'),
(8, 0, '201710015205940598204', 2017100, '1.00', '0.90', 0, '', 1520594059, 11, '10.00', 'zfbwap', 0, 'a:5:{s:6:"fxdesc";s:4:"test";s:7:"fxattch";s:6:"mytest";s:11:"fxnotifyurl";s:41:"http://122.224.34.163:8001/Test/notifyUrl";s:9:"fxbackurl";s:39:"http://122.224.34.163:8001/Test/backUrl";s:4:"fxip";s:14:"117.61.128.200";}'),
(9, 0, '201710015205945703763', 2017100, '1.00', '0.90', 0, '', 1520594570, 11, '10.00', 'zfbwap', 0, 'a:5:{s:6:"fxdesc";s:4:"test";s:7:"fxattch";s:6:"mytest";s:11:"fxnotifyurl";s:41:"http://122.224.34.163:8001/Test/notifyUrl";s:9:"fxbackurl";s:39:"http://122.224.34.163:8001/Test/backUrl";s:4:"fxip";s:14:"117.61.128.200";}');

-- --------------------------------------------------------

--
-- 表的结构 `fx_fandian`
--

CREATE TABLE IF NOT EXISTS `fx_fandian` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `totalmoney` decimal(10,2) NOT NULL COMMENT '总金额 每日交易额',
  `fl` decimal(10,2) NOT NULL COMMENT '代理费率 1% 这里填1',
  `havemoney` decimal(10,2) NOT NULL COMMENT '获得金额',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 默认0未申请 1申请 2通过 3冻结',
  `userid` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='代理等级表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `fx_jiekou`
--

CREATE TABLE IF NOT EXISTS `fx_jiekou` (
  `jkid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `jkname` varchar(20) NOT NULL COMMENT '接口名称',
  `jkstyle` varchar(20) NOT NULL COMMENT '接口类型 字母关键字 识别接口 例如wxwap zfbwap',
  PRIMARY KEY (`jkid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='接口表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `fx_jiekou`
--

INSERT INTO `fx_jiekou` (`jkid`, `jkname`, `jkstyle`) VALUES
(1, '微信wap', 'wxwap'),
(3, '微信公众号', 'wxgzh'),
(4, '微信扫码', 'wxsm'),
(5, '支付宝wap', 'zfbwap'),
(6, '支付宝扫码', 'zfbsm');

-- --------------------------------------------------------

--
-- 表的结构 `fx_jiekoupeizhi`
--

CREATE TABLE IF NOT EXISTS `fx_jiekoupeizhi` (
  `pzid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `pzname` varchar(20) NOT NULL COMMENT '配置名称',
  `style` varchar(20) NOT NULL COMMENT '账号类型 支付宝alipay wechat',
  `params` text NOT NULL COMMENT '配置参数 序列化数据',
  PRIMARY KEY (`pzid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='接口配置表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fx_jiekoupeizhi`
--

INSERT INTO `fx_jiekoupeizhi` (`pzid`, `pzname`, `style`, `params`) VALUES
(1, '微信第一账户', 'wechat', 'a:4:{s:12:"wechat_appid";s:18:"wxac75c7a3d758e0f2";s:12:"wechat_mchid";s:10:"1489917312";s:10:"wechat_key";s:32:"W234SGWRWFDSG43532rfZdvaearw4234";s:16:"wechat_appsecret";s:32:"1eb6d48260b92e707f5d48406433403c";}'),
(2, '支付宝第一账户', 'alipay', 'a:4:{s:12:"alipay_appid";s:16:"2016080800191563";s:11:"alipay_sign";s:4:"RSA2";s:14:"alipay_private";s:1584:"MIIEoAIBAAKCAQEApaAebdTwJMJ6qUOmtpLdQklCxuFlfwY2rNtDOVfmWfIBvdY5OwNm5vtTNJayhHb3HJ5eoJdT3tZmX+8gUC39w0zSgufdMqGLFEIWjVCZ7FILels+IQtx/vbVNKQmB1DPKCvlGPFpSOb2unQP4MtFlW4JHrPQH7Ny8OTKGFOjfQREwZRCxhbzBZK1s565JUqK7SI+ctO2DvipMiLsantqwvjnQN+R8gi+xbx3uRA+B79QAuP3XhISV+OE3/wkBzHy0sA4n2iNKUwxTHQjWOVpcenHCtJjlgHBhLSz5CB7WR9fK32UUR7CzgRq19KIaq2lgD2+oKdJ6zVG4xzX0DAEKwIDAQABAoIBAD5srCtfT6e7OTokymgT0JsUO7vz5ipLMD5UYfDyBVsvUKK5ZFauwJEcds7iYaR1pku+ERJcFvttOaa83SP7QaLjiJBYTdGwe1gGVLOshmdAwRy72R3hT3T2mYM+vyqQtZOBf9a33qPgkWvTJMzoMHDSyVMuGKpqG09aHCWxGHSclK4V4y4374a91VBuL+A55Z8XQShIwQWD0VhMUoNq2TK2CB2ETYvo2Ib0x4lc+ipQk8erHG1Qe4sNEEK9KZftbW8mr+3pz1AvcTASWKECq2Pz//QM7KfPo52hxz0zjtLySJCahmyr2Iw6Or3G17oQU5mqtn+xvygYXZI8oqxEPmECgYEA3FbTpGSzbUlVNBiOEx8jH9AlxjAWKAIX7e9RbfcyLgLjvRnQhJR4K5t3cyTRcRwBbjQzQnbUCeJJPFYM43SczP57yOuD0cWtJCpsLK+17FANvxWO4aKm7jY9chSoRuW0HtRgU4fqCjhL79sWnK1bc2KazVoKiWoV2qOzcg9/L5sCgYEAwG5fuSuOo5uJy3TeYVPVi3WRdZoZYFetGYfDRsxxg/8nwmdaOKdM2i5UP2869dhX08WkxtloSdG+BoByeideB00kDvrmThH6Awh6eloYV4knKQy1To76EtBiYALd0rv50quMZ/r7MD8MmDapmj+tppinQzWCXeySH8ldOIPa7rECgYBwhXa3cSWgHd8BJ7kGUtRhHq7rswrdi5Qk0h5HhgF+NcOPgmtWCWwE+PPbPWYn2SFx4f57ZquKEKFNyrPyRE7+8MbOKFe8/LIa0f9EIsdI0ujyOFQrLiEJbXGbnKkC67M8O0Cl57bBWVaOOtglUvJszmI3lE/lNOPML+UnznopGQKBgF7xVjtXWU4xvJ/srpfYtCDVxgn/GQwm1holmNyCnHNi3ewV8DbJnKp9d0XBDJclwdeTyYPu2nyphpdQoqrQZ500m1jkw+K7Dd6XPU7GywHNgsvHIGF9O7cyp4b1gxqpck5WI7Vd6LdaNE2Zkr6vMm9jHAuWCBdtVH9oa50puUhRAn9/nTkkl9R3JhA1O0HKWBw9XDo7qYfc7RnzL6Mtttv40JETn+U233T2s60z9l4cxBCyIwXxhAqtFxt6sKVixE384bRW/eQGqG30ll4xQrB2qFLahu3jiWzsVrz9tTha2oqsJK8yig8C5n5/6MqBhOVNavkRiOCrkMiXCbngwukQ";s:13:"alipay_public";s:392:"MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApa4pdzvXFsGFBfPnJVkizt9ZsGGV1tGGnUE8jh2nYWev48FrBi2LhmGE1QylMacSyxVIIbZjjQ+qynP142gCve0zR3ftmV9b2oBoPrVT9xKNrepwJJgblO65Z5ZAGNoGejE8r4mSXqqpRnHbZ6LfdJYgwoIgozbVl8jEwC1b2RHAOPDw6ch4LZYQpQkwcCGs7dy3KuAKcRKw9kG4bPv90/SsoAR+1M+GkkA0U9iSGb+RkJJ2EnVp8sXZK/uh1HWbQEO5+I73ShBeAbSgn1iGbh+r7FB3o4/5O8Uyg2nBhIFBlm9ONwmbro6QhddU8Xb16hei2ORobALEK34R2P2fQQIDAQAB";}');

-- --------------------------------------------------------

--
-- 表的结构 `fx_jiekouzj`
--

CREATE TABLE IF NOT EXISTS `fx_jiekouzj` (
  `zjid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `jkid` int(11) NOT NULL COMMENT '接口id',
  `pzid` int(11) NOT NULL COMMENT '配置id',
  `fl` decimal(10,2) NOT NULL COMMENT '接口费率',
  `ifopen` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启 默认1开启  0关闭',
  `ifchoose` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否使用当前接口 默认0不是 1是 ，同一接口类型只能有一个是1',
  PRIMARY KEY (`zjid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='接口配置中间表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `fx_jiekouzj`
--

INSERT INTO `fx_jiekouzj` (`zjid`, `jkid`, `pzid`, `fl`, `ifopen`, `ifchoose`) VALUES
(6, 1, 1, '10.00', 1, 1),
(7, 3, 1, '10.00', 1, 1),
(10, 4, 1, '10.00', 1, 1),
(11, 5, 2, '10.00', 1, 1),
(12, 6, 2, '10.00', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `fx_ka`
--

CREATE TABLE IF NOT EXISTS `fx_ka` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `username` varchar(20) NOT NULL COMMENT '收款人',
  `ka` varchar(30) NOT NULL COMMENT '卡号',
  `address` varchar(255) NOT NULL COMMENT '开户地址',
  `ifcheck` varchar(255) NOT NULL DEFAULT '0' COMMENT '审核 默认0未通过 1通过',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `checktime` int(10) NOT NULL COMMENT '审核时间',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='银行卡表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `fx_ka`
--

INSERT INTO `fx_ka` (`id`, `userid`, `username`, `ka`, `address`, `ifcheck`, `addtime`, `checktime`) VALUES
(4, 2017100, '风行', '123@qq.com', '支付宝', '1', 1506858874, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fx_log_error`
--

CREATE TABLE IF NOT EXISTS `fx_log_error` (
  `ErrorID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `Url` varchar(200) NOT NULL COMMENT '请求地址',
  `Params` text NOT NULL COMMENT '请求参数',
  `Description` text NOT NULL COMMENT '描述',
  `SqlContent` text NOT NULL COMMENT 'Sql语句',
  `AddTime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`ErrorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='错误日志表' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `fx_log_error`
--

INSERT INTO `fx_log_error` (`ErrorID`, `Url`, `Params`, `Description`, `SqlContent`, `AddTime`) VALUES
(1, 'Manage/User/save', 'a:1:{s:22:"/Manage/User/save_html";s:0:"";}##@##a:11:{s:8:"password";s:0:"";s:9:"password2";s:0:"";s:10:"txpassword";s:0:"";s:2:"qq";s:8:"51125330";s:5:"phone";s:11:"15515515555";s:5:"email";s:15:"51125330@qq.com";s:6:"status";s:1:"0";s:7:"ifagent";s:1:"0";s:5:"agent";s:1:"0";s:3:"act";s:4:"edit";s:2:"id";s:1:"1";}##@##a:4:{s:9:"PHPSESSID";s:26:"537r20h9cd7a3ls6qisj0sog82";s:4:"_UID";s:1:"1";s:6:"_UNAME";s:5:"admin";s:5:"_CODE";s:32:"1ab940a45431549cd044dfaef3d5c835";}', '无', '1064:You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '')'' at line 1\n [ SQL语句 ] : UPDATE `fx_user` SET `username`=NULL,`password`='''',`qq`=''51125330'',`email`=''51125330@qq.com'',`phone`=''15515515555'',`status`=''0'',`ifagent`=''0'',`id`=''1'' WHERE ( userid= )', 1506580721),
(2, 'Manage/User/save', 'a:1:{s:22:"/Manage/User/save_html";s:0:"";}##@##a:11:{s:8:"password";s:0:"";s:9:"password2";s:0:"";s:10:"txpassword";s:0:"";s:2:"qq";s:8:"51125330";s:5:"phone";s:11:"15515515555";s:5:"email";s:15:"51125330@qq.com";s:6:"status";s:1:"0";s:7:"ifagent";s:1:"0";s:5:"agent";s:1:"0";s:3:"act";s:4:"edit";s:2:"id";s:1:"1";}##@##a:4:{s:9:"PHPSESSID";s:26:"537r20h9cd7a3ls6qisj0sog82";s:4:"_UID";s:1:"1";s:6:"_UNAME";s:5:"admin";s:5:"_CODE";s:32:"1ab940a45431549cd044dfaef3d5c835";}', '无', '1064:You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '')'' at line 1\n [ SQL语句 ] : UPDATE `fx_user` SET `username`=NULL,`password`='''',`qq`=''51125330'',`email`=''51125330@qq.com'',`phone`=''15515515555'',`status`=''0'',`ifagent`=''0'',`id`=''1'' WHERE ( userid= )', 1506580735),
(3, 'Manage/User/save', 'a:1:{s:22:"/Manage/User/save_html";s:0:"";}##@##a:11:{s:8:"password";s:0:"";s:9:"password2";s:0:"";s:10:"txpassword";s:0:"";s:2:"qq";s:8:"51125330";s:5:"phone";s:11:"15515515555";s:5:"email";s:0:"";s:6:"status";s:1:"0";s:7:"ifagent";s:1:"0";s:5:"agent";s:1:"0";s:3:"act";s:4:"edit";s:2:"id";s:1:"1";}##@##a:4:{s:9:"PHPSESSID";s:26:"537r20h9cd7a3ls6qisj0sog82";s:4:"_UID";s:1:"1";s:6:"_UNAME";s:5:"admin";s:5:"_CODE";s:32:"1ab940a45431549cd044dfaef3d5c835";}', '无', '1064:You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '')'' at line 1\n [ SQL语句 ] : UPDATE `fx_user` SET `qq`=''51125330'',`email`='''',`phone`=''15515515555'',`status`=''0'',`ifagent`=''0'',`id`=''1'' WHERE ( userid= )', 1506581045),
(4, 'Index/Index/login', 'a:1:{s:23:"/Index/Index/login_html";s:0:"";}##@##a:3:{s:8:"username";s:10:"qq51125330";s:8:"password";s:10:"qq51125330";s:1:"t";s:18:"0.4332557507402265";}##@##a:4:{s:6:"_UNAME";s:5:"admin";s:9:"PHPSESSID";s:26:"h1g39g824bhoklrruehp0a1g55";s:4:"_UID";s:1:"1";s:5:"_CODE";s:32:"1b31782bad183c22524618e983980bcf";}', '无', '无', 1506697659),
(5, 'Index/Index/login', 'a:1:{s:23:"/Index/Index/login_html";s:0:"";}##@##a:3:{s:8:"username";s:10:"qq51125330";s:8:"password";s:10:"qq51125330";s:1:"t";s:17:"0.797534626680804";}##@##a:4:{s:6:"_UNAME";s:5:"admin";s:9:"PHPSESSID";s:26:"h1g39g824bhoklrruehp0a1g55";s:4:"_UID";s:1:"1";s:5:"_CODE";s:32:"1b31782bad183c22524618e983980bcf";}', '无', '无', 1506697663),
(6, 'Index/Index/login', 'a:1:{s:23:"/Index/Index/login_html";s:0:"";}##@##a:3:{s:8:"username";s:10:"qq51125330";s:8:"password";s:10:"qq51125330";s:1:"t";s:19:"0.07319808938067252";}##@##a:4:{s:6:"_UNAME";s:5:"admin";s:9:"PHPSESSID";s:26:"h1g39g824bhoklrruehp0a1g55";s:4:"_UID";s:1:"1";s:5:"_CODE";s:32:"1b31782bad183c22524618e983980bcf";}', '无', '无', 1506697744),
(7, 'Index/Index/login', 'a:1:{s:23:"/Index/Index/login_html";s:0:"";}##@##a:3:{s:8:"username";s:10:"qq51125330";s:8:"password";s:10:"qq51125330";s:1:"t";s:18:"0.5411565895102043";}##@##a:4:{s:6:"_UNAME";s:5:"admin";s:9:"PHPSESSID";s:26:"h1g39g824bhoklrruehp0a1g55";s:4:"_UID";s:1:"1";s:5:"_CODE";s:32:"1b31782bad183c22524618e983980bcf";}', '无', '无', 1506697775),
(8, 'Index/Home/dingdan', 'a:1:{s:24:"/Index/Home/dingdan_html";s:0:"";}##@##a:0:{}##@##a:4:{s:4:"_UID";s:7:"2017100";s:6:"_UNAME";s:10:"qq51125330";s:5:"_CODE";s:32:"79483029bf09ed6d18f0dfd18d3f58a4";s:9:"PHPSESSID";s:26:"815o5jndc4o8hmjqraop7f95q3";}', '无', '1064:You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''AND status<2  ) ORDER BY ddid DESC LIMIT 0,15'' at line 1\n [ SQL语句 ] : SELECT * FROM `fx_dingdan` WHERE (  AND status<2  ) ORDER BY ddid DESC LIMIT 0,15  ', 1506839062),
(9, 'Manage/User/fl', 'a:2:{s:2:"id";s:1:"2";s:25:"/Manage/User/fl/id/2_html";s:0:"";}##@##a:0:{}##@##a:7:{s:9:"PHPSESSID";s:26:"cchd7ub45er5o8i9q69c4c8s55";s:4:"_UID";s:7:"2017100";s:6:"_UNAME";s:10:"qq51125330";s:5:"_CODE";s:32:"835f8458bf9d548d2d8ba55434dd2130";s:17:"fx_admin_user_UID";s:1:"1";s:19:"fx_admin_user_UNAME";s:5:"admin";s:18:"fx_admin_user_CODE";s:32:"909005c73719f200a64de81e8611cb89";}', '无', '1054:Unknown column ''id'' in ''order clause''\n [ SQL语句 ] : SELECT * FROM `fx_jiekou` WHERE ( 1=1 ) ORDER BY id asc ', 1506952486),
(10, 'Manage/User/fl', 'a:1:{s:20:"/Manage/User/fl_html";s:0:"";}##@##a:8:{s:4:"jkid";a:5:{i:0;s:1:"1";i:1;s:1:"3";i:2;s:1:"4";i:3;s:1:"5";i:4;s:1:"6";}s:8:"ifopen_1";s:1:"0";s:8:"ifopen_3";s:1:"0";s:8:"ifopen_4";s:1:"0";s:8:"ifopen_5";s:1:"0";s:8:"ifopen_6";s:1:"0";s:3:"act";s:4:"edit";s:2:"id";s:1:"2";}##@##a:7:{s:9:"PHPSESSID";s:26:"cchd7ub45er5o8i9q69c4c8s55";s:4:"_UID";s:7:"2017100";s:6:"_UNAME";s:10:"qq51125330";s:5:"_CODE";s:32:"835f8458bf9d548d2d8ba55434dd2130";s:17:"fx_admin_user_UID";s:1:"1";s:19:"fx_admin_user_UNAME";s:5:"admin";s:18:"fx_admin_user_CODE";s:32:"909005c73719f200a64de81e8611cb89";}', '无', '1048:Column ''fl'' cannot be null\n [ SQL语句 ] : INSERT INTO `fx_jiekou_user` (`jkid`,`userid`,`fl`,`ifopen`) VALUES (''1'',''2017101'',NULL,''0'')', 1506955030),
(11, 'Index/Home/fl', 'a:1:{s:19:"/Index/Home/fl_html";s:0:"";}##@##a:0:{}##@##a:7:{s:9:"PHPSESSID";s:26:"cchd7ub45er5o8i9q69c4c8s55";s:4:"_UID";s:7:"2017100";s:6:"_UNAME";s:10:"qq51125330";s:5:"_CODE";s:32:"835f8458bf9d548d2d8ba55434dd2130";s:17:"fx_admin_user_UID";s:1:"1";s:19:"fx_admin_user_UNAME";s:5:"admin";s:18:"fx_admin_user_CODE";s:32:"909005c73719f200a64de81e8611cb89";}', '无', '1054:Unknown column ''jid'' in ''order clause''\n [ SQL语句 ] : SELECT * FROM `fx_jiekou` WHERE ( 1=1 ) ORDER BY jid asc ', 1506958179),
(12, 'Index/Home/dlfandian', 'a:1:{s:26:"/Index/Home/dlfandian_html";s:0:"";}##@##a:0:{}##@##a:7:{s:4:"_UID";s:7:"2017100";s:6:"_UNAME";s:10:"qq51125330";s:5:"_CODE";s:32:"8c83d7be94d208c7e1cd6b11a2b7119f";s:17:"fx_admin_user_UID";s:1:"1";s:19:"fx_admin_user_UNAME";s:5:"admin";s:18:"fx_admin_user_CODE";s:32:"019c5f8496e69326f31bfb84fd4c4862";s:9:"PHPSESSID";s:26:"u0gcja17vpio594fnetqp8jdl5";}', '逻辑层声明失败，模型【Fandian】不存在', '无', 1507012046),
(13, 'Index/Pay/notify', 'a:1:{s:18:"/Pay/notify/wechat";s:0:"";}##@##a:0:{}##@##a:7:{s:4:"mode";s:5:"2.000";s:7:"fanDian";s:5:"10.21";s:39:"Hm_lvt_c50bfe5f24a55954494327a79485064c";s:10:"1507361748";s:17:"fx_admin_user_UID";s:1:"1";s:19:"fx_admin_user_UNAME";s:5:"admin";s:18:"fx_admin_user_CODE";s:32:"45f4352c138407e174e86fb292a8e27b";s:9:"PHPSESSID";s:26:"33b5b0e0ap4884ls3e5nol8lm7";}', '无', '1064:You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''0=''paytime=1507471255'',`preordernum`=''4200000003201709264262461142'' WHERE ( ddid'' at line 1\n [ SQL语句 ] : UPDATE `fx_dingdan` SET `status`=''1'',0=''paytime=1507471255'',`preordernum`=''4200000003201709264262461142'' WHERE ( ddid=1 )', 1507471255),
(14, 'Manage/Api/check', 'a:1:{s:22:"/Manage/Api/check_html";s:0:"";}##@##a:0:{}##@##a:10:{s:4:"mode";s:5:"2.000";s:7:"fanDian";s:5:"10.21";s:39:"Hm_lvt_c50bfe5f24a55954494327a79485064c";s:10:"1507361748";s:4:"_UID";s:7:"2017100";s:6:"_UNAME";s:10:"qq51125330";s:5:"_CODE";s:32:"16a9997dc4122acee6514c4a24903814";s:17:"fx_admin_user_UID";s:1:"1";s:19:"fx_admin_user_UNAME";s:5:"admin";s:18:"fx_admin_user_CODE";s:32:"fe28250034d7346521a18928b1bb7f80";s:9:"PHPSESSID";s:26:"6h2c6fsrjs19hdqk78io27st85";}', '无', '1146:Table ''my_pay.fx_jiekoupz'' doesn''t exist\n [ SQL语句 ] : SELECT * FROM `fx_jiekoupz` WHERE ( 1=1 ) ORDER BY pzid ASC ', 1507691718),
(15, 'Index/Index/index', 'a:0:{}##@##a:0:{}##@##a:8:{s:39:"Hm_lvt_c50bfe5f24a55954494327a79485064c";s:10:"1507361748";s:17:"fx_admin_user_UID";s:1:"1";s:19:"fx_admin_user_UNAME";s:5:"admin";s:18:"fx_admin_user_CODE";s:32:"97551cc293b8cfe0d32881f9072be1cd";s:4:"_UID";s:7:"2017110";s:6:"_UNAME";s:10:"yy51125330";s:5:"_CODE";s:32:"69e6f23049f6a29a86ff3f328811ccc3";s:9:"PHPSESSID";s:26:"qmjabnqhl1ritbelidi5slvj36";}', '逻辑层声明失败，模型【Param】不存在', '无', 1507881784),
(16, 'Index/Index/index', 'a:0:{}##@##a:0:{}##@##a:8:{s:39:"Hm_lvt_c50bfe5f24a55954494327a79485064c";s:10:"1507361748";s:17:"fx_admin_user_UID";s:1:"1";s:19:"fx_admin_user_UNAME";s:5:"admin";s:18:"fx_admin_user_CODE";s:32:"97551cc293b8cfe0d32881f9072be1cd";s:4:"_UID";s:7:"2017110";s:6:"_UNAME";s:10:"yy51125330";s:5:"_CODE";s:32:"69e6f23049f6a29a86ff3f328811ccc3";s:9:"PHPSESSID";s:26:"qmjabnqhl1ritbelidi5slvj36";}', '逻辑层声明失败，模型【Param】不存在', '无', 1507882005);

-- --------------------------------------------------------

--
-- 表的结构 `fx_pay`
--

CREATE TABLE IF NOT EXISTS `fx_pay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  `money` decimal(10,2) NOT NULL COMMENT '提现金额',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态   默认0申请提现 1已支付 2冻结',
  `realname` varchar(20) NOT NULL COMMENT '提现用户真实姓名',
  `ka` varchar(50) NOT NULL COMMENT '卡号',
  `address` varchar(255) NOT NULL COMMENT '地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='支付表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fx_pay`
--

INSERT INTO `fx_pay` (`id`, `userid`, `addtime`, `money`, `status`, `realname`, `ka`, `address`) VALUES
(1, 2017100, 1507855657, '100.00', 1, '风行', '123@qq.com', '支付宝'),
(2, 2017100, 1507856817, '100.00', 0, '风行', '123@qq.com', '支付宝');

-- --------------------------------------------------------

--
-- 表的结构 `fx_peizhi`
--

CREATE TABLE IF NOT EXISTS `fx_peizhi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `sitename` varchar(50) NOT NULL COMMENT '网站名称',
  `closeweb` tinyint(1) NOT NULL DEFAULT '0' COMMENT '关闭网站 默认0不关闭  1关闭',
  `klvalue` int(11) NOT NULL COMMENT '扣量初始值',
  `klzijian` int(11) NOT NULL COMMENT '扣量自减值',
  `klinitmoney` decimal(10,2) NOT NULL COMMENT '起扣金额',
  `ifkl` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否扣量 默认0不扣 1扣',
  `ifregcheck` tinyint(1) NOT NULL DEFAULT '0' COMMENT '注册审核 默认0不审核  1审核',
  `ifcheckka` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否审核提现账户 0不审核 1审核',
  `minpay` int(11) NOT NULL DEFAULT '100' COMMENT '最小提现金额 默认100',
  `xieyi` text NOT NULL COMMENT '注册协议',
  `bzjuserid` int(11) NOT NULL COMMENT '保证金收款用户id',
  `ifagent` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开启代理 默认0开启 1不开启',
  `notice` text NOT NULL COMMENT '公告',
  `phone` varchar(20) NOT NULL COMMENT '电话',
  `qq` varchar(20) NOT NULL COMMENT 'qq',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='配置表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `fx_peizhi`
--

INSERT INTO `fx_peizhi` (`id`, `sitename`, `closeweb`, `klvalue`, `klzijian`, `klinitmoney`, `ifkl`, `ifregcheck`, `ifcheckka`, `minpay`, `xieyi`, `bzjuserid`, `ifagent`, `notice`, `phone`, `qq`) VALUES
(1, '犁支付', 0, 10, 10, '10.00', 1, 0, 1, 100, '一、总则\r\n1.1 犁支付的所有权和运营权归犁支付所有。\r\n1.2 用户在注册之前，应当仔细阅读本协议，并同意遵守本协议后方可成为注册用户。一旦注册成功，则用户与犁支付之间自动形成协议关系，用户应当受本协议的约束。用户在使用特殊的服务或产品时，应当同意接受相关协议后方能使用。\r\n1.3 本协议则可由犁支付随时更新，用户应当及时关注并同意本站不承担通知义务。本站的通知、公告、声明或其它类似内容是本协议的一部分。\r\n\r\n二、服务内容\r\n2.1 犁支付的具体内容由本站根据实际情况提供。\r\n2.2 本站仅提供相关的网络服务，除此之外与相关网络服务有关的设备(如个人电脑、手机、及其他与接入互联网或移动网有关的装置)及所需的费用(如为接入互联网而支付的电话费及上网费、为使用移动网而支付的手机费)均应由用户自行负担。\r\n\r\n三、用户帐号\r\n3.1 经本站注册系统完成注册程序并通过身份认证的用户即成为正式用户，可以获得本站规定用户所应享有的一切权限；未经认证仅享有本站规定的部分会员权限。犁支付有权对会员的权限设计进行变更。\r\n3.2 用户只能按照注册要求使用真实姓名，及身份证号注册。用户有义务保证密码和帐号的安全，用户利用该密码和帐号所进行的一切活动引起的任何损失或损害，由用户自行承担全部责任，本站不承担任何责任。如用户发现帐号遭到未授权的使用或发生其他任何安全问题，应立即修改帐号密码并妥善保管，如有必要，请通知本站。因黑客行为或用户的保管疏忽导致帐号非法使用，本站不承担任何责任。\r\n\r\n四、使用规则\r\n4.1 遵守中华人民共和国相关法律法规，包括但不限于《中华人民共和国计算机信息系统安全保护条例》、《计算机软件保护条例》、《最高人民法院关于审理涉及计算机网络著作权纠纷案件适用法律若干问题的解释(法释[2004]1号)》、《全国人大常委会关于维护互联网安全的决定》、《互联网电子公告服务管理规定》、《互联网新闻信息服务管理规定》、《互联网著作权行政保护办法》和《信息网络传播权保护条例》等有关计算机互联网规定和知识产权的法律和法规、实施办法。\r\n4.2 用户对其自行发表、上传或传送的内容负全部责任，所有用户不得在本站任何页面发布、转载、传送含有下列内容之一的信息，否则本站有权自行处理并不通知用户：\r\n(1)违反宪法确定的基本原则的；\r\n(2)危害国家安全，泄漏国家机密，颠覆国家政权，破坏国家统一的；\r\n(3)损害国家荣誉和利益的；\r\n(4)煽动民族仇恨、民族歧视，破坏民族团结的；\r\n(5)破坏国家宗教政策，宣扬邪教和封建迷信的；\r\n(6)散布谣言，扰乱社会秩序，破坏社会稳定的；\r\n(7)散布淫秽、色情、赌博、暴力、恐怖或者教唆犯罪的；\r\n(8)侮辱或者诽谤他人，侵害他人合法权益的；\r\n(9)煽动非法集会、结社、游行、示威、聚众扰乱社会秩序的；\r\n(10)以非法民间组织名义活动的；\r\n(11)含有法律、行政法规禁止的其他内容的。 \r\n4.3 用户承诺对其发表或者上传于本站的所有信息(即属于《中华人民共和国著作权法》规定的作品，包括但不限于文字、图片、音乐、电影、表演和录音录像制品和电脑程序等)均享有完整的知识产权，或者已经得到相关权利人的合法授权；如用户违反本条规定造成本站被第三人索赔的，用户应全额补偿本站一切费用(包括但不限于各种赔偿费、诉讼代理费及为此支出的其它合理费用)；\r\n4.4 当第三方认为用户发表或者上传于本站的信息侵犯其权利，并根据《信息网络传播权保护条例》或者相关法律规定向本站发送权利通知书时，用户同意本站可以自行判断决定删除涉嫌侵权信息，除非用户提交书面证据材料排除侵权的可能性，本站将不会自动恢复上述删除的信息； (1)不得为任何非法目的而使用网络服务系统；\r\n(2)遵守所有与网络服务有关的网络协议、规定和程序； (3)不得利用本站进行任何可能对互联网的正常运转造成不利影响的行为；\r\n(4)不得利用本站进行任何不利于本站的行为。 \r\n4.5 如用户在使用网络服务时违反上述任何规定，本站有权要求用户改正或直接采取一切必要的措施(包括但不限于删除用户张贴的内容、暂停或终止用户使用网络服务的权利)以减轻用户不当行为而造成的影响。\r\n\r\n五、隐私保护\r\n5.1 本站不对外公开或向第三方提供单个用户的注册资料及用户在使用网络服务时存储在本站的非公开内容，但下列情况除外： (1)事先获得用户的明确授权；\r\n(2)根据有关的法律法规要求；\r\n(3)按照相关政府主管部门的要求；\r\n(4)为维护社会公众的利益。 \r\n5.2 本站可能会与第三方合作向用户提供相关的网络服务，在此情况下，如该第三方同意承担与本站同等的保护用户隐私的责任，则本站有权将用户的注册资料等提供给该第三方。\r\n5.3 在不透露单个用户隐私资料的前提下，本站有权对整个用户数据库进行分析并对用户数据库进行商业上的利用。\r\n\r\n六、版权声明\r\n6.1 本站的文字、图片、音频、视频等版权均归犁支付享有或与作者共同享有，未经本站许可，不得任意转载。\r\n6.2 本站特有的标识、版面设计、编排方式等版权均属犁支付享有，未经本站许可，不得任意复制或转载。\r\n6.3 使用本站的任何内容均应注明“来源于犁支付”及署上作者姓名，按法律规定需要支付稿酬的，应当通知本站及作者及支付稿酬，并独立承担一切法律责任。\r\n6.4 本站享有所有作品用于其它用途的优先权，包括但不限于网站、电子杂志、平面出版等，但在使用前会通知作者，并按同行业的标准支付稿酬。\r\n6.5 本站所有内容仅代表作者自己的立场和观点，与本站无关，由作者本人承担一切法律责任。\r\n6.6 恶意转载本站内容的，本站保留将其诉诸法律的权利。\r\n\r\n七、责任声明\r\n7.1 用户明确同意其使用本站网络服务所存在的风险及一切后果将完全由用户本人承担，犁支付对此不承担任何责任。\r\n7.2 本站无法保证网络服务一定能满足用户的要求，也不保证网络服务的及时性、安全性、准确性。\r\n7.3 本站不保证为方便用户而设置的外部链接的准确性和完整性，同时，对于该等外部链接指向的不由本站实际控制的任何网页上的内容，本站不承担任何责任。\r\n7.4 对于因不可抗力或本站不能控制的原因造成的网络服务中断或其它缺陷，本站不承担任何责任，但将尽力减少因此而给用户造成的损失和影响。\r\n7.5 对于站向用户提供的下列产品或者服务的质量缺陷本身及其引发的任何损失，本站无需承担任何责任： (1)本站向用户免费提供的各项网络服务；\r\n(2)本站向用户赠送的任何产品或者服务。 \r\n7.6 本站有权于任何时间暂时或永久修改或终止本服务(或其任何部分)，而无论其通知与否，本站对用户和任何第三人均无需承担任何责任。\r\n\r\n八、附则\r\n8.1 本协议的订立、执行和解释及争议的解决均应适用中华人民共和国法律。\r\n8.2 如本协议中的任何条款无论因何种原因完全或部分无效或不具有执行力，本协议的其余条款仍应有效并且有约束力。\r\n8.3 本协议解释权及修订权归犁支付所有。 ', 2017100, 0, '犁支付1.0正式上线', '17121572898', '652064397');

-- --------------------------------------------------------

--
-- 表的结构 `fx_rizhi`
--

CREATE TABLE IF NOT EXISTS `fx_rizhi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `module` varchar(255) NOT NULL COMMENT '模块名称',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `ifadmin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是管理员 默认0不是 1是',
  `userid` varchar(20) NOT NULL COMMENT '用户id',
  `ip` varchar(20) NOT NULL COMMENT 'ip',
  PRIMARY KEY (`id`),
  KEY `module` (`module`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='日志表' AUTO_INCREMENT=264 ;

--
-- 转存表中的数据 `fx_rizhi`
--

INSERT INTO `fx_rizhi` (`id`, `module`, `content`, `addtime`, `ifadmin`, `userid`, `ip`) VALUES
(1, '管理员', '修改管理员AdminID为【1】的数据', 1505659357, 1, '0', '0.0.0.0'),
(2, '管理员', '修改管理员AdminID为【1】的数据', 1505659417, 1, '0', '0.0.0.0'),
(3, '管理员', '修改管理员AdminID为【1】的数据', 1505659688, 1, '0', '0.0.0.0'),
(4, '管理员', '修改管理员AdminID为【1】的数据', 1505659998, 1, '0', '0.0.0.0'),
(5, '管理员', '修改管理员AdminID为【1】的数据', 1505660053, 1, '0', '0.0.0.0'),
(6, '管理员', '修改管理员AdminID为【1】的数据', 1505660083, 1, '0', '0.0.0.0'),
(7, '管理员', '修改管理员AdminID为【1】的数据', 1505660119, 1, '0', '0.0.0.0'),
(8, '管理员', '修改管理员AdminID为【1】的数据', 1505660195, 1, '0', '0.0.0.0'),
(9, '管理员', '修改管理员AdminID为【1】的数据', 1505660235, 1, '0', '0.0.0.0'),
(10, '管理员', '修改管理员AdminID为【1】的数据', 1505660360, 1, '0', '0.0.0.0'),
(11, '管理员', '修改管理员AdminID为【1】的数据', 1505660435, 1, '0', '0.0.0.0'),
(12, '管理员', '修改管理员AdminID为【1】的数据', 1505660444, 1, '0', '0.0.0.0'),
(13, '管理员', '修改管理员AdminID为【1】的数据', 1505660453, 1, '0', '0.0.0.0'),
(14, '管理员', '修改管理员AdminID为【1】的数据', 1505660755, 1, '0', '0.0.0.0'),
(15, '管理员', '添加管理员【qweqwe】', 1505999114, 1, '0', '0.0.0.0'),
(16, '管理员', '修改管理员AdminID为【2】的数据', 1505999284, 1, '0', '0.0.0.0'),
(17, '管理员', '修改管理员AdminID为【2】的数据', 1505999292, 1, '0', '0.0.0.0'),
(18, '管理员', '删除管理员AdminID为【2】的数据', 1505999586, 1, '0', '0.0.0.0'),
(19, '管理员', '添加管理员【qweqwe】', 1505999647, 1, '0', '0.0.0.0'),
(20, '管理员', '删除管理员AdminID为【3】的数据', 1505999654, 1, '0', '0.0.0.0'),
(21, '管理员', '添加管理员【qweqwe】', 1505999702, 1, '0', '0.0.0.0'),
(22, '管理员', '删除管理员AdminID为【4】的数据', 1505999712, 1, '0', '0.0.0.0'),
(23, '管理员', '添加管理员【qweqwe】', 1506000055, 1, '0', '0.0.0.0'),
(24, '管理员', '添加管理员【qweqwe1】', 1506000068, 1, '0', '0.0.0.0'),
(25, '管理员', '删除管理员AdminID为【5】的数据', 1506000075, 1, '0', '0.0.0.0'),
(26, '管理员', '删除管理员AdminID为【6】的数据', 1506000089, 1, '0', '0.0.0.0'),
(27, '管理员', '修改管理员AdminID为【1】的数据', 1506001967, 1, '0', '0.0.0.0'),
(28, '管理员', '添加管理员【qweqwe】', 1506001998, 1, '0', '0.0.0.0'),
(29, '管理员', '添加管理员【qweqwe1】', 1506002146, 1, '0', '0.0.0.0'),
(30, '管理员', '添加管理员【qweqwe11】', 1506002218, 1, '0', '0.0.0.0'),
(31, '管理员', '删除管理员AdminID为【87】的数据', 1506002236, 1, '0', '0.0.0.0'),
(32, '管理员', '删除管理员AdminID为【87】的数据', 1506005042, 1, '0', '0.0.0.0'),
(33, '管理员', '删除管理员AdminID为【8,7】的数据', 1506005120, 1, '0', '0.0.0.0'),
(34, '管理员登录', '管理员【admin】登录系统', 1506007557, 1, '0', '0.0.0.0'),
(35, '管理员登录', '管理员【admin】登录系统', 1506007647, 1, '0', '0.0.0.0'),
(36, '管理员登录', '管理员【admin】登录系统', 1506007686, 1, '0', '0.0.0.0'),
(37, '管理员登录', '管理员【admin】登录系统', 1506007876, 1, '0', '0.0.0.0'),
(38, '管理员登录', '管理员【admin】登录系统', 1506008039, 1, '0', '0.0.0.0'),
(39, '管理员登录', '管理员【admin】登录系统', 1506008186, 1, '1', '0.0.0.0'),
(40, '管理员登录', '管理员【admin】登录系统', 1506008430, 1, '0', '0.0.0.0'),
(41, '管理员登录', '管理员【admin】登录系统', 1506150821, 1, '0', '0.0.0.0'),
(42, '管理员登录', '管理员【admin】登录系统', 1506153104, 1, '0', '0.0.0.0'),
(43, '管理员登录', '管理员【admin】登录系统', 1506331710, 1, '0', '0.0.0.0'),
(44, '参数', '修改配置参数数据', 1506333592, 1, '1', '0.0.0.0'),
(45, '参数', '修改配置参数数据', 1506333623, 1, '1', '0.0.0.0'),
(46, '参数', '修改配置参数数据', 1506333662, 1, '1', '0.0.0.0'),
(47, '参数', '修改配置参数数据', 1506334654, 1, '1', '0.0.0.0'),
(48, '参数', '修改配置参数数据', 1506334995, 1, '1', '0.0.0.0'),
(49, '管理员登录', '管理员【admin】登录系统', 1506344270, 1, '0', '0.0.0.0'),
(50, '管理员登录', '管理员【admin】登录系统', 1506344732, 1, 'admin', '0.0.0.0'),
(51, '管理员', '删除管理员AdminID为【50,49,48,47,46,45,44,43,42,41,40,39,38,37,36,35,34,33,32,31】的数据', 1506344763, 1, 'admin', '0.0.0.0'),
(52, '接口', '添加接口类型【微信wap】', 1506350701, 1, 'admin', '0.0.0.0'),
(53, '接口', '添加接口类型【微信公众号】', 1506350721, 1, 'admin', '0.0.0.0'),
(54, '接口', '删除接口类型jkID为【2】的数据', 1506351555, 1, 'admin', '0.0.0.0'),
(55, '接口', '添加接口类型【微信公众号】', 1506351564, 1, 'admin', '0.0.0.0'),
(56, '接口', '添加接口类型【微信扫码】', 1506351577, 1, 'admin', '0.0.0.0'),
(57, '管理员登录', '管理员【admin】登录系统', 1506414720, 1, 'admin', '0.0.0.0'),
(58, '接口', '添加接口账户【微信第一账户】', 1506423252, 1, 'admin', '0.0.0.0'),
(59, '接口', '修改接口账户pzid为【1】的数据', 1506424749, 1, 'admin', '0.0.0.0'),
(60, '接口', '修改接口账户pzid为【1】的数据', 1506424763, 1, 'admin', '0.0.0.0'),
(61, '接口', '修改接口账户pzid为【1】的数据', 1506424771, 1, 'admin', '0.0.0.0'),
(62, '接口', '修改接口账户pzid为【1】的数据', 1506424783, 1, 'admin', '0.0.0.0'),
(63, '接口', '修改接口账户pzid为【1】的数据', 1506424815, 1, 'admin', '0.0.0.0'),
(64, '接口', '修改接口账户pzid为【1】的数据', 1506424905, 1, 'admin', '0.0.0.0'),
(65, '接口', '修改接口账户pzid为【1】的数据', 1506424912, 1, 'admin', '0.0.0.0'),
(66, '接口', '修改接口账户pzid为【1】的数据', 1506424938, 1, 'admin', '0.0.0.0'),
(67, '接口', '修改接口账户pzid为【1】的数据', 1506424948, 1, 'admin', '0.0.0.0'),
(68, '接口', '修改接口账户pzid为【1】的数据', 1506424959, 1, 'admin', '0.0.0.0'),
(69, '接口', '修改接口账户pzid为【1】的数据', 1506424973, 1, 'admin', '0.0.0.0'),
(70, '接口', '修改接口账户pzid为【1】的数据', 1506424983, 1, 'admin', '0.0.0.0'),
(71, '接口', '修改接口账户pzid为【1】的数据', 1506424995, 1, 'admin', '0.0.0.0'),
(72, '接口', '修改接口账户pzid为【1】的数据', 1506425011, 1, 'admin', '0.0.0.0'),
(73, '接口', '添加接口类型【支付宝wap】', 1506425306, 1, 'admin', '0.0.0.0'),
(74, '接口', '添加接口类型【支付宝扫码】', 1506425321, 1, 'admin', '0.0.0.0'),
(75, '代理等级', '添加代理等级【一星代理】', 1506435865, 1, 'admin', '0.0.0.0'),
(76, '代理等级', '添加代理等级【二星代理】', 1506435922, 1, 'admin', '0.0.0.0'),
(77, '代理等级', '添加代理等级【三星代理】', 1506435937, 1, 'admin', '0.0.0.0'),
(78, '代理等级', '删除代理等级dlID为【3】的数据', 1506436058, 1, 'admin', '0.0.0.0'),
(79, '代理等级', '修改代理等级dlid为【2】的数据', 1506436070, 1, 'admin', '0.0.0.0'),
(80, '代理等级', '修改代理等级dlid为【2】的数据', 1506436078, 1, 'admin', '0.0.0.0'),
(81, '代理等级', '修改代理等级dlid为【2】的数据', 1506436080, 1, 'admin', '0.0.0.0'),
(82, '管理员登录', '管理员【admin】登录系统', 1506568004, 1, '0', '0.0.0.0'),
(83, '用户', '添加用户【qq51125330】', 1506580626, 1, 'admin', '0.0.0.0'),
(84, '用户', '修改用户UserID为【2017100】的数据', 1506581070, 1, 'admin', '0.0.0.0'),
(85, '用户', '修改用户UserID为【2017100】的数据', 1506581081, 1, 'admin', '0.0.0.0'),
(86, '管理员登录', '管理员【admin】登录系统', 1506654305, 1, 'admin', '0.0.0.0'),
(87, '管理员', '修改管理员密码AdminID为【1】的数据', 1506660969, 1, 'admin', '0.0.0.0'),
(88, '管理员登录', '管理员【admin】登录系统', 1506660977, 1, '0', '0.0.0.0'),
(89, '管理员', '修改管理员密码AdminID为【1】的数据', 1506660995, 1, 'admin', '0.0.0.0'),
(90, '管理员登录', '管理员【admin】登录系统', 1506661006, 1, '0', '0.0.0.0'),
(91, '管理员登录', '管理员【admin】登录系统', 1506680747, 1, 'admin', '0.0.0.0'),
(92, '管理员登录', '管理员【admin】登录系统', 1506689146, 1, 'admin', '0.0.0.0'),
(93, '用户登录', '用户【qq51125330】登录系统', 1506697833, 0, '2017100', '0.0.0.0'),
(94, '用户', '用户注册【2017101】', 1506697871, 0, '2017101', '0.0.0.0'),
(95, '管理员登录', '管理员【admin】登录系统', 1506697886, 1, 'qq51125330', '0.0.0.0'),
(96, '用户登录', '用户【qq51125330】登录系统', 1506777904, 0, '2017100', '0.0.0.0'),
(97, '用户登录', '用户【qq51125330】登录系统', 1506778559, 0, '2017100', '0.0.0.0'),
(98, '用户登录', '用户【qq51125330】登录系统', 1506778591, 0, '2017100', '0.0.0.0'),
(99, '用户登录', '用户【qq51125330】登录系统', 1506781551, 0, '2017100', '0.0.0.0'),
(100, '用户账户', '修改用户UserID为【2017100】的数据', 1506786655, 0, '2017100', '0.0.0.0'),
(101, '用户账户', '修改用户UserID为【2017100】的数据', 1506786663, 0, '2017100', '0.0.0.0'),
(102, '用户登录', '用户【qq51125330】登录系统', 1506836746, 0, '2017100', '0.0.0.0'),
(103, '银行卡', '添加银行卡【ww】', 1506852220, 0, '2017100', '0.0.0.0'),
(104, '银行卡', '添加银行卡【qq】', 1506852318, 0, '2017100', '0.0.0.0'),
(105, '银行卡', '添加银行卡【qq】', 1506852445, 0, '2017100', '0.0.0.0'),
(106, '银行卡', '修改银行卡ID为【1】的数据', 1506852680, 0, '2017100', '0.0.0.0'),
(107, '银行卡', '删除银行卡ID为【2】的数据', 1506853294, 0, 'qq51125330', '0.0.0.0'),
(108, '银行卡', '添加银行卡【123@qq.com】', 1506858874, 0, '2017100', '0.0.0.0'),
(109, '管理员登录', '管理员【admin】登录系统', 1506858956, 1, 'qq51125330', '0.0.0.0'),
(110, '用户', '修改用户UserID为【2017100】的数据', 1506858983, 1, 'admin', '0.0.0.0'),
(111, '用户登录', '用户【qq51125330】登录系统', 1506859189, 0, '2017100', '0.0.0.0'),
(112, '管理员登录', '管理员【admin】登录系统', 1506859321, 1, 'qq51125330', '0.0.0.0'),
(113, '用户登录', '用户【qq51125330】登录系统', 1506859397, 0, '2017100', '0.0.0.0'),
(114, '管理员登录', '管理员【admin】登录系统', 1506859795, 1, 'qq51125330', '0.0.0.0'),
(115, '用户登录', '用户【qq51125330】登录系统', 1506862559, 0, '2017100', '0.0.0.0'),
(116, '用户登录', '用户【qq51125330】登录系统', 1506948866, 0, '2017100', '0.0.0.0'),
(117, '管理员登录', '管理员【admin】登录系统', 1506949722, 1, 'qq51125330', '0.0.0.0'),
(118, '用户登录', '用户【qq51125330】登录系统', 1506949737, 0, '2017100', '0.0.0.0'),
(119, '管理员登录', '管理员【admin】登录系统', 1506949841, 1, '0', '0.0.0.0'),
(120, '参数', '修改配置参数数据', 1506953406, 1, 'admin', '0.0.0.0'),
(121, '参数', '修改配置参数数据', 1506953428, 1, 'admin', '0.0.0.0'),
(122, '接口', '修改接口类型jkid为【1】的数据', 1506954735, 1, 'admin', '0.0.0.0'),
(123, '用户', '管理员修改用户费率【2017101】', 1506954841, 1, 'admin', '0.0.0.0'),
(124, '用户', '管理员修改用户费率【2017101】', 1506955212, 1, 'admin', '0.0.0.0'),
(125, '用户', '管理员修改用户费率【2017101】', 1506955231, 1, 'admin', '0.0.0.0'),
(126, '用户', '管理员修改用户费率【2017101】', 1506955432, 1, 'admin', '0.0.0.0'),
(127, '用户', '管理员修改用户费率【2017101】', 1506955453, 1, 'admin', '0.0.0.0'),
(128, '用户', '添加用户【ee51125330】', 1506955519, 1, 'admin', '0.0.0.0'),
(129, '扣量', '修改扣量用户UserID为【3】的数据', 1506955630, 1, 'admin', '0.0.0.0'),
(130, '用户', '添加用户【rr51125330】', 1506955664, 1, 'admin', '0.0.0.0'),
(131, '用户', '管理员修改用户费率【2017100】', 1506958225, 1, 'admin', '0.0.0.0'),
(132, '用户登录', '用户【qq51125330】登录系统', 1507001961, 0, '2017100', '0.0.0.0'),
(133, '管理员登录', '管理员【admin】登录系统', 1507001969, 1, 'admin', '0.0.0.0'),
(134, '用户', '修改用户UserID为【2017100】的数据', 1507002049, 1, 'admin', '0.0.0.0'),
(135, '参数', '修改配置参数数据', 1507002228, 1, 'admin', '0.0.0.0'),
(136, '参数', '修改配置参数数据', 1507002262, 1, 'admin', '0.0.0.0'),
(137, '参数', '修改配置参数数据', 1507002340, 1, 'admin', '0.0.0.0'),
(138, '参数', '修改配置参数数据', 1507002891, 1, 'admin', '0.0.0.0'),
(139, '参数', '修改配置参数数据', 1507002972, 1, 'admin', '0.0.0.0'),
(140, '参数', '修改配置参数数据', 1507004346, 1, 'admin', '0.0.0.0'),
(141, '参数', '修改配置参数数据', 1507004359, 1, 'admin', '0.0.0.0'),
(142, '参数', '修改配置参数数据', 1507004371, 1, 'admin', '0.0.0.0'),
(143, '用户登录', '用户【qq51125330】登录系统', 1507090985, 0, '2017100', '0.0.0.0'),
(144, '管理员登录', '管理员【admin】登录系统', 1507096830, 1, '0', '0.0.0.0'),
(145, '管理员登录', '管理员【admin】登录系统', 1507339344, 1, '0', '0.0.0.0'),
(146, '用户登录', '用户【qq51125330】登录系统', 1507339355, 0, '2017100', '0.0.0.0'),
(147, '参数', '修改配置参数数据', 1507373033, 1, 'admin', '0.0.0.0'),
(148, '用户', '用户注册【2017104】', 1507385787, 0, '2017104', '0.0.0.0'),
(149, '用户登录', '用户【aa51125330】登录系统', 1507385799, 0, '2017104', '0.0.0.0'),
(150, '管理员登录', '管理员【admin】登录系统', 1507431611, 1, '0', '0.0.0.0'),
(151, '接口', '修改接口账户pzid为【1】的数据', 1507432143, 1, 'admin', '0.0.0.0'),
(152, '接口', '修改接口账户pzid为【1】的数据', 1507432152, 1, 'admin', '0.0.0.0'),
(153, '接口', '修改接口账户pzid为【1】的数据', 1507432240, 1, 'admin', '0.0.0.0'),
(154, '接口', '修改接口账户pzid为【1】的数据', 1507432243, 1, 'admin', '0.0.0.0'),
(155, '接口', '修改接口账户pzid为【1】的数据', 1507432250, 1, 'admin', '0.0.0.0'),
(156, '接口', '修改接口账户pzid为【1】的数据', 1507432259, 1, 'admin', '0.0.0.0'),
(157, '接口', '修改接口账户pzid为【1】的数据', 1507436706, 1, 'admin', '0.0.0.0'),
(158, '管理员登录', '管理员【admin】登录系统', 1507466254, 1, 'admin', '0.0.0.0'),
(159, '接口', '添加接口账户【支付宝第一账户】', 1507466350, 1, 'admin', '0.0.0.0'),
(160, '接口', '修改接口账户pzid为【2】的数据', 1507467121, 1, 'admin', '0.0.0.0'),
(161, '接口', '修改接口账户pzid为【2】的数据', 1507467203, 1, 'admin', '0.0.0.0'),
(162, '接口', '修改接口账户pzid为【2】的数据', 1507468663, 1, 'admin', '0.0.0.0'),
(163, '接口', '修改接口账户pzid为【1】的数据', 1507469626, 1, 'admin', '0.0.0.0'),
(164, '接口', '修改接口账户pzid为【1】的数据', 1507470278, 1, 'admin', '0.0.0.0'),
(165, '管理员登录', '管理员【admin】登录系统', 1507546671, 1, '0', '0.0.0.0'),
(166, '用户登录', '用户【qq51125330】登录系统', 1507638667, 0, '2017100', '0.0.0.0'),
(167, '管理员登录', '管理员【admin】登录系统', 1507640183, 1, '0', '0.0.0.0'),
(168, '扣量', '添加扣量用户【2017100】', 1507640593, 1, 'admin', '0.0.0.0'),
(169, '管理员登录', '管理员【admin】登录系统', 1507642843, 1, '0', '192.168.0.100'),
(170, '管理员登录', '管理员【admin】登录系统', 1507687761, 1, 'admin', '0.0.0.0'),
(171, '管理员登录', '管理员【admin】登录系统', 1507729771, 1, 'admin', '0.0.0.0'),
(172, '管理员登录', '管理员【admin】登录系统', 1507773298, 1, 'admin', '0.0.0.0'),
(173, '接口', '修改接口账户pzid为【2】的数据', 1507773456, 1, 'admin', '0.0.0.0'),
(174, '接口', '修改接口账户pzid为【2】的数据', 1507773718, 1, 'admin', '0.0.0.0'),
(175, '接口', '修改接口账户pzid为【2】的数据', 1507773810, 1, 'admin', '0.0.0.0'),
(176, '接口', '修改接口账户pzid为【2】的数据', 1507774606, 1, 'admin', '0.0.0.0'),
(177, '接口', '修改接口账户pzid为【1】的数据', 1507775768, 1, 'admin', '0.0.0.0'),
(178, '参数', '修改配置参数数据', 1507779271, 1, 'admin', '0.0.0.0'),
(179, '用户登录', '用户【qq51125330】登录系统', 1507780831, 0, '2017100', '0.0.0.0'),
(180, '用户登录', '用户【qq51125330】登录系统', 1507781590, 0, '2017100', '0.0.0.0'),
(181, '参数', '修改配置参数数据', 1507794871, 1, 'admin', '0.0.0.0'),
(182, '用户', '用户注册【2017105】', 1507795333, 0, '2017105', '0.0.0.0'),
(183, '用户登录', '用户【zz51125330】登录系统', 1507795346, 0, '2017105', '0.0.0.0'),
(184, '参数', '修改配置参数数据', 1507795527, 1, 'admin', '0.0.0.0'),
(185, '参数', '修改配置参数数据', 1507796202, 1, 'admin', '0.0.0.0'),
(186, '用户登录', '用户【zz51125330】登录系统', 1507796230, 0, '2017105', '0.0.0.0'),
(187, '参数', '修改配置参数数据', 1507796514, 1, 'admin', '0.0.0.0'),
(188, '参数', '修改配置参数数据', 1507796523, 1, 'admin', '0.0.0.0'),
(189, '管理员登录', '管理员【admin】登录系统', 1507853543, 1, '0', '0.0.0.0'),
(190, '用户登录', '用户【qq51125330】登录系统', 1507855347, 0, '2017100', '0.0.0.0'),
(191, '用户', '修改用户UserID为【2017100】的数据', 1507855396, 1, 'admin', '0.0.0.0'),
(192, '用户', '修改用户UserID为【2017100】的数据', 1507855642, 1, 'admin', '0.0.0.0'),
(193, '申请提现', '申请提现【100】', 1507855657, 0, '2017100', '0.0.0.0'),
(194, '用户', '添加用户【xx51125330】', 1507856395, 1, 'admin', '0.0.0.0'),
(195, '用户', '管理员修改用户费率【2017106】', 1507856418, 1, 'admin', '0.0.0.0'),
(196, '参数', '修改配置参数数据', 1507856453, 1, 'admin', '0.0.0.0'),
(197, '用户', '添加用户【cc51125330】', 1507856489, 1, 'admin', '0.0.0.0'),
(198, '用户', '管理员修改用户费率【2017107】', 1507856507, 1, 'admin', '0.0.0.0'),
(199, '用户', '管理员修改用户费率【2017107】', 1507856517, 1, 'admin', '0.0.0.0'),
(200, '参数', '修改配置参数数据', 1507856673, 1, 'admin', '0.0.0.0'),
(201, '用户', '添加用户【vv51125330】', 1507856705, 1, 'admin', '0.0.0.0'),
(202, '用户', '管理员修改用户费率【2017108】', 1507856710, 1, 'admin', '0.0.0.0'),
(203, '用户账户', '修改用户UserID为【2017100】的数据', 1507856783, 0, '2017100', '0.0.0.0'),
(204, '用户登录', '用户【qq51125330】登录系统', 1507856798, 0, '2017100', '0.0.0.0'),
(205, '申请提现', '申请提现【100】', 1507856817, 0, '2017100', '0.0.0.0'),
(206, '订单', '删除订单3天以上未支付的数据', 1507862496, 1, 'admin', '0.0.0.0'),
(207, '用户', '用户注册【2017109】', 1507863007, 0, '2017109', '0.0.0.0'),
(208, '用户', '用户注册【2017110】', 1507863209, 0, '2017110', '0.0.0.0'),
(209, '账单', '修改账单状态id为【1】的数据', 1507863405, 1, 'admin', '0.0.0.0'),
(210, '用户登录', '用户【yy51125330】登录系统', 1507864700, 0, '2017110', '0.0.0.0'),
(211, '管理员登录', '管理员【admin】登录系统', 1507878725, 1, 'admin', '0.0.0.0'),
(212, '管理员', '删除管理员AdminID为【9】的数据', 1507878736, 1, 'admin', '0.0.0.0'),
(213, '订单', '删除订单3天以上未支付的数据', 1507878756, 1, 'admin', '0.0.0.0'),
(214, '订单', '删除订单DingdanID为【42,41,40,39,38,37,36,35,34,33,32,31,30,29,28】的数据', 1507878763, 1, 'admin', '0.0.0.0'),
(215, '订单', '删除订单DingdanID为【27,26,25,24,23,22,21,20,19,18,17,16,15,14,13】的数据', 1507878772, 1, 'admin', '0.0.0.0'),
(216, '订单', '删除订单DingdanID为【12,11,10,9,8,7】的数据', 1507878775, 1, 'admin', '0.0.0.0'),
(217, '用户', '删除用户UserID为【11,10,9,8,7,6,5,4,3,2】的数据', 1507878812, 1, 'admin', '0.0.0.0'),
(218, '扣量', '删除扣量用户zjID为【6,5,4,2,1】的数据', 1507878820, 1, 'admin', '0.0.0.0'),
(219, '银行卡', '删除银行卡ID为【3,1】的数据', 1507878827, 1, 'admin', '0.0.0.0'),
(220, '用户', '删除用户UserID为【11,10,9,8,7,6,5,4,3,2】的数据', 1507878864, 1, 'admin', '0.0.0.0'),
(221, '用户', '删除用户UserID为【11】的数据', 1507878930, 1, 'admin', '0.0.0.0'),
(222, '用户', '删除用户UserID为【11】的数据', 1507878944, 1, 'admin', '0.0.0.0'),
(223, '用户', '删除用户UserID为【11,10,9,8,7,6,5,4,3,2】的数据', 1507879001, 1, 'admin', '0.0.0.0'),
(224, '订单', '删除订单DingdanID为【5】的数据', 1507879029, 1, 'admin', '0.0.0.0'),
(225, '订单', '删除订单DingdanID为【6】的数据', 1507879035, 1, 'admin', '0.0.0.0'),
(226, '参数', '修改配置参数数据', 1507880445, 1, 'admin', '0.0.0.0'),
(227, '管理员登录', '管理员【admin】登录系统', 1507946289, 1, 'admin', '0.0.0.0'),
(228, '管理员登录', '管理员【admin】登录系统', 1508056003, 1, 'admin', '0.0.0.0'),
(229, '管理员登录', '管理员【admin】登录系统', 1508311582, 1, 'admin', '0.0.0.0'),
(230, '管理员登录', '管理员【admin】登录系统', 1508480316, 1, '0', '0.0.0.0'),
(231, '参数', '修改配置参数数据', 1508480332, 1, 'admin', '0.0.0.0'),
(232, '参数', '修改配置参数数据', 1508480338, 1, 'admin', '0.0.0.0'),
(233, '参数', '修改配置参数数据', 1508480346, 1, 'admin', '0.0.0.0'),
(234, '接口', '修改接口账户pzid为【1】的数据', 1508481442, 1, 'admin', '0.0.0.0'),
(235, '用户', '添加用户【ww51125330】', 1508481934, 1, 'admin', '0.0.0.0'),
(236, '管理员登录', '管理员【admin】登录系统', 1508508642, 1, 'admin', '0.0.0.0'),
(237, '管理员登录', '管理员【admin】登录系统', 1520248809, 1, '0', '115.60.93.114'),
(238, '用户', '修改用户UserID为【2017100】的数据', 1520248904, 1, 'admin', '115.60.93.114'),
(239, '用户登录', '用户【qq51125330】登录系统', 1520248918, 0, '2017100', '115.60.93.114'),
(240, '管理员登录', '管理员【admin】登录系统', 1520249486, 1, '0', '59.63.206.199'),
(241, '管理员登录', '管理员【admin】登录系统', 1520249622, 1, '0', '115.60.93.114'),
(242, '用户', '用户注册【2017102】', 1520249636, 0, '2017102', '124.236.212.28'),
(243, '用户登录', '用户【112345】登录系统', 1520249652, 0, '2017102', '124.236.212.28'),
(244, '管理员登录', '管理员【admin】登录系统', 1520249690, 1, '0', '124.236.212.28'),
(245, '用户登录', '用户【112345】登录系统', 1520249800, 0, '2017102', '124.236.212.28'),
(246, '用户登录', '用户【112345】登录系统', 1520249827, 0, '2017102', '124.236.212.28'),
(247, '管理员登录', '管理员【admin】登录系统', 1520250119, 1, 'admin', '124.236.212.28'),
(248, '管理员登录', '管理员【admin】登录系统', 1520262664, 1, '0', '221.220.156.9'),
(249, '用户', '用户注册【2017103】', 1520304721, 0, '2017103', '221.220.156.9'),
(250, '用户登录', '用户【admin】登录系统', 1520304746, 0, '2017103', '221.220.156.9'),
(251, '参数', '修改配置参数数据', 1520305545, 1, 'admin', '221.220.156.9'),
(252, '用户登录', '用户【admin】登录系统', 1520305640, 0, '2017103', '221.220.156.9'),
(253, '管理员登录', '管理员【admin】登录系统', 1520307525, 1, 'admin', '59.63.206.200'),
(254, '管理员登录', '管理员【admin】登录系统', 1520392182, 1, '0', '218.77.95.82'),
(255, '管理员登录', '管理员【admin】登录系统', 1520402083, 1, '0', '124.90.54.129'),
(256, '管理员登录', '管理员【admin】登录系统', 1520402482, 1, '0', '124.90.54.129'),
(257, '管理员登录', '管理员【admin】登录系统', 1520422276, 1, 'admin', '218.77.95.82'),
(258, '管理员登录', '管理员【admin】登录系统', 1520437868, 1, '0', '125.120.174.208'),
(259, '管理员登录', '管理员【admin】登录系统', 1520520060, 1, '0', '111.197.6.177'),
(260, '参数', '修改配置参数数据', 1520520113, 1, 'admin', '111.197.6.177'),
(261, '参数', '修改配置参数数据', 1520567335, 1, 'admin', '111.197.6.177'),
(262, '管理员登录', '管理员【admin】登录系统', 1520574182, 1, '0', '115.60.93.241'),
(263, '管理员登录', '管理员【admin】登录系统', 1520690935, 1, '0', '125.120.174.208');

-- --------------------------------------------------------

--
-- 表的结构 `fx_user`
--

CREATE TABLE IF NOT EXISTS `fx_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `username` varchar(20) NOT NULL COMMENT '用户账户',
  `password` varchar(32) NOT NULL COMMENT '用户密码',
  `qq` varchar(20) NOT NULL COMMENT 'qq号',
  `tx` decimal(10,2) NOT NULL COMMENT '提现金额',
  `money` decimal(10,2) NOT NULL COMMENT '账户余额',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 默认0正常  1锁定',
  `miyao` varchar(32) NOT NULL COMMENT '秘钥',
  `savecode` varchar(20) NOT NULL COMMENT '安全码',
  `lastip` varchar(20) NOT NULL COMMENT '最后一次登录ip',
  `logintimes` int(11) NOT NULL COMMENT '登录次数',
  `addtime` int(10) NOT NULL COMMENT '注册时间',
  `phone` varchar(20) NOT NULL COMMENT '手机号',
  `email` varchar(20) NOT NULL COMMENT '邮箱',
  `txpassword` varchar(32) NOT NULL COMMENT '提现密码',
  `ifagent` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是代理 默认0 不是 1是',
  `agent` int(11) NOT NULL COMMENT '代理id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userid` (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `fx_user`
--

INSERT INTO `fx_user` (`id`, `userid`, `username`, `password`, `qq`, `tx`, `money`, `status`, `miyao`, `savecode`, `lastip`, `logintimes`, `addtime`, `phone`, `email`, `txpassword`, `ifagent`, `agent`) VALUES
(1, 2017100, 'qq51125330', '9d47c7a7e80f7736d844a155078d2456', '51125330', '200.00', '10911.80', 0, 'ZVFjVNoCFluOoYcpzPUtYIIRsZVPilhC', 'yGAmHt', '115.60.93.114', 20, 1506580626, '15515515555', '51125330@qq.com', '2c2685041640f92b7814cab9b5449883', 1, 0),
(2, 2017101, 'ww51125330', '37e262f6de2208ae4c26b7157c99950e', '51125330', '0.00', '0.00', 0, 'siZzAnNbGDrFHjOrCuLDmZgtcMdTgCxq', 'otPmBE', '0.0.0.0', 0, 1508481934, '15515515555', '51125330@qq.com', '37e262f6de2208ae4c26b7157c99950e', 0, 0),
(3, 2017102, '112345', '403a64dcc37e7a12fcd36df6800ecd06', '2909401105', '0.00', '0.00', 0, 'bBbohmLiIgcvksKqfGDAHHtDoDKaVflB', 'SO|B)''4+J#1hq+%', '124.236.212.28', 3, 1520249636, '15614103757', '123456@qq.com', '1ef7372066417b433cc618413452c83a', 0, 0),
(4, 2017103, 'admin', 'f693da0c3f7e93ea60f466f49df158c5', '89674508', '0.00', '0.00', 0, 'AACMgdPXUWJuUpEeUJhNrzMCcBrfXsDR', 'Trc''9r*aa6^Y^i>', '221.220.156.9', 2, 1520304721, '18618407067', '89674508@qq.com', 'f693da0c3f7e93ea60f466f49df158c5', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fx_zijian`
--

CREATE TABLE IF NOT EXISTS `fx_zijian` (
  `zjid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `zijian` int(11) NOT NULL DEFAULT '10' COMMENT '自减值',
  `initval` int(11) NOT NULL DEFAULT '10' COMMENT '初始值',
  PRIMARY KEY (`zjid`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户扣量自减表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `fx_zijian`
--

INSERT INTO `fx_zijian` (`zjid`, `userid`, `zijian`, `initval`) VALUES
(3, 2017100, 0, 0),
(4, 2017101, 10, 10),
(5, 2017102, 10, 10),
(6, 2017103, 10, 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
