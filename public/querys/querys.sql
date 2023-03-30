/*CREATE TABLE `sislo_usuarios` (
  `sislo_usuarios_id` int unsigned NOT NULL AUTO_INCREMENT,
  `sislo_login` varchar(99) NOT NULL,
  `sislo_id_loterica` varchar(10) NOT NULL,
  `sislo_nome` varchar(145) NOT NULL,
  `sislo_pass` varchar(255) NOT NULL,
  `sislo_email` varchar(104) NOT NULL,
  `sislo_status` int NOT NULL,
  `sislo_data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`sislo_usuarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


CREATE TABLE `sislo_loterica` (
  `idsislo_loterica` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `nome_fantasia` varchar(145) NOT NULL,
  `razao_social` varchar(145) NOT NULL,
  `cnpj` varchar(15) NOT NULL,
  `logradouro` varchar(145) NOT NULL,
  `numero` varchar(15) NOT NULL,
  `complemento` varchar(145) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `bairro` varchar(145) NOT NULL,
  `cidade` varchar(145) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `tel1` varchar(13) NOT NULL,
  `tel2` varchar(13) NOT NULL,
  `tel3` varchar(13) NOT NULL,
  `whatsapp` varchar(13) NOT NULL,
  `agencia_cc` varchar(4) NOT NULL,
  `conta_corrente` varchar(45) NOT NULL,
  `cc_prestacao` varchar(45) NOT NULL,
  `tel_agencia` varchar(13) NOT NULL,
  `proprietario_user` varchar(95) NOT NULL,
  `proprietario_pass` varchar(45) NOT NULL,
  `expresso_login` varchar(75) NOT NULL,
  `expresso_pass` varchar(45) NOT NULL,
  `caixaaqui_cod` varchar(45) NOT NULL,
  `caixaaqui_codlot` varchar(45) NOT NULL,
  `caixaaqui_pass` varchar(45) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_loterica`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `sislo_tfl` (
  `idsislo_tfl` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `terminal` varchar(45) NOT NULL,
  `serie` varchar(45) NOT NULL,
  `caixa_numero` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_tfl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `sislo_sangria` (
  `idsislo_sangria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `data_registro` datetime NOT NULL,
  `data_coleta` datetime NOT NULL,
  `caixa_operador` int(11) NOT NULL,
  `idsislo_tfl` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `num_controle` varchar(45) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_sangria`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=latin1;

CREATE TABLE `sislo_contas_pagar` (
  `idsislo_contas_pagar` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `id_sislo_fornecedores` int(11) NOT NULL,
  `vencimento` datetime NOT NULL,
  `valor_pagar` decimal(10,2) NOT NULL,
  `descontos` decimal(10,2) NOT NULL,
  `juros` decimal(10,2) NOT NULL,
  `valor_pago` decimal(10,2) NOT NULL,
  `data_pagamento` datetime NOT NULL,
  `status_pagamento` int(11) NOT NULL,
  `tipo_pagamento` int(11) DEFAULT NULL,
  `forma_pagamento` int(11) DEFAULT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`idsislo_contas_pagar`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

CREATE TABLE `sislo_fornecedores` (
  `idsislo_fornecedores` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_loterico` varchar(10) NOT NULL,
  `nome` varchar(145) NOT NULL,
  `cnpj` varchar(16) NOT NULL,
  `contato` varchar(99) NOT NULL,
  `tel` varchar(45) NOT NULL,
  `whats` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` varchar(45) NOT NULL,
  PRIMARY KEY (`idsislo_fornecedores`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
*/
#select * from sislo_usuarios;
#select * from sislo_loterica;
#select * from sislo_tfl;
#SELECT * FROM sislo_fornecedores;


'cod_loterico'//
'genero'//
'nome'//
'nascimento'//
'local_nascimento'//
'id_escolaridade'//
'id_estado_civil'//
'id_cor'//
'nome_mae'//
'nome_pai'//
'endereco'//
'numero'//
'complemento'//
'cep'//
'bairro'//
'cidade'//
'uf'//
'tel1'//
'tel2'//
'tel3'//
'email'//
'identidade'//
'orgao_emissor'//
'identidade_emissao'//
'pis'//
'ctps'//
'serie'//
'ctps_emissao'//
'cpf'//
'titulo_eleitor'//
'zona'//
'secao'//
'cnh'//
'cnh_emissao'//
'nome_conjuge'//
'nascimento_conjuge'//
'cpf_conjuge'//
'nome_filho1'//
'cpf_filho1'//
'nascimento_filho1'//
'nome_filho2'//
'cpf_filho2'//
'nascimento_filho2'//
'nome_filho3'//
'cpf_filho3'//
'nascimento_filho3'//
'nome_filho4'//
'cpf_filho4'//
'nascimento_filho4'//
'optante_VT'//
'linha1'//
'valor_linha1'//
'linha2'//
'valor_linha2'//
'linha3'//
'valor_linha3'//
'reemprego'//
'id_cargo'//
'admissao'//
'data_demissao'//
'id_motivo_demissao'//
'salario'//
'adicional'//
'insalubridade'//
'insalubridade_percent'//
'entrada'//
'almoco'//
'volta_almoco'//
'saida'//
'id_contrato_experiencia'//
'status'//
'data_ultima_alteracao'//