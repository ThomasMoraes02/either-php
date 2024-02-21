# Nome do Projeto

Praticando o Padrão Either no Pest PHP

## Começando

Estas instruções fornecerão uma cópia do projeto em execução na sua máquina local para fins de desenvolvimento e teste.

### Pré-requisitos

O que você precisa para instalar o software e como instalá-los:

- Docker
- Docker Compose

### Instalação

Um passo a passo que informa o que você deve executar para ter um ambiente de desenvolvimento em execução:

1. **Baixar o container:**

   Para construir e iniciar o container em modo detached (em segundo plano), execute:

   ```bash
   docker compose up -d --build

2. **Acessar o container:**

    Para acessar o bash do container da aplicação, use:

    ```bash
    docker compose run app bash

3. **Atualizar dependências:**

    Dentro do container, execute o seguinte comando para atualizar as dependências do Composer:

    ```bash
    composer update

4. **Rodar Testes:**

    Para rodar os testes e gerar o relatório de cobertura de código com o Pest, use o seguinte comando dentro do container:

    ```bash
    php vendor/bin/pest tests --colors --coverage