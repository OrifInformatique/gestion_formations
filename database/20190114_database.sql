-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 15 jan. 2019 à 08:35
-- Version du serveur :  10.1.34-MariaDB
-- Version de PHP :  7.2.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données :  `gestion_formations`
--
CREATE DATABASE IF NOT EXISTS `gestion_formations` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gestion_formations`;

-- --------------------------------------------------------

--
-- Structure de la table `apprentices`
--

DROP TABLE IF EXISTS `apprentices`;
CREATE TABLE IF NOT EXISTS `apprentices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_birth` date NOT NULL,
  `fk_formation` int(11) NOT NULL,
  `fk_teacher` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `apprentices`
--

INSERT INTO `apprentices` (`id`, `firstname`, `last_name`, `date_birth`, `fk_formation`, `fk_teacher`, `fk_user`) VALUES
(3, 'Lim', 'Jancer', '2000-01-04', 0, 0, 0),
(4, 'Janc', 'Lime', '1999-09-01', 0, 0, 0),
(7, 'Fred', 'George', '2019-08-09', 0, 0, 0),
(8, 'Loar', 'firfer', '2008-05-11', 0, 0, 0),
(9, 'osdka', 'pwqle', '2020-10-10', 0, 0, 0),
(10, 'plsd', 'splad', '2020-02-20', 1, 2, 0),
(11, 'foai', 'pfiafaome', '2020-02-20', 0, 0, 0),
(12, 'saoif', 'sodfankg', '2020-02-20', 0, 0, 0),
(13, 'Lars', 'Sral', '1991-01-01', 2, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `apprentices_formations`
--

DROP TABLE IF EXISTS `apprentices_formations`;
CREATE TABLE IF NOT EXISTS `apprentices_formations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_apprentice` int(11) NOT NULL,
  `fk_formation` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('lmcm6s2rm3jsocg9d3ri96k47v928556', '::1', 1545120735, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132303733353b),
('g6lp0jv40rhksd67bh6i31clhnb8jimj', '::1', 1545121528, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132313532383b),
('h7ui9gvo79hd8sd81fmok3eciv01qsnp', '::1', 1545122077, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132323037373b),
('dl2ohionrroqcc6makorkjv708eht8h2', '::1', 1545123676, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132333637363b),
('l8j97a7n5vvrjjme2tnutqqr1801plh8', '::1', 1545122182, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132323138323b),
('7mag3hvqbg4f6mv3t1kvdqm8u3p424cp', '::1', 1545124015, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132343031353b),
('83pjn0pdd68aab86riiqjve3fg918l2j', '::1', 1545124456, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132343435363b),
('28ckrh4oeiso5khq7mof2049ldmq01h6', '::1', 1545124876, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132343837363b),
('6o3s8uecaj47b7co2fqmvk1ks0210gq8', '::1', 1545125444, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132353434343b),
('meiihv66l16dh8jhjndsurl5tv43lq74', '::1', 1545125757, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132353735373b),
('7o96b42tb0du328kcmc5vkj3dto8u4tp', '::1', 1545126953, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132363935333b),
('4p9n7kf5anladdv88h0m0lfkmnbp6r4j', '::1', 1545128186, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132383138363b),
('j11s90fj88a3rd9s0k4tbgp79e5k42bp', '::1', 1545128773, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132383737333b),
('mmrqjdu93qpm8q8t4004f8ilcpgauugn', '::1', 1545129074, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132393037343b),
('ctoe20abc5f107kghsf21hifgl4uhd60', '::1', 1545129424, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353132393432343b),
('tpmlq2luc6su5cuss2esuqtjmnrlnm1l', '::1', 1545130260, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133303236303b),
('ue7gk8ia5j04d0idu92eutu3au0k91l9', '::1', 1545130611, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133303631313b),
('l8i60jhh9bl97uruhbop58ragabv2fgu', '::1', 1545133501, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133333530313b),
('k2rvce170jidk3d5lqqe9i0hhnneiclt', '::1', 1545133811, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133333831313b),
('1bht0fnfmav0141rmvvm55tnqeokv44j', '::1', 1545134141, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133343134313b),
('t15g8bdoabbi1svn4mq2mnacl3i1pauq', '::1', 1545134452, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133343435323b),
('4u2tm97spj2dmb7am78avjf4hs4csvtf', '::1', 1545134854, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133343835343b),
('9e55a5oq44g5m5mff29a8voip3u0rsqf', '::1', 1545135158, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133353135383b),
('ttjocph2105708rh7ahpbqqus6pcg3du', '::1', 1545135667, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133353636373b),
('rc6u1d193g5ca5689hu8fl56ias0q9dg', '::1', 1545136502, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133363530323b),
('u86m7v5hbtntdtqgd6dp0aggj6on6pqo', '::1', 1545136811, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133363831313b),
('u9cfra0nt52ga1j7g1sg16tr4hcv4haq', '::1', 1545137216, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133373231363b),
('cr98r26lqqofc3fjl1g539s21rl0djph', '::1', 1545137559, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133373535393b),
('rrn31l2ju5k49l06q3a307qhq4jsb3rm', '::1', 1545138171, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133383137313b),
('vbln77242qnv25pjftgfd8trfa8u2nj0', '::1', 1545138475, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133383437353b),
('i9g487r5urqvkjhv38vkivtiu5jhvjmm', '::1', 1545139796, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353133393739363b),
('kch0bfcvuso2orrp4u98s6rmhvvqtthh', '::1', 1545141623, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353134313632333b),
('4k9s1ee9vmijufqtndb1056a9vq81nfi', '::1', 1545141932, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353134313933323b),
('4qohftt81cgmtj4iikoffpnvhks8m4ed', '::1', 1545144975, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353134343937353b),
('cqvklan6ipip6i7mmvuk1125e58nl3rl', '::1', 1545145547, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353134353534373b),
('157db3lactu4gbhsqtsolh6t3jfem2an', '::1', 1545145547, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534353134353534373b),
('25slmh5ucb8eassaqhdjplnm5j5upl1d', '127.0.0.1', 1546845179, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363834353137393b),
('qrvvmvoa0iq5s6tu8psea0s6l24agbsq', '::1', 1546845486, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363834353438363b),
('nq940nfekb3kvnak7i5jppbvvlcr0fsp', '::1', 1546846003, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363834363030333b),
('9bvtdq0jvb5tsaegg5eoob2bpasp83ok', '::1', 1546846345, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363834363334353b),
('m8r8kqaf9kkp0u190g9gsn0p8gvbf263', '::1', 1546846669, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363834363636393b),
('m62mndb560bn897t39j6qk22oogb2h03', '::1', 1546846972, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363834363937323b),
('bqupp5i8m08rs32pq398bu53fbd0gloh', '::1', 1546849019, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363834393031393b),
('dlutsudq1o2221l3jv9ebbl54322s82j', '::1', 1546854674, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363835343637343b),
('ltme6i67up34cccjr3oem8ptqdraraji', '::1', 1546856541, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363835363534313b),
('j0p2uv0deum83kognu2mcs90j72kvv6v', '::1', 1546857359, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363835373335393b),
('9jf8vvtosphul327h6j4kp55sbd9gm9r', '::1', 1546857703, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363835373730333b),
('nqrj73qsr0jhgp3dsec7j4fr9ip4pufi', '::1', 1546858008, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363835383030383b),
('6sp4rn4hct391645vdm58kmk223b41mi', '::1', 1546858382, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363835383338323b),
('h9l400nv42maknoape464kfgq8e1e3c0', '::1', 1546858706, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363835383730363b),
('94efos08jghsc8bnv0i52b1qamnj6fo9', '::1', 1546862297, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363836323239373b),
('proejhf7nenmad7j4ou0pqlv3subgk4q', '::1', 1546862906, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363836323930363b),
('s5e9gjiderhf9r01bc4sstv2gla8mme3', '::1', 1546863506, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363836333530363b),
('fb4udf5knr2ro7t3qafu47q970d18q1r', '::1', 1546864162, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363836343136323b),
('1qv617n6macpm7482255oraehg0seunc', '::1', 1546864586, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363836343538363b),
('rmn83q29qb0eu89dpbdadohkan8q7n5k', '::1', 1546867341, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363836373334313b),
('br2gffrhdaodlhr776jjoo8ecllevffl', '::1', 1546867800, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363836373830303b),
('roiklldmghhcaarko2uo1v6m3lkgq6ip', '::1', 1546868110, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363836383131303b),
('019kq06imdre8ct92rab1fsa8j3lrg6v', '::1', 1546868553, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363836383535333b),
('vof0i6u3ammt9hbsmlrom5jbtvbo0u2r', '::1', 1546870069, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363837303036393b),
('j819hpefs7rm07orar2f4sntirja77hu', '::1', 1546870853, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363837303835333b),
('04c2vst8p43su8qnuerhhcc5sgnl9i73', '::1', 1546873170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363837333137303b),
('d08rjde7sv5eicv94ccuvtkr5di9h3b8', '::1', 1546873490, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363837333439303b),
('41h98357pcoi73c27584g4b4p4v88rr0', '::1', 1546873820, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363837333832303b),
('231fbvpf4h3l4smbos9htj7ps67g1p8v', '::1', 1546873992, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363837333832303b),
('ncevq6tk9jm191h2j13bealucc2esl68', '::1', 1546930014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363933303031343b),
('2j2a3asnit8n9e3377v4seudk7tbmv02', '::1', 1546930895, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363933303839353b),
('sqaf347573u0dik1c1k77g0bttqlrs6m', '::1', 1546935469, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363933353436393b),
('evfvimn201bv4pqsbke0hi9cptbfo81u', '::1', 1546935915, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363933353931353b),
('ltfan6hji66pj6sfifiglpj2dcktnfpf', '::1', 1546936244, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363933363234343b),
('1d0j84mq8cnqhh38eauup6pul9b6poug', '::1', 1546936595, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363933363539353b),
('bl4op02j5h4i7muvb3mnc4k9cjms4dum', '::1', 1546938298, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363933383239383b),
('duvc007k4hgpmpidqgp5l7g544r5lk6l', '::1', 1546938693, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363933383639333b),
('jhenq2v2n9vhdkpr2boacqmv92ul00ni', '::1', 1546939156, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363933393135363b),
('jaouav7cqhg6junu4b89jp3o6dophh07', '::1', 1546939460, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363933393436303b),
('lasdmijcohbnvnep0dto526kb5hn22nv', '::1', 1546939768, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363933393736383b),
('tj5g0u7ma1ql1d0ae5b2voktfhoc2q2b', '::1', 1546940124, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934303132343b),
('nifvmev0mrbkrk7crt201dimsl2n83s5', '::1', 1546940460, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934303436303b),
('1a52o3iha4njm8eet2q1b8em94h2cqn4', '::1', 1546940921, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934303932313b),
('eh859hnqooj36g2vjntc1igpp4nreafd', '::1', 1546941343, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934313334333b),
('s66vhf2i09vqeuk3lhrkjpdd0v3n9coi', '::1', 1546942014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934323031343b),
('t79m06f4d2fub33i0gv7jqk1mpn3ljfp', '::1', 1546942362, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934323336323b),
('j9su5p9iu8aftoklnj0qap268e94ps4q', '::1', 1546942670, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934323637303b),
('ab7vfu8v1jq6v9khk05gnhpsq1ai0nld', '::1', 1546944402, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934343430323b),
('g2i0guqc1hbk0i0lpvnu0980bur04l13', '::1', 1546944982, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934343938323b),
('cij727hc79u3ng6jmi52bg4k3sokpbt8', '::1', 1546948039, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934383033393b),
('82h835fo4n1406cat07saffr3b14g52c', '::1', 1546948366, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934383336363b),
('9cspil42kgeqbn75uelrt5588ool0b4i', '::1', 1546948799, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934383739393b),
('2etd7f7fuqe8cejfv5t99cgujb3bhuup', '::1', 1546949202, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934393230323b),
('5hp1j865h9jaa810n2rnh08ocpae455e', '::1', 1546949993, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363934393939333b),
('glirhsictvns621b2fpmiui27kqj00ln', '::1', 1546950450, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363935303435303b),
('becc4jj21o6rs8a3lu60f9p23emmcf44', '::1', 1546950926, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363935303932363b),
('gh9648fhahonuf6eb6m3iodfg6m51i2t', '::1', 1546953944, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363935333934343b),
('mdchje5dbfg8qdt4ush32f5lth38jdak', '::1', 1546954337, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363935343333373b),
('a3jg7kcrafl028puah8go232tsti3umf', '::1', 1546954552, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534363935343333373b),
('57g70samdrjsf01jeetiodpru60p90rc', '::1', 1547188580, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373138383538303b),
('rk1f7aapnf13b6341m8oq23kfk02g80v', '::1', 1547190035, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373139303033353b),
('qlji7l80fbd6vqutcclhmnhbqul34js9', '::1', 1547191652, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373139313635323b),
('fbub60kjatcekq9ld912tud25130f8vj', '::1', 1547192006, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373139323030363b),
('fhu6l97k2tpbo4ce8nnj4qv4n4obugap', '::1', 1547192988, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373139323938383b),
('iuitf4t1dhitedet1tgtc1t7b88pu62b', '::1', 1547193351, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373139333335313b),
('mnc2btj014c8q463b7chgt4e278btpdf', '::1', 1547193972, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373139333937323b),
('n22nert4fa5juc5n6j2qdc1me6npskvp', '::1', 1547194293, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373139343239333b),
('4m35b0lci5dfu17jl1l17uh4q1dviflc', '::1', 1547194675, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373139343637353b),
('c8achscr4jugn8gkcfd16j02fuib4vce', '::1', 1547195081, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373139353038313b),
('cnk783ivjg9i13i88nokc9onb1vv7sk5', '::1', 1547195081, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373139353038313b),
('56cc73ms34shnuqk2sbei3jn60k0q1fh', '::1', 1547452242, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373435323234323b),
('lksisng9db8u5icurp7pvtf791dkt46a', '::1', 1547452406, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373435323234323b),
('ajd817slv3smd1um5scflrfca5ob1int', '::1', 1547536108, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373533363130383b),
('jorq2hi6ujmfn0q8mv0hsqmg2375ghb4', '::1', 1547536480, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373533363438303b),
('ri6opbqih3qp5eoc4vqk6lhqplh7khue', '::1', 1547536783, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373533363738333b),
('1kphn82lcns3nvn0jcdlrfounpc8i19i', '::1', 1547537164, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373533373136343b),
('endnfbi5oh4rhbeh7gcr12vn7e9tb5i6', '::1', 1547537526, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373533373532363b),
('m9rsq52ca6ju9mgie7f94r9mqilqgngb', '::1', 1547537692, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534373533373532363b);

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_formation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `name_formation`, `duration`) VALUES
(1, 'Stage', 3),
(2, 'Stage d\'observation', 6),
(3, 'Stage', 1);

-- --------------------------------------------------------

--
-- Structure de la table `formations_modules`
--

DROP TABLE IF EXISTS `formations_modules`;
CREATE TABLE IF NOT EXISTS `formations_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_formation` int(11) NOT NULL,
  `fk_module` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` decimal(2,1) NOT NULL,
  `fk_apprentice_formation` int(11) NOT NULL,
  `fk_module_subject` int(11) NOT NULL,
  `date_test` date NOT NULL,
  `date_inscription` date NOT NULL,
  `weight` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `modules_groups`
--

DROP TABLE IF EXISTS `modules_groups`;
CREATE TABLE IF NOT EXISTS `modules_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `eliminatory` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `fk_parent_group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `modules_groups`
--

INSERT INTO `modules_groups` (`id`, `name_group`, `weight`, `eliminatory`, `position`, `fk_parent_group`) VALUES
(1, 'Général', 100, 0, 1, 0),
(3, 'Vide', 100, 1, 1, 1),
(5, 'Générique', 50, 1, 2, 8),
(6, 'Fermeture', 50, 1, 2, 0),
(7, 'Ouverture', 50, 1, 2, 6),
(8, 'Lettre', 0, 1, 0, 1),
(9, 'Négatif', -1, 1, -1, 1),
(10, 'Plein', 999, 1, 999, 3);

-- --------------------------------------------------------

--
-- Structure de la table `modules_subjects`
--

DROP TABLE IF EXISTS `modules_subjects`;
CREATE TABLE IF NOT EXISTS `modules_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL COMMENT '0 pour les matières',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_group` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `modules_subjects`
--

INSERT INTO `modules_subjects` (`id`, `number`, `title`, `fk_group`, `description`) VALUES
(1, 5, 'Grrr', 1, 'rien');

-- --------------------------------------------------------

--
-- Structure de la table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `teachers`
--

INSERT INTO `teachers` (`id`, `firstname`, `last_name`, `fk_user`) VALUES
(1, 'Joe', 'Doe', 0),
(2, 'Jane', 'Dae', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user_type` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access_level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
