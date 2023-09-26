<?php

namespace Config;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->add('login', 'Login::index');
$routes->add('sislo_teste', 'SisloTesteController::index');
$routes->add('sair', 'Sislo::sair');
$routes->add('ajax_login', 'Login::ajax_login');
$routes->add('sislo', 'Sislo::index');
$routes->get('candidato_cadastro', 'Sislo_Candidato::include_candidate');
$routes->get('ver_vaga', 'Sislo_Candidato::ver_vaga');
$routes->get('empresa_cadastro', 'Sislo_LotericaEmpresa::include_empresa');
$routes->get('area_candidato', 'Sislo_Candidato::area_candidato');
$routes->get('vagas_aberto', 'Home::vagas_aberto');
$routes->post('ajax_list_site_vaga', 'Home::ajax_list_site_vaga');
$routes->get('empresa_area', 'Sislo_LotericaEmpresa::empresa_area');
$routes->get('area_candidato_logado', 'Sislo_Candidato::area_candidato_logado');
$routes->get('area_empresa_logado', 'Sislo_LotericaEmpresa::area_empresa_logado');
$routes->get('candidato_perfil', 'Sislo_Candidato::candidato_perfil');
$routes->get('candidato_vagas', 'Sislo_Candidato::candidato_vagas');
$routes->post('ajax_list_candidato_vaga', 'Sislo_Candidato::ajax_list_candidato_vaga');
$routes->post('ajax_list_vaga_aplicada', 'Sislo_VagasAplicadas::ajax_list_vaga_aplicada');
$routes->get('candidato_editar_perfil', 'Sislo_Candidato::candidato_editar_perfil');
$routes->post('salva_candidato', 'Sislo_Candidato::ajax_save_form');
$routes->get('candidato_vagas_aplicadas', 'Sislo_VagasAplicadas::index');
$routes->post('salva_empresa', 'Sislo_LotericaEmpresa::ajax_save_form');
$routes->post('aplicarvaga', 'Sislo_VagasAplicadas::ajax_save_form');
$routes->post('ajax_list_experiencia', 'Sislo_Candidato::ajax_list_experiencia');
$routes->post('ajax_login_candidato', 'Sislo_Candidato::ajax_login_candidato');
$routes->post('ajax_login_empresa', 'Sislo_LotericaEmpresa::ajax_login_empresa');
//inicio base crud ajax
$routes->add('sislo_usuarios', 'Sislo_Usuarios::index');
$routes->add('ajax_list_user', 'Sislo_Usuarios::ajax_list_user');
$routes->add('redireciona_usuario', 'Sislo_Usuarios::redireciona_usuario');
$routes->add('salva_usuarios', 'Sislo_Usuarios::ajax_save_form');
//inicio base crud ajax
$routes->get('candidato_experiencia', 'Sislo_CandidatoExperiencia::index');
$routes->post('ajax_list_candidato_experiencia', 'Sislo_CandidatoExperiencia::ajax_list_candidato_experiencia');
$routes->get('redireciona_experiencia', 'Sislo_CandidatoExperiencia::redireciona_experiencia');
$routes->post('salva_experiencia', 'Sislo_CandidatoExperiencia::ajax_save_form');
//fim base crud ajax
//inicio base crud ajax
$routes->add('tipos_convenio', 'Sislo_TiposConvenio::index');
$routes->add('ajax_list_tiposconvenio', 'Sislo_TiposConvenio::ajax_list_tiposconvenio');
$routes->add('redireciona_tiposconvenio', 'Sislo_TiposConvenio::redireciona_tiposconvenio');
$routes->add('salva_tipos_convenio', 'Sislo_TiposConvenio::ajax_save_form');
//fim base crud ajax
//inicio base crud ajaxsislo_jogos_cef
$routes->add('sislo_jogos_cef', 'SisloJogosCef::index');
$routes->add('ajax_list_sislo_jogos_cef', 'SisloJogosCef::ajax_list_jogos_cef');
$routes->add('redireciona_jogoscef', 'SisloJogosCef::redireciona_jogoscef');
$routes->add('salva_sislo_jogos_cef', 'SisloJogosCef::ajax_save_form');
//fim base crud ajax
//inicio base crud ajaxsislo_jogos_cef
$routes->add('chamados', 'Sislo_Chamados::index');
$routes->add('ajax_list_chamados', 'Sislo_Chamados::ajax_list_chamados');
$routes->add('redireciona_sislo_chamados', 'Sislo_Chamados::redireciona_sislo_chamados');
$routes->add('salva_sislo_chamados', 'Sislo_Chamados::ajax_save_form');
//fim base crud ajax
//inicio base crud ajaxsislo_horas
$routes->add('sislo_horas', 'Sislo_Horas::index');
$routes->add('ajax_list_horas', 'Sislo_Horas::ajax_list_horas');
$routes->add('salva_sislo_horas', 'Sislo_Horas::ajax_save_form');
$routes->add('sislo_ajuste_horas', 'Sislo_Horas::ajuste_horas_index');
$routes->add('ajax_list_ajuste_horas', 'Sislo_Horas::ajax_list_ajuste_horas');
$routes->add('redireciona_horas', 'Sislo_Horas::redireciona_horas');
$routes->add('sislo_ajustahora', 'Sislo_Horas::sislo_ajustahora');
//fim base crud ajax
//inicio base crud ajaxsislo_horas
$routes->add('sislo_fechamento_dia', 'Sislo_FechamentoCofre::index');
$routes->add('sislo_fechamento_cofre_execute', 'Sislo_FechamentoCofre::sislo_fechamento_cofre_execute');

$routes->add('sislo_fechamento_cofre', 'Sislo_FechamentoCofre::index');
$routes->add('sislo_fechamento_cofre_novo_execute', 'Sislo_FechamentoCofre::sislo_fechamento_cofre_novo_execute');
//fim base crud ajax
//inicio base crud ajaxsislo_horas
$routes->add('sislo_indicadores_caixas', 'Sislo_Indicadores_Caixas::index');
$routes->add('ajax_sislo_indicadores_caixa', 'Sislo_Indicadores_Caixas::ajax_sislo_indicadores_caixa');
//fim base crud ajax
//inicio base crud ajaxsislo_horas
$routes->add('sislo_situacao_geral', 'Sislo_Situacao_Geral::index');
$routes->add('ajax_sislo_situacao_geral', 'Sislo_Situacao_Geral::ajax_sislo_situacao_geral');
//fim base crud ajax
//inicio base crud megasemana
$routes->add('sislo_mega_semana', 'Sislo_MegaSemana::index');
$routes->add('ajax_list_megasemana', 'Sislo_MegaSemana::ajax_list_megasemana');
$routes->add('redireciona_megasemana', 'Sislo_MegaSemana::redireciona_megasemana');
$routes->add('salva_sislo_megasemana', 'Sislo_MegaSemana::ajax_save_form');
//fim base crud ajax
//inicio base crud megasemana
$routes->add('sislo_loteria_federal', 'Sislo_LoteriaFederal::index');
$routes->add('ajax_list_loteria_federal', 'Sislo_LoteriaFederal::ajax_list_loteria_federal');
$routes->add('redireciona_loteria_federal', 'Sislo_LoteriaFederal::redireciona_loteria_federal');
$routes->add('salva_sislo_loteria_federal', 'Sislo_LoteriaFederal::ajax_save_form');
//fim base crud ajax
//inicio base crud megasemana
$routes->add('sislo_metas_nao_jogos', 'Sislo_MetaNaoJogos::index');
$routes->add('ajax_list_meta_nao_jogos', 'Sislo_MetaNaoJogos::ajax_list_meta_nao_jogos');
$routes->add('redireciona_meta_nao_jogos', 'Sislo_MetaNaoJogos::redireciona_meta_nao_jogos');
$routes->add('salva_meta_nao_jogos', 'Sislo_MetaNaoJogos::ajax_save_form');
//fim base crud ajax
//inicio base crud megasemana
$routes->add('sislo_metas_jogos', 'Sislo_MetaJogos::index');
$routes->add('ajax_list_meta_jogos', 'Sislo_MetaJogos::ajax_list_meta_jogos');
$routes->add('redireciona_meta_jogos', 'Sislo_MetaJogos::redireciona_meta_jogos');
$routes->add('salva_meta_jogos', 'Sislo_MetaJogos::ajax_save_form');
//fim base crud ajax
//inicio base crud megasemana
$routes->add('sislo_decendio', 'Sislo_Decendio::index');
$routes->add('ajax_list_decendio', 'Sislo_Decendio::ajax_list_decendio');
$routes->add('redireciona_decendio', 'Sislo_Decendio::redireciona_decendio');
$routes->add('salva_sislo_decendio', 'Sislo_Decendio::ajax_save_form');
//fim base crud ajax
//inicio base crud megasena
$routes->add('sislo_mega_sena', 'Sislo_MegaSena::index');
$routes->add('ajax_list_megasena', 'Sislo_MegaSena::ajax_list_megasena');
$routes->add('redireciona_megasena', 'Sislo_MegaSena::redireciona_megasena');
$routes->add('salva_sislo_megasena', 'Sislo_MegaSena::ajax_save_form');
//inicio base crud duplasena
//inicio base crud megasena
$routes->add('sislo_milionaria', 'Sislo_Milionaria::index');
$routes->add('ajax_list_milionaria', 'Sislo_Milionaria::ajax_list_milionaria');
$routes->add('redireciona_milionaria', 'Sislo_Milionaria::redireciona_milionaria');
$routes->add('salva_sislo_milionaria', 'Sislo_Milionaria::ajax_save_form');
//inicio base crud duplasena
//inicio base crud megasena
$routes->add('sislo_timemania', 'Sislo_Timemania::index');
$routes->add('ajax_list_timemania', 'Sislo_Timemania::ajax_list_timemania');
$routes->add('redireciona_timemania', 'Sislo_Timemania::redireciona_timemania');
$routes->add('salva_sislo_timemania', 'Sislo_Timemania::ajax_save_form');
//inicio base crud duplasena
//inicio base crud megasena
$routes->add('sislo_diadesorte', 'Sislo_DiaDeSorte::index');
$routes->add('ajax_list_diadesorte', 'Sislo_DiaDeSorte::ajax_list_diadesorte');
$routes->add('redireciona_diadesorte', 'Sislo_DiaDeSorte::redireciona_diadesorte');
$routes->add('salva_sislo_diadesorte', 'Sislo_DiaDeSorte::ajax_save_form');
//inicio base crud duplasena
//inicio base crud megasena
$routes->add('sislo_lotofacil', 'Sislo_Lotofacil::index');
$routes->add('ajax_list_lotofacil', 'Sislo_Lotofacil::ajax_list_lotofacil');
$routes->add('redireciona_lotofacil', 'Sislo_Lotofacil::redireciona_lotofacil');
$routes->add('salva_sislo_lotofacil', 'Sislo_Lotofacil::ajax_save_form');
//inicio base crud duplasena
//inicio base crud megasena
$routes->add('sislo_lotomania', 'Sislo_Lotomania::index');
$routes->add('ajax_list_lotomania', 'Sislo_Lotomania::ajax_list_lotomania');
$routes->add('redireciona_lotomania', 'Sislo_Lotomania::redireciona_lotomania');
$routes->add('salva_sislo_lotomania', 'Sislo_Lotomania::ajax_save_form');
//inicio base crud duplasena
$routes->add('sislo_dupla_sena', 'Sislo_DuplaSena::index');
$routes->add('ajax_list_duplasena', 'Sislo_DuplaSena::ajax_list_duplasena');
$routes->add('redireciona_duplasena', 'Sislo_DuplaSena::redireciona_duplasena');
$routes->add('salva_sislo_duplasena', 'Sislo_DuplaSena::ajax_save_form');
//fim base crud ajax
//inicio base crud duplasena
$routes->add('sislo_quina', 'Sislo_Quina::index');
$routes->add('ajax_list_quina', 'Sislo_Quina::ajax_list_quina');
$routes->add('redireciona_quina', 'Sislo_Quina::redireciona_quina');
$routes->add('salva_sislo_quina', 'Sislo_Quina::ajax_save_form');
//fim base crud ajax
//inicio base crud duplasena
$routes->add('sislo_supersete', 'Sislo_SuperSete::index');
$routes->add('ajax_list_supersete', 'Sislo_SuperSete::ajax_list_supersete');
$routes->add('redireciona_supersete', 'Sislo_SuperSete::redireciona_supersete');
$routes->add('salva_sislo_supersete', 'Sislo_SuperSete::ajax_save_form');
//fim base crud ajax
//inicio lotericas
$routes->add('lotericas', 'Sislo_Loterica::index');
$routes->add('ajax_list_lotericas', 'Sislo_Loterica::ajax_list_lotericas');
$routes->add('redireciona_loterica', 'Sislo_Loterica::redireciona_loterica');
$routes->add('salva_lotericas', 'Sislo_Loterica::ajax_save_form');
//fim lotericas
//inicio tfl
$routes->add('sislo_tfl', 'Sislo_Tfl::index');
$routes->add('ajax_list_tfl', 'Sislo_Tfl::ajax_list_tfl');
$routes->add('redireciona_tfl', 'Sislo_Tfl::redireciona_tfl');
$routes->add('salva_tfl', 'Sislo_Tfl::ajax_save_form');
//fim tfl
//inicio tfl
$routes->get('sislo_item_estoque', 'Sislo_ItemEstoque::index');
$routes->post('ajax_list_item_estoque', 'Sislo_ItemEstoque::ajax_list_item_estoque');
$routes->get('redireciona_item_estoque', 'Sislo_ItemEstoque::redireciona_item_estoque');
$routes->post('salva_item_estoque', 'Sislo_ItemEstoque::ajax_save_form');
//fim tfl
//inicio tfl
$routes->get('sislo_movimentacao_estoque', 'Sislo_MovimentacaoEstoque::index');
$routes->post('ajax_list_movimentacao_estoque', 'Sislo_MovimentacaoEstoque::ajax_list_movimentacao_estoque');
$routes->get('redireciona_movimentacao_estoque', 'Sislo_MovimentacaoEstoque::redireciona_movimentacao_estoque');
$routes->post('salva_movimentacao_estoque', 'Sislo_MovimentacaoEstoque::ajax_save_form');
//fim tfl
//inicio tfl
$routes->add('sislo_item_estoque', 'Sislo_ItemEstoque::index');
$routes->add('ajax_list_item_estoque', 'Sislo_ItemEstoque::ajax_list_item_estoque');
$routes->add('redireciona_item_estoque', 'Sislo_ItemEstoque::redireciona_item_estoque');
$routes->add('salva_item_estoque', 'Sislo_ItemEstoque::ajax_save_form');
//fim tfl
//inicio tfl
$routes->add('sislo_estoque', 'Sislo_Estoque::index');
$routes->add('ajax_list_estoque', 'Sislo_Estoque::ajax_list_estoque');
$routes->add('redireciona_estoque', 'Sislo_Estoque::redireciona_estoque');
$routes->add('salva_estoque', 'Sislo_Estoque::ajax_save_form');
//fim tfl
//inicio tfl
$routes->add('sislo_movimentacao_estoque', 'Sislo_MovimentacaoEstoque::index');
$routes->add('ajax_list_movimentacao_estoque', 'Sislo_MovimentacaoEstoque::ajax_list_movimentacao_estoque');
$routes->add('redireciona_movimentacao_estoque', 'Sislo_MovimentacaoEstoque::redireciona_movimentacao_estoque');
$routes->add('salva_movimentacao_estoque', 'Sislo_MovimentacaoEstoque::ajax_save_form');
//fim tfl
//inicio carro forte
$routes->add('protege', 'Sislo_CarroForteProtege::index');
$routes->add('ajax_list_protege', 'Sislo_CarroForteProtege::ajax_list_protege');
$routes->add('redireciona_protege', 'Sislo_CarroForteProtege::redireciona_protege');
$routes->add('salva_protege', 'Sislo_CarroForteProtege::ajax_save_form');
$routes->add('protege_senha', 'Sislo_CarroForteProtege::protege_senha');
$routes->add('ajax_data_senha', 'Sislo_CarroForteProtege::ajax_data_senha');
//fim carro forte
//inicio fornecedores
$routes->add('sislo_fornecedores', 'Sislo_Fornecedores::index');
$routes->add('ajax_list_fornecedores', 'Sislo_Fornecedores::ajax_list_fornecedores');
$routes->add('redireciona_fornecedores', 'Sislo_Fornecedores::redireciona_fornecedores');
$routes->add('salva_fornecedores', 'Sislo_Fornecedores::ajax_save_form');
//fim 
//inicio contas pagar exemplo com busca
$routes->add('sislo_contas_pagar', 'Sislo_ContasPagar::index');
$routes->add('ajax_list_contas_pagar', 'Sislo_ContasPagar::ajax_list_contas_pagar');
$routes->add('redireciona_contas_pagar', 'Sislo_ContasPagar::redireciona_contas_pagar');
$routes->add('sislo_contaapagar', 'Sislo_ContasPagar::ajax_save_form');
//fim 
//inicio sangrias exemplo com busca
$routes->add('sislo_sangrias', 'SisloSangrias::index');
$routes->add('ajax_list_sangria', 'SisloSangrias::ajax_list_sangria');
$routes->add('redireciona_sangria', 'SisloSangrias::redireciona_sangria');
$routes->add('sislo_sangria', 'SisloSangrias::ajax_save_form');
//fim 
//inicio contas corrente exemplo com busca
$routes->add('sislo_contacorrente', 'Sislo_ContaCorrente::index');
$routes->add('ajax_list_contacorrente', 'Sislo_ContaCorrente::ajax_list_contacorrente');
//fim 
//inicio funcionarios
$routes->add('sislo_funcionarios', 'Sislo_Funcionarios::index');
$routes->add('ajax_list_funcionarios', 'Sislo_Funcionarios::ajax_list_funcionarios');
$routes->add('redireciona_funcionarios', 'Sislo_Funcionarios::redireciona_funcionarios');
$routes->add('salva_funcionarios', 'Sislo_Funcionarios::ajax_save_form');
//fim funcionarios
//inicio escolaridade
$routes->add('escolaridades', 'Sislo_Escolaridade::index');
$routes->add('ajax_list_escolaridade', 'Sislo_Escolaridade::ajax_list_escolaridade');
$routes->add('redireciona_escolaridade', 'Sislo_Escolaridade::redireciona_escolaridade');
$routes->add('salva_escolaridade', 'Sislo_Escolaridade::ajax_save_form');
//fim escolaridade
//inicio cor
$routes->add('cors', 'Sislo_Cor::index');
$routes->add('ajax_list_cor', 'Sislo_Cor::ajax_list_cor');
$routes->add('redireciona_cor', 'Sislo_Cor::redireciona_cor');
$routes->add('salva_cor', 'Sislo_Cor::ajax_save_form');
//fim cor
//inicio cor
$routes->add('sislo_timemania_time_coracao', 'Sislo_TimemaniaTimeCoracao::index');
$routes->add('ajax_list_timemania_time_coracao', 'Sislo_TimemaniaTimeCoracao::ajax_list_timemania_time_coracao');
$routes->add('redireciona_timemania_time_coracao', 'Sislo_TimemaniaTimeCoracao::redireciona_timemania_time_coracao');
$routes->add('salva_time_coracao', 'Sislo_TimemaniaTimeCoracao::ajax_save_form');
//fim cor
//inicio cargo
$routes->add('cargos', 'Sislo_Cargo::index');
$routes->add('ajax_list_cargo', 'Sislo_Cargo::ajax_list_cargo');
$routes->add('redireciona_cargo', 'Sislo_Cargo::redireciona_cargo');
$routes->add('salva_cargo', 'Sislo_Cargo::ajax_save_form');
//fim cargo
//inicio status das vagas
$routes->get('statusvaga', 'Sislo_StatusVagas::index');
$routes->post('ajax_list_vagas', 'Sislo_StatusVagas::ajax_list_vagas');
$routes->get('redireciona_vagas', 'Sislo_StatusVagas::redireciona_vagas');
$routes->post('salva_vaga', 'Sislo_StatusVagas::ajax_save_form');
//fim cargo
//inicio status das vagas candidatos
$routes->get('statusvagacandidato', 'Sislo_StatusVagasCandidato::index');
$routes->post('ajax_list_vagas_candidato', 'Sislo_StatusVagasCandidato::ajax_list_vagas_candidato');
$routes->get('redireciona_vagas_candidato', 'Sislo_StatusVagasCandidato::redireciona_vagas_candidato');
$routes->post('salva_status_vaga_candidato', 'Sislo_StatusVagasCandidato::ajax_save_form');
//fim cargo
//inicio status das vagas
$routes->get('empresa_vagas', 'Sislo_Vagas::index');
$routes->post('ajax_list_vaga', 'Sislo_Vagas::ajax_list_vaga');
$routes->get('redireciona_vaga', 'Sislo_Vagas::redireciona_vaga');
$routes->post('salva_vaga_empresa', 'Sislo_Vagas::ajax_save_form');
//fim cargo
//inicio tipo servico
$routes->add('sislo_tipo_servico', 'Sislo_Tipo_Servico::index');
$routes->add('ajax_list_servico', 'Sislo_Tipo_Servico::ajax_list_servico');
$routes->add('redireciona_servico', 'Sislo_Tipo_Servico::redireciona_servico');
$routes->add('salva_servico', 'Sislo_Tipo_Servico::ajax_save_form');
//fim tipo servico
//inicio motivo_demissao
$routes->add('motivos', 'Sislo_MotivoDemissao::index');
$routes->add('ajax_list_motivo_demissao', 'Sislo_MotivoDemissao::ajax_list_motivo_demissao');
$routes->add('redireciona_motivo_demissao', 'Sislo_MotivoDemissao::redireciona_motivo_demissao');
$routes->add('salva_motivo_demissao', 'Sislo_MotivoDemissao::ajax_save_form');
//fim motivo_demissao
//inicio estado civil
$routes->add('estadocivils', 'Sislo_EstadoCivil::index');
$routes->add('ajax_list_estadocivil', 'Sislo_EstadoCivil::ajax_list_estadocivil');
$routes->add('redireciona_estadocivil', 'Sislo_EstadoCivil::redireciona_estadocivil');
$routes->add('salva_estadocivil', 'Sislo_EstadoCivil::ajax_save_form');
//fim estado civil
//inicio fechamento caixa
$routes->add('sislo_fechamentos', 'Sislo_FechamentoCaixa::index');
$routes->add('ajax_list_fechamento_caixa', 'Sislo_FechamentoCaixa::ajax_list_fechamento_caixa');
$routes->add('redireciona_fechamento_caixa', 'Sislo_FechamentoCaixa::redireciona_fechamento_caixa');
$routes->add('sislo_fechamento_caixa', 'Sislo_FechamentoCaixa::ajax_save_form');
//fim fechamento caixa
//inicio cob diaria exemplo com busca
$routes->add('sislo_cob_diaria_conta_servico', 'Sislo_cob_diaria_conta_servico::index');
$routes->add('ajax_list_servicos', 'Sislo_cob_diaria_conta_servico::ajax_list_servicos');
$routes->add('redireciona_cob_servicos', 'Sislo_cob_diaria_conta_servico::redireciona_cob_servicos');
$routes->add('sislo_cob_diaria_conta_servico_form', 'Sislo_cob_diaria_conta_servico::ajax_save_form');
//fim 
//inicio servicos decendio
$routes->add('servicos_decendio', 'Sislo_ServicosDecendio::index');
$routes->add('ajax_list_servicos_dec', 'Sislo_ServicosDecendio::ajax_list_servicos_dec');
$routes->add('redireciona_dec_servicos', 'Sislo_ServicosDecendio::redireciona_dec_servicos');
$routes->add('ajax_save_form_dec_servicos', 'Sislo_ServicosDecendio::ajax_save_form');
//fim 
//inicio sislo_comissao_jogos com busca
$routes->add('sislo_comissao_jogos', 'Sislo_ComissaoJogos::index');
$routes->add('ajax_list_comissao', 'Sislo_ComissaoJogos::ajax_list_comissao');
$routes->add('redireciona_comissao_jogos', 'Sislo_ComissaoJogos::redireciona_comissao_jogos');
$routes->add('sislo_comissao_jogos_loterias_form', 'Sislo_ComissaoJogos::ajax_save_form');
$routes->add('sislo_comissao_jogos_situacao', 'Sislo_ComissaoJogos::sislo_comissao_jogos_situacao');
$routes->add('ajax_table_sislo_situacao_jogos', 'Sislo_ComissaoJogos::ajax_table_sislo_situacao_jogos');
$routes->add('sislo_comissao_jogos_situacao_geral', 'Sislo_ComissaoJogos::sislo_comissao_jogos_situacao_geral');
$routes->add('ajax_table_sislo_situacao_jogos_geral', 'Sislo_ComissaoJogos::ajax_table_sislo_situacao_jogos_geral');
//fim 
//inicio sislo_comissao_jogosbolao com busca
$routes->add('sislo_comissao_jogosboloes', 'Sislo_ComissaoBolao::index');
$routes->add('ajax_list_comissao_bolao', 'Sislo_ComissaoBolao::ajax_list_comissao_bolao');
$routes->add('redireciona_comissao_jogosbolao', 'Sislo_ComissaoBolao::redireciona_comissao_jogosbolao');
$routes->add('ajax_save_formbolao', 'Sislo_ComissaoBolao::ajax_save_form');
$routes->add('situacao_boloes', 'Sislo_ComissaoBolao::situacao_boloes');
$routes->add('ajax_table_sislo_situacao_boloes', 'Sislo_ComissaoBolao::ajax_table_sislo_situacao_boloes');
//fim 
//inicio premios pagos com busca
$routes->add('sislo_premios_pagos', 'Sislo_Premios_Pagos::index');
$routes->add('ajax_list_premios_pagos', 'Sislo_Premios_Pagos::ajax_list_premios_pagos');
$routes->add('redireciona_premios_pagos', 'Sislo_Premios_Pagos::redireciona_premios_pagos');
$routes->add('ajax_save_formpremio_pago', 'Sislo_Premios_Pagos::ajax_save_form');
//fim 
//inicio sislo_comissao_jogosibc com busca
$routes->add('sislo_comissao_ibc', 'Sislo_ComissaoIBC::index');
$routes->add('ajax_list_comissao_ibc', 'Sislo_ComissaoIBC::ajax_list_comissao_ibc');
$routes->add('redireciona_comissao_jogosibc', 'Sislo_ComissaoIBC::redireciona_comissao_jogosibc');
$routes->add('sislo_comissao_jogos_ibc_loterias_form', 'Sislo_ComissaoIBC::ajax_save_form');
//fim 
//inicio sislo_comissao_jogossilce com busca
$routes->add('sislo_comissao_silce', 'Sislo_ComissaoSilce::index');
$routes->add('ajax_list_comissao_silce', 'Sislo_ComissaoSilce::ajax_list_comissao_silce');
$routes->add('redireciona_comissao_jogossilce', 'Sislo_ComissaoSilce::redireciona_comissao_jogossilce');
$routes->add('sislo_comissao_jogos_silce_loterias_form', 'Sislo_ComissaoSilce::ajax_save_form');
//fim 
//inicio tipo pec
$routes->add('tipo_pec', 'Sislo_TipoPEC::index');
$routes->add('ajax_list', 'Sislo_TipoPEC::ajax_list');
$routes->add('redireciona', 'Sislo_TipoPEC::redireciona');
$routes->add('salva', 'Sislo_TipoPEC::ajax_save_form');
//fim tipo pec
//inicio tipo op pec
$routes->add('op_pec', 'Sislo_OPEntrada::index');
$routes->add('ajax_list_op', 'Sislo_OPEntrada::ajax_list');
$routes->add('redireciona_op', 'Sislo_OPEntrada::redireciona');
$routes->add('salva_op', 'Sislo_OPEntrada::ajax_save_form');
//fim tipo pec
//inicio tipo op pec
$routes->add('des_pec', 'Sislo_PECDestinacao::index');
$routes->add('ajax_list_des', 'Sislo_PECDestinacao::ajax_list');
$routes->add('redireciona_des', 'Sislo_PECDestinacao::redireciona');
$routes->add('salva_des', 'Sislo_PECDestinacao::ajax_save_form');
//fim tipo pec
//inicio identificador pec
$routes->add('ide_pec', 'Sislo_PECIdentificador::index');
$routes->add('ajax_list_ide', 'Sislo_PECIdentificador::ajax_list');
$routes->add('redireciona_ide', 'Sislo_PECIdentificador::redireciona');
$routes->add('salva_ide', 'Sislo_PECIdentificador::ajax_save_form');
//fim tipo pec
//inicio pec
$routes->add('sislo_pec', 'Sislo_PEC::index');
$routes->add('ajax_list_pec', 'Sislo_PEC::ajax_list');
$routes->add('redireciona_pec', 'Sislo_PEC::redireciona');
$routes->add('salva_pec', 'Sislo_PEC::ajax_save_form');
//fim pec

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
