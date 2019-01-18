/*
 Navicat Premium Data Transfer

 Source Server         : zmzc_test
 Source Server Type    : MySQL
 Source Server Version : 50641
 Source Host           : 106.15.196.35:3306
 Source Schema         : cs_db

 Target Server Type    : MySQL
 Target Server Version : 50641
 File Encoding         : 65001

 Date: 18/01/2019 15:04:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cs_bank_code
-- ----------------------------
DROP TABLE IF EXISTS `cs_bank_code`;
CREATE TABLE `cs_bank_code`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bank_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `color` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bank_name`(`bank_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 228 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cs_bank_code
-- ----------------------------
INSERT INTO `cs_bank_code` VALUES (1, '中国银行', 'BOC', NULL, 'zhongguo.jpg');
INSERT INTO `cs_bank_code` VALUES (2, '中国农业银行', 'ABC', NULL, 'nongye.jpg');
INSERT INTO `cs_bank_code` VALUES (3, '中国工商银行', 'ICBC', NULL, 'gongshang.png');
INSERT INTO `cs_bank_code` VALUES (4, '中国建设银行', 'CCB', NULL, 'jianshe.png');
INSERT INTO `cs_bank_code` VALUES (5, '交通银行', 'COMM', NULL, 'jiaotong.jpg');
INSERT INTO `cs_bank_code` VALUES (6, '中国邮政储蓄银行', 'PSBC', NULL, 'youzhengchuxu.png');
INSERT INTO `cs_bank_code` VALUES (7, '招商银行', 'CMB', NULL, 'zhaoshang.jpg');
INSERT INTO `cs_bank_code` VALUES (8, '中国民生银行', 'CMBC', NULL, 'minsheng.jpg');
INSERT INTO `cs_bank_code` VALUES (9, '中信银行', 'CITIC', NULL, 'zhaongxin.jpg');
INSERT INTO `cs_bank_code` VALUES (10, '光大银行', 'CEB', NULL, 'guangda.jpg');
INSERT INTO `cs_bank_code` VALUES (11, '华夏银行', 'HXB', NULL, 'huaxia.jpg');
INSERT INTO `cs_bank_code` VALUES (12, '广发银行', 'GDB', NULL, 'guangfa.png');
INSERT INTO `cs_bank_code` VALUES (13, '深圳发展银行', 'SDB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (14, '兴业银行', 'CIB', NULL, 'xingye.png');
INSERT INTO `cs_bank_code` VALUES (15, '浦东发展银行', 'SPDB', NULL, 'pufa.jpg');
INSERT INTO `cs_bank_code` VALUES (16, '恒丰银行', 'EGB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (17, '齐鲁银行', 'QLBANK', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (18, '烟台商业银行', 'YTB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (19, '潍坊银行', 'WFCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (20, '临沂商业银行', 'LSB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (21, '浙商银行', 'CZB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (22, '渤海银行', 'CBHB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (23, '上海银行', 'SHB', NULL, 'shanghai.png');
INSERT INTO `cs_bank_code` VALUES (24, '厦门银行', 'XMCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (25, '北京银行', 'BJB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (26, '福建海峡银行', 'FJHXB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (27, '宁波银行', 'NBB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (28, '平安银行', 'SPAB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (29, '焦作市商业银行', 'JZCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (30, '温州银行', 'WZCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (31, '广州银行', 'GCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (32, '汉口银行', 'HKBC', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (33, '龙江银行', 'DAQINGB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (34, '盛京银行', 'SJB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (35, '洛阳银行', 'BOLY', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (36, '大连银行', 'DLB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (37, '苏州市商业银行', 'SZB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (38, '南京银行', 'NJCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (39, '东莞市商业银行', 'DGB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (40, '金华银行', 'JHCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (41, '乌鲁木齐市商业银行', 'URMQCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (42, '绍兴银行', 'SXCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (43, '成都市商业银行', 'BCD', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (44, '抚顺银行', 'FSB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (45, '葫芦岛市商业银行', 'HLDB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (46, '郑州银行', 'ZZB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (47, '宁夏银行', 'YCCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (48, '珠海华润银行', 'CRB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (49, '齐商银行', 'QSB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (50, '锦州银行', 'BOJZ', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (51, '徽商银行', 'HSB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (52, '重庆银行', 'CQB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (53, '哈尔滨银行', 'HEBB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (54, '贵阳银行', 'GYB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (55, '西安银行', 'XAB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (56, '无锡市商业银行', 'WRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (57, '丹东银行', 'DDB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (58, '兰州银行', 'LZB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (59, '南昌银行', 'NCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (60, '晋商银行', 'JSHB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (61, '青岛商行', 'QDCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (62, '吉林市商业银行', 'JLB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (63, '九江银行', 'JJCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (64, '鞍山市商业银行', 'BOAS', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (65, '秦皇岛市商业银行', 'QHDB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (66, '青海银行', 'QHB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (67, '台州银行', 'TZCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (68, '长沙银行', 'CSCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (69, '赣州银行', 'GZCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (70, '泉州市商业银行', 'QZCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (71, '营口市商业银行', 'BOYK', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (72, '阜新银行', 'FXB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (73, '嘉兴市商业银行', 'JXCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (74, '廊坊银行', 'LCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (75, '泰隆城市信用社', 'ZJTLCRU', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (76, '内蒙古银行', 'BOIMC', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (77, '湖州市商业银行', 'HZCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (78, '沧州银行', 'BOCZ', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (79, '威海市商业银行', 'WHSHB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (80, '攀枝花市商业银行', 'PZHCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (81, '绵阳市商业银行', 'MYSYYH', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (82, '泸州市商业银行', 'LZCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (83, '大同市商业银行', 'DTCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (84, '三门峡市商业银行', 'SMXB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (85, '江苏长江商业银行', 'CJCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (86, '柳州银行', 'LZHCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (87, '南充市商业银行', 'CGNB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (88, '莱商银行', 'LSBC', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (89, '唐山市商业银行', 'TSB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (90, '六盘水商行', 'LPSB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (91, '曲靖市商业银行', 'QJCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (92, '晋城银行', 'JCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (93, '江苏银行', 'JSB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (94, '长治市商业银行', 'CZCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (95, '承德银行', 'CDB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (96, '德州银行', 'DZB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (97, '遵义市商业银行', 'ZYB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (98, '邯郸市商业银行', 'HDCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (99, '安顺市商业银行', 'ASHB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (100, '玉溪市商业银行', 'YXCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (101, '浙江民泰商业银行', 'MTBANK', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (102, '上饶银行', 'SRB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (103, '东营市商业银行', 'DYCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (104, '泰安市商业银行', 'TACCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (105, '浙江稠州商业银行', 'CZCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (106, '乌海银行', 'WHCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (107, '自贡市商业银行', 'ZGB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (108, '鄂尔多斯银行', 'ORBANK', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (109, '鹤壁银行', 'HBSB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (110, '许昌市商业银行', 'XCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (111, '济宁银行', 'JNB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (112, '铁岭市商业银行', 'BOTL', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (113, '乐山市商业银行', 'LSCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (114, '长安银行', 'CCABC', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (115, '重庆三峡银行', 'CCQTGB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (116, '石嘴山银行', 'SZSCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (117, '盘锦市商业银行', 'PJB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (118, '昆仑银行', 'KLB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (119, '平顶山银行', 'PDSCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (120, '朝阳市商业银行', 'CYCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (121, '遂宁市商业银行', 'SNCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (122, '保定市商业银行', 'BOBD', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (123, '邢台银行', 'XTB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (124, '凉山州商业银行', 'LSZSH', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (125, '漯河商行', 'LHB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (126, '达州市商业银行', 'DZCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (127, '新乡市商业银行', 'XXSSH', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (128, '晋中市商业银行', 'JZB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (129, '驻马店市商业银行', 'ZMDB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (130, '衡水市商业银行', 'HSMB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (131, '周口市商业银行', 'ZKB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (132, '阳泉市商业银行', 'YQCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (133, '宜宾市商业银行', 'YBCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (134, '库尔勒市商业银行', 'XJKCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (135, '雅安市商业银行', 'YACCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (136, '商丘商行', 'SQB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (137, '安阳市商业银行', 'AYB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (138, '信阳银行', 'XYCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (139, '华融湘江银行', 'HRXJB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (140, '上海农村信用社', 'SRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (141, '昆山农信社', 'JSNXB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (142, '常熟农村商业银行', 'CSRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (143, '广州农村商业银行', 'GRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (144, '佛山顺德农村商业银行', 'SDEB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (145, '湖北农村信用社', 'HBXH', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (146, '江阴农村商业银行', 'JRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (147, '重庆农村商业银行', 'CRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (148, '山东省农村信用社', 'SDNXS', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (149, '东莞农村商业银行', 'DRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (150, '张家港农村商业银行', 'ZRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (151, '福建省农村信用社', 'FJNXB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (152, '北京农村商业银行', 'BJRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (153, '天津农村商业银行', 'TRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (154, '鄞州银行', 'YZB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (155, '成都农村商业银行', 'CDRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (156, '江苏省农村信用社', 'JSNX', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (157, '吴江农商行', 'WJRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (158, '浙江省农村信用社', 'ZJRCC', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (159, '珠海农村信用社', 'ZHRCU', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (160, '太仓农村商业银行', 'TCRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (161, '贵州省农村信用社', 'GZNXB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (162, '无锡农村商业银行', 'WXRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (163, '江西农信联合社', 'JXNXS', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (164, '河南省农村信用社', 'HNNX', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (165, '陕西省农村信用社', 'SXNXS', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (166, '广西农村信用社', 'GXRCU', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (167, '新疆农村信用社', 'XJCCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (168, '吉林农信联合社', 'JLNLS', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (169, '黄河农村商业银行', 'BYW', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (170, '安徽省农村信用社', 'AHRCU', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (171, '青海省农村信用社', 'QHYHXH', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (172, '广东省农村信用社', 'GDRCU', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (173, '内蒙古农村信用社', 'NMGNXS', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (174, '四川省农村信用社', 'SCRCU', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (175, '甘肃省农村信用社', 'GSRCU', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (176, '辽宁省农村信用社', 'LNRCC', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (177, '山西省农村信用社', 'SXINJ', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (178, '天津滨海农村商业银行', 'TJBHB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (179, '黑龙江省农村信用社', 'HLJRCC', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (180, '青岛即墨北农商村镇银行', 'QDJMB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (181, '浙江长兴联合村镇银行', 'ZJCURB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (182, '深圳龙岗鼎业村镇银行', 'EDRB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (183, '中山小榄村镇银行', 'ZSXLB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (184, '深圳福田银座村镇银行', 'FTYZB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (185, '杭州市商业银行', 'HZCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (187, '日照银行', 'BORZ', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (188, '富滇银行', 'FDB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (189, '浙江泰隆商业银行', 'ZJTLCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (190, '广西北部湾银行', 'BOBBG', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (191, '桂林银行', 'GLB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (192, '上海农村商业银行', 'SHRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (193, '云南省农村信用社', 'YNRCC', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (194, '河北省农村信用社', 'HEBNX', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (195, '湖北银行', 'HBB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (196, '广州农村信用合作社', 'GZCRU', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (197, '深圳市农村商业银行', 'SZCRU', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (198, '景德镇商业银行', 'BOFJDZ', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (199, '新疆汇和银行', 'BOHH', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (200, '广东华兴银行', 'GHB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (201, '江南农村商业银行', 'JNRCU', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (202, '深圳宝安融兴村镇银行', 'BARXB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (203, '南阳村镇银行', 'NYCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (204, '河北银行股份有限公司', 'BHB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (206, '包商银行', 'BSB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (207, '濮阳银行', 'PYYH', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (208, '宁波通商银行', 'NBCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (209, '甘肃银行', 'GSB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (210, '上海农商银行', 'SHRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (211, '青岛农信', 'QRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (212, '福建省农村信用社联合社', 'FJNX', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (213, '贵州省农村信用社联合社', 'GZNXRU', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (214, '湖南省农村信用社联合社', 'HNNXB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (215, '海南省农村信用社联合社', 'HNB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (216, '广东南粤银行', 'ZJCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (217, '无锡农村商业银行', 'WXRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (218, '枣庄银行', 'ZHZB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (219, '武汉农村商业银行', 'WHRCB', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (220, '东亚银行', 'BEA', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (222, '工商银行', 'ICBC', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (224, '邮政储蓄银行', 'PSBC', NULL, NULL);
INSERT INTO `cs_bank_code` VALUES (227, '浦发银行', 'SPDB', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
