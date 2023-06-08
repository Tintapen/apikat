CREATE TABLE IF NOT EXISTS `tb_tokens` (  
    `id` int(11) NOT NULL AUTO_INCREMENT,  
    `token` varchar(255) NOT NULL,  
    `tb_user_id` int(10) NOT NULL,  
    `created` date NOT NULL,  
    PRIMARY KEY (`id`)  
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;