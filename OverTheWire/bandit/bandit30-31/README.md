# [Bandit Level 30-31](https://overthewire.org/wargames/bandit/bandit31.html)

## Descrição original
There is a git repository at **ssh://bandit30-git@localhost/home/bandit30-git/repo** via the port **2220**. The password for the user bandit30-git is the same as for the user bandit30.

Clone the repository and find the password for the next level.

## Introdução
O objetivo desse level é realizar um clone(cópia) do repositório git **ssh://bandit30-git@localhost/home/bandit30-git/repo** através da porta **2220** e encontrar o password para o próximo level.

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
git branch:  mostrará os ramos disponíveis no seu diretório de trabalho.

-a: lista todos os ramos, incluindo os ramos remotos (que podem estar no servidor remoto).
```

```
git tag: marca pontos específicos na história do repositório, geralmente usados para indicar versões de lançamento ou marcos importantes.
```
```
git pull: busca as alterações mais recentes de um repositório remoto e os mescla automaticamente na branch local. 
```

```
cd: permite que você mude o diretório de trabalho atual para um diretório específico.
```


## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit30@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit30@bandit.labs.overthewire.org's password: xbhV3HpNGlTIdnjUrdAlPzc2L6y9EOnS
```

```console
bandit30@bandit:~$ whoami
bandit30
```

Realizado o login faço o clone desse repositório para o diretório **/tmp/git-bandit30**(caso ele não exista o git faz a criação automaticamente e clonará o repositório dentro dele).

Note que depois de localhost eu fiz a definição da porta para **:2220** e após a conexão defino o diretório **/tmp/git-bandit30** onde o clone do repositório será feito.

```console
bandit30@bandit:~$ git clone ssh://bandit30-git@localhost:2220/home/bandit30-git/repo /tmp/git-bandit30
Cloning into '/tmp/git-bandit30'...
```

Recebo uma mensagem a seguir que solicita a verificação de uma chave de host. Isso acontece quando você tenta se conectar a um servidor SSH (nesse caso, "localhost" na porta 2220) pela primeira vez. O SSH está pedindo a minha confirmação para adicionar a chave de host do servidor à lista de chaves conhecidas no meu sistema.
```
The authenticity of host '[localhost]:2220 ([127.0.0.1]:2220)' can't be established.
ED25519 key fingerprint is SHA256:C2ihUBV7ihnV1wUXRb4RrEcLfXC5CXlhmAAM/urerLY.
This key is not known by any other names
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
```

Após digitar **yes** forneço o password do **bandit30** e o clone do repositório é feito:
```console
bandit30-git@localhost's password: xbhV3HpNGlTIdnjUrdAlPzc2L6y9EOnS

remote: Enumerating objects: 4, done.
remote: Counting objects: 100% (4/4), done.
remote: Total 4 (delta 0), reused 0 (delta 0), pack-reused 0
Receiving objects: 100% (4/4), done.
```

Listo o conteúdo desse repositório recém criado e encontro o arquivo **README.md**.
```console
bandit30@bandit:~$ ls /tmp/git-bandit30
README.md
```

Já que alguns comandos do git requerem que eu os execute em um diretório que seja um repositório Git válido, ou seja, um diretório que contenha o diretório oculto **.git**, vou navegar para o diretório que acabei de clonar:

```console
bandit30@bandit:~$ cd /tmp/git-bandit30
bandit30@bandit:/tmp/git-bandit30$
```

Visualizo o conteúdo do **README.md** e encontro o seguinte:
```console
bandit30@bandit:/tmp/git-bandit30$ git show README.md
commit 59530d30d299ff2e3e9719c096ebf46a65cc1424 (HEAD -> master, origin/master, origin/HEAD)
Author: Ben Dover <noone@overthewire.org>
Date:   Sun Apr 23 18:04:42 2023 +0000

    initial commit of README.md

diff --git a/README.md b/README.md
new file mode 100644
index 0000000..029ba42
--- /dev/null
+++ b/README.md
@@ -0,0 +1 @@
+just an epmty file... muahaha
```

Uma mensagem de **"apenas um arquivo vazio... muahaha"** aparece. Já que não encontrei nenhum conteúdo útil nesse arquivo vou seguir o pensamento do desafio anterior e consultar outras branchs existentes buscando maiores informações.

    Uma branch em um sistema de controle de versão, como o Git, é uma linha independente de desenvolvimento que permite que você trabalhe em diferentes recursos ou partes do código de forma isolada.


Visualizo quais branchs estão disponíveis nesse repositório local e encontro a branch atual indicada pelo * e a única atualmente nesse repositório local:

```console
bandit30@bandit:/tmp/git-bandit30$ git branch
* master
```

Consulto as branchs remotas e identifico a presença de uma branch que possui o mesmo nome da minha branch local(master), porém ela é a versão remota do meu repositório local:

```console
bandit30@bandit:/tmp/git-bandit30$ git branch -a
* master
  remotes/origin/HEAD -> origin/master
  remotes/origin/master
```

    A linha remotes/origin/HEAD -> origin/master não é uma branch real; é apenas uma referência para a branch "origin/master" que está sendo considerada como a branch padrão no repositório remoto.

Como minha branch local pode estar desatualizada em relação com a remota faço um **git pull** para confirmar se estou com a última versão do repositório remoto:

```console
bandit30@bandit:/tmp/git-bandit30$ git pull

The authenticity of host '[localhost]:2220 ([127.0.0.1]:2220)' can't be established.
ED25519 key fingerprint is SHA256:C2ihUBV7ihnV1wUXRb4RrEcLfXC5CXlhmAAM/urerLY.
This key is not known by any other names
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes

bandit30-git@localhost's password: xbhV3HpNGlTIdnjUrdAlPzc2L6y9EOnS
Already up to date.
```

Recebo a mensagem **Already up to date**, indicando que estou com a última versão.


Verifico o histórico de commits do repositório, porém encontro somente um commit:
```
59530d3 (HEAD -> master, origin/master, origin/HEAD) initial commit of README.md
```

O repositório local está atualizado em relação ao remoto e foi realizado somente um commit nesse repositório local que não tem nenhuma credencial. Então provalmente o password não está  colocado diretamente em um commit. 

Faço uma busca por comandos do git e encontro o **git tag**.

    git tag: Usado para criar, listar ou verificar tags (marcas) associadas a commits específicos.

Ao utilizar esse comando encontro uma tag chamada **secret** e ao visualizar seu conteúdo encontro um password:
```console
bandit30@bandit:/tmp/git-bandit30$ git tag
secret
bandit30@bandit:/tmp/git-bandit30$ git show secret
OoffzGDlzhAlerFJ2cAiz1D41JW1Mhmt
```

Dessa forma encontro o password do próximo level **bandit31**:

    OoffzGDlzhAlerFJ2cAiz1D41JW1Mhmt

Por fim saio do usuário atual por meio do comando exit.

```console
bandit30@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```