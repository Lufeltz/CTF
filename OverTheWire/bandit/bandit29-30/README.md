# [Bandit Level 29-30](https://overthewire.org/wargames/bandit/bandit30.html)

## Descrição original
There is a git repository at **ssh://bandit29-git@localhost/home/bandit29-git/repo** via the port **2220**. The password for the user bandit29-git is the same as for the user bandit29.

Clone the repository and find the password for the next level.

## Introdução
O objetivo desse level é realizar um clone(cópia) do repositório git **ssh://bandit29-git@localhost/home/bandit29-git/repo** através da porta **2220** e encontrar o password para o próximo level.

## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório especificado.

-l: mostra detalhes adicionais sobre cada arquivo, incluindo permissões, proprietário, grupo, tamanho, data de modificação e nome.

a: inclui os arquivos ocultos no resultado da listagem. Os arquivos ocultos são aqueles cujos nomes começam com um ponto.
```

```
whoami: exibe o nome do usuário que está atualmente logado no terminal ou no sistema operacional.
```

```
cat: exibe o conteúdo de um ou mais arquivos de texto diretamente no terminal.
```

```
git show: usado para exibir informações detalhadas sobre um commit específico no histórico de um repositório Git.
```
```
git clone: cria uma cópia completa e funcional de um repositório Git existente.
```
```
git checkout: usado para alternar entre ramos (branches) existentes ou para restaurar arquivos de um commit específico.
```
```
git branch:  mostrará os ramos disponíveis no seu diretório de trabalho.

-a: lista todos os ramos, incluindo os ramos remotos (que podem estar no servidor remoto).
```

```
cd: permite que você mude o diretório de trabalho atual para um diretório específico.
```


## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit29@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit29@bandit.labs.overthewire.org's password: tQKvmcwNYcFS6vmPHIUSI3ShmsrQZK8S
```

```console
bandit29@bandit:~$ whoami
bandit29
```

Realizado o login faço o clone desse repositório para o diretório **/tmp/git-bandit29**(caso ele não exista o git faz a criação automaticamente e clonará o repositório dentro dele).

Note que depois de localhost eu fiz a definicação da porta para **:2220** e após a conexão defino o diretório **/tmp/git-bandit29** onde o clone do repositório será feito.

```console
bandit29@bandit:~$ git clone ssh://bandit29-git@localhost:2220/home/bandit29-git/repo /tmp/git-bandit29
Cloning into '/tmp/git-bandit29'...
```

Recebo uma mensagem a seguir que solicita a verificação de uma chave de host. Isso acontece quando você tenta se conectar a um servidor SSH (nesse caso, "localhost" na porta 2220) pela primeira vez. O SSH está pedindo a minha confirmação para adicionar a chave de host do servidor à lista de chaves conhecidas no meu sistema.
```
The authenticity of host '[localhost]:2220 ([127.0.0.1]:2220)' can't be established.
ED25519 key fingerprint is SHA256:C2ihUBV7ihnV1wUXRb4RrEcLfXC5CXlhmAAM/urerLY.
This key is not known by any other names
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
```

Após digitar **yes** forneço o password do **bandit29** e o clone do repositório é feito:
```console
bandit29-git@localhost's password: tQKvmcwNYcFS6vmPHIUSI3ShmsrQZK8S

remote: Enumerating objects: 9, done.
remote: Counting objects: 100% (9/9), done.
remote: Compressing objects: 100% (6/6), done.
remote: Total 9 (delta 2), reused 0 (delta 0), pack-reused 0
Receiving objects: 100% (9/9), done.
Resolving deltas: 100% (2/2), done.
```

Listo o conteúdo desse repositório recém criado e encontro o arquivo **README.md**.
```console
bandit29@bandit:~$ ls /tmp/git-bandit29
README.md
```

Já que alguns comandos do git requerem que eu os execute em um diretório que seja um repositório Git válido, ou seja, um diretório que contenha o diretório oculto **.git**, vou navegar para o diretório que acabei de clonar:

```console
bandit29@bandit:~$ cd /tmp/git-bandit29
```

Visualizo o conteúdo do **README.md** e encontro o seguinte:
```console
bandit29@bandit:/tmp/git-bandit29$ cat README.md 
# Bandit Notes
Some notes for bandit30 of bandit.

## credentials

- username: bandit30
- password: <no passwords in production!>
```

Uma mensagem de **"sem senhas em produção!"** aparece me indicando que nessa branch não existe senhas.

    Uma branch em um sistema de controle de versão, como o Git, é uma linha independente de desenvolvimento que permite que você trabalhe em diferentes recursos ou partes do código de forma isolada.


Vou visualizar quais branchs estão disponíveis nesse repositório local:

```console
bandit29@bandit:/tmp/git-bandit29$ git branch
* master
```

Encontrei a branch master que é a branch atual indicada pelo *, porém essa é a branch de produção, e a única atualmente nesse repositório local.

    branch de produção: representa a versão do software que já está implantada e sendo utilizada pelos usuários finais

Provavelmente existem mais branchs no repositório remoto, então vamos consultá-las:
```console
bandit29@bandit:/tmp/git-bandit29$ git branch -a
* master
  remotes/origin/HEAD -> origin/master
  remotes/origin/dev
  remotes/origin/master
  remotes/origin/sploits-dev
```

Existem várias branchs remotamente e uma que me chama atenção é a **dev**, ou seja a branch de desenvolvimento que talvez tenha alguma informação interessante.

    branch de desenvolvimento: usada para desenvolver novos recursos e funcionalidades antes de serem lançados na produção.

Altero então a minha branch atual(master) para a branch **dev**:
```console
bandit29@bandit:/tmp/git-bandit29$ git checkout dev
Switched to branch 'dev'
Your branch is up to date with 'origin/dev'.
```

Visualizo o último commit realizado(para maiores detalhes sobre a estrutura do commit abaixo veja o desafio anterior [bandit28-29](../bandit28-29/README.md)):
```console
bandit29@bandit:/tmp/git-bandit29$ git show
commit 13e735685c73e5e396252074f2dca2e415fbcc98 (HEAD -> dev, origin/dev)
Author: Morla Porla <morla@overthewire.org>
Date:   Sun Apr 23 18:04:40 2023 +0000

    add data needed for development

diff --git a/README.md b/README.md
index 1af21d3..a4b1cf1 100644
--- a/README.md
+++ b/README.md
@@ -4,5 +4,5 @@ Some notes for bandit30 of bandit.
 ## credentials
 
 - username: bandit30
-- password: <no passwords in production!>
+- password: xbhV3HpNGlTIdnjUrdAlPzc2L6y9EOnS
 
:
```

Nesse commit consta o password que havia sido removido quando foi realizado o commit para a branch de produção(master).

Dessa forma encontro o password do próximo level **bandit30**:

    xbhV3HpNGlTIdnjUrdAlPzc2L6y9EOnS

Por fim saio do usuário atual por meio do comando exit.

```console
bandit29@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```