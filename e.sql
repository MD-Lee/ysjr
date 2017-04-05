-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 01 月 05 日 11:19
-- 服务器版本: 5.5.40
-- PHP 版本: 5.4.33

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `e_kuaijin`
--

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_activity`
--

CREATE TABLE IF NOT EXISTS `haoidcn_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_start` varchar(20) DEFAULT NULL COMMENT '活动开始的时间',
  `time_end` varchar(20) DEFAULT NULL COMMENT '活动结束时间',
  `money_num` int(10) DEFAULT NULL COMMENT '优惠金额',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加活动时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `haoidcn_activity`
--

INSERT INTO `haoidcn_activity` (`id`, `time_start`, `time_end`, `money_num`, `time`) VALUES
(2, '2016-08-16', '2016-08-21', 20, '2016-08-21 16:00:00'),
(3, '2016-08-17', '2016-08-25', 20, '2016-08-22 10:44:05'),
(4, '2016-08-15', '2016-08-18', 20, '2016-08-22 10:46:32'),
(5, '2016-08-15 ', '2016-08-25', 20, '2016-08-22 10:49:26'),
(9, '2016-09-02', '2016-09-03', 20, '2016-09-02 02:08:49');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_addwork`
--

CREATE TABLE IF NOT EXISTS `haoidcn_addwork` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tz_status` enum('1','-1') NOT NULL DEFAULT '-1',
  `g_reply` text NOT NULL,
  `repdate` varchar(250) NOT NULL,
  `pid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_admin_data`
--

CREATE TABLE IF NOT EXISTS `haoidcn_admin_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '出借人',
  `uid` varchar(30) DEFAULT NULL COMMENT '出借人身份证号',
  `company` varchar(100) DEFAULT NULL COMMENT '后台管理员公司',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `mobile` varchar(30) DEFAULT NULL COMMENT '联系电话',
  `mailbox` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `account_num` varchar(100) DEFAULT NULL COMMENT '支付宝账号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `haoidcn_admin_data`
--

INSERT INTO `haoidcn_admin_data` (`id`, `name`, `uid`, `company`, `address`, `mobile`, `mailbox`, `account_num`) VALUES
(1, 'aaaa', '350600199902145678', '啊啊啊', '泉州晋江', '383843888', '6986896@qq.com', '689698789');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_agreement`
--

CREATE TABLE IF NOT EXISTS `haoidcn_agreement` (
  `id` int(11) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `haoidcn_agreement`
--

INSERT INTO `haoidcn_agreement` (`id`, `content`) VALUES
(0, '&amp;lt;p&amp;gt;“e快金”微信公众号（以下简称“本产品”）由 泉州市万年利信息咨询有限公司负责运营。为明确本产品用户（以下简称“甲方”）与 泉州市万年利信息咨询有限公司 （以下简称“乙方”）之间的权利义务关系，维护双方的合法权益，本着平等互利的原则，双方就本产品服务之相关事宜达成以下协议，以资共同遵守。本产品协议适用于甲方注册使用乙方产品、服务的全部活动，为避免误解，甲方通过关注乙方的微信公众号并注册使用乙方服务即视为本产品用户，受本产品协议约束。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;在注册成为本产品用户前，请甲方务必认真、仔细阅读并充分理解本产品协议全部内容。甲方在注册本产品取得用户身份时勾选同意本产品协议并成功注册为本产品用户，视为甲方已经充分理解和同意本产品协议全部内容，并签署了本产品协议，本产品协议立即在甲方与乙方之间产生法律效力，甲方注册使用本产品服务的全部活动将受到本产品协议的约束并承担相应的责任和义务。如甲方不同意本产品协议内容，请不要注册使用本产品服务。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;在甲方同意接受本协议并注册成为本产品用户时，甲方已经年满18周岁。如甲方不具备前述条件，甲方应终止注册或停止使用本产品。甲方若通过本人注册的账户为其他不满18周岁的任何第三方借款，产生的任何法律责任均与乙方无关，乙方对此不承担任何法律责任。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;本产品协议包括以下所有条款，同时也包括本产品已经发布的或者将来可能发布的各类规则。所有规则均为本产品协议不可分割的一部分，与本产品协议具有同等法律效力。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;甲方在此确认知悉并同意乙方有权根据需要不时修改、增加或删减本产品协议。乙方将采用在本产品公示的方式通知甲方该等修改、增加或删减，甲方有义务注意该等公示。一经本产品公示，视为已经通知到甲方。甲方同意并确认，乙方可能以页面消息、微信、短消息等方式向甲方发送将来可能发布的各类规则，该等规则构成本产品协议的一部分。若甲方在本产品协议及各类规则变更后继续使用本产品服务的，视为甲方已仔细认真阅读、充分理解并同意接受修改后的本产品协议及各类规则，且甲方承诺遵守修改后的本产品协议及各类规则内容，并承担相应的责任和义务。若甲方不同意修改后的本产品协议及各类规则内容，应立即停止使用本产品服务，乙方保留中止、终止或限制甲方继续使用本产品服务的权利，但该等终止、中止或限制行为并不豁免甲方在本产品已经进行的交易下所应承担的责任和义务。乙方不承担任何因此导致的法律责任。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;一、账户管理&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;甲方注册本产品时请按照乙方要求准确提供个人信息，并在取得该账户后及时更新甲方正确、最新及完整的身份信息及相关资料，包括手机号码、身份证号码、亲属联系人及社会联系人姓名、职业、银行账户等信息，以便乙方与甲方进行及时、有效联系。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;甲方应当使用自身合法的身份信息进行注册，若甲方冒用、盗用、拾得他人身份证件办理乙方提供的产品/服务的，甲方对此承担所有法律责任；乙方仅对甲方的身份信息承担形式审查责任，且仅在其业务职责范围内承担法律责任。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;此账户仅供甲方本人使用，甲方对使用该账户或密码进行的一切操作及言论负完全的责任。甲方对账户密码、身份信息等进行妥善保管，对于因密码、身份信息、校验码等泄露所致的损失由甲方自行承担。如甲方遗失手机或身份证件或银行卡以及其他可能危及本产品账户资金安全或发现有他人冒用或盗用甲方的账户登录名及密码或任何其他未经合法授权的情形，应立即以有效方式通知乙方，向乙方申请暂停相关服务。除非另有法律规定或经司法裁判，且征得乙方同意，否则甲方不得以任何方式转让、赠与或继承（相关的财产权益除外）其登录名及密码等个人信息。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;甲方不得通过本人注册的账户为任何第三方借款，甲方充分知悉并承诺，不得以本人的账户出租、出借给他人，且甲方充分知悉：若以本人账户出租、出借给他人使用，甲方仍应承担《借款协议》项下的还款义务。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;若甲方有上述违反本协议约定情形的，产生的任何法律责任均由甲方承担，乙方对此不承担任何法律责任。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;在需要终止使用本产品时，甲方可以申请注销本产品账户，甲方应当依照乙方规定的程序进行甲方的本人账户注销。本产品账户注销将导致乙方终止为甲方提供本产品，本协议约定的双方的权利义务终止，但依本协议其他条款另行约定不得终止的或依其性质不能终止的除外。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;下列情形发生时，乙方有权拒绝甲方注销账户的申请：1、甲方申请注销的账户存在任何由于该账户被注销而导致的未了结的合同关系；2、存在其他基于该账户的存在而产生或维持的权利义务；3、乙方认为注销该账户会由此产生未了结的权利义务而产生纠纷。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;二、服务内容&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;本产品是由乙方投资并运营的提供个人对个人借款中介服务的信息服务平台。乙方为甲方提供信息发布、信用咨询、合同管理、资金代管、还款管理，以及促成甲方与第三方出借人达成交易的居间服务。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;1、信用评估：信用评估即授予信用额度，信用评估服务是指乙方为甲方提供的通过读取和分析甲方的个人公开信息、甲方对乙方授权使用的个人隐私信息及其他授权信息来授予甲方信用额度的服务。为乙方顺利分析与甲方信用信息相关的甲方个人隐私信息，甲方在此不可撤销地授权乙方读取、分析及使用甲方的以下信息：1、甲方的身份信息；2、甲方的手机账单、清单、实名制等信息；3、甲方的银行卡信息；4、其他有助于乙方授予甲方信用额度的信息。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;2、信息发布：甲方注册成为本产品借款用户后，可以委托乙方将其借款需求信息通过乙方公开发布，即发出借款要约。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;3、提现：甲方可申请对其信用额度内通过乙方初步审批核定后的金额提取现金，甲方应当按照乙方要求的程序进行申请，包括持证自拍、乙方工作人员与甲方通过微信、电话进行核实等。甲方完成上述申请程序后，乙方将对甲方的申请进行审批，若审批通过，乙方将向甲方的指定账户内存入提现金额。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;4、代付：在订立借款合同后，乙方接受第三方出借人委托，将甲方借款款项存入甲方指定的账户内。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;5、代扣：在订立借款合同后，甲方委托乙方及乙方授权/聘请的具备相关业务资质的第三方从甲方银行账户上代为扣取应还款款项，并用于向第三方出借人支付还款。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;6、查询：乙方将对甲方在本产品中的所有操作进行记录，不论该操作之目的最终是否实现。甲方可以在本产品中查询其注册用户名下的个人信息及借贷交易记录。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;7、交易：甲方每次使用乙方平台进行借款，需遵从甲方与乙方及第三方出借人签订的借款协议。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;三、信息授权&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;为帮助甲方获得信用额度，乙方在经甲方授权后，会从中国移动、中国电信、中国联通等第三方网站获取甲方的相关个人信息，用于信用额度审批和贷后管理。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;1、为本产品之目的，甲方授权乙方及乙方聘用的其他第三方机构根据甲方所提供的各项信息及乙方及乙方聘用的其他第三方机构独立获得的信息，来评定甲方在本产品中所拥有的个人信用额度，或决定是否审核通过甲方的服务申请。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;2、在本产品使用中，为了乙方能够充分评估甲方的个人信用额度，甲方同意在申请借款的过程中输入个人手机运营商的服务密码、验证码等信息，且授权乙方及乙方聘用的其他第三方机构使用上述服务密码、验证码等信息获取甲方的手机消费账单、清单、实名制等。甲方知悉并同意乙方及乙方聘用的其他第三方机构可能将使用甲方授权的手机号码、服务密码、验证码等信息获取甲方的相关信息，甲方同意乙方及乙方聘用的其他第三方机构为本产品之目的使用甲方的上述信息。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;3、在本产品使用中，如甲方输入学历信息、学信网账户名及密码等，即表示同意为本产品之目的，向乙方及乙方聘用的其他第三方机构授权使用甲方的学信网账户，乙方及乙方聘用的其他第三方机构将可能通过甲方所授权的学信网账户查看并读取甲方的学籍信息；如甲方在授权时尚未注册学信网账户，乙方及乙方聘用的其他第三方机构将基于甲方的授权代甲方申请注册学信网账户。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;4、在本产品使用中，如甲方同意向乙方提交、绑定或授权甲方的银行卡信息／账户，乙方将可能：&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;1）查询并核对甲方的账户信息。&amp;lt;br/&amp;gt;2）查询并读取甲方银行卡账户中的交易信息。&amp;lt;br/&amp;gt;3）基于《借款协议》通过甲方所授权或绑定的银行卡账户进行代收与代付服务。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;5、乙方有权依据《征信业管理条例》及相关法律法规，向第三方支付/征信/金融机构合法了解、获取、核实甲方的信用信息，所获取的个人信用信息仅在本产品中使用，且不向其他机构、个人提供或披露。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;6、甲方如通过本产品进行借款，应当依据《借款协议》中约定之还款日期进行还款，乙方有权通过电话、短信、微信、手机应用通知、发律师函、上门等途径对甲方进行服务与还款提醒。甲方理解并同意，如甲方未有按期履行还款义务，甲方的个人逾期信息将可能向第三方进行分享或公布。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;四、使用规则&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;为有效保障甲方使用本产品时的合法权益，甲方理解并同意接受以下规则：&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;1、乙方通过甲方的产品服务账户接受来自甲方的指令，无论甲方通过何种方式向乙方发出指令，都不可撤回或撤销，且视为甲方本人的指令。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;2、甲方应按照乙方的要求完善甲方的身份信息以最终达到实名，否则甲方可能会受到信用评估、提现、支付和（或）还款的限制，且乙方有权对甲方的账户进行冻结，直至甲方达到实名。请甲方保证甲方信息的真实性，若被检测出虚假信息，平台将会采取拒绝决议，若涉嫌恶意信息作假或盗用他人信息，将可能记入网络征信系统，影响甲方的征信记录，同时乙方将保留追究甲方相应法律责任的权利。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;3、乙方并非银行或其他金融机构，本产品也非金融业务，本协议项下的资金移转均通过银行或第三方支付公司来实现，甲方理解并同意其资金于流转途中的合理时间。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;4、交易风险&amp;lt;br/&amp;gt;因甲方的过错导致的任何损失均由甲方自行承担，该过错包括但不限于：不按照交易提示操作，未及时进行交易操作，遗忘或泄漏密码、校验码等，密码被他人破解等。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;5、服务费用&amp;lt;br/&amp;gt;在甲方使用本产品时，乙方有权依照双方签订的电子交易合同向甲方收取服务费用。乙方拥有制订及调整服务费之权利，具体服务费用以甲方使用本产品时产品页面上所列之收费方式公告或甲方与乙方达成的其他电子或书面协议为准。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;五、使用限制&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;1、甲方在使用本产品时应遵守中华人民共和国相关法律法规、甲方所在国家或地区之法令及相关国际惯例，不将本产品用于任何非法目的，也不以任何非法方式使用本产品，否则乙方有权拒绝提供本产品，或提前终止协议并追回借款，且甲方应承担所有相关法律责任。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;2、甲方不得利用本产品从事侵害他人合法权益之行为，否则乙方有权拒绝提供本产品，且甲方应承担所有相关法律责任，因此导致乙方或乙方雇员或其他方受损的，甲方应承担赔偿责任。上述行为包括但不限于:&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;1）侵害他人名誉权、隐私权、商业秘密、商标权、著作权、专利权等合法权益。&amp;lt;br/&amp;gt;2）违反依法定或约定之保密义务。&amp;lt;br/&amp;gt;3）冒用他人名义使用本产品。&amp;lt;br/&amp;gt;4）从事不法交易行为。&amp;lt;br/&amp;gt;5）未按时履行还款义务。&amp;lt;br/&amp;gt;6）提供骗贷资讯或以任何方式引诱他人参与骗贷。&amp;lt;br/&amp;gt;7）非法使用他人银行账户或无效银行账户交易。&amp;lt;br/&amp;gt;8）从事任何可能含有电脑病毒或是可能侵害本产品系统、资料之行为。&amp;lt;br/&amp;gt;9）其他乙方有正当理由认为不适当之行为。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;3、甲方理解并同意，乙方不对因下述任一情况导致的任何损害赔偿承担责任:&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;1）乙方有权基于单方判断，包含但不限于乙方认为甲方已经违反本协议的明文规定及精神，对甲方的名下的全部或部分产品账户暂停、中断或终止向甲方提供本产品或其任何部分，并移除或公布甲方的资料。&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;2）乙方在发现异常交易或合理怀疑交易有疑义或有违反法律规定或本协议约定之虞时， 有权不经通知先行暂停或终止甲方产品账户的使用（包括但不限于对账户名下的信用额度和在途交易采取取消交易等限制措施），并拒绝甲方使用本产品之部分或全部功能。&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;3）甲方理解并同意，存在如下情形时，乙方有权对甲方名下产品账户或交易进行冻结或追回，且有权限制甲方所使用的产品或服务的部分或全部功能：&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;a．根据本协议的约定。&amp;lt;br/&amp;gt;b．根据法律法规及法律文书的规定。&amp;lt;br/&amp;gt;c．根据有权机关的要求。&amp;lt;br/&amp;gt;d．甲方使用本产品服务的行为涉嫌违反国家法律法规及行政规定的。&amp;lt;br/&amp;gt;e．乙方基于单方面合理判断认为账户信息、操作等存在异常时。&amp;lt;br/&amp;gt;f．乙方依据自行合理判断认为可能产生风险的。&amp;lt;br/&amp;gt;g．甲方在参加市场活动时有批量注册账户、提供虚假信息或材料及其他舞弊等违反活动规则、违反诚实信用原则的。&amp;lt;br/&amp;gt;h．错误汇入资金等导致甲方可能存在不当得利的。&amp;lt;br/&amp;gt;i．甲方未按时履行还款义务的。&amp;lt;br/&amp;gt;j．甲方遭到他人投诉，且对方已经提供了一定证据的。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;4、如甲方申请解除上述冻结或限制，甲方应按乙方要求如实提供相关资料及甲方的身份证明以及乙方要求的其他信息或文件，以便乙方进行核实，且乙方有权依照自行判断来决定是否同意甲方的申请。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;六、隐私权保护&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;乙方重视对用户隐私的保护。因收集甲方的信息是出于遵守国家法律法规的规定以及向甲方提供服务及提升服务质量的目的，乙方对甲方的信息承担保密义务，不会为满足第三方的营销目的而向其出售或出租甲方的任何信息，乙方会在下列情况下才将甲方的信息与第三方共享，甲方同意并授权乙方在下列情况下的共享行为：&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;1、获得甲方的同意或授权。&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;2、某些情况下，只有共享甲方的信息，才能提供甲方需要的服务和（或）产品，或处理甲方与他人的交易纠纷或争议。&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;3、某些服务和（或）产品由乙方的合作伙伴提供或由乙方与合作伙伴共同提供，乙方会与其共享提供服务和（或）产品需要的信息。&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;4、乙方与第三方进行联合推广活动，乙方可能与其共享活动过程中产生的、为完成活动所必要的个人信息，如参加活动的中奖名单、中奖人联系方式等，以便第三方能及时向甲方发放奖品。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;5、根据法律法规的规定及有权机关的要求。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;6、为维护乙方和甲方其他用户的合法权益。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;7、根据法律规定及合理商业习惯，在乙方计划与其他公司合并或被其收购或进行其他资本市场活动（包括但不限于IPO，债券发行）时，以及其他情形下乙方需要接受来自其他主体的尽职调查时，乙方会把甲方的信息提供给必要的主体，但乙方会通过和这些主体签署保密协议等方式要求其对甲方的个人信息采取合理的保密措施。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;七、征信授权&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;1、甲方知晓并同意乙方依据《征信业管理条例》及相关法律法规，委托第三方征信机构，合法调查甲方信息，包括但不限于个人基本信息、借贷交易信息、银行卡交易信息、电商交易信息、公用事业信息、央行征信报告。所获取的信息，仅在此笔借贷业务的贷前审批和贷后管理工作中使用。乙方将对所获取的信息妥善进行保管，除为甲方提供信审服务/借款资金的合作方外，未经甲方授权，不得向其他机构或个人公开、编辑或透露信息内容。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;2、甲方知晓并同意乙方依据《征信业管理条例》及相关法律法规，向第三方征信机构提交甲方在此笔借贷业务中产生的相关信息，包括但不限于个人基本信息、借款申请信息、借款合同信息以及还款行为信息，并记录在征信机构的个人信用信息数据库中。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;3、甲方知晓并同意第三方征信机构向已合法获取并保存甲方个人信息的机构或个人（包括但不限于公共事业单位、网络服务机构、运营商等）采集甲方的个人信息。为了免除重复授权的不便，甲方同意信息提供者无需再向甲方逐一另行获取其向信息使用者及征信机构提供甲方个人信息的授权，信息提供者可以依本征信授权条款的授权径行向第三方征信机构及信息使用者提供甲方的个人信息，且无需对甲方进行事先通知。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;4、甲方同意若甲方出现不良还款行为，乙方按合同所留联系方式对甲方进行提醒并告知，甲方若仍未履行还款义务，乙方可将甲方的不良还款信息提交至第三方征信机构，记录在征信机构的个人信用信息库中。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;5、甲方知晓并同意，甲方已被明确告知不良还款信息一旦记录在第三方征信机构的个人信用信息数据库中，在日后的经济活动中对甲方可能产生的不良影响。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;6、甲方知晓第三方征信机构包括但不限于：北京华道征信有限公司、北京安融惠众征信有限公司、上海资信有限公司和鹏元资信评估有限公司。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;7、甲方保证其所提供的个人信息均为甲方本人的真实信息，不可为他人的信息或虚假信息，若涉嫌恶意信息作假或盗用他人信息，将可能记入网络征信系统，影响甲方的征信记录，同时乙方将保留追究甲方相应法律责任的权利。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;8、如甲方所提供的个人信息中的全部或部分信息为他人信息或虚假信息，乙方将有权暂停或终止与甲方的全部或部分服务协议，由此行为所产生的全部法律责任将由甲方承担，乙方将不对此承担法律责任。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;八、平台中断或故障&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;乙方平台因维修、故障、黑客攻击、电信部门技术调整或故障、网站升级、银行方面、意外、不可抗力等状况无法正常运作，使甲方无法使用各项服务时，乙方不承担损害赔偿责任。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;九、 责任范围及责任限制&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;1、乙方仅对本协议中列明的责任承担范围负责。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;2、乙方用户信息是由用户本人自行提供的，乙方无法保证该信息之准确、及时和完整。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;3、乙方不对信用评估额度及本产品提供任何形式的保证。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;十、商标、知识产权、专利的保护&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;1、乙方及关联公司所有平台及乙方上所有内容，包括但不限于著作、图片、档案、资讯、资料、网站架构、网站画面的安排、网页设计，均由乙方或乙方关联公司依法拥有其知识产权，包括但不限于商标权、专利权、著作权、商业秘密等。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;2、非经乙方或乙方关联企业书面同意，任何人不得擅自使用、修改、复制、公开传播、改变、散布、发行或公开发表本网站程序或内容。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;3、尊重知识产权是甲方应尽的义务，如有违反，甲方应承担损害赔偿责任。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;十一、法律适用与管辖&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;本协议之效力、解释、变更、执行与争议解决均适用中华人民共和国法律， 没有相关法律规定的，参照通用国际商业惯例和（或）行业惯例。因本协议产生之争议，均应依照中华人民共和国法律予以处理，并由乙方所在地的人民法院管辖。&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;br/&amp;gt;&amp;lt;/p&amp;gt;');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_article_problem`
--

CREATE TABLE IF NOT EXISTS `haoidcn_article_problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL COMMENT '常见问题的标题',
  `content` text COMMENT '常见问题的内容',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `top` tinyint(1) unsigned DEFAULT '0' COMMENT '置顶',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `haoidcn_article_problem`
--

INSERT INTO `haoidcn_article_problem` (`id`, `title`, `content`, `time`, `top`) VALUES
(1, '什么是e借款？额度和期限是多少？', '<p>e借款是在您需要时为您快速提供现金借款的一项服务</p>', '2016-07-07 07:55:40', 1),
(2, '如何申请借款？', '<p>您可以在微信上先关注“e快金”,然后关注，点击e借款进行申请</p>', '2016-07-07 07:55:40', 0),
(4, '的根本赛季', '<p>的别撒娇的把控了<br/></p>', '2016-07-07 07:55:40', 0);

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_bank_info`
--

CREATE TABLE IF NOT EXISTS `haoidcn_bank_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL COMMENT '用户手机号',
  `bank_name` varchar(20) DEFAULT NULL COMMENT '用户银行名称',
  `province` varchar(20) DEFAULT NULL COMMENT '用户银行卡所在的省',
  `city` varchar(20) DEFAULT NULL COMMENT '用户银行所在的城市',
  `account_opening` varchar(30) NOT NULL COMMENT '开户网点',
  `name` varchar(20) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL COMMENT '上传银行卡截图',
  `bank_num` varchar(30) DEFAULT NULL COMMENT '用户银行卡号',
  `is_payment` varchar(5) DEFAULT '0' COMMENT '验证银行卡 1是验证成功  2是验证失败',
  `condition` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `haoidcn_bank_info`
--

INSERT INTO `haoidcn_bank_info` (`id`, `openid`, `phone`, `bank_name`, `province`, `city`, `account_opening`, `name`, `img`, `bank_num`, `is_payment`, `condition`) VALUES
(11, 'oUnmhwkGh61-SQUyzHxk-pcm5MmA', '15555581612', '工商银行', NULL, NULL, '0130600238', '谢涌', '/Uploads/2016-09-08/57d111511d536.jpg', '6212261306002035863', '0', 0),
(6, 'oUnmhwn9lg17p7RVRGdJnt1b8G2I', '13896333391', '建设银行', NULL, NULL, '重庆市万州区沙龙路一段沙龙分理处', '林洁', '/Uploads/2016-09-03/57c9fb6b43c17.jpg', '6217003760026127829', '0', 0),
(2, NULL, '', '建设银行', NULL, NULL, '晋江', '', '/Uploads/2016-09-02/57c9211f13b0f.jpeg', '6222603550000171875', '0', 0),
(7, 'oUnmhwkwEpNJumpNMSCGHdLHpk5I', '13221617730', '农业银行', NULL, NULL, '浙江省台州市金清分行', '杨君华', '/Uploads/2016-09-05/57cd0d1772fc8.jpg', '6228480369201159679', '0', 0),
(9, 'oUnmhwhNxr3O8wpTU3i0FymgcCqk', '15080351996', '建设银行', NULL, NULL, 'fdsa fsad fsda fds', '很久', '/Uploads/2016-09-07/57cfb5a2ae318.jpg', '6228480369201159679', '1', 0),
(10, 'oUnmhwiEDYIUD51e32SXhOr2KYJE', '13805946646', '建设银行', NULL, NULL, '泉州市田安路支行', '王礼胜', '/Uploads/2016-09-08/57d0a39b813a8.jpg', '6236681830006376602', '0', 0),
(14, 'oUnmhwpgzDcXzxjoO6z_1C1p668Q', '13658248456', '建设银行', NULL, NULL, '海南海口', '雷亚辉', '/Uploads/2016-09-11/57d482f519e19.jpg', '6210813520009878029', '0', 0),
(15, 'oUnmhwmbX5MYAfpNRXChcnuPNPdA', '18182208512', '中国银行', NULL, NULL, '北碚支行', '唐佳', '/Uploads/2016-09-13/57d7498df27ca.jpg', '6217903200006877250', '0', 0),
(16, 'oUnmhwmfYpdNLoGInR5LEdOTIqWg', '15980045822', '交通银行', NULL, NULL, '福建晋江支行', '大海', '/Uploads/2016-09-13/57d771d2dea5b.jpg', '6222603550000423813', '2', 1);

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_card`
--

CREATE TABLE IF NOT EXISTS `haoidcn_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned DEFAULT NULL,
  `bank_name` varchar(26) CHARACTER SET utf8 DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(12) CHARACTER SET utf8 DEFAULT NULL COMMENT '持有人姓名',
  `id_card` char(18) CHARACTER SET utf8 DEFAULT NULL COMMENT '身份证',
  `mobile` char(11) CHARACTER SET utf8 DEFAULT NULL,
  `credit` int(10) unsigned DEFAULT NULL COMMENT '额度',
  `temp_credit` int(10) unsigned DEFAULT NULL COMMENT '临时额度',
  `bill_day` date DEFAULT NULL COMMENT '账单日',
  `re_bill_day` date DEFAULT NULL COMMENT '还款日',
  `pic` tinytext CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_card_bank`
--

CREATE TABLE IF NOT EXISTS `haoidcn_card_bank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(26) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `haoidcn_card_bank`
--

INSERT INTO `haoidcn_card_bank` (`id`, `name`) VALUES
(1, '工商银行'),
(2, '建设银行'),
(3, '招商银行'),
(4, '交通银行'),
(5, '农业银行'),
(6, '平安银行'),
(7, '民生银行'),
(8, '兴业银行'),
(9, '中国银行'),
(10, '华夏银行');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_code`
--

CREATE TABLE IF NOT EXISTS `haoidcn_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` char(11) NOT NULL,
  `code` varchar(6) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_config`
--

CREATE TABLE IF NOT EXISTS `haoidcn_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail_address` varchar(250) NOT NULL,
  `mail_smtp` varchar(250) NOT NULL,
  `mail_loginname` varchar(250) NOT NULL,
  `mail_password` varchar(250) NOT NULL,
  `mail_formname` varchar(250) NOT NULL,
  `phone_target` varchar(250) NOT NULL,
  `phone_user` varchar(250) NOT NULL,
  `phone_pass` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `haoidcn_config`
--

INSERT INTO `haoidcn_config` (`id`, `mail_address`, `mail_smtp`, `mail_loginname`, `mail_password`, `mail_formname`, `phone_target`, `phone_user`, `phone_pass`) VALUES
(3, '222', '22', 'admin', 'admin', '2233', 'http://api.smsbao.com/', 'xhgxzl', 'Zxd621224');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_daoqi`
--

CREATE TABLE IF NOT EXISTS `haoidcn_daoqi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `days` int(11) DEFAULT NULL COMMENT '显示几天到期提醒',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `haoidcn_daoqi`
--

INSERT INTO `haoidcn_daoqi` (`id`, `days`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_ecomment`
--

CREATE TABLE IF NOT EXISTS `haoidcn_ecomment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `remark` varchar(250) NOT NULL,
  `s_grade` enum('2','1') NOT NULL,
  `f_grade` enum('2','1') NOT NULL,
  `pj_date` varchar(250) NOT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_jihuoma`
--

CREATE TABLE IF NOT EXISTS `haoidcn_jihuoma` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `jihuoma` char(8) NOT NULL,
  `status` int(1) NOT NULL,
  `time` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_loan_money`
--

CREATE TABLE IF NOT EXISTS `haoidcn_loan_money` (
  `money_num` int(10) DEFAULT NULL COMMENT '借款金额',
  `time_length` varchar(10) DEFAULT NULL COMMENT '期限',
  `letter` int(10) DEFAULT NULL COMMENT '快速信审费',
  `account_money` int(10) DEFAULT NULL COMMENT '账号管理费',
  `interest` int(10) DEFAULT NULL COMMENT '利息',
  `sum` int(20) DEFAULT NULL COMMENT '实际到账总额',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `haoidcn_loan_money`
--

INSERT INTO `haoidcn_loan_money` (`money_num`, `time_length`, `letter`, `account_money`, `interest`, `sum`, `id`) VALUES
(500, '7', 22, 16, 2, 460, 11),
(1000, '7', 45, 30, 5, 920, 12),
(1500, '7', 68, 45, 7, 1380, 13),
(2000, '7', 90, 60, 10, 1840, 14),
(2500, '7', 113, 75, 12, 2300, 15),
(3000, '7', 135, 90, 15, 2760, 16),
(500, '14', 45, 30, 5, 420, 17),
(1000, '14', 90, 60, 10, 840, 18),
(1500, '14', 135, 90, 15, 1260, 19),
(2000, '14', 180, 120, 20, 1680, 20),
(2500, '14', 225, 150, 25, 2100, 21),
(3000, '14', 270, 180, 30, 2520, 22);

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_news`
--

CREATE TABLE IF NOT EXISTS `haoidcn_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(168) CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `times` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `haoidcn_news`
--

INSERT INTO `haoidcn_news` (`id`, `title`, `content`, `times`) VALUES
(1, '工商银行', '&lt;strong&gt;工商&lt;span style=&quot;background-color:#CC33E5;&quot;&gt;银&lt;/span&gt;行&lt;img src=&quot;http://e.v-tuo.cn/Uploads/kindeditor/attached/image/20160613/20160613024206_72954.jpg&quot; alt=&quot;&quot; width=&quot;300&quot; height=&quot;300&quot; title=&quot;&quot; align=&quot;&quot; /&gt;&lt;/strong&gt;&lt;strong&gt;&lt;/strong&gt;', '2016-06-12 16:30:46'),
(11, '标题', '&lt;span style=&quot;color:#333333;font-family:RobotoRegular, ''Helvetica Neue'', Helvetica, sans-serif;font-size:13px;line-height:21px;background-color:#FFFFFF;&quot;&gt;标题&lt;/span&gt;&lt;span style=&quot;color:#333333;font-family:RobotoRegular, ''Helvetica Neue'', Helvetica, sans-serif;font-size:13px;line-height:21px;background-color:#FFFFFF;&quot;&gt;标题&lt;/span&gt;&lt;span style=&quot;color:#333333;font-family:RobotoRegular, ''Helvetica Neue'', Helvetica, sans-serif;font-size:13px;line-height:21px;background-color:#FFFFFF;&quot;&gt;标题&lt;/span&gt;', '2016-06-12 17:20:19');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_payment_list`
--

CREATE TABLE IF NOT EXISTS `haoidcn_payment_list` (
  `openid` varchar(100) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) DEFAULT NULL COMMENT '放款用户的手机号',
  `bank_num` varchar(30) DEFAULT NULL COMMENT '放款用户的银行卡号',
  `money_num` int(10) DEFAULT NULL COMMENT '借款金额',
  `time_length` int(10) DEFAULT NULL COMMENT '借款时长',
  `letter` int(10) DEFAULT NULL COMMENT '快速信审费',
  `account_money` int(10) DEFAULT NULL COMMENT '账号管理费',
  `interest` int(10) DEFAULT NULL COMMENT '息费',
  `sum` int(10) DEFAULT NULL COMMENT '到期应还总额',
  `actual_money` varchar(255) DEFAULT NULL COMMENT '实际放款额度',
  `payment_time` varchar(50) DEFAULT NULL COMMENT '放款日期',
  `appoint_time` varchar(50) DEFAULT NULL COMMENT '约定还款日期',
  `actual_time` varchar(50) DEFAULT NULL COMMENT '实际还款日期',
  `is_overdue` varchar(5) DEFAULT '0' COMMENT '是否逾期',
  `yuqi_time` varchar(255) DEFAULT NULL COMMENT '逾期天数',
  `trade_mode` varchar(10) DEFAULT NULL COMMENT '还款方式  1是银行卡支付  2是支付宝还款',
  `wait_xuqi` varchar(255) DEFAULT NULL COMMENT '1是续期中  2是续期成功 3还款等待 4还款成功',
  `huankuan_type` varchar(5) DEFAULT NULL COMMENT '1是全额还款  2是续期还款',
  `is_repayment` int(11) NOT NULL DEFAULT '0' COMMENT '是否还款  0是未还款    1是已还款',
  `renewal_time` varchar(20) NOT NULL COMMENT '续期时间',
  `renewal_money` int(10) NOT NULL COMMENT '续期金额',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `haoidcn_payment_list`
--

INSERT INTO `haoidcn_payment_list` (`openid`, `id`, `phone`, `bank_num`, `money_num`, `time_length`, `letter`, `account_money`, `interest`, `sum`, `actual_money`, `payment_time`, `appoint_time`, `actual_time`, `is_overdue`, `yuqi_time`, `trade_mode`, `wait_xuqi`, `huankuan_type`, `is_repayment`, `renewal_time`, `renewal_money`) VALUES
('oUnmhwhNxr3O8wpTU3i0FymgcCqk', 4, '15080351996', '6228480369201159679', 500, 7, 22, 16, 2, 500, '460', '2016-09-08 11:57:46', '2016-09-15', '2016-09-12', '0', NULL, '2', '4', '1', 1, '', 0),
('oUnmhwhNxr3O8wpTU3i0FymgcCqk', 6, '15080351996', '6228480369201159679', 500, 14, 45, 30, 5, 500, '420', '2016-09-13 10:03:19', '2016-09-27', '', '0', NULL, '', '', '', 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_placard`
--

CREATE TABLE IF NOT EXISTS `haoidcn_placard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(168) CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `times` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `haoidcn_placard`
--

INSERT INTO `haoidcn_placard` (`id`, `title`, `content`, `times`) VALUES
(14, '上线公告', '&amp;lt;p style=&amp;quot;color:#666666;font-family:''Microsoft YaHei'', sans-serif;font-size:14px;background-color:#FFFFFF;&amp;quot;&amp;gt;\r\n	&amp;lt;br /&amp;gt;\r\n&amp;lt;/p&amp;gt;', '2016-06-12 22:17:49');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_service`
--

CREATE TABLE IF NOT EXISTS `haoidcn_service` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) NOT NULL,
  `uname` varchar(250) DEFAULT NULL,
  `password` char(32) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_Loan` varchar(5) DEFAULT '0' COMMENT ' 0是申请  1是放款成功 2是放款失败',
  `level` varchar(10) DEFAULT NULL COMMENT '风控级别',
  `recommend` varchar(30) DEFAULT NULL COMMENT '推荐人的号码',
  `coupon` int(11) NOT NULL COMMENT '优惠卷',
  `money` int(11) NOT NULL COMMENT '优惠金额',
  `money_state` int(11) NOT NULL DEFAULT '0' COMMENT '优惠卷的状态',
  PRIMARY KEY (`id`,`openid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- 转存表中的数据 `haoidcn_service`
--

INSERT INTO `haoidcn_service` (`id`, `openid`, `uname`, `password`, `phone`, `time`, `is_Loan`, `level`, `recommend`, `coupon`, `money`, `money_state`) VALUES
(42, 'oUnmhwtppR1hz-9l6K4cj-DRRMVE', '此刻我的内心是崩溃的', 'a3a1c30a23e6b795a11372d20d7d5d12', '15778305523', '2016-09-11 17:41:26', '0', NULL, NULL, 0, 0, 0),
(44, 'oUnmhwg74qjit_qJgLfl0KI2HKJE', '独自流浪  . HR2u', 'e10adc3949ba59abbe56e057f20f883e', '18030094706', '2016-09-12 07:57:11', '0', NULL, NULL, 0, 0, 0),
(32, 'oUnmhwmfYpdNLoGInR5LEdOTIqWg', 'DODOCU', 'e10adc3949ba59abbe56e057f20f883e', '15980045822', '2016-09-13 03:22:32', '0', '良好', NULL, 0, 0, 0),
(16, 'oUnmhwq4v7hTdquhTkD7aUGENt_o', 'Q N D Ye', 'f862883add1d76c1f8103d734b423678', '13934591555', '2016-09-02 15:27:21', '0', NULL, NULL, 0, 20, 0),
(9, 'oUnmhwn9lg17p7RVRGdJnt1b8G2I', 'MIss  L.', '9bff531b7a7688e082ac4ffff1963bd3', '13896333391', '2016-09-01 22:42:34', '0', NULL, NULL, 0, 0, 1),
(13, 'oUnmhwiJVaX26mLh8RZrJYhxPdkk', '幸福的味道', 'c3fec67187f59f2fc133c3dc5d741909', '15128937771', '2016-09-02 05:19:15', '0', NULL, NULL, 0, 20, 1),
(20, 'oUnmhwhNxr3O8wpTU3i0FymgcCqk', 'jack', 'd3d062a47c58fcc0db472817fd702d71', '15080351996', '2016-09-13 02:03:19', '1', '良好', NULL, 0, 0, 0),
(43, 'oUnmhwkzECOrlC_Ok3CIZk_b4uuI', '芒果金融2号-林达达私人号', 'e10adc3949ba59abbe56e057f20f883e', '15860583309', '2016-09-12 07:05:32', '0', NULL, NULL, 0, 0, 0),
(19, 'oUnmhwp0Dd2bBve3Y8yP_bJTxaKc', '这些动作都来了,', '0cb9c1302dff8b27c75e6fd0e8f01f7f', '18308241587', '2016-09-03 02:42:20', '0', NULL, NULL, 0, 0, 0),
(21, 'oUnmhwnExdTEWHEXL2-NegbVlTFY', '( ´◔ ‸◔'')', '0bf28bb59fa38df1a59a08f52093c7e0', '15902807744', '2016-09-04 05:49:19', '0', NULL, NULL, 0, 0, 0),
(22, 'oUnmhwkwEpNJumpNMSCGHdLHpk5I', '', 'e7f15b034fdc97f46c8c61fcc0539bad', '13221617730', '2016-09-05 04:55:53', '0', NULL, NULL, 0, 0, 0),
(26, 'oUnmhwsQv0NLACJ7u3XXgwvZLS_I', '你怎么了怎么了', '3750067688d8dea741093c817be891ce', '18873573853', '2016-09-05 20:53:58', '0', NULL, NULL, 0, 0, 0),
(27, 'oUnmhwsW8ZsqY0RoS28ZpvgGTeHg', '萨摩蒂咔', '4b98a2c472f8c15d02ccbd46a3d0d665', '18078048136', '2016-09-06 02:33:30', '0', NULL, NULL, 0, 0, 0),
(28, 'oUnmhwuzl13SvRGFkcXQjWzfDf8o', '拼搏', '58a479249a3cecfa663f3d515f29c793', '18135411117', '2016-09-06 04:34:26', '0', NULL, NULL, 0, 0, 0),
(29, 'oUnmhwkUBISfiqHC69jpD5vXrfeM', '', 'bed7faec75b5fe16eb0bb47527d9584f', '13713669836', '2016-09-06 05:02:29', '0', NULL, NULL, 0, 0, 0),
(30, 'oUnmhwh40f7d041XAYbQ7iIxveWg', '祥祥', '93156164cb5616dd5a8957147f91d870', '13476000537', '2016-09-07 04:19:25', '0', NULL, NULL, 0, 0, 0),
(31, 'oUnmhwiEDYIUD51e32SXhOr2KYJE', '王不败', '734605a1c59f9a05e06460eb88d69598', '13805946646', '2016-09-07 23:10:28', '0', NULL, NULL, 0, 0, 0),
(34, 'oUnmhwkGh61-SQUyzHxk-pcm5MmA', '二子', 'b5a5e5844b2c0aea1e15c17a2a473067', '15555581612', '2016-09-08 06:46:04', '0', NULL, NULL, 0, 0, 0),
(35, 'oUnmhwkOiIJrg90IOukA2JkRrw2Y', '雄霸天', 'df9935ffcc6e5b5c51559b1bf7c03c90', '15115487856', '2016-09-08 07:39:08', '0', NULL, NULL, 0, 0, 0),
(36, 'oUnmhwn0O7JXfgdrK_HzGHcStdR8', 'H', '61efc17aa07cd32e8a23a22b932b6569', '18228159595', '2016-09-08 16:16:16', '0', NULL, NULL, 0, 0, 0),
(37, 'oUnmhwpgzDcXzxjoO6z_1C1p668Q', '开心', '16a82629848bd2d4707ec2365808f66e', '13658248456', '2016-09-09 21:48:55', '0', NULL, NULL, 0, 0, 0),
(38, 'oUnmhwnef1eJnfpdYm7dtWKyibmk', '懂得再多，不如珍惜我。', '30568ade7c375ac4da6360fdf45627ed', '13081187050', '2016-09-10 03:30:38', '0', NULL, NULL, 0, 0, 0),
(40, 'oUnmhwrgeHRdxp03thxr9nW7H4u8', 'ldh1235', '3875fc562c5a7562a73371cb633c3e4a', '13645926886', '2016-09-10 09:17:11', '0', NULL, NULL, 0, 0, 0),
(45, 'oUnmhwnitwnXAaoJYKDe88CC2AhA', '{森林}', 'ff1393e4ddcdc71f63eb343bc26dd699', '13840045083', '2016-09-12 08:41:46', '0', NULL, NULL, 0, 0, 0),
(46, 'oUnmhwkK0WCAFtJ4jb4uZtcz8SHE', '哥', '69b1c341ebd1253a7a1fe902a007e56f', '18316916783', '2016-09-12 17:05:59', '0', NULL, NULL, 0, 0, 0),
(47, 'oUnmhwmbX5MYAfpNRXChcnuPNPdA', '、Loser', 'fad789fd18ab472dd4889434ccfd0605', '18182208512', '2016-09-13 00:23:42', '0', NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_status`
--

CREATE TABLE IF NOT EXISTS `haoidcn_status` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(250) NOT NULL,
  `time` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `haoidcn_status`
--

INSERT INTO `haoidcn_status` (`id`, `status`, `time`) VALUES
(14, '经销商', '1465730966');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_survey`
--

CREATE TABLE IF NOT EXISTS `haoidcn_survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) DEFAULT NULL COMMENT '手机号',
  `follow` varchar(20) DEFAULT NULL COMMENT '怎么关注',
  `factor` varchar(20) DEFAULT NULL COMMENT '最看重的因素',
  `money_num` varchar(20) DEFAULT NULL COMMENT '期待借款金额',
  `time_length` varchar(20) DEFAULT NULL COMMENT '期待借款天数',
  `purpose` varchar(20) DEFAULT NULL COMMENT '主要用途',
  `problem` varchar(20) DEFAULT NULL COMMENT '借款中遇到什么问题',
  `service` varchar(20) DEFAULT NULL COMMENT '人工客服怎么样',
  `credit` int(1) DEFAULT NULL COMMENT '是否有信用卡',
  `faith` varchar(255) DEFAULT NULL COMMENT '征信记录',
  `bad_faith` varchar(255) DEFAULT NULL COMMENT '不良征信',
  `is_need_money` varchar(255) DEFAULT NULL COMMENT '急需钱的时候多吗',
  `time_lack` varchar(255) DEFAULT NULL COMMENT '什么时候比较缺钱',
  `pay_off` varchar(255) DEFAULT NULL COMMENT '几号发工资',
  `proposal` varchar(255) DEFAULT NULL COMMENT '给e快金的建议',
  `complain` varchar(255) DEFAULT NULL COMMENT 'e快金哪方面做得不好',
  `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `haoidcn_survey`
--

INSERT INTO `haoidcn_survey` (`id`, `phone`, `follow`, `factor`, `money_num`, `time_length`, `purpose`, `problem`, `service`, `credit`, `faith`, `bad_faith`, `is_need_money`, `time_lack`, `pay_off`, `proposal`, `complain`, `time`) VALUES
(1, '18030094706', '微信朋友圈/群', '放款速度', '1000', '1个月', '资金周转', '网页加载速度过慢', '一般', 1, '我很在意', '不能去其它平台借款', '一个月一次', '每月10-15日', '12', '广泛的文化佛教访问各位', '发v购物卡房间去二分IQ', NULL),
(2, '', '微信朋友圈/群', 'e快金的知名度和信誉实力', '50000000000000000000', '6个月', '偿还信用卡', '联系不上客服', '有待改进', 1, '我很在意', '不能办理信用卡', '2-3个月左右一次', '每月10-15日', '31', '1', '2', '2016-08-20 06:42:26'),
(3, '13230000192', '微信朋友圈/群', '额度高低', '3000', '14天', '资金周转', '微信号无法提供服务', '一般', 1, '我很在意', '不能办理信用卡', '一个月一次', '每月25-31日', '26', '对额度得满意', '审核太慢', '2016-08-30 01:59:36'),
(4, '13230000192', '微信朋友圈/群', 'e快金的知名度和信誉实力', '3000', '7天', '资金周转', '审核速度过慢', '满意', 1, '我很在意', '不能办理信用卡', '4-6个月一次', '每月25-31日', '27', '方便简单', '审核太慢', '2016-08-31 07:15:30'),
(5, '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '2016-09-02 01:56:33'),
(6, '15555581612', '好友推荐', '放款速度', '1000', '21天', '网购付款', '微信号无法提供服务', '没体验过', 0, '我很在意', '因信用“污点”找工作困难', '一个月一次', '每月5-10日', '15', '没感觉到', '处处都差', '2016-09-04 15:06:55'),
(7, '15555581612', '好友推荐', '放款速度', '1000', '21天', '网购付款', '微信号无法提供服务', '没体验过', 0, '我很在意', '因信用“污点”找工作困难', '一个月一次', '每月5-10日', '15', '没感觉到', '处处都差', '2016-09-04 15:06:55');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_time`
--

CREATE TABLE IF NOT EXISTS `haoidcn_time` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `begin_time` varchar(250) NOT NULL,
  `end_time` varchar(250) NOT NULL,
  `begin_beputtime` varchar(250) NOT NULL,
  `end_beputtime` varchar(250) NOT NULL,
  `pubtime` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `haoidcn_time`
--

INSERT INTO `haoidcn_time` (`id`, `begin_time`, `end_time`, `begin_beputtime`, `end_beputtime`, `pubtime`) VALUES
(4, '8:30', '18:00', '1475251200', '1475424000', '1465732559');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_tubiao`
--

CREATE TABLE IF NOT EXISTS `haoidcn_tubiao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_tuijian`
--

CREATE TABLE IF NOT EXISTS `haoidcn_tuijian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tuijian` varchar(255) DEFAULT NULL COMMENT '推荐人的id',
  `time` varchar(30) DEFAULT NULL,
  `openid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_user`
--

CREATE TABLE IF NOT EXISTS `haoidcn_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(250) NOT NULL,
  `pwd` varchar(250) NOT NULL,
  `uname` varchar(250) NOT NULL,
  `qq` varchar(250) NOT NULL,
  `weixin` varchar(20) DEFAULT NULL COMMENT '微信',
  `email` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `sex` varchar(1) DEFAULT NULL COMMENT '性别',
  `province` varchar(10) DEFAULT NULL COMMENT '地区',
  `city` varchar(10) DEFAULT NULL COMMENT '地区',
  `url` varchar(250) NOT NULL,
  `f_date` varchar(250) NOT NULL,
  `zl_status` enum('1','-1') NOT NULL DEFAULT '-1',
  `u_status` varchar(250) NOT NULL,
  `limits` enum('1','2','3') NOT NULL DEFAULT '3',
  `sid` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `haoidcn_user`
--

INSERT INTO `haoidcn_user` (`id`, `userid`, `pwd`, `uname`, `qq`, `weixin`, `email`, `phone`, `sex`, `province`, `city`, `url`, `f_date`, `zl_status`, `u_status`, `limits`, `sid`) VALUES
(1, 'admin', '7fef6171469e80d32c0559f88b377245', '', '', NULL, '', '', NULL, NULL, NULL, '', '', '-1', '', '1', ''),
(10, 'shenhe01', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '15080350001', '', NULL, NULL, '', '', '-1', '', '2', ''),
(14, 'daili02', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '15080352002', '男', '福建省', '泉州市', '', '', '-1', '', '3', ''),
(8, 'shenhe02', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '18030094789', '男', NULL, NULL, '', '', '-1', '', '2', ''),
(11, 'shenhe03', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '15080350003', '', NULL, NULL, '', '', '-1', '', '2', ''),
(12, 'daili01', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '15080352001', '男', '福建省', '福州市', '', '', '-1', '', '3', ''),
(15, 'daili03', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '15080350003', '女', '江苏省', '徐州市', '', '', '-1', '', '3', ''),
(16, '13260601490', 'f00b6adb9b053b055d7bb321a46ea583', '', '892209906', '892209906', '892209906@qq.com', '13260601490', '男', '湖北省', '武汉市', '', '', '-1', '', '3', ''),
(17, '15860583309', 'e10adc3949ba59abbe56e057f20f883e', '', '541486704', '541486704', '541486704@qq.com', '15860583309', '男', '福建省', '莆田市', '', '', '-1', '', '3', '');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_user_gam`
--

CREATE TABLE IF NOT EXISTS `haoidcn_user_gam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL COMMENT '用户手机号',
  `name` varchar(20) DEFAULT NULL COMMENT '用户姓名',
  `family` varchar(20) DEFAULT NULL COMMENT '用户父母',
  `family_name` varchar(20) DEFAULT NULL COMMENT '亲属关系的姓名',
  `family_mobile` varchar(20) DEFAULT NULL COMMENT '用户父母的手机号码',
  `gam` varchar(20) DEFAULT NULL COMMENT '用户社交关系',
  `gam_name` varchar(255) DEFAULT NULL,
  `gam_mobile` varchar(20) DEFAULT NULL COMMENT '用户社交联系人号码',
  `gam2` varchar(20) DEFAULT NULL COMMENT '用户社交联系人',
  `gam_name2` varchar(255) DEFAULT NULL,
  `gam_mobile2` varchar(20) DEFAULT NULL COMMENT '用户社交联系人号码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `haoidcn_user_gam`
--

INSERT INTO `haoidcn_user_gam` (`id`, `openid`, `phone`, `name`, `family`, `family_name`, `family_mobile`, `gam`, `gam_name`, `gam_mobile`, `gam2`, `gam_name2`, `gam_mobile2`) VALUES
(21, 'oUnmhwmfYpdNLoGInR5LEdOTIqWg', '15980045822', '大海', '配偶', '三', '13586958695', '朋友', '三', '18709625863', '朋友', '三', '13158692470'),
(16, 'oUnmhwsW8ZsqY0RoS28ZpvgGTeHg', '18078048136', '潘得林', '兄弟姐妹', '潘波', '13014822803', '朋友', '陈少集', '13926934533', '同事', '潘裕', '18677537750'),
(4, 'oUnmhwn9lg17p7RVRGdJnt1b8G2I', '13896333391', '林洁', '父母', '牟其芬', '13896932380', '朋友', '张茂华', '18523689337', '同事', '杨帅', '15536151545'),
(6, 'oUnmhwiJVaX26mLh8RZrJYhxPdkk', '15128937771', '于世鹏', '配偶', '苏春红', '18776898187', '同事', '李志刚', '18931419290', '朋友', '任建心', '18131417706'),
(10, 'oUnmhwp0Dd2bBve3Y8yP_bJTxaKc', '18308241587', '张开军', '父母', '张贤利', '15196739373', '同事', '张倩', '13551531323', '朋友', '钱艳', '13989119979'),
(9, 'oUnmhwq4v7hTdquhTkD7aUGENt_o', '13934591555', '要江英', '兄弟姐妹', '要江磊', '13834510752', '朋友', '徐韬', '13623455102', '朋友', '周宇', '15235109990'),
(11, 'oUnmhwhNxr3O8wpTU3i0FymgcCqk', '15080351996', '很久', '父母', '你', '15080351001', '同事', '你', '15080351002', '朋友', '你', '15080351003'),
(13, 'oUnmhwnExdTEWHEXL2-NegbVlTFY', '15902807744', '尤奇力', '兄弟姐妹', '尤艳娇', '13715555965', '同事', '于勇', '13666108940', '朋友', '顾正伟', '15928695957'),
(14, 'oUnmhwkwEpNJumpNMSCGHdLHpk5I', '13221617730', '杨君华', '兄弟姐妹', '杨仙君', '13105761868', '朋友', '任建敏', '13566823213', '同事', '林西国', '13857610949'),
(17, 'oUnmhwuzl13SvRGFkcXQjWzfDf8o', '18135411117', '白富宏', '父母', '白永庆', '15135199673', '朋友', '刘海生', '15003518540', '同事', '郭星星', '15035863577'),
(18, 'oUnmhwkUBISfiqHC69jpD5vXrfeM', '13713669836', '何斯杰', '父母', '王秀娥', '13767637280', '同事', '赵慧婷', '13691630937', '朋友', '曾响', '15707948439'),
(19, 'oUnmhwh40f7d041XAYbQ7iIxveWg', '13476000537', '张祥', '父母', '李爱萍', '13163222704', '朋友', '周勇', '15623109709', '同学', '刘坤', '15629178093'),
(20, 'oUnmhwiEDYIUD51e32SXhOr2KYJE', '13805946646', '王礼胜', '配偶', '苏小青', '15980498616', '朋友', '刘峰', '15859150811', '同事', '王红军', '15159882708'),
(23, 'oUnmhwkGh61-SQUyzHxk-pcm5MmA', '15555581612', '谢涌', '兄弟姐妹', '谢涛', '13855515600', '朋友', '居和平', '13045550222', '朋友', '王海健', '15655565678'),
(24, 'oUnmhwkOiIJrg90IOukA2JkRrw2Y', '15115487856', '曾志翔', '父母', '曾维国', '13974733037', '同事', '颜培', '15607470677', '朋友', '杨俊', '13786417092'),
(26, 'oUnmhwn0O7JXfgdrK_HzGHcStdR8', '18228159595', '胡恒川', '父母', '胡建军', '18228152815', '朋友', '张军', '13548222261', '同事', '张超', '13666182251'),
(27, 'oUnmhwpgzDcXzxjoO6z_1C1p668Q', '13658248456', '雷亚辉', '父母', '雷正兴', '15523636472', '同学', '刘昌羊', '15826313668', '朋友', '陈刚', '15723358999'),
(28, 'oUnmhwnef1eJnfpdYm7dtWKyibmk', '13081187050', '李白', '父母', '李福刚', '13180195405', '朋友', '李强', '13633300339', '朋友', '李华', '13933334945'),
(32, 'oUnmhwkzECOrlC_Ok3CIZk_b4uuI', '15860583309', '林达常', '配偶', '洪丽萍', '18059992737', '朋友', '林达常', '18059992737', '同事', '林达常', '18059992737'),
(33, 'oUnmhwnitwnXAaoJYKDe88CC2AhA', '13840045083', '梁万成', '兄弟姐妹', '梁万柱', '15640397809', '同事', '刘金库', '15141041005', '朋友', '李文', '13166749408'),
(31, 'oUnmhwtppR1hz-9l6K4cj-DRRMVE', '15778305523', '巫莲广', '父母', '彭菊莲', '15177821772', '朋友', '张景志', '15778136288', '同事', '何克树', '15778325668'),
(34, 'oUnmhwkK0WCAFtJ4jb4uZtcz8SHE', '18316916783', '黄凯平', '父母', '黄顾', '13750237405', '朋友', '钟敏', '13829379775', '同事', '罗洋', '13536763111'),
(35, 'oUnmhwmbX5MYAfpNRXChcnuPNPdA', '18182208512', '唐佳', '父母', '钟世萍', '15730457458', '朋友', '付国荣', '13617695860', '同事', '王超', '15923003673');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_user_info`
--

CREATE TABLE IF NOT EXISTS `haoidcn_user_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) DEFAULT NULL,
  `phone` varchar(20) NOT NULL COMMENT '用户手机号',
  `time` varchar(20) NOT NULL COMMENT '个人征信协议时间',
  `name` varchar(10) NOT NULL COMMENT '用户姓名',
  `uID` varchar(20) NOT NULL COMMENT '用户身份证号码',
  `qq` int(20) DEFAULT NULL COMMENT '用户QQ号码',
  `email` varchar(50) DEFAULT NULL COMMENT '用户的电子邮箱地址',
  `education` varchar(10) DEFAULT NULL COMMENT '用户的教育水平',
  `marriage` varchar(10) DEFAULT NULL COMMENT '用户婚姻状况',
  `is_children` varchar(10) DEFAULT NULL COMMENT '有没有子女',
  `integral` varchar(10) DEFAULT NULL COMMENT '芝麻分',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `haoidcn_user_info`
--

INSERT INTO `haoidcn_user_info` (`id`, `openid`, `phone`, `time`, `name`, `uID`, `qq`, `email`, `education`, `marriage`, `is_children`, `integral`) VALUES
(7, 'oUnmhwiJVaX26mLh8RZrJYhxPdkk', '15128937771', '', '于世鹏', '130823198701010011', 317016671, '317016671@qq.com', '大专', '已婚', '有', NULL),
(25, 'oUnmhwmfYpdNLoGInR5LEdOTIqWg', '15980045822', '2016-09-13 11:14:44', '大海', '350582198710174512', 66655365, 'xjh-800@163.com', '小学', '已婚', '有', NULL),
(21, 'oUnmhwuzl13SvRGFkcXQjWzfDf8o', '18135411117', '2016-09-06 12:36:32', '白富宏', '141181197509250078', 869109781, '869109781@qq.com', '大专', '已婚', '有', NULL),
(5, 'oUnmhwn9lg17p7RVRGdJnt1b8G2I', '13896333391', '', '林洁', '500101198511070120', 329693840, '329693840@qq.com', '高中', '已婚', '有', NULL),
(37, 'oUnmhwnitwnXAaoJYKDe88CC2AhA', '13840045083', '2016-09-12 16:44:28', '梁万成', '211225196603071058', 2147483647, '3108983879@.com', '高中', '已婚', '有', NULL),
(11, 'oUnmhwq4v7hTdquhTkD7aUGENt_o', '13934591555', '', '要江英', '140105198806280027', 970817826, '970817826@qq.com', '本科', '未婚', '无', NULL),
(15, 'oUnmhwhNxr3O8wpTU3i0FymgcCqk', '15080351996', '2016-09-12 15:37:46', '很久', '350583198710102613', 1222, '1222@12.cjn', '小学', '已婚', '有', NULL),
(14, 'oUnmhwp0Dd2bBve3Y8yP_bJTxaKc', '18308241587', '2016-09-03 10:43:24', '张开军', '511025199111023475', 285731160, '285731160@qq.com', '初中', '已婚', '有', NULL),
(17, 'oUnmhwnExdTEWHEXL2-NegbVlTFY', '15902807744', '2016-09-04 13:51:11', '尤奇力', '51082319920204655X', 953843959, '953843959@qq.com', '大专', '未婚', '无', NULL),
(18, 'oUnmhwkwEpNJumpNMSCGHdLHpk5I', '13221617730', '2016-09-05 13:23:54', '杨君华', '332603197707082073', 2099487095, '2099487095@qq.com', '高中', '已婚', '有', NULL),
(20, 'oUnmhwsW8ZsqY0RoS28ZpvgGTeHg', '18078048136', '2016-09-06 11:01:37', '潘得林', '450881198805090317', 815305320, '815305320@qq.com', '高中', '已婚', '有', NULL),
(22, 'oUnmhwkUBISfiqHC69jpD5vXrfeM', '13713669836', '2016-09-06 13:03:32', '何斯杰', '362502199405191859', 780647306, '780647306@qq.com', '本科', '未婚', '无', NULL),
(23, 'oUnmhwh40f7d041XAYbQ7iIxveWg', '13476000537', '2016-09-07 12:20:57', '张祥', '420103198109083217', 2147483647, '2413537050@qq.com', '大专', '已婚', '无', NULL),
(24, 'oUnmhwiEDYIUD51e32SXhOr2KYJE', '13805946646', '2016-09-08 07:12:11', '王礼胜', '420984197811294433', 471832215, '471832215@qq.com', '高中', '已婚', '有', NULL),
(27, 'oUnmhwkGh61-SQUyzHxk-pcm5MmA', '15555581612', '2016-09-08 14:48:17', '谢涌', '340521198101152817', 2098608052, '2098608052@qq.com', '高中', '已婚', '有', NULL),
(28, 'oUnmhwkOiIJrg90IOukA2JkRrw2Y', '15115487856', '2016-09-08 15:41:44', '曾志翔', '430405198602015016', 271839732, '271839732@qq.com', '高中', '已婚', '无', NULL),
(36, 'oUnmhwkzECOrlC_Ok3CIZk_b4uuI', '15860583309', '2016-09-12 15:06:48', '林达常', '350525199011021911', 541486704, '541486704@qq.com', '大专', '已婚', '有', NULL),
(30, 'oUnmhwn0O7JXfgdrK_HzGHcStdR8', '18228159595', '2016-09-09 00:24:18', '胡恒川', '513822198901207334', 314257765, '314257765@qq.com', '大专', '已婚', '有', NULL),
(31, 'oUnmhwpgzDcXzxjoO6z_1C1p668Q', '13658248456', '2016-09-10 05:50:53', '雷亚辉', '500234198511128831', 378535325, '378535325@qq.com', '大专', '已婚', '有', NULL),
(32, 'oUnmhwnef1eJnfpdYm7dtWKyibmk', '13081187050', '2016-09-10 11:31:51', '李白', '130229199103281014', 850048247, '850048247@qq.com', '初中', '未婚', '无', NULL),
(35, 'oUnmhwtppR1hz-9l6K4cj-DRRMVE', '15778305523', '2016-09-12 01:43:04', '巫莲广', '450122199001113057', 269629228, '269629228@qq.com', '大专', '未婚', '无', NULL),
(38, 'oUnmhwkK0WCAFtJ4jb4uZtcz8SHE', '18316916783', '2016-09-13 01:09:40', '黄凯平', '441621199104223232', 543734065, '543734065@qq.com', '本科', '未婚', '无', NULL),
(39, 'oUnmhwmbX5MYAfpNRXChcnuPNPdA', '18182208512', '2016-09-13 08:25:32', '唐佳', '500109198511187127', 280733500, '280733500@qq.com', '大专', '已婚', '有', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_user_message`
--

CREATE TABLE IF NOT EXISTS `haoidcn_user_message` (
  `phone` varchar(20) DEFAULT NULL,
  `message` varchar(10) DEFAULT NULL,
  `content` varchar(225) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `haoidcn_user_message`
--

INSERT INTO `haoidcn_user_message` (`phone`, `message`, `content`, `time`) VALUES
('15902807744', '建议', '老大.不是说审核20分钟嘛', '2016-09-04 15:22:19'),
('15902807744', '建议', '老大.不是说审核20分钟嘛', '2016-09-04 15:22:23');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_user_mobile`
--

CREATE TABLE IF NOT EXISTS `haoidcn_user_mobile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `service_pwd` varchar(10) DEFAULT NULL COMMENT '服务密码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- 转存表中的数据 `haoidcn_user_mobile`
--

INSERT INTO `haoidcn_user_mobile` (`id`, `openid`, `phone`, `service_pwd`) VALUES
(29, 'oUnmhwmfYpdNLoGInR5LEdOTIqWg', '15980045822', '123123'),
(8, 'oUnmhwiJVaX26mLh8RZrJYhxPdkk', '15128937771', '177133'),
(40, 'oUnmhwkzECOrlC_Ok3CIZk_b4uuI', '15860583309', '900916'),
(6, 'oUnmhwn9lg17p7RVRGdJnt1b8G2I', '13896333391', '479705'),
(41, 'oUnmhwg74qjit_qJgLfl0KI2HKJE', '18030094706', '123456'),
(16, 'oUnmhwhNxr3O8wpTU3i0FymgcCqk', '15080351996', '121212'),
(12, 'oUnmhwq4v7hTdquhTkD7aUGENt_o', '13934591555', '161800'),
(15, 'oUnmhwp0Dd2bBve3Y8yP_bJTxaKc', '18308241587', '521255'),
(18, 'oUnmhwnExdTEWHEXL2-NegbVlTFY', '15902807744', '117609'),
(19, 'oUnmhwkwEpNJumpNMSCGHdLHpk5I', '13221617730', '112288'),
(23, 'oUnmhwsQv0NLACJ7u3XXgwvZLS_I', '18873573853', '188188'),
(24, 'oUnmhwsW8ZsqY0RoS28ZpvgGTeHg', '18078048136', '147258'),
(25, 'oUnmhwuzl13SvRGFkcXQjWzfDf8o', '18135411117', '430851'),
(26, 'oUnmhwkUBISfiqHC69jpD5vXrfeM', '13713669836', '147258'),
(27, 'oUnmhwh40f7d041XAYbQ7iIxveWg', '13476000537', '123321'),
(28, 'oUnmhwiEDYIUD51e32SXhOr2KYJE', '13805946646', '258369'),
(31, 'oUnmhwkGh61-SQUyzHxk-pcm5MmA', '15555581612', '139555'),
(32, 'oUnmhwkOiIJrg90IOukA2JkRrw2Y', '15115487856', '622418'),
(33, 'oUnmhwn0O7JXfgdrK_HzGHcStdR8', '18228159595', '198800'),
(34, 'oUnmhwpgzDcXzxjoO6z_1C1p668Q', '13658248456', '461795'),
(35, 'oUnmhwnef1eJnfpdYm7dtWKyibmk', '13081187050', '982688'),
(37, NULL, '13645926886', '961081'),
(39, 'oUnmhwtppR1hz-9l6K4cj-DRRMVE', '15778305523', '980606'),
(42, 'oUnmhwnitwnXAaoJYKDe88CC2AhA', '13840045083', '196637'),
(43, 'oUnmhwkK0WCAFtJ4jb4uZtcz8SHE', '18316916783', '778899'),
(44, 'oUnmhwmbX5MYAfpNRXChcnuPNPdA', '18182208512', '850313');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_user_money_info`
--

CREATE TABLE IF NOT EXISTS `haoidcn_user_money_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) DEFAULT NULL,
  `phone` varchar(20) NOT NULL COMMENT '用户手机号',
  `apply_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '用户申请时间',
  `money_num` varchar(20) NOT NULL COMMENT '用户借款金额',
  `time_length` varchar(10) NOT NULL COMMENT '用户借款时长',
  `letter` int(10) DEFAULT NULL COMMENT '借款快速信审费',
  `interest` int(10) DEFAULT NULL COMMENT '借款利息费',
  `account_money` int(10) DEFAULT NULL COMMENT '借款账户管理费',
  `sum` varchar(20) DEFAULT NULL COMMENT '用户应还款多少',
  `daozhang` int(10) NOT NULL COMMENT '实际到账总额',
  `state` varchar(5) DEFAULT '0' COMMENT '1已审或0未审',
  `is_adopt` int(2) DEFAULT '-1' COMMENT '是否通过审核  -1是未提交 0是申请中 1是通过 2是不通过 3已取消申请',
  `loan_people` varchar(100) DEFAULT NULL COMMENT '审核人员',
  `content` varchar(255) DEFAULT NULL COMMENT '审核备注',
  `is_renewal` int(20) DEFAULT '0' COMMENT '续期次数',
  `complete_renewal` int(1) NOT NULL DEFAULT '0' COMMENT '已经完成续期次数',
  `repayment_state` int(11) NOT NULL DEFAULT '0' COMMENT '0是未还款的借款    1是已经还款的借款',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `haoidcn_user_money_info`
--

INSERT INTO `haoidcn_user_money_info` (`id`, `openid`, `phone`, `apply_time`, `money_num`, `time_length`, `letter`, `interest`, `account_money`, `sum`, `daozhang`, `state`, `is_adopt`, `loan_people`, `content`, `is_renewal`, `complete_renewal`, `repayment_state`) VALUES
(29, 'oUnmhwmfYpdNLoGInR5LEdOTIqWg', '15980045822', '2016-09-13 03:13:39', '2000', '14', 180, 20, 120, '2000', 1680, '1', 2, 'admin', '范德萨', 0, 0, 0),
(9, 'oUnmhwiJVaX26mLh8RZrJYhxPdkk', '15128937771', '2016-09-13 03:13:42', '3000', '14', 270, 30, 180, '3000', 2540, '0', 0, 'shenhe01(审)', NULL, 0, 0, 0),
(13, 'oUnmhwq4v7hTdquhTkD7aUGENt_o', '13934591555', '2016-09-13 03:13:42', '1000', '14', 90, 10, 60, '1000', 860, '0', 0, 'shenhe02(审)', NULL, 0, 0, 0),
(6, 'oUnmhwn9lg17p7RVRGdJnt1b8G2I', '13896333391', '2016-09-13 03:13:42', '500', '14', 45, 5, 30, '500', 420, '0', 0, 'shenhe03(审)', NULL, 0, 0, 0),
(45, 'oUnmhwkzECOrlC_Ok3CIZk_b4uuI', '15860583309', '2016-09-12 07:35:19', '1000', '14', 90, 10, 60, '1000', 840, '0', 0, 'daili02(代)', NULL, 0, 0, 0),
(16, 'oUnmhwp0Dd2bBve3Y8yP_bJTxaKc', '18308241587', '2016-09-13 03:13:42', '3000', '14', 270, 30, 180, '3000', 2520, '0', 0, 'shenhe01(审)', NULL, 0, 0, 0),
(17, 'oUnmhwhNxr3O8wpTU3i0FymgcCqk', '15080351996', '2016-09-12 03:28:04', '500', '7', 22, 2, 16, '500', 460, '1', 1, 'admin', NULL, 0, 0, 1),
(49, 'oUnmhwmbX5MYAfpNRXChcnuPNPdA', '18182208512', '2016-09-13 03:13:42', '3000', '14', 270, 30, 180, '3000', 2520, '0', 0, 'shenhe02(审)', NULL, 0, 0, 0),
(18, 'oUnmhwnExdTEWHEXL2-NegbVlTFY', '15902807744', '2016-09-13 03:13:42', '1000', '7', 45, 5, 30, '1000', 920, '0', 0, 'shenhe03(审)', NULL, 0, 0, 0),
(19, 'oUnmhwkwEpNJumpNMSCGHdLHpk5I', '13221617730', '2016-09-13 03:13:42', '3000', '14', 270, 30, 180, '3000', 2520, '0', 0, 'shenhe01(审)', NULL, 0, 0, 0),
(23, 'oUnmhwsQv0NLACJ7u3XXgwvZLS_I', '18873573853', '2016-09-05 20:54:26', '1000', '7', 45, 5, 30, '1000', 920, '0', -1, NULL, NULL, 0, 0, 0),
(24, 'oUnmhwsW8ZsqY0RoS28ZpvgGTeHg', '18078048136', '2016-09-13 03:13:42', '3000', '14', 270, 30, 180, '3000', 2520, '0', 0, 'shenhe02(审)', NULL, 0, 0, 0),
(25, 'oUnmhwuzl13SvRGFkcXQjWzfDf8o', '18135411117', '2016-09-13 03:13:42', '2000', '14', 180, 20, 120, '2000', 1680, '0', 0, 'shenhe03(审)', NULL, 0, 0, 0),
(26, 'oUnmhwkUBISfiqHC69jpD5vXrfeM', '13713669836', '2016-09-13 03:13:42', '3000', '14', 270, 30, 180, '3000', 2520, '0', 0, 'shenhe01(审)', NULL, 0, 0, 0),
(27, 'oUnmhwh40f7d041XAYbQ7iIxveWg', '13476000537', '2016-09-07 06:11:28', '1000', '14', 90, 10, 60, '1000', 840, '0', 0, '13260601490(代)', NULL, 0, 0, 0),
(28, 'oUnmhwiEDYIUD51e32SXhOr2KYJE', '13805946646', '2016-09-08 01:42:28', '1000', '7', 45, 5, 30, '1000', 920, '0', 0, 'daili02(代)', NULL, 0, 0, 0),
(31, 'oUnmhwkGh61-SQUyzHxk-pcm5MmA', '15555581612', '2016-09-13 03:13:42', '500', '7', 22, 2, 16, '500', 460, '0', 0, 'shenhe02(审)', NULL, 0, 0, 0),
(32, 'oUnmhwkOiIJrg90IOukA2JkRrw2Y', '15115487856', '2016-09-13 03:13:42', '1500', '14', 135, 15, 90, '1500', 1260, '0', 0, 'shenhe03(审)', NULL, 0, 0, 0),
(33, 'oUnmhwn0O7JXfgdrK_HzGHcStdR8', '18228159595', '2016-09-08 16:16:34', '3000', '14', 270, 30, 180, '3000', 2520, '0', -1, NULL, NULL, 0, 0, 0),
(34, 'oUnmhwpgzDcXzxjoO6z_1C1p668Q', '13658248456', '2016-09-13 03:13:42', '1500', '14', 135, 15, 90, '1500', 1260, '0', 0, 'shenhe01(审)', NULL, 0, 0, 0),
(35, 'oUnmhwnef1eJnfpdYm7dtWKyibmk', '13081187050', '2016-09-10 03:30:59', '3000', '14', 270, 30, 180, '3000', 2520, '0', -1, NULL, NULL, 0, 0, 0),
(37, 'oUnmhwrgeHRdxp03thxr9nW7H4u8', '13645926886', '2016-09-10 09:17:26', '1500', '7', 68, 7, 45, '1500', 1380, '0', -1, NULL, NULL, 0, 0, 0),
(40, NULL, '', '2016-09-13 03:13:42', '', '', NULL, NULL, NULL, NULL, 0, '0', 0, 'shenhe02(审)', NULL, 1, 0, 0),
(48, 'oUnmhwkK0WCAFtJ4jb4uZtcz8SHE', '18316916783', '2016-09-13 03:13:42', '2000', '14', 180, 20, 120, '2000', 1680, '0', 0, 'shenhe03(审)', NULL, 0, 0, 0),
(42, 'oUnmhwtppR1hz-9l6K4cj-DRRMVE', '15778305523', '2016-09-13 03:13:42', '1000', '14', 90, 10, 60, '1000', 840, '0', 0, 'shenhe01(审)', NULL, 0, 0, 0),
(43, 'oUnmhwhNxr3O8wpTU3i0FymgcCqk', '15080351996', '2016-09-12 07:57:41', '500', '14', 45, 5, 30, '500', 420, '1', 1, 'admin', NULL, 0, 0, 0),
(47, 'oUnmhwnitwnXAaoJYKDe88CC2AhA', '13840045083', '2016-09-13 03:13:42', '500', '14', 45, 5, 30, '500', 420, '0', 0, 'shenhe02(审)', NULL, 0, 0, 0),
(46, 'oUnmhwg74qjit_qJgLfl0KI2HKJE', '18030094706', '2016-09-12 07:57:18', '2000', '14', 180, 20, 120, '2000', 1680, '0', -1, NULL, NULL, 0, 0, 0),
(50, 'oUnmhwmfYpdNLoGInR5LEdOTIqWg', '15980045822', '2016-09-13 03:22:32', '4000', '', NULL, NULL, NULL, '4000', 0, '1', 1, 'admin', NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_user_overdue`
--

CREATE TABLE IF NOT EXISTS `haoidcn_user_overdue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interest` int(10) DEFAULT NULL COMMENT '逾期利息费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `haoidcn_user_overdue`
--

INSERT INTO `haoidcn_user_overdue` (`id`, `interest`) VALUES
(1, 30);

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_user_work`
--

CREATE TABLE IF NOT EXISTS `haoidcn_user_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL COMMENT '用户手机号',
  `name` varchar(20) DEFAULT NULL COMMENT '用户名',
  `work` varchar(10) NOT NULL COMMENT '用户工作名称',
  `wages` varchar(30) NOT NULL COMMENT '用户的工资',
  `company_name` varchar(30) DEFAULT NULL COMMENT '单位名称',
  `province` varchar(10) DEFAULT NULL COMMENT '用户工作的省',
  `city` varchar(10) DEFAULT NULL COMMENT '用户工作的市',
  `address` varchar(100) DEFAULT NULL COMMENT '用户的所在地址',
  `zip_code` varchar(20) DEFAULT NULL COMMENT '用户邮编',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- 转存表中的数据 `haoidcn_user_work`
--

INSERT INTO `haoidcn_user_work` (`id`, `openid`, `phone`, `name`, `work`, `wages`, `company_name`, `province`, `city`, `address`, `zip_code`) VALUES
(20, 'oUnmhwmfYpdNLoGInR5LEdOTIqWg', '15980045822', '大海', '运输设备操作人员', '10000元以上', '苹果', '河北省', '石家庄市', '晋江', ''),
(6, 'oUnmhwiJVaX26mLh8RZrJYhxPdkk', '15128937771', '于世鹏', '专业技术人员', '2000-3000元', '旭日电脑有限责任公司', '河北省', '承德市', '平泉县兴平路8号底商', '03146205888'),
(15, 'oUnmhwsW8ZsqY0RoS28ZpvgGTeHg', '18078048136', '潘得林', '商业、服务业', '3000-4000元', '和海服装厂', '广西壮族自治区', '贵港市', '广西桂平市木乐镇富民路120号', '0775-3689748'),
(4, 'oUnmhwn9lg17p7RVRGdJnt1b8G2I', '13896333391', '林洁', '运输设备操作人员', '3000-4000元', '重庆市万州区顺达出租汽车有限公司', '重庆市', '市辖区', '果园路114号', '023-64891988'),
(8, 'oUnmhwq4v7hTdquhTkD7aUGENt_o', '13934591555', '要江英', '企业、事业单位', '3000-4000元', '交警支队迎泽二大队', '山西省', '太原市', '南内环地下桥往南500米天玺公馆', '03516329383'),
(29, 'oUnmhwtppR1hz-9l6K4cj-DRRMVE', '15778305523', '巫莲广', '企业、事业单位', '2000-3000元', '广西美固龙商贸有限公司', '广西壮族自治区', '南宁市', '永和路2号永华苑4单元404号', '0771-2386135'),
(10, 'oUnmhwp0Dd2bBve3Y8yP_bJTxaKc', '18308241587', '张开军', '商业、服务业', '3000-4000元', '朋杏酒楼', '四川省', '成都市', '武侯区小天东街5号', '02885558888'),
(12, 'oUnmhwnExdTEWHEXL2-NegbVlTFY', '15902807744', '尤奇力', '专业技术人员', '3000-4000元', '四川三众电梯有限公司', '四川省', '成都市', '锦江区沙河南路29号沙河壹号二期7栋1406', '02886741778'),
(13, 'oUnmhwkwEpNJumpNMSCGHdLHpk5I', '13221617730', '杨君华', '专业技术人员', '5000-10000元', '台州市宝瑞塑业有限公司', '浙江省', '台州市', '黄岩区南城街道横河村391号', '0576-82890937'),
(16, 'oUnmhwuzl13SvRGFkcXQjWzfDf8o', '18135411117', '白富宏', '企业、事业单位', '5000-10000元', '山西焦煤汾西矿业双柳煤矿', '山西省', '吕梁市', '柳林县孟门镇白家焉', '0358-4308518'),
(17, 'oUnmhwkUBISfiqHC69jpD5vXrfeM', '13713669836', '何斯杰', '企业、事业单位', '5000-10000元', '深圳运泰利自动化设备有限公司', '广东省', '深圳市', '光明新区观光路3009号招商科技园a6栋2层2002室', '0755-23571396'),
(18, 'oUnmhwh40f7d041XAYbQ7iIxveWg', '13476000537', '张祥', '运输设备操作人员', '3000-4000元', '武汉京昌物流有限公司', '湖北省', '武汉市', '舵落口大市场18区B13栋8号', '027-83660428'),
(19, 'oUnmhwiEDYIUD51e32SXhOr2KYJE', '13805946646', '王礼胜', '运输设备操作人员', '5000-10000元', '华龙油库', '福建省', '泉州市', '南安市石井镇延平大道华龙油库', '0595-86099572'),
(22, 'oUnmhwkGh61-SQUyzHxk-pcm5MmA', '15555581612', '谢涌', '商业、服务业', '3000-4000元', '芜马运输公司', '安徽省', '马鞍山市', '当涂县焦家开发区11栋105', '0555-6867505'),
(23, 'oUnmhwkOiIJrg90IOukA2JkRrw2Y', '15115487856', '曾志翔', '专业技术人员', '5000-10000元', '衡阳一品车道名车服务机构', '湖南省', '衡阳市', '珠晖区酃湖乡解放村四组30号', ''),
(30, 'oUnmhwkzECOrlC_Ok3CIZk_b4uuI', '15860583309', '林达常', '企业、事业单位', '2000-3000元', '泉州芒果网络科技有限公司', '福建省', '泉州市', '大洋百货', '0595-88888888'),
(25, 'oUnmhwn0O7JXfgdrK_HzGHcStdR8', '18228159595', '胡恒川', '企业、事业单位', '3000-4000元', '成都市盛嘉科技有限公司', '四川省', '成都市', '青羊区西御街8号，西御大厦b座26楼k1', '02864053168'),
(26, 'oUnmhwpgzDcXzxjoO6z_1C1p668Q', '13658248456', '雷亚辉', '企业、事业单位', '3000-4000元', '湖南六建', '海南省', '海口市', '澄迈马村怡宝项目部', '0898-65978456'),
(27, 'oUnmhwnef1eJnfpdYm7dtWKyibmk', '13081187050', '李白', '企业、事业单位', '3000-4000元', '鑫福鑫炉业', '河北省', '唐山市', '玉田县郭家屯乡', '0315-6592126'),
(31, 'oUnmhwnitwnXAaoJYKDe88CC2AhA', '13840045083', '梁万成', '专业技术人员', '3000-4000元', '辽宁省沈阳和平区比尔森', '辽宁省', '沈阳市', '和平区南宁北街19一1一8一3', '02431315777'),
(32, 'oUnmhwkK0WCAFtJ4jb4uZtcz8SHE', '18316916783', '黄凯平', '企业、事业单位', '5000-10000元', '快捷公司', '广东省', '河源市', '广东省深圳市南山区科技园路56', '0755-83115421'),
(33, 'oUnmhwmbX5MYAfpNRXChcnuPNPdA', '18182208512', '唐佳', '企业、事业单位', '3000-4000元', '中国电信北碚胜利路营业厅', '重庆市', '市辖区', '重庆市北碚区胜利路一号', '02368289244');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_weixin_img`
--

CREATE TABLE IF NOT EXISTS `haoidcn_weixin_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) DEFAULT NULL COMMENT '用户的openID',
  `phone` varchar(20) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL COMMENT '创建时间',
  `img_url` varchar(255) DEFAULT NULL COMMENT '图片链接',
  `img1` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- 转存表中的数据 `haoidcn_weixin_img`
--

INSERT INTO `haoidcn_weixin_img` (`id`, `openid`, `phone`, `time`, `img_url`, `img1`, `img2`, `img3`) VALUES
(20, 'oUnmhwmfYpdNLoGInR5LEdOTIqWg', '15980045822', '2016-09-13', NULL, '/Uploads/2016-09-08/57d0e4475b151.jpg', '/Uploads/2016-09-08/57d0e4475b71d.jpg', '/Uploads/2016-09-08/57d0e4475b86e.png'),
(14, 'oUnmhwsW8ZsqY0RoS28ZpvgGTeHg', '18078048136', '2016-09-06', NULL, '/Uploads/2016-09-06/57ce3270caaea.jpeg', '/Uploads/2016-09-06/57ce3270cddf2.jpeg', '/Uploads/2016-09-06/57ce3270ce524.jpg'),
(4, 'oUnmhwn9lg17p7RVRGdJnt1b8G2I', '13896333391', '2016-09-03', './Uploads/2016-09-02/1472772588.63.jpg', '/Uploads/2016-09-03/57c9f859a8100.jpg', '/Uploads/2016-09-03/57c9f859af800.jpg', '/Uploads/2016-09-03/57c9f859b6248.jpg'),
(6, 'oUnmhwiJVaX26mLh8RZrJYhxPdkk', '15128937771', '2016-09-02', NULL, '/Uploads/2016-09-02/57c90d8c91bb7.jpg', '/Uploads/2016-09-02/57c90d8c98418.jpg', '/Uploads/2016-09-02/57c90d8c9c860.jpg'),
(10, 'oUnmhwp0Dd2bBve3Y8yP_bJTxaKc', '18308241587', '2016-09-03', NULL, '/Uploads/2016-09-03/57ca3a5b9857c.jpg', '/Uploads/2016-09-03/57ca3a5b9ef6a.jpg', '/Uploads/2016-09-03/57ca3a5ba35d4.jpg'),
(9, 'oUnmhwq4v7hTdquhTkD7aUGENt_o', '13934591555', '2016-09-02', NULL, '/Uploads/2016-09-02/57c99b37e0d9b.jpg', '/Uploads/2016-09-02/57c99b37e0f3f.jpg', '/Uploads/2016-09-02/57c99b37e137d.jpg'),
(11, 'oUnmhwnExdTEWHEXL2-NegbVlTFY', '15902807744', '2016-09-04', NULL, '/Uploads/2016-09-04/57cbb702e1610.jpeg', '/Uploads/2016-09-04/57cbb702e1e6c.jpeg', '/Uploads/2016-09-04/57cbb702e263f.jpeg'),
(12, 'oUnmhwkwEpNJumpNMSCGHdLHpk5I', '13221617730', '2016-09-05', NULL, '/Uploads/2016-09-05/57cd01afbfad7.jpg', '/Uploads/2016-09-05/57cd01afc2d4b.jpg', '/Uploads/2016-09-05/57cd01afc5a76.jpg'),
(15, 'oUnmhwuzl13SvRGFkcXQjWzfDf8o', '18135411117', '2016-09-06', NULL, '/Uploads/2016-09-06/57ce48b8697fe.jpg', '/Uploads/2016-09-06/57ce48b86ea34.jpg', '/Uploads/2016-09-06/57ce48b8717f9.jpg'),
(16, 'oUnmhwkUBISfiqHC69jpD5vXrfeM', '13713669836', '2016-09-06', NULL, '/Uploads/2016-09-06/57ce4f48afda8.jpg', '/Uploads/2016-09-06/57ce4f48b3413.jpg', '/Uploads/2016-09-06/57ce4f48b3bd5.jpg'),
(17, 'oUnmhwhNxr3O8wpTU3i0FymgcCqk', '15080351996', '2016-09-12', NULL, '/Uploads/2016-09-06/57ce744e35c5a.jpeg', '/Uploads/2016-09-06/57ce744e35ead.jpeg', '/Uploads/2016-09-06/57ce744e3b391.jpg'),
(18, 'oUnmhwh40f7d041XAYbQ7iIxveWg', '13476000537', '2016-09-07', NULL, '/Uploads/2016-09-07/57cf968602080.jpg', '/Uploads/2016-09-07/57cf968602781.jpg', '/Uploads/2016-09-07/57cf968603226.jpg'),
(19, 'oUnmhwiEDYIUD51e32SXhOr2KYJE', '13805946646', '2016-09-08', NULL, '/Uploads/2016-09-08/57d0a1a05b577.jpg', '/Uploads/2016-09-08/57d0a1a05d912.jpg', '/Uploads/2016-09-08/57d0a1a05f01a.jpg'),
(22, 'oUnmhwkGh61-SQUyzHxk-pcm5MmA', '15555581612', '2016-09-08', NULL, '/Uploads/2016-09-08/57d10ba6b4977.jpg', '/Uploads/2016-09-08/57d10ba6b74f6.jpg', '/Uploads/2016-09-08/57d10ba6b7ace.jpg'),
(23, 'oUnmhwkOiIJrg90IOukA2JkRrw2Y', '15115487856', '2016-09-08', NULL, '/Uploads/2016-09-08/57d116dec4954.jpg', '/Uploads/2016-09-08/57d116dec4e12.jpg', '/Uploads/2016-09-08/57d116dec5113.jpg'),
(30, 'oUnmhwkzECOrlC_Ok3CIZk_b4uuI', '15860583309', '2016-09-12', NULL, '/Uploads/2016-09-12/57d65471d8dc7.jpeg', '/Uploads/2016-09-12/57d65471dd80e.jpeg', '/Uploads/2016-09-12/57d65471e4583.jpeg'),
(31, 'oUnmhwnitwnXAaoJYKDe88CC2AhA', '13840045083', '2016-09-12', NULL, '/Uploads/2016-09-12/57d679555dc3c.jpg', '/Uploads/2016-09-12/57d679556144e.jpg', '/Uploads/2016-09-12/57d6795562419.jpg'),
(26, 'oUnmhwpgzDcXzxjoO6z_1C1p668Q', '13658248456', '2016-09-10', NULL, '/Uploads/2016-09-10/57d32ff5b4c8f.jpg', '/Uploads/2016-09-10/57d32ff5bd7e9.jpg', '/Uploads/2016-09-10/57d32ff5bde65.jpg'),
(29, 'oUnmhwtppR1hz-9l6K4cj-DRRMVE', '15778305523', '2016-09-12', NULL, '/Uploads/2016-09-12/57d5995782ca0.jpg', '/Uploads/2016-09-12/57d5995782f6c.jpg', '/Uploads/2016-09-12/57d599578314b.jpg'),
(32, 'oUnmhwkK0WCAFtJ4jb4uZtcz8SHE', '18316916783', '2016-09-13', NULL, '/Uploads/2016-09-13/57d7433ee5151.jpeg', '/Uploads/2016-09-13/57d7433ee5c1d.jpeg', '/Uploads/2016-09-13/57d7433ee616b.jpeg'),
(33, 'oUnmhwmbX5MYAfpNRXChcnuPNPdA', '18182208512', '2016-09-13', NULL, '/Uploads/2016-09-13/57d7483886f27.jpg', '/Uploads/2016-09-13/57d748388a85f.jpg', '/Uploads/2016-09-13/57d748388c1a1.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_work`
--

CREATE TABLE IF NOT EXISTS `haoidcn_work` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `issue` text NOT NULL,
  `sc_file` varchar(255) NOT NULL,
  `puddate` varchar(250) NOT NULL,
  `cc_status` enum('-1','1') NOT NULL,
  `tz_status` enum('-1','1') NOT NULL,
  `wc_sataus` enum('2','1','-1','3') NOT NULL,
  `uid` int(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_xuesheng`
--

CREATE TABLE IF NOT EXISTS `haoidcn_xuesheng` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `work` varchar(50) DEFAULT NULL COMMENT '职业学生',
  `province` varchar(10) DEFAULT NULL COMMENT '省',
  `city` varchar(10) DEFAULT NULL COMMENT '市',
  `school` varchar(100) DEFAULT NULL COMMENT '学校',
  `time` varchar(100) DEFAULT NULL COMMENT '入学时间',
  `account` varchar(20) DEFAULT NULL COMMENT '学信网账号',
  `password` varchar(100) DEFAULT NULL COMMENT '学信网密码',
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `haoidcn_xuesheng`
--

INSERT INTO `haoidcn_xuesheng` (`id`, `openid`, `phone`, `work`, `province`, `city`, `school`, `time`, `account`, `password`, `url`) VALUES
(3, 'oUnmhwg74qjit_qJgLfl0KI2HKJE', '18030094706', '学生', '福建省', '厦门市', '海洋学校', '20160809', 'rhj', '123456', '/Uploads/2016-09-12/57d6601ff15b3.jpg'),
(2, 'oUnmhwhNxr3O8wpTU3i0FymgcCqk', '15080351996', '学生', '北京市', '市辖区', '杰队以', '225556', '1254566', 'sfg', '/Uploads/2016-09-03/57ca7100659a1.png');

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_xuexin`
--

CREATE TABLE IF NOT EXISTS `haoidcn_xuexin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) DEFAULT NULL,
  `num` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_xuqi`
--

CREATE TABLE IF NOT EXISTS `haoidcn_xuqi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xuqi` int(10) DEFAULT NULL COMMENT '续期服务费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `haoidcn_xuqi`
--

INSERT INTO `haoidcn_xuqi` (`id`, `xuqi`) VALUES
(1, 100);

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_zfb`
--

CREATE TABLE IF NOT EXISTS `haoidcn_zfb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) DEFAULT NULL,
  `num` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `haoidcn_zixun`
--

CREATE TABLE IF NOT EXISTS `haoidcn_zixun` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL,
  `content` text,
  `times` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `haoidcn_zixun`
--

INSERT INTO `haoidcn_zixun` (`id`, `title`, `content`, `times`) VALUES
(1, '测试2', 'e点赚成功上线！&amp;lt;br /&amp;gt;\r\n&amp;lt;img src=&amp;quot;http://e.v-tuo.cn/Uploads/kindeditor/attached/image/20160613/20160613061007_36191.gif&amp;quot; alt=&amp;quot;&amp;quot; /&amp;gt;&amp;lt;br /&amp;gt;\r\n感谢CCTV,感谢MTV!', '2016-06-12 22:10:31'),
(2, '测试1', '&amp;lt;img src=&amp;quot;http://e.v-tuo.cn/Uploads/kindeditor/attached/image/20160613/20160613060839_27410.jpg&amp;quot; alt=&amp;quot;&amp;quot; width=&amp;quot;96&amp;quot; height=&amp;quot;96&amp;quot; title=&amp;quot;&amp;quot; align=&amp;quot;&amp;quot; /&amp;gt;&amp;lt;br /&amp;gt;\r\n测试数据', '2016-06-12 22:09:17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
