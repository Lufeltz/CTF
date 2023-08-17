# [Bandit Level 28-29](https://overthewire.org/wargames/bandit/bandit29.html)

## Descrição original
There is a git repository at **ssh://bandit28-git@localhost/home/bandit28-git/repo** via the port **2220**. The password for the user bandit28-git is the same as for the user bandit28.

Clone the repository and find the password for the next level.

## Introdução
O objetivo desse level é realizar um clone(cópia) do repositório git **ssh://bandit28-git@localhost/home/bandit28-git/repo** através da porta **2220** e encontrar o password para o próximo level.

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
cd: permite que você mude o diretório de trabalho atual para um diretório específico.
```


## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit28@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit28@bandit.labs.overthewire.org's password: AVanL161y9rsbcJIsFHuw35rjaOM19nR
```

```console
bandit28@bandit:~$ whoami
bandit28
```

Realizado o login faço o clone desse repositório para o diretório **/tmp/git-bandit28**(caso ele não exista o git faz a criação automaticamente e clonará o repositório dentro dele).

Note que depois de localhost eu fiz a definicação da porta para **:2220** e após a conexão defino o diretório **/tmp/git-bandit28** onde o clone do repositório será feito.

```console
bandit28@bandit:~$ git clone ssh://bandit28-git@localhost:2220/home/bandit28-git/repo /tmp/git-bandit28
Cloning into '/tmp/git-bandit28'...
```

Recebo uma mensagem a seguir que solicita a verificação de uma chave de host. Isso acontece quando você tenta se conectar a um servidor SSH (nesse caso, "localhost" na porta 2220) pela primeira vez. O SSH está pedindo a minha confirmação para adicionar a chave de host do servidor à lista de chaves conhecidas no meu sistema.
```
The authenticity of host '[localhost]:2220 ([127.0.0.1]:2220)' can't be established.
ED25519 key fingerprint is SHA256:C2ihUBV7ihnV1wUXRb4RrEcLfXC5CXlhmAAM/urerLY.
This key is not known by any other names
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
```

Após digitar **yes** forneço o password do **bandit28** e o clone do repositório é feito:
```console
bandit28-git@localhost's password: AVanL161y9rsbcJIsFHuw35rjaOM19nR

remote: Enumerating objects: 9, done.
remote: Counting objects: 100% (9/9), done.
remote: Compressing objects: 100% (6/6), done.
remote: Total 9 (delta 2), reused 0 (delta 0), pack-reused 0
Receiving objects: 100% (9/9), done.
Resolving deltas: 100% (2/2), done.
```

Listo o conteúdo desse repositório recém criado e encontro o arquivo **README.md**.
```console
bandit28@bandit:~$ ls /tmp/git-bandit28
README.md
```

Visualizo o conteúdo desse arquivo e encontro o seguinte:
```console
bandit28@bandit:~$ cat /tmp/git-bandit28/README.md 
# Bandit Notes
Some notes for level29 of bandit.

## credentials

- username: bandit29
- password: xxxxxxxxxx
```

O password parece ter sido escondido, vou verificar o histórico de commits para consultar as últimas alterações desse arquivo.

Já que comandos como git show requerem que eu os execute em um diretório que seja um repositório Git válido, ou seja, um diretório que contenha o diretório oculto **.git**, vou navegar para o diretório que acabei de clonar:

```console
bandit28@bandit:~$ cd /tmp/git-bandit28
```

Listo o conteúdo desse diretório incluindo qualquer arquivo oculto e como pode ser visto encontro o **.git** que confirma que esse diretório é um repositório git válido:
```console
bandit28@bandit:/tmp/git-bandit28$ ls -la
total 10568
drwxrwxr-x   3 bandit28 bandit28     4096 Aug 17 02:29 .
drwxrwx-wt 422 root     root     10801152 Aug 17 02:41 ..
drwxrwxr-x   8 bandit28 bandit28     4096 Aug 17 02:29 .git
-rw-rw-r--   1 bandit28 bandit28      111 Aug 17 02:29 README.md
```
Utilizando o **git show** tenho acesso aos detalhes do commit mais recente(incluindo diferenças entre os commits realizados) caso não especifique um commit:
```console
bandit28@bandit:/tmp/git-bandit28$ git show
commit 899ba88df296331cc01f30d022c006775d467f28 (HEAD -> master, origin/master, origin/HEAD)
Author: Morla Porla <morla@overthewire.org>
Date:   Sun Apr 23 18:04:39 2023 +0000

    fix info leak

diff --git a/README.md b/README.md
index b302105..5c6457b 100644
--- a/README.md
+++ b/README.md
@@ -4,5 +4,5 @@ Some notes for level29 of bandit.
 ## credentials
 
 - username: bandit29
-- password: tQKvmcwNYcFS6vmPHIUSI3ShmsrQZK8S
+- password: xxxxxxxxxx
:
```

Acima encontro algumas informações sobre o commit(hash do commit, autor, data). 
```
commit 899ba88df296331cc01f30d022c006775d467f28 (HEAD -> master, origin/master, origin/HEAD)
Author: Morla Porla <morla@overthewire.org>
Date:   Sun Apr 23 18:04:39 2023 +0000

    fix info leak
```

O **diff** mostra as alterações feitas nos arquivos de commit, ele indica também que o arquivo README.md foi modificado.

```
diff --git a/README.md b/README.md
index b302105..5c6457b 100644
--- a/README.md
+++ b/README.md
```

Na última parte é mostrado as alterações realizadas em que a principal foi a modificação do password:
```
@@ -4,5 +4,5 @@ Some notes for level29 of bandit.
 ## credentials
 
 - username: bandit29
-- password: tQKvmcwNYcFS6vmPHIUSI3ShmsrQZK8S
+- password: xxxxxxxxxx
:
```


Dessa forma encontro o password do próximo level **bandit29**:

    tQKvmcwNYcFS6vmPHIUSI3ShmsrQZK8S

Por fim saio do usuário atual por meio do comando exit.

```console
bandit28@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```