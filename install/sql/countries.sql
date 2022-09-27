# noinspection SqlNoDataSourceInspectionForFile

SET NAMES utf8mb4;

TRUNCATE `rex_flexshop_country`;
INSERT INTO `rex_flexshop_country` (`id`, `name`, `code`)
VALUES (1, 'Afghanistan', 'AF'),
       (2, 'Ägypten', 'EG'),
       (3, 'Aland', 'AX'),
       (4, 'Albanien', 'AL'),
       (5, 'Algerien', 'DZ'),
       (6, 'Amerikanisch-Samoa', 'AS'),
       (7, 'Amerikanische Jungferninseln', 'VI'),
       (8, 'Andorra', 'AD'),
       (9, 'Angola', 'AO'),
       (10, 'Anguilla', 'AI'),
       (11, 'Antarktis', 'AQ'),
       (12, 'Antigua und Barbuda', 'AG'),
       (13, 'Äquatorialguinea', 'GQ'),
       (14, 'Argentinien', 'AR'),
       (15, 'Armenien', 'AM'),
       (16, 'Aruba', 'AW'),
       (17, 'Ascension', 'AC'),
       (18, 'Aserbaidschan', 'AZ'),
       (19, 'Äthiopien', 'ET'),
       (20, 'Australien', 'AU'),
       (21, 'Bahamas', 'BS'),
       (22, 'Bahrain', 'BH'),
       (23, 'Bangladesch', 'BD'),
       (24, 'Barbados', 'BB'),
       (25, 'Belgien', 'BE'),
       (26, 'Belize', 'BZ'),
       (27, 'Benin', 'BJ'),
       (28, 'Bermuda', 'BM'),
       (29, 'Bhutan', 'BT'),
       (30, 'Bolivien', 'BO'),
       (31, 'Bosnien und Herzegowina', 'BA'),
       (32, 'Botswana', 'BW'),
       (33, 'Bouvetinsel', 'BV'),
       (34, 'Brasilien', 'BR'),
       (35, 'Britische Jungferninseln', 'VG'),
       (36, 'Britisches Territorium im Indischen Ozean', 'IO'),
       (37, 'Brunei', 'BN'),
       (38, 'Bulgarien', 'BG'),
       (39, 'Burkina Faso', 'BF'),
       (40, 'Burundi', 'BI'),
       (41, 'Chile', 'CL'),
       (42, 'China, Volksrepublik', 'CN'),
       (43, 'Cookinseln', 'CK'),
       (44, 'Costa Rica', 'CR'),
       (45, 'Republik Côte d’Ivoire', 'CI'),
       (46, 'Dänemark', 'DK'),
       (47, 'Deutschland', 'DE'),
       (48, 'St. Helena und Nebengebiete', 'SH'),
       (49, 'Diego Garcia', 'DG'),
       (50, 'Dominica', 'DM'),
       (51, 'Dominikanische Republik', 'DO'),
       (52, 'Dschibuti', 'DJ'),
       (53, 'Ecuador', 'EC'),
       (54, 'El Salvador', 'SV'),
       (55, 'Eritrea', 'ER'),
       (56, 'Estland', 'EE'),
       (58, 'Falklandinseln', 'FK'),
       (59, 'Färöer', 'FO'),
       (60, 'Fidschi', 'FJ'),
       (61, 'Finnland', 'FI'),
       (62, 'Frankreich', 'FR'),
       (63, 'Französisch-Guayana', 'GF'),
       (64, 'Französisch-Polynesien', 'PF'),
       (65, 'Französische Süd- und Antarktisgebiete', 'TF'),
       (66, 'Gabun', 'GA'),
       (67, 'Gambia', 'GM'),
       (68, 'Georgien', 'GE'),
       (69, 'Ghana', 'GH'),
       (70, 'Gibraltar', 'GI'),
       (71, 'Grenada', 'GD'),
       (72, 'Griechenland', 'GR'),
       (73, 'Grönland', 'GL'),
       (74, 'Guadeloupe', 'GP'),
       (75, 'Guam', 'GU'),
       (76, 'Guatemala', 'GT'),
       (77, 'Guernsey', 'GG'),
       (78, 'Guinea', 'GN'),
       (79, 'Guinea-Bissau', 'GW'),
       (80, 'Guyana', 'GY'),
       (81, 'Haiti', 'HT'),
       (82, 'Heard und McDonaldinseln', 'HM'),
       (83, 'Honduras', 'HN'),
       (84, 'Hongkong', 'HK'),
       (85, 'Indien', 'IN'),
       (86, 'Indonesien', 'ID'),
       (87, 'Isle of Man', 'IM'),
       (88, 'Irak', 'IQ'),
       (89, 'Iran', 'IR'),
       (90, 'Irland', 'IE'),
       (91, 'Island', 'IS'),
       (92, 'Israel', 'IL'),
       (93, 'Italien', 'IT'),
       (94, 'Jamaika', 'JM'),
       (95, 'Japan', 'JP'),
       (96, 'Jemen', 'YE'),
       (97, 'Jersey', 'JE'),
       (98, 'Jordanien', 'JO'),
       (99, 'Kaimaninseln', 'KY'),
       (100, 'Kambodscha', 'KH'),
       (101, 'Kamerun', 'CM'),
       (102, 'Kanada', 'CA'),
       (103, 'Kanarische Inseln', 'IC'),
       (104, 'Kap Verde', 'CV'),
       (105, 'Kasachstan', 'KZ'),
       (106, 'Katar', 'QA'),
       (107, 'Kenia', 'KE'),
       (108, 'Kirgisistan', 'KG'),
       (109, 'Kiribati', 'KI'),
       (110, 'Kokosinseln', 'CC'),
       (111, 'Kolumbien', 'CO'),
       (112, 'Komoren', 'KM'),
       (113, 'Kongo, Demokratische Republik', 'CD'),
       (114, 'Republik Kongo', 'CG'),
       (115, 'Nordkorea', 'KP'),
       (116, 'Südkorea', 'KR'),
       (117, 'Kroatien', 'HR'),
       (118, 'Kuba', 'CU'),
       (119, 'Kuwait', 'KW'),
       (120, 'Laos', 'LA'),
       (121, 'Lesotho', 'LS'),
       (122, 'Lettland', 'LV'),
       (123, 'Libanon', 'LB'),
       (124, 'Liberia, Republik', 'LR'),
       (125, 'Libyen', 'LY'),
       (126, 'Liechtenstein', 'LI'),
       (127, 'Litauen', 'LT'),
       (128, 'Luxemburg', 'LU'),
       (129, 'Macao', 'MO'),
       (130, 'Madagaskar', 'MG'),
       (131, 'Malawi', 'MW'),
       (132, 'Malaysia', 'MY'),
       (133, 'Malediven', 'MV'),
       (134, 'Mali, Republik', 'ML'),
       (135, 'Malta', 'MT'),
       (136, 'Marokko', 'MA'),
       (137, 'Marshallinseln', 'MH'),
       (138, 'Martinique', 'MQ'),
       (139, 'Mauretanien', 'MR'),
       (140, 'Mauritius', 'MU'),
       (141, 'Mayotte', 'YT'),
       (142, 'Mazedonien', 'MK'),
       (143, 'Mexiko', 'MX'),
       (144, 'Mikronesien', 'FM'),
       (145, 'Moldawien', 'MD'),
       (146, 'Monaco', 'MC'),
       (147, 'Mongolei', 'MN'),
       (148, 'Montserrat', 'MS'),
       (149, 'Mosambik', 'MZ'),
       (150, 'Myanmar', 'MM'),
       (151, 'Namibia', 'NA'),
       (152, 'Nauru', 'NR'),
       (153, 'Nepal', 'NP'),
       (154, 'Neukaledonien', 'NC'),
       (155, 'Neuseeland', 'NZ'),
       (156, 'Neutrale Zone (Irak)', 'NT'),
       (157, 'Nicaragua', 'NI'),
       (158, 'Niederlande', 'NL'),
       (159, 'Niederländische Antillen', 'AN'),
       (160, 'Niger', 'NE'),
       (161, 'Nigeria', 'NG'),
       (162, 'Niue', 'NU'),
       (163, 'Nördliche Marianen', 'MP'),
       (164, 'Norfolkinsel', 'NF'),
       (165, 'Norwegen', 'NO'),
       (166, 'Oman', 'OM'),
       (167, 'Österreich', 'AT'),
       (168, 'Pakistan', 'PK'),
       (169, 'Palästinensische Autonomiegebiete', 'PS'),
       (170, 'Palau', 'PW'),
       (171, 'Panama', 'PA'),
       (172, 'Papua-Neuguinea', 'PG'),
       (173, 'Paraguay', 'PY'),
       (174, 'Peru', 'PE'),
       (175, 'Philippinen', 'PH'),
       (176, 'Pitcairninseln', 'PN'),
       (177, 'Polen', 'PL'),
       (178, 'Portugal', 'PT'),
       (179, 'Puerto Rico', 'PR'),
       (180, 'Réunion', 'RE'),
       (181, 'Ruanda', 'RW'),
       (182, 'Rumänien', 'RO'),
       (183, 'Russische Föderation', 'RU'),
       (184, 'Salomonen', 'SB'),
       (185, 'Sambia', 'ZM'),
       (186, 'Samoa', 'WS'),
       (187, 'San Marino', 'SM'),
       (188, 'São Tomé und Príncipe', 'ST'),
       (189, 'Saudi-Arabien', 'SA'),
       (190, 'Schweden', 'SE'),
       (191, 'Schweiz', 'CH'),
       (192, 'Senegal', 'SN'),
       (193, 'Serbien und Montenegro', 'CS'),
       (194, 'Seychellen', 'SC'),
       (195, 'Sierra Leone', 'SL'),
       (196, 'Simbabwe', 'ZW'),
       (197, 'Singapur', 'SG'),
       (198, 'Slowakei', 'SK'),
       (199, 'Slowenien', 'SI'),
       (200, 'Somalia, Demokratische Republik', 'SO'),
       (201, 'Spanien', 'ES'),
       (202, 'Sri Lanka', 'LK'),
       (203, 'St. Kitts und Nevis', 'KN'),
       (204, 'St. Lucia', 'LC'),
       (205, 'St. Pierre und Miquelon', 'PM'),
       (206, 'St. Vincent und die Grenadinen', 'VC'),
       (207, 'Südafrika', 'ZA'),
       (208, 'Sudan', 'SD'),
       (209, 'Südgeorgien und die Südlichen Sandwichinseln', 'GS'),
       (210, 'Suriname', 'SR'),
       (211, 'Svalbard und Jan Mayen', 'SJ'),
       (212, 'Swasiland', 'SZ'),
       (213, 'Syrien', 'SY'),
       (214, 'Tadschikistan', 'TJ'),
       (215, 'Taiwan', 'TW'),
       (216, 'Tansania', 'TZ'),
       (217, 'Thailand', 'TH'),
       (218, 'Osttimor', 'TL'),
       (219, 'Togo', 'TG'),
       (220, 'Tokelau', 'TK'),
       (221, 'Tonga', 'TO'),
       (222, 'Trinidad und Tobago', 'TT'),
       (223, 'Tristan da Cunha', 'TA'),
       (224, 'Tschad', 'TD'),
       (225, 'Tschechien', 'CZ'),
       (226, 'Tunesien', 'TN'),
       (227, 'Türkei', 'TR'),
       (228, 'Turkmenistan', 'TM'),
       (229, 'Turks- und Caicosinseln', 'TC'),
       (230, 'Tuvalu', 'TV'),
       (231, 'Uganda', 'UG'),
       (232, 'Ukraine', 'UA'),
       (233, 'Sowjetunion', 'SU'),
       (234, 'Uruguay', 'UY'),
       (235, 'Usbekistan', 'UZ'),
       (236, 'Vanuatu', 'VU'),
       (237, 'Vatikanstadt', 'VA'),
       (238, 'Venezuela', 'VE'),
       (239, 'Vereinigte Arabische Emirate', 'AE'),
       (240, 'Vereinigte Staaten', 'US'),
       (241, 'Vereinigtes Königreich', 'GB'),
       (242, 'Vietnam', 'VN'),
       (243, 'Wallis und Futuna', 'WF'),
       (244, 'Weihnachtsinsel', 'CX'),
       (245, 'Weißrussland', 'BY'),
       (246, 'Westsahara', 'EH'),
       (247, 'Zentralafrikanische Republik', 'CF'),
       (248, 'Zypern, Republik', 'CY'),
       (249, 'Ungarn', 'HU'),
       (250, 'Montenegro', 'ME'),
       (251, 'Serbien', 'RS');