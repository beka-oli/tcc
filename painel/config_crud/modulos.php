<?php
// Configuração central dos módulos migrados para o CRUD.
// Somente tabelas e campos definidos aqui podem ser acessados pelo CRUD.
return [
    'autores' => [
        'titulo' => 'Autores', 'singular' => 'Autor', 'tabela' => 'autores', 'chave' => 'id_autor',
        'campos' => [
            'nome'=>['label'=>'Nome','tipo'=>'text','obrigatorio'=>true],
            'email'=>['label'=>'E-mail','tipo'=>'email'],
            'instituicao'=>['label'=>'Instituição','tipo'=>'text'],
            'orcid'=>['label'=>'ORCID','tipo'=>'text'],
            'curriculo'=>['label'=>'Currículo / Biografia','tipo'=>'textarea'],
            'area_atuacao'=>['label'=>'Área de Atuação','tipo'=>'text'],
            'status'=>['label'=>'Status','tipo'=>'select','opcoes'=>['Ativo','Inativo']]
        ],
        'pesquisa'=>['nome','email','instituicao','orcid','area_atuacao']
    ],
    'livros' => [
        'titulo'=>'Livros','singular'=>'Livro','tabela'=>'livros','chave'=>'id_livro',
        'campos'=>[
            'titulo'=>['label'=>'Título','tipo'=>'text','obrigatorio'=>true],
            'isbn'=>['label'=>'ISBN','tipo'=>'text'], 'autor'=>['label'=>'Autor','tipo'=>'text'],
            'editora'=>['label'=>'Editora','tipo'=>'text'], 'ano_publicacao'=>['label'=>'Ano de Publicação','tipo'=>'number'],
            'paginas'=>['label'=>'Páginas','tipo'=>'number'], 'edicao'=>['label'=>'Edição','tipo'=>'text'],
            'categoria'=>['label'=>'Categoria','tipo'=>'text'], 'idioma'=>['label'=>'Idioma','tipo'=>'text'],
            'sinopse'=>['label'=>'Sinopse','tipo'=>'textarea'], 'data_cadastro'=>['label'=>'Data de Cadastro','tipo'=>'date'],
            'status'=>['label'=>'Status','tipo'=>'select','opcoes'=>['Ativo','Inativo']],
            'destaque'=>['label'=>'Destaque','tipo'=>'select','opcoes'=>['0','1']]
        ],
        'pesquisa'=>['titulo','isbn','autor','editora','categoria']
    ],
    'revistas' => [
        'titulo'=>'Revistas','singular'=>'Revista','tabela'=>'revistas','chave'=>'id_revista',
        'campos'=>[
            'issn'=>['label'=>'ISSN','tipo'=>'text'], 'nome'=>['label'=>'Nome da Revista','tipo'=>'text','obrigatorio'=>true],
            'volume'=>['label'=>'Volume','tipo'=>'text'], 'numero'=>['label'=>'Número','tipo'=>'text'],
            'ano'=>['label'=>'Ano','tipo'=>'number'], 'doi'=>['label'=>'DOI','tipo'=>'text'],
            'periodicidade'=>['label'=>'Periodicidade','tipo'=>'text'], 'editor_chefe'=>['label'=>'Editor-chefe','tipo'=>'text'],
            'conselho'=>['label'=>'Conselho Editorial','tipo'=>'textarea'], 'revisores'=>['label'=>'Revisores','tipo'=>'textarea'],
            'data_publicacao'=>['label'=>'Data de Publicação','tipo'=>'date'],
            'status'=>['label'=>'Status','tipo'=>'select','opcoes'=>['Ativo','Inativo']],
            'destaque'=>['label'=>'Destaque','tipo'=>'select','opcoes'=>['0','1']]
        ],
        'pesquisa'=>['issn','nome','doi','periodicidade']
    ],
    'concursos' => [
        'titulo'=>'Concursos','singular'=>'Concurso','tabela'=>'concursos','chave'=>'id_concurso',
        'campos'=>[
            'nome'=>['label'=>'Nome','tipo'=>'text','obrigatorio'=>true], 'orgao'=>['label'=>'Órgão','tipo'=>'text'],
            'cargo'=>['label'=>'Cargo','tipo'=>'text'], 'escolaridade'=>['label'=>'Escolaridade','tipo'=>'text'],
            'edital'=>['label'=>'Edital','tipo'=>'text'], 'ano'=>['label'=>'Ano','tipo'=>'number'],
            'data_inscricao_inicio'=>['label'=>'Início das Inscrições','tipo'=>'date'],
            'data_inscricao_fim'=>['label'=>'Fim das Inscrições','tipo'=>'date'], 'data_prova'=>['label'=>'Data da Prova','tipo'=>'date'],
            'descricao'=>['label'=>'Descrição','tipo'=>'textarea'],
            'status'=>['label'=>'Status','tipo'=>'select','opcoes'=>['Aberto','Em andamento','Encerrado','Suspenso']],
            'destaque'=>['label'=>'Destaque','tipo'=>'select','opcoes'=>['0','1']]
        ],
        'pesquisa'=>['nome','orgao','cargo','edital']
    ],
    'inscricoes' => [
        'titulo'=>'Inscrições','singular'=>'Inscrição','tabela'=>'inscricoes','chave'=>'id_inscricao',
        'campos'=>[
            'id_concurso'=>['label'=>'ID do Concurso','tipo'=>'number','obrigatorio'=>true],
            'nome'=>['label'=>'Nome','tipo'=>'text','obrigatorio'=>true], 'cpf'=>['label'=>'CPF','tipo'=>'text'],
            'email'=>['label'=>'E-mail','tipo'=>'email'], 'telefone'=>['label'=>'Telefone','tipo'=>'text'],
            'escolaridade'=>['label'=>'Escolaridade','tipo'=>'text'], 'data_inscricao'=>['label'=>'Data da Inscrição','tipo'=>'date'],
            'status'=>['label'=>'Status','tipo'=>'select','opcoes'=>['Pendente','Confirmada','Cancelada']]
        ],
        'pesquisa'=>['nome','cpf','email','telefone','escolaridade']
    ]
];
