# 🚀 LaraLearn - Projeto do Curso "Let's Learn Laravel & Livewire"

Este repositório contém o código-fonte do projeto `LaraLearn`, desenvolvido como parte do curso da Udemy **["Let's Learn Laravel & Livewire: A Guided Path For Beginners"](https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/)**, ministrado pelo instrutor **[Brad Schiff](https://www.udemy.com/user/bradschiff/)**.

O objetivo do projeto é construir uma aplicação social simples, semelhante a um blog ou Twitter, para praticar os conceitos fundamentais e as melhores práticas do ecossistema Laravel e Livewire.

---

## ⚙️ Pré-requisitos

Antes de começar, garanta que você tenha o seguinte ambiente de desenvolvimento configurado:

* Um ambiente de servidor local (ex: Laragon, XAMPP, WAMP, Herd)
* PHP 8.2 ou superior
* Composer
* Um banco de dados (MySQL, MariaDB, etc.)

---

## 📝 Guia de Instalação e Configuração

Siga estes passos para configurar o projeto em um novo ambiente.

1.  **Clonar o Repositório**
    ```bash
    git clone [https://github.com/Robson16/laralearn.git](https://github.com/Robson16/laralearn.git)
    cd laralearn
    ```

2.  **Instalar Dependências do PHP**
    Execute o Composer para baixar todos os pacotes necessários.
    ```bash
    composer install
    ```

3.  **Configurar o Ambiente**
    Copie o arquivo de ambiente de exemplo e gere a chave da aplicação.
    ```bash
    # Para Windows
    copy .env.example .env

    # Para MacOS/Linux
    cp .env.example .env
    ```
    Em seguida, gere a chave:
    ```bash
    php artisan key:generate
    ```

4.  **Configurar o Banco de Dados**
    Abra o arquivo `.env` e configure as variáveis do seu banco de dados (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

5.  **Executar as Migrations (❗️ Importante)**
    Este comando criará todas as tabelas necessárias no banco de dados que você configurou.
    ```bash
    php artisan migrate
    ```

6.  **Criar o Link da Pasta Storage (❗️ Importante)**
    Para que os uploads de arquivos (como avatares) fiquem publicamente acessíveis, execute este comando. Ele cria um atalho de `public/storage` para `storage/app/public`.
    ```bash
    php artisan storage:link
    ```

7.  **Acessar a Aplicação**
    Pronto! Agora você pode acessar o projeto através do seu servidor local (ex: `http://laralearn.test`).

---

## 🔧 Configuração Recomendada do `php.ini` (Crítico!)

Para evitar problemas com upload de arquivos e processamento de imagens, é **altamente recomendado** que seu arquivo `php.ini` contenha as seguintes configurações. Em um ambiente como o Laragon, você pode acessar este arquivo facilmente pelo menu.

```ini
; Garante que o PHP tenha permissão para escrever em uma pasta temporária.
; Aponte para a pasta 'tmp' da sua instalação do Laragon ou similar.
upload_tmp_dir = "C:/laragon/tmp"

; Ativa a biblioteca GD, necessária para manipulação de imagens (ex: com a library Intervention/Image).
extension=gd

; Permite o envio de arquivos maiores (ajuste conforme necessário).
upload_max_filesize = 50M
post_max_size = 50M
```

**Lembre-se de reiniciar seu servidor (Apache/Nginx) após qualquer alteração no `php.ini`!**
