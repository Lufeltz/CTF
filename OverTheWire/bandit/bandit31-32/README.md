# [Bandit Level 31-32](https://overthewire.org/wargames/bandit/bandit32.html)

## Descrição original
There is a git repository at **ssh://bandit31-git@localhost/home/bandit31-git/repo** via the port **2220**. The password for the user bandit31-git is the same as for the user bandit31.

Clone the repository and find the password for the next level.

## Introdução
O objetivo desse level é realizar um clone(cópia) do repositório git **ssh://bandit31-git@localhost/home/bandit31-git/repo** através da porta **2220** e encontrar o password para o próximo level.

## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório especificado.

-l: mostra detalhes adicionais sobre cada arquivo, incluindo permissões, proprietário, grupo, tamanho, data de modificação e nome.

-a: inclui os arquivos ocultos no resultado da listagem. Os arquivos ocultos são aqueles cujos nomes começam com um ponto.
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
git add:usado para adicionar mudanças específicas nos arquivos à área de stage, preparando-os para serem incluídos no próximo commit.
```

```
git commit: usado para criar um novo commit contendo as mudanças que você adicionou ao stage. Ao criar um commit, você também precisa fornecer uma mensagem descritiva que explique as alterações realizadas.
```
```
git push: usado para enviar seus commits locais para um repositório remoto. A opção origin indica o nome do repositório remoto, e master é o nome da branch para a qual você está fazendo o push. Isso atualiza o repositório remoto com as alterações que você fez localmente.
```
```
cd: permite que você mude o diretório de trabalho atual para um diretório específico.
```
```
echo: exibe mensagens de texto ou variáveis na saída padrão (normalmente o terminal ou console).
```


## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit31@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit31@bandit.labs.overthewire.org's password: OoffzGDlzhAlerFJ2cAiz1D41JW1Mhmt
```

```console
bandit31@bandit:~$ whoami
bandit31
```

Realizado o login faço o clone desse repositório para o diretório **/tmp/git-bandit31**(caso ele não exista o git faz a criação automaticamente e clonará o repositório dentro dele).

Note que depois de localhost eu fiz a definição da porta para **:2220** e após a conexão defino o diretório **/tmp/git-bandit31** onde o clone do repositório será feito.

```console
bandit31@bandit:~$ git clone ssh://bandit31-git@localhost:2220/home/bandit31-git/repo /tmp/git-bandit31
Cloning into '/tmp/git-bandit31'...
```

Recebo uma mensagem a seguir que solicita a verificação de uma chave de host. Isso acontece quando você tenta se conectar a um servidor SSH (nesse caso, "localhost" na porta 2220) pela primeira vez. O SSH está pedindo a minha confirmação para adicionar a chave de host do servidor à lista de chaves conhecidas no meu sistema.
```
The authenticity of host '[localhost]:2220 ([127.0.0.1]:2220)' can't be established.
ED25519 key fingerprint is SHA256:C2ihUBV7ihnV1wUXRb4RrEcLfXC5CXlhmAAM/urerLY.
This key is not known by any other names
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
```

Após digitar **yes** forneço o password do **bandit31** e o clone do repositório é feito:
```console
bandit31-git@localhost's password: OoffzGDlzhAlerFJ2cAiz1D41JW1Mhmt

remote: Enumerating objects: 4, done.
remote: Counting objects: 100% (4/4), done.
remote: Compressing objects: 100% (3/3), done.
remote: Total 4 (delta 0), reused 0 (delta 0), pack-reused 0
Receiving objects: 100% (4/4), done.
```

Listo o conteúdo desse repositório recém criado e encontro o arquivo **README.md**.
```console
bandit31@bandit:~$ ls /tmp/git-bandit31
README.md
```

Já que alguns comandos do git requerem que eu os execute em um diretório que seja um repositório Git válido, ou seja, um diretório que contenha o diretório oculto **.git**, vou navegar para o diretório que acabei de clonar:

```console
bandit31@bandit:~$ cd /tmp/git-bandit31
bandit31@bandit:/tmp/git-bandit31$
```

Visualizo o conteúdo do commit envolvendo o **README.md** e encontro o seguinte:
```console
bandit31@bandit:/tmp/git-bandit31$ git show README.md
commit 362bfd50c2007554b4aac93af07ebf964179a7b7 (HEAD -> master, origin/master, origin/HEAD)
Author: Ben Dover <noone@overthewire.org>
Date:   Sun Apr 23 18:04:43 2023 +0000

    initial commit

diff --git a/README.md b/README.md
new file mode 100644
index 0000000..0edecc0
--- /dev/null
+++ b/README.md
@@ -0,0 +1,7 @@
+This time your task is to push a file to the remote repository.
+
+Details:
+    File name: key.txt
```

Duas coisas me chamam a atenção:

    1 - This time your task is to push a file to the remote repository.

A primeira é uma mensagem indicando que a minha tarefa é realizar um push(enviar o conteúdo do repositório local para o remoto) de um arquivo.

Já a segunda é o nome do arquivo que deve ser enviado **key.txt**

    2 - File name: key.txt

Vejo também o conteúdo desse arquivo e encontro informações para o envio do arquivo **key.txt**:
```console
bandit31@bandit:/tmp/git-bandit31$ cat README.md 
This time your task is to push a file to the remote repository.

Details:
    File name: key.txt
    Content: 'May I come in?'
    Branch: master
```

Busco mais informações sobre esse repositório para não deixar passar algo desapercebido. Logo faço uma listagem incluindo os arquivos ocultos e recebo o seguinte:
```console
bandit31@bandit:/tmp/git-bandit31$ ls -la
total 10572
drwxrwxr-x   3 bandit31 bandit31     4096 Aug 20 00:25 .
drwxrwx-wt 302 root     root     10801152 Aug 20 00:42 ..
drwxrwxr-x   8 bandit31 bandit31     4096 Aug 20 00:29 .git
-rw-rw-r--   1 bandit31 bandit31        6 Aug 20 00:25 .gitignore
-rw-rw-r--   1 bandit31 bandit31      147 Aug 20 00:25 README.md
```

Encontro um arquivo chamado **.gitignore**.

    O arquivo .gitignore é um arquivo de configuração utilizado em projetos controlados pelo Git para especificar quais arquivos e pastas devem ser ignorados pelo controle de versão. Isso significa que os arquivos listados no .gitignore não serão rastreados, versionados ou incluídos em commits.


Ao visualizar o conteúdo desse arquivo, vejo que ele está ignorando qualquer arquivo que possua a extensão **.txt**:
```console
bandit31@bandit:/tmp/git-bandit31$ cat .gitignore
*.txt
```

Já que esse arquivo vai atrapalhar a minha tarefa de enviar o arquivo **key.txt**, realizo a remoção dele:
```console
bandit31@bandit:/tmp/git-bandit31$ rm .gitignore

bandit31@bandit:/tmp/git-bandit31$ ls -la
total 10568
drwxrwxr-x   3 bandit31 bandit31     4096 Aug 20 00:47 .
drwxrwx-wt 304 root     root     10801152 Aug 20 00:47 ..
drwxrwxr-x   8 bandit31 bandit31     4096 Aug 20 00:29 .git
-rw-rw-r--   1 bandit31 bandit31      147 Aug 20 00:25 README.md
```

Realizo aqui a criação do arquivo **key.txt** com o conteúdo indicado no **README.md**:

```console
echo 'May I come in?' > key.txt
```

Adiciono o arquivo a área de stage, faço um commit e depois um push para o repositório remoto do arquivo **key.txt**:

```
stage: é uma área temporária onde você prepara as mudanças que deseja incluir no próximo commit.
```

```console
bandit31@bandit:/tmp/git-bandit31$ git add key.txt
```

```console
bandit31@bandit:/tmp/git-bandit31$ git commit -m "Envio do arquivo key.txt"
[master c3cc4c5] Envio do arquivo key.txt
 1 file changed, 1 insertion(+), 1 deletion(-)
```

```console
bandit31@bandit:/tmp/git-bandit31$ git push origin master
The authenticity of host '[localhost]:2220 ([127.0.0.1]:2220)' can't be established.
ED25519 key fingerprint is SHA256:C2ihUBV7ihnV1wUXRb4RrEcLfXC5CXlhmAAM/urerLY.
This key is not known by any other names
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes

bandit31-git@localhost's password: OoffzGDlzhAlerFJ2cAiz1D41JW1Mhmt
```

Depois de colocar o password do level atual recebo uma mensagem indicando a existência de uma validação do arquivo **key.txt**:
```console
Enumerating objects: 4, done.
Counting objects: 100% (4/4), done.
Delta compression using up to 2 threads
Compressing objects: 100% (2/2), done.
Writing objects: 100% (3/3), 322 bytes | 322.00 KiB/s, done.
Total 3 (delta 0), reused 0 (delta 0), pack-reused 0
remote: ### Attempting to validate files... ####
remote: 
remote: .oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.
remote: 
remote: Well done! Here is the password for the next level:
remote: rmCBvG56y58BXzv98yZGdO7ATVL5dW8y 
remote: 
remote: .oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.
remote: 
To ssh://localhost:2220/home/bandit31-git/repo
 ! [remote rejected] master -> master (pre-receive hook declined)
error: failed to push some refs to 'ssh://localhost:2220/home/bandit31-git/repo'                                                                                 
```
Após ser confirmada a validação recebo o password do próximo level:

    remote: Well done! Here is the password for the next level:
    remote: rmCBvG56y58BXzv98yZGdO7ATVL5dW8y 

Dessa forma encontro o password do próximo level **bandit32**:

    rmCBvG56y58BXzv98yZGdO7ATVL5dW8y

Por fim saio do usuário atual por meio do comando exit.

```console
bandit31@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```