-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 21, 2013 at 08:16 PM
-- Server version: 5.1.70-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ir8_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `acp_nav_links`
--

CREATE TABLE IF NOT EXISTS `acp_nav_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `sub_action` varchar(255) NOT NULL,
  `options` varchar(255) NOT NULL,
  `perms` varchar(255) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `acp_nav_links`
--

INSERT INTO `acp_nav_links` (`id`, `secid`, `title`, `action`, `sub_action`, `options`, `perms`, `orderid`) VALUES
(1, 1, 'Site Settings', 'settings', '', '', 'can_admin_settings', 0),
(4, 3, 'Category Manager', 'forums', 'categories', '', 'can_admin_forums', 1),
(5, 3, 'Forum Manager', 'forums', 'forums', '', 'can_admin_forums', 2),
(7, 4, 'View Usergroups', 'usergroups', '', '', 'can_admin_usergroups', 1),
(8, 4, 'Add Usergroup', 'usergroups', 'addusergroup', '', 'can_admin_usergroups', 2),
(9, 4, 'Permissions Manager', 'usergroups', 'perms', '', 'can_admin_permissions', 3),
(11, 5, 'Search Users', 'users', 'search', '', 'can_admin_users', 1),
(12, 5, 'Ban User', 'users', 'ban', '', 'can_admin_users', 2),
(16, 2, 'Manage Navigation', 'sitenav', '', '', 'can_admin_navigation', 1),
(17, 6, 'Staff Logs', 'logs', 'staff', '', 'can_view_logs', 1),
(18, 6, 'User Logs', 'logs', 'user', '', 'can_view_logs', 2),
(19, 7, 'Slider Management', 'fpage', 'slider', '', 'can_admin_frontpage', 1),
(20, 7, 'Frontpage Settings', 'fpage', 'settings', '', 'can_admin_frontpage', 2),
(22, 8, 'View PHP Info', 'maintenance', 'phpinfo', '', 'can_admin_maintenance', 1),
(23, 8, 'Control Panel Navigation', 'maintenance', 'cpnav', '', 'can_admin_maintenance', 0),
(29, 12, 'Ticket Management', 'tickets', 'tickets', '', 'can_view_tickets', 1),
(30, 12, 'Manage Categories', 'tickets', 'categories', '', 'can_admin_ticket_categories', 0),
(31, 13, 'Manage Posts', 'cpnews', '', '', 'can_admin_cpnews', 0),
(32, 14, 'Manage News', 'snews', '', '', 'can_admin_site_news', 0),
(33, 15, 'View Sidebars', 'sidebars', '', '', 'can_admin_sidebars', 0),
(34, 16, 'Pages Manager', 'pages', '', '', 'can_admin_pages', 0),
(35, 17, 'Manage Blogs', 'blogs', '', '', 'can_admin_blogs', 0),
(36, 17, 'Add Blog Post', 'blogs', 'add', '', 'can_admin_blogs', 0),
(37, 16, 'Add New Page', 'pages', 'newpage', '', 'can_admin_pages', 0),
(38, 15, 'New Sidebar', 'sidebars', 'add', '', 'can_admin_sidebars', 0),
(39, 18, 'Manage Videos', 'videos', '', '', 'can_admin_videos', 0),
(40, 18, 'Add New Video', 'videos', 'add', '', 'can_admin_videos', 0),
(45, 20, 'Manage Galleries', 'galleries', '', '', 'can_admin_gallery', 0);

-- --------------------------------------------------------

--
-- Table structure for table `acp_nav_sections`
--

CREATE TABLE IF NOT EXISTS `acp_nav_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL,
  `perms` varchar(255) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `acp_nav_sections`
--

INSERT INTO `acp_nav_sections` (`id`, `title`, `href`, `perms`, `orderid`) VALUES
(1, 'General', '#', 'can_admin_settings', 0),
(2, 'Site Navigation', '#', 'can_admin_navigation', 6),
(3, 'Forum Management', '#', 'can_admin_forums', 11),
(4, 'Usergroups', '#', 'can_admin_usergroups', 12),
(5, 'Users', '#', 'can_admin_users', 13),
(6, 'Logs', '#', 'can_view_logs', 14),
(7, 'Frontpage', '#', 'can_admin_frontpage', 7),
(8, 'Maintenance', '#', 'can_admin_maintenance', 15),
(12, 'Tickets', '', 'can_view_tickets', 10),
(13, 'CP News Management', '', 'can_admin_cpnews', 9),
(14, 'Site News Management', '', 'can_admin_site_news', 8),
(15, 'Sidebars', '', 'can_admin_sidebars', 5),
(16, 'Pages Management', '', 'can_admin_pages', 3),
(17, 'Blog Management', '', 'can_admin_blogs', 2),
(18, 'Videos Management', '', 'can_admin_videos', 1),
(20, 'Gallery Management', '', 'can_admin_gallery', 4);

-- --------------------------------------------------------

--
-- Table structure for table `acp_news`
--

CREATE TABLE IF NOT EXISTS `acp_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `acp_news`
--

INSERT INTO `acp_news` (`id`, `title`, `content`, `date`, `userid`) VALUES
(1, 'Welcome!', 'Thank you for choosing Irate CMS! You will notice everything you need is here in the admin panel!', '2012-12-25 07:56:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `banned`
--

CREATE TABLE IF NOT EXISTS `banned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `userip` varchar(255) NOT NULL,
  `ban_date` varchar(255) NOT NULL,
  `lift_date` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `adminid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` longtext NOT NULL,
  `content` text NOT NULL,
  `authorid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `image`, `short_desc`, `content`, `authorid`, `date`) VALUES
(1, 'Test Blog', '', '', '<p>This is a simple test blog.2</p>', 1, '2013-11-03 22:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `perms` varchar(255) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `perms`, `orderid`) VALUES
(1, 'General', 'a:5:{i:0;i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `printable_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`iso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`iso`, `name`, `printable_name`, `iso3`, `numcode`) VALUES
('AD', 'ANDORRA', 'Andorra', 'AND', 20),
('AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784),
('AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4),
('AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28),
('AI', 'ANGUILLA', 'Anguilla', 'AIA', 660),
('AL', 'ALBANIA', 'Albania', 'ALB', 8),
('AM', 'ARMENIA', 'Armenia', 'ARM', 51),
('AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530),
('AO', 'ANGOLA', 'Angola', 'AGO', 24),
('AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL),
('AR', 'ARGENTINA', 'Argentina', 'ARG', 32),
('AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16),
('AT', 'AUSTRIA', 'Austria', 'AUT', 40),
('AU', 'AUSTRALIA', 'Australia', 'AUS', 36),
('AW', 'ARUBA', 'Aruba', 'ABW', 533),
('AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31),
('BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70),
('BB', 'BARBADOS', 'Barbados', 'BRB', 52),
('BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50),
('BE', 'BELGIUM', 'Belgium', 'BEL', 56),
('BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854),
('BG', 'BULGARIA', 'Bulgaria', 'BGR', 100),
('BH', 'BAHRAIN', 'Bahrain', 'BHR', 48),
('BI', 'BURUNDI', 'Burundi', 'BDI', 108),
('BJ', 'BENIN', 'Benin', 'BEN', 204),
('BM', 'BERMUDA', 'Bermuda', 'BMU', 60),
('BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96),
('BO', 'BOLIVIA', 'Bolivia', 'BOL', 68),
('BR', 'BRAZIL', 'Brazil', 'BRA', 76),
('BS', 'BAHAMAS', 'Bahamas', 'BHS', 44),
('BT', 'BHUTAN', 'Bhutan', 'BTN', 64),
('BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL),
('BW', 'BOTSWANA', 'Botswana', 'BWA', 72),
('BY', 'BELARUS', 'Belarus', 'BLR', 112),
('BZ', 'BELIZE', 'Belize', 'BLZ', 84),
('CA', 'CANADA', 'Canada', 'CAN', 124),
('CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL),
('CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180),
('CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140),
('CG', 'CONGO', 'Congo', 'COG', 178),
('CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756),
('CI', 'COTE D''IVOIRE', 'Cote D''Ivoire', 'CIV', 384),
('CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184),
('CL', 'CHILE', 'Chile', 'CHL', 152),
('CM', 'CAMEROON', 'Cameroon', 'CMR', 120),
('CN', 'CHINA', 'China', 'CHN', 156),
('CO', 'COLOMBIA', 'Colombia', 'COL', 170),
('CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188),
('CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL),
('CU', 'CUBA', 'Cuba', 'CUB', 192),
('CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132),
('CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL),
('CY', 'CYPRUS', 'Cyprus', 'CYP', 196),
('CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203),
('DE', 'GERMANY', 'Germany', 'DEU', 276),
('DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262),
('DK', 'DENMARK', 'Denmark', 'DNK', 208),
('DM', 'DOMINICA', 'Dominica', 'DMA', 212),
('DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214),
('DZ', 'ALGERIA', 'Algeria', 'DZA', 12),
('EC', 'ECUADOR', 'Ecuador', 'ECU', 218),
('EE', 'ESTONIA', 'Estonia', 'EST', 233),
('EG', 'EGYPT', 'Egypt', 'EGY', 818),
('EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732),
('ER', 'ERITREA', 'Eritrea', 'ERI', 232),
('ES', 'SPAIN', 'Spain', 'ESP', 724),
('ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231),
('FI', 'FINLAND', 'Finland', 'FIN', 246),
('FJ', 'FIJI', 'Fiji', 'FJI', 242),
('FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238),
('FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583),
('FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234),
('FR', 'FRANCE', 'France', 'FRA', 250),
('GA', 'GABON', 'Gabon', 'GAB', 266),
('GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826),
('GD', 'GRENADA', 'Grenada', 'GRD', 308),
('GE', 'GEORGIA', 'Georgia', 'GEO', 268),
('GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254),
('GH', 'GHANA', 'Ghana', 'GHA', 288),
('GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292),
('GL', 'GREENLAND', 'Greenland', 'GRL', 304),
('GM', 'GAMBIA', 'Gambia', 'GMB', 270),
('GN', 'GUINEA', 'Guinea', 'GIN', 324),
('GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312),
('GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226),
('GR', 'GREECE', 'Greece', 'GRC', 300),
('GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL),
('GT', 'GUATEMALA', 'Guatemala', 'GTM', 320),
('GU', 'GUAM', 'Guam', 'GUM', 316),
('GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624),
('GY', 'GUYANA', 'Guyana', 'GUY', 328),
('HK', 'HONG KONG', 'Hong Kong', 'HKG', 344),
('HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL),
('HN', 'HONDURAS', 'Honduras', 'HND', 340),
('HR', 'CROATIA', 'Croatia', 'HRV', 191),
('HT', 'HAITI', 'Haiti', 'HTI', 332),
('HU', 'HUNGARY', 'Hungary', 'HUN', 348),
('ID', 'INDONESIA', 'Indonesia', 'IDN', 360),
('IE', 'IRELAND', 'Ireland', 'IRL', 372),
('IL', 'ISRAEL', 'Israel', 'ISR', 376),
('IN', 'INDIA', 'India', 'IND', 356),
('IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL),
('IQ', 'IRAQ', 'Iraq', 'IRQ', 368),
('IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364),
('IS', 'ICELAND', 'Iceland', 'ISL', 352),
('IT', 'ITALY', 'Italy', 'ITA', 380),
('JM', 'JAMAICA', 'Jamaica', 'JAM', 388),
('JO', 'JORDAN', 'Jordan', 'JOR', 400),
('JP', 'JAPAN', 'Japan', 'JPN', 392),
('KE', 'KENYA', 'Kenya', 'KEN', 404),
('KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417),
('KH', 'CAMBODIA', 'Cambodia', 'KHM', 116),
('KI', 'KIRIBATI', 'Kiribati', 'KIR', 296),
('KM', 'COMOROS', 'Comoros', 'COM', 174),
('KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659),
('KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'Korea, Democratic People''s Republic of', 'PRK', 408),
('KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410),
('KW', 'KUWAIT', 'Kuwait', 'KWT', 414),
('KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136),
('KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398),
('LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Lao People''s Democratic Republic', 'LAO', 418),
('LB', 'LEBANON', 'Lebanon', 'LBN', 422),
('LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662),
('LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438),
('LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144),
('LR', 'LIBERIA', 'Liberia', 'LBR', 430),
('LS', 'LESOTHO', 'Lesotho', 'LSO', 426),
('LT', 'LITHUANIA', 'Lithuania', 'LTU', 440),
('LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442),
('LV', 'LATVIA', 'Latvia', 'LVA', 428),
('LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434),
('MA', 'MOROCCO', 'Morocco', 'MAR', 504),
('MC', 'MONACO', 'Monaco', 'MCO', 492),
('MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498),
('MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450),
('MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584),
('MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807),
('ML', 'MALI', 'Mali', 'MLI', 466),
('MM', 'MYANMAR', 'Myanmar', 'MMR', 104),
('MN', 'MONGOLIA', 'Mongolia', 'MNG', 496),
('MO', 'MACAO', 'Macao', 'MAC', 446),
('MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580),
('MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474),
('MR', 'MAURITANIA', 'Mauritania', 'MRT', 478),
('MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500),
('MT', 'MALTA', 'Malta', 'MLT', 470),
('MU', 'MAURITIUS', 'Mauritius', 'MUS', 480),
('MV', 'MALDIVES', 'Maldives', 'MDV', 462),
('MW', 'MALAWI', 'Malawi', 'MWI', 454),
('MX', 'MEXICO', 'Mexico', 'MEX', 484),
('MY', 'MALAYSIA', 'Malaysia', 'MYS', 458),
('MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508),
('NA', 'NAMIBIA', 'Namibia', 'NAM', 516),
('NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540),
('NE', 'NIGER', 'Niger', 'NER', 562),
('NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574),
('NG', 'NIGERIA', 'Nigeria', 'NGA', 566),
('NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558),
('NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528),
('NO', 'NORWAY', 'Norway', 'NOR', 578),
('NP', 'NEPAL', 'Nepal', 'NPL', 524),
('NR', 'NAURU', 'Nauru', 'NRU', 520),
('NU', 'NIUE', 'Niue', 'NIU', 570),
('NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554),
('OM', 'OMAN', 'Oman', 'OMN', 512),
('PA', 'PANAMA', 'Panama', 'PAN', 591),
('PE', 'PERU', 'Peru', 'PER', 604),
('PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258),
('PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598),
('PH', 'PHILIPPINES', 'Philippines', 'PHL', 608),
('PK', 'PAKISTAN', 'Pakistan', 'PAK', 586),
('PL', 'POLAND', 'Poland', 'POL', 616),
('PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666),
('PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612),
('PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630),
('PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL),
('PT', 'PORTUGAL', 'Portugal', 'PRT', 620),
('PW', 'PALAU', 'Palau', 'PLW', 585),
('PY', 'PARAGUAY', 'Paraguay', 'PRY', 600),
('QA', 'QATAR', 'Qatar', 'QAT', 634),
('RE', 'REUNION', 'Reunion', 'REU', 638),
('RO', 'ROMANIA', 'Romania', 'ROM', 642),
('RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643),
('RW', 'RWANDA', 'Rwanda', 'RWA', 646),
('SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682),
('SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90),
('SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690),
('SD', 'SUDAN', 'Sudan', 'SDN', 736),
('SE', 'SWEDEN', 'Sweden', 'SWE', 752),
('SG', 'SINGAPORE', 'Singapore', 'SGP', 702),
('SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654),
('SI', 'SLOVENIA', 'Slovenia', 'SVN', 705),
('SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744),
('SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703),
('SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694),
('SM', 'SAN MARINO', 'San Marino', 'SMR', 674),
('SN', 'SENEGAL', 'Senegal', 'SEN', 686),
('SO', 'SOMALIA', 'Somalia', 'SOM', 706),
('SR', 'SURINAME', 'Suriname', 'SUR', 740),
('ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678),
('SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222),
('SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760),
('SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748),
('TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796),
('TD', 'CHAD', 'Chad', 'TCD', 148),
('TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL),
('TG', 'TOGO', 'Togo', 'TGO', 768),
('TH', 'THAILAND', 'Thailand', 'THA', 764),
('TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762),
('TK', 'TOKELAU', 'Tokelau', 'TKL', 772),
('TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL),
('TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795),
('TN', 'TUNISIA', 'Tunisia', 'TUN', 788),
('TO', 'TONGA', 'Tonga', 'TON', 776),
('TR', 'TURKEY', 'Turkey', 'TUR', 792),
('TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780),
('TV', 'TUVALU', 'Tuvalu', 'TUV', 798),
('TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158),
('TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834),
('UA', 'UKRAINE', 'Ukraine', 'UKR', 804),
('UG', 'UGANDA', 'Uganda', 'UGA', 800),
('UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL),
('US', 'UNITED STATES', 'United States', 'USA', 840),
('UY', 'URUGUAY', 'Uruguay', 'URY', 858),
('UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860),
('VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336),
('VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670),
('VE', 'VENEZUELA', 'Venezuela', 'VEN', 862),
('VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92),
('VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850),
('VN', 'VIET NAM', 'Viet Nam', 'VNM', 704),
('VU', 'VANUATU', 'Vanuatu', 'VUT', 548),
('WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876),
('WS', 'SAMOA', 'Samoa', 'WSM', 882),
('YE', 'YEMEN', 'Yemen', 'YEM', 887),
('YT', 'MAYOTTE', 'Mayotte', NULL, NULL),
('ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710),
('ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894),
('ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716);

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `perms` varchar(255) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `catid`, `title`, `desc`, `perms`, `orderid`) VALUES
(1, 1, 'Site Announcements', 'Latest announcements about the site here.', 'a:4:{i:0;i:0;i:1;i:1;i:2;i:2;i:3;i:4;}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fp_settings`
--

CREATE TABLE IF NOT EXISTS `fp_settings` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `featured_video` varchar(500) NOT NULL,
  `facebook_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fp_settings`
--

INSERT INTO `fp_settings` (`id`, `featured_video`, `facebook_url`) VALUES
(1, 'http://www.youtube.com/embed/NDDfPxF3EFE', 'https://www.facebook.com/iratedesigns');

-- --------------------------------------------------------

--
-- Table structure for table `fp_slides`
--

CREATE TABLE IF NOT EXISTS `fp_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` varchar(500) NOT NULL,
  `image` varchar(255) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fp_slides`
--

INSERT INTO `fp_slides` (`id`, `title`, `desc`, `image`, `orderid`) VALUES
(1, 'Welcome to the Irate CMS', 'Welcome to Irate CMS!', '1384833364_56.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  `friendid` int(255) NOT NULL,
  `status` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` mediumtext NOT NULL,
  `active` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `galleryid` int(255) NOT NULL,
  `active` int(2) NOT NULL,
  `image` mediumtext NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `desc` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `image` mediumtext NOT NULL,
  `mime` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `userip` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `nav_config`
--

CREATE TABLE IF NOT EXISTS `nav_config` (
  `auto_detect_tournaments` int(11) NOT NULL,
  `auto_detect_platforms` int(11) NOT NULL,
  `auto_detect_teams` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nav_config`
--

INSERT INTO `nav_config` (`auto_detect_tournaments`, `auto_detect_platforms`, `auto_detect_teams`) VALUES
(1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nav_links`
--

CREATE TABLE IF NOT EXISTS `nav_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `href` varchar(500) NOT NULL,
  `loggedin` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nav_sections`
--

CREATE TABLE IF NOT EXISTS `nav_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `href` varchar(500) NOT NULL,
  `loggedin` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `nav_sections`
--

INSERT INTO `nav_sections` (`id`, `title`, `href`, `loggedin`, `orderid`) VALUES
(1, 'Forums', 'forums/', 0, 2),
(2, 'Blog', 'blog/', 0, 3),
(3, 'Galleries', 'galleries/', 0, 4),
(4, 'About Us', 'aboutus/', 0, 1),
(5, 'Videos', 'videos/', 0, 5),
(6, 'News', 'news/', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` longtext NOT NULL,
  `content` text NOT NULL,
  `authorid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `image`, `short_desc`, `content`, `authorid`, `date`) VALUES
(1, 'This is a test from the admin CPs', '', 'This is the short description for this news post. You can edit this from the admin panel along with any of the other information for this news post. Simply login to the admin panel, navigate to "Manage News" and edit the article of your choice.', 'asdf', 1, '2012-12-20 01:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `callname` varchar(255) NOT NULL,
  `template` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `comments` int(2) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `callname`, `template`, `content`, `comments`, `modified`) VALUES
(1, 'About Us', 'aboutus', 'sidebars', '<p>&nbsp;</p>\n<p>Irate CMS was built to become the foundation of all Irate Designs projects that deal with web development. We''ve spent many hours perfecting this script.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;</p>\n<p>&nbsp;</p>', 0, '2013-11-19 07:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `secid` int(11) NOT NULL,
  `perm` varchar(255) NOT NULL,
  `usergroups` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `secid`, `perm`, `usergroups`) VALUES
(1, 'Can Access Control Panel', 1, 'can_access_cp', 'a:4:{i:0;s:1:"2";i:1;i:3;i:2;i:4;i:3;i:5;}'),
(2, 'Can Administrate Settings', 1, 'can_admin_settings', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(3, 'Can Administrate FAQs', 1, 'can_admin_faq', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(4, 'Can Administrate Forums', 1, 'can_admin_forums', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(5, 'Can Administrate Usergroups', 1, 'can_admin_usergroups', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(6, 'Can Administrate Users', 1, 'can_admin_users', 'a:4:{i:0;s:1:"2";i:1;i:3;i:2;i:4;i:3;i:5;}'),
(7, 'Can Delete Threads', 2, 'can_delete_threads', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(8, 'Can Delete Replies', 2, 'can_delete_replies', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(9, 'Can Edit Threads', 2, 'can_edit_threads', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(10, 'Can Edit Replies', 2, 'can_edit_replies', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(11, 'Can Move Threads', 2, 'can_move_threads', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(12, 'Can Merge Threads', 2, 'can_merge_threads', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(16, 'Can Administrate Navigation', 1, 'can_admin_navigation', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(17, 'Can View Logs', 1, 'can_view_logs', 'a:3:{i:0;i:3;i:1;i:4;i:2;s:1:"2";}'),
(18, 'Can Administrate Frontpage', 1, 'can_admin_frontpage', 'a:3:{i:0;s:1:"2";i:1;i:3;i:2;i:4;}'),
(19, 'Can Sticky Thread', 2, 'can_sticky_thread', 'a:3:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:1:"3";}'),
(20, 'Can Administrate Pages', 1, 'can_admin_pages', 'a:2:{i:0;s:1:"2";i:1;s:1:"4";}'),
(21, 'Can Administrate Maintenance', 1, 'can_admin_maintenance', 'a:2:{i:0;s:1:"2";i:1;s:1:"4";}'),
(23, 'Can Administrate Permissions', 1, 'can_admin_permissions', 'a:2:{i:0;s:1:"2";i:1;s:1:"4";}'),
(24, 'Can View Tickets', 3, 'can_view_tickets', 'a:4:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:1:"3";i:3;i:5;}'),
(25, 'Can Resolve Tickets', 3, 'can_resolve_tickets', 'a:4:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:1:"3";i:3;i:5;}'),
(26, 'Can Delete Tickets', 3, 'can_delete_tickets', 'a:3:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:1:"3";}'),
(27, 'Can Administrate Ticket Categories', 3, 'can_admin_ticket_categories', 'a:3:{i:0;s:1:"2";i:1;s:1:"4";i:2;s:1:"3";}'),
(28, 'Can Administrate CP News', 4, 'can_admin_cpnews', 'a:3:{i:0;s:1:"2";i:1;s:1:"3";i:2;s:1:"4";}'),
(29, 'Can Administrate Site News', 1, 'can_admin_site_news', 'a:1:{i:0;s:1:"2";}'),
(30, 'Can Administrate Sidebars', 1, 'can_admin_sidebars', 'a:1:{i:0;s:1:"2";}'),
(31, 'Can Administrate Blogs', 1, 'can_admin_blogs', 'a:1:{i:0;s:1:"2";}'),
(32, 'Can Administrate Videos', 1, 'can_admin_videos', 'a:1:{i:0;s:1:"2";}'),
(33, 'Can Administrate Store', 5, 'can_admin_store', 'a:1:{i:0;s:1:"2";}'),
(34, 'Administrate Galleries', 1, 'can_admin_gallery', 'a:1:{i:0;s:1:"2";}'),
(35, 'Can Lock Threads', 2, 'can_lock_thread', 'a:1:{i:0;s:1:"2";}');

-- --------------------------------------------------------

--
-- Table structure for table `perm_sections`
--

CREATE TABLE IF NOT EXISTS `perm_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `perm_sections`
--

INSERT INTO `perm_sections` (`id`, `title`) VALUES
(1, 'Administration Permissions'),
(2, 'Forum Permissions'),
(3, 'Ticket Permissions'),
(4, 'Control Panel News'),
(5, 'Store Permissions');

-- --------------------------------------------------------

--
-- Table structure for table `privmsgs`
--

CREATE TABLE IF NOT EXISTS `privmsgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT 'parent',
  `parentid` int(11) NOT NULL,
  `sendid` int(11) NOT NULL,
  `recvid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_reply_date` varchar(255) NOT NULL,
  `sender_read` int(11) NOT NULL,
  `recv_read` int(11) NOT NULL,
  `sender_deleted` int(11) NOT NULL,
  `recv_deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE IF NOT EXISTS `replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` varchar(600) NOT NULL,
  `variable` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `options` text NOT NULL,
  `input_type` varchar(255) NOT NULL,
  `required` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `secid`, `title`, `desc`, `variable`, `value`, `options`, `input_type`, `required`, `orderid`) VALUES
(1, 1, 'Site Title', '', 'site_title', 'Irate CMS', '', 'text', 1, 1),
(2, 1, 'Site URL', '', 'site_url', '%SITE_URL%', '', 'text', 1, 2),
(3, 1, 'Static Directory', '', 'static_dir', 'static/', '', 'text', 1, 4),
(4, 1, 'Admin Directory', '', 'admin_dir', 'administration/', '', 'text', 1, 5),
(5, 1, 'Site Description', '', 'site_desc', 'This is where your Site Description will go.', '', 'text', 0, 6),
(6, 1, 'Site Keywords', '', 'site_keywords', 'Forums, Keywords, Go, Here', '', 'text', 0, 7),
(7, 1, 'Site Footer', '', 'site_footer', 'Copyright  2012 <b>Irate Designs.</b>', '', 'text', 0, 9),
(8, 1, 'Site Theme', '', 'theme', 'default', 'default=>default', 'select', 1, 10),
(12, 2, 'Facebook', 'Use the full facebook URL', 'facebook', 'http://www.facebook.com/IrateDesigns', '', 'text', 0, 2),
(13, 2, 'Twitter Handle', '', 'twitter', 'Irate_Designs', '', 'text', 0, 3),
(14, 2, 'YouTube', 'Use the full YouTube URL', 'youtube', 'http://www.youtube.com/IrateDesigns', '', 'text', 0, 4),
(10, 2, 'Show Social Links', 'Shows/Hides the Social Network Buttons at the top of the site.', 'show_social_links', '1', 'Yes=>1,No=>0', 'radio', 0, 1),
(16, 3, 'Show News Ticker', 'Shows/Hides the News Ticker at the top of the page.', 'show_news_ticker', '1', 'Yes=>1,No=>0', 'radio', 0, 1),
(17, 3, 'Total News Items', '', 'ticker_items', '5', '0=>0,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,', 'select', 0, 2),
(20, 1, 'Clean URLs', 'Enable this if you have mod_rewrite enabled on your sever.', 'clean_urls', '1', 'Yes=>1,No=>0', 'radio', 1, 3),
(22, 5, 'Show Ads', 'Enable/Disable ads on your website.', 'show_ads', '0', 'Enable=>1,Disable=>0', 'radio', 0, 1),
(23, 5, 'Google Publisher ID', 'Found on the Google Adsense account settings page.', 'google_publisher_id', 'pub-3176403920753974', '', 'text', 0, 2),
(24, 6, 'Allow Facebook Comments', 'Enable/Disable facebook comments on news posts.', 'show_facebook_comments', '1', 'Enable=>1,Disable=>0', 'radio', 0, 1),
(25, 6, 'Facebook Application ID', 'Application ID is required for Facebook Comments.', 'facebook_app_id', '372933292797577', '', 'text', 0, 2),
(26, 1, 'Footer About Us', 'About Us at the bottom of the site.', 'footer_about_us', 'Irate Designs is a Graphic Design & Web Development company who provides professional work for gaming organizations, gaming teams, and businesses worldwide.', '', 'text', 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `settings_sections`
--

CREATE TABLE IF NOT EXISTS `settings_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `settings_sections`
--

INSERT INTO `settings_sections` (`id`, `title`) VALUES
(1, 'General Settings'),
(2, 'Social Network Settings'),
(3, 'News Ticker'),
(4, 'Administration Settings'),
(5, 'Ad Settings'),
(6, 'News Settings');

-- --------------------------------------------------------

--
-- Table structure for table `sidebars`
--

CREATE TABLE IF NOT EXISTS `sidebars` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `enabled` int(2) NOT NULL,
  `orderid` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sidebars`
--

INSERT INTO `sidebars` (`id`, `title`, `content`, `enabled`, `orderid`) VALUES 
(2, 'Featured Video', '<p>&lt;iframe src="http://www.youtube.com/embed/h2-QpYrrup0" width="278" height="156" frameborder="0" allowfullscreen="allowfullscreen"&gt;&lt;/iframe></p>', 1, 1);


--
-- Table structure for table `threads`
--

CREATE TABLE IF NOT EXISTS `threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `locked` int(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `userid` varchar(255) NOT NULL,
  `views` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latest_reply_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `userip` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closed` varchar(255) NOT NULL,
  `catid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `proof` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `ticket_categories`
--

CREATE TABLE IF NOT EXISTS `ticket_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `ticket_categories`
--

INSERT INTO `ticket_categories` (`id`, `title`, `orderid`) VALUES
(1, 'Account: Can''t change my Password', 0),
(2, 'Account: Can''t update my Info', 2),
(3, 'Match: Score Dispute', 9),
(4, 'Match: Opponent Cheated', 10),
(5, 'Site: Other', 13),
(6, 'Account: Username Change', 3),
(7, 'Account: Contact Information', 1),
(9, 'Credits: Purchase Issues', 7),
(10, 'Forums: General Issue', 8),
(11, 'Tournament: Lag Issues', 12),
(12, 'Tournament: Opponent No Show', 11),
(13, 'Gamertag: Can''t Add Gamertag', 5),
(14, 'Gamertag: Can''t Update Gamertag', 6),
(15, 'Gamertag: My Gamertag Won''t Validate', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comments`
--

CREATE TABLE IF NOT EXISTS `ticket_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE IF NOT EXISTS `timezones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timezoneName` varchar(50) NOT NULL,
  `timezoneValue` time DEFAULT NULL,
  `timezoneMinusPlus` varchar(1) DEFAULT NULL,
  `timezoneMinuteValue` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `timezoneName`, `timezoneValue`, `timezoneMinusPlus`, `timezoneMinuteValue`) VALUES
(1, 'Eniwetok, Kwajalein', '12:00:00', '-', 720),
(2, 'Midway Island, Samoa', '11:00:00', '-', 660),
(3, 'Hawaii', '10:00:00', '-', 600),
(4, 'Alaska', '09:00:00', '-', 540),
(5, 'Pacific Time (US &amp; Canada)', '08:00:00', '-', 480),
(6, 'Mountain Time (US &amp; Canada)', '07:00:00', '-', 420),
(7, 'Central Time (US &amp; Canada), Mexico City', '06:00:00', '-', 360),
(8, 'Eastern Time (US &amp; Canada), Bogota, Lima', '05:00:00', '-', 300),
(9, 'Atlantic Time (Canada), Caracas, La Paz', '04:00:00', '-', 240),
(10, 'Newfoundland', '03:30:00', '-', 210),
(11, 'Brazil, Buenos Aires, Georgetown', '03:00:00', '-', 180),
(12, 'Mid-Atlantic', '02:00:00', '-', 120),
(13, 'Azores, Cape Verde Islands', '01:00:00', '-', 60),
(14, 'Western Europe Time, London, Lisbon, Casablanca', '00:00:00', '+', 0),
(15, 'Brussels, Copenhagen, Madrid, Paris', '01:00:00', '+', 60),
(16, 'Kaliningrad, South Africa, Istanbul, Athens', '02:00:00', '+', 120),
(17, 'Baghdad, Riyadh, Moscow, St. Petersburg', '03:00:00', '+', 180),
(18, 'Tehran', '03:30:00', '+', 210),
(19, 'Abu Dhabi, Muscat, Baku, Tbilisi', '04:00:00', '+', 240),
(20, 'Kabul', '04:30:00', '+', 270),
(21, 'Ekaterinburg, Islamabad, Karachi, Tashkent', '05:00:00', '+', 300),
(22, 'Bombay, Calcutta, Madras, New Delhi', '05:30:00', '+', 330),
(23, 'Kathmandu', '05:45:00', '+', 345),
(24, 'Almaty, Dhaka, Colombo', '06:00:00', '+', 360),
(25, 'Bangkok, Hanoi, Jakarta', '07:00:00', '+', 420),
(26, 'Beijing, Perth, Singapore, Hong Kong', '08:00:00', '+', 480),
(27, 'Tokyo, Seoul, Osaka, Sapporo, Yakutsk', '09:00:00', '+', 540),
(28, 'Adelaide, Darwin', '09:30:00', '+', 570),
(29, 'Eastern Australia, Guam, Vladivostok', '10:00:00', '+', 600),
(30, 'Magadan, Solomon Islands, New Caledonia', '11:00:00', '+', 660),
(31, 'Auckland, Wellington, Fiji, Kamchatka', '12:00:00', '+', 720),
(32, 'Chatham Islands', '12:45:00', '+', 765),
(33, 'New Zelanad Daylight Time, Tonga', '13:00:00', '+', 780);

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE IF NOT EXISTS `usergroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#FFFFFF',
  `static` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `usergroups`
--

INSERT INTO `usergroups` (`id`, `title`, `color`, `static`, `orderid`) VALUES
(0, 'Guest', '#FFFFFF', 1, 5),
(1, 'User', '#FFFFFF', 1, 4),
(2, 'Site Administrator', '#FF0000', 1, 0),
(4, 'Moderator', '#079500', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `groupid` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `timezone` varchar(11) NOT NULL,
  `dst` int(11) NOT NULL,
  `bio` longtext NOT NULL,
  `recieve_email` int(11) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `youtube` varchar(25) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `userip` varchar(255) NOT NULL,
  `suspended` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `credits` int(255) NOT NULL,
  `exp` int(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `groupid`, `avatar`, `location`, `timezone`, `dst`, `bio`, `recieve_email`, `signature`, `youtube`, `twitter`, `facebook`, `skype`, `userip`, `suspended`, `created`, `credits`, `exp`, `salt`) VALUES
(1, 'administrator', '7c5cbb4c8461f83870f138dc7c97bbda', 'admin@site.com', 2, '', 'Somewhere, USA', '8', 1, 'Site Administrator', 1, '', '', '', '', '', '76.177.165.223', 0, '2012-12-08 05:37:17', 1200, 2500, '12345678');

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `source` longtext NOT NULL,
  `authorid` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

