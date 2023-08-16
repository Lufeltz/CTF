# [Bandit Level 27-28](https://overthewire.org/wargames/bandit/bandit28.html)

## Descrição original
There is a git repository at **ssh://bandit27-git@localhost/home/bandit27-git/repo** via the port **2220**. The password for the user bandit27-git is the same as for the user bandit27.

Clone the repository and find the password for the next level.

## Introdução
O objetivo desse level é realizar um clone(cópia) do repositório git **ssh://bandit27-git@localhost/home/bandit27-git/repo** através da porta **2220** e encontrar o password para o próximo level.

## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório especificado.
```

```
whoami: exibe o nome do usuário que está atualmente logado no terminal ou no sistema operacional.
```

```
cat: exibe o conteúdo de um ou mais arquivos de texto diretamente no terminal.
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit27@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit27@bandit.labs.overthewire.org's password: YnQpBuifNMas1hcUFk70ZmqkhUU2EuaS
```

```console
bandit27@bandit:~$ whoami
bandit27
```

Realizado o login faço o clone desse repositório para o diretório **/tmp/git-bandit27**(caso ele não exista o git faz a criação automaticamente e clonará o repositório dentro dele).

Note que depois de localhost eu fiz a definicação da porta para **:2220** e após a conexão defino o diretório **/tmp/git-bandit27** onde o clone do repositório será feito.

```console
bandit27@bandit:~$ git clone ssh://bandit27-git@localhost:2220/home/bandit27-git/repo /tmp/git-bandit27
Cloning into '/tmp/git-bandit27'...
```

Recebo uma mensagem a seguir que solicita a verificação de uma chave de host. Isso acontece quando você tenta se conectar a um servidor SSH (nesse caso, "localhost" na porta 2220) pela primeira vez. O SSH está pedindo a minha confirmação para adicionar a chave de host do servidor à lista de chaves conhecidas no meu sistema.
```
The authenticity of host '[localhost]:2220 ([127.0.0.1]:2220)' can't be established.
ED25519 key fingerprint is SHA256:C2ihUBV7ihnV1wUXRb4RrEcLfXC5CXlhmAAM/urerLY.
This key is not known by any other names
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
```

Após digitar **yes** forneço o password do **bandit27** e o clone do repositório é feito:
```console
bandit27-git@localhost's password: YnQpBuifNMas1hcUFk70ZmqkhUU2EuaS

remote: Enumerating objects: 3, done.
remote: Counting objects: 100% (3/3), done.
remote: Compressing objects: 100% (2/2), done.
remote: Total 3 (delta 0), reused 0 (delta 0), pack-reused 0
Receiving objects: 100% (3/3), done.
```

Listo o conteúdo desse repositório recém criado e encontro o arquivo **README**.
```console
bandit27@bandit:~$ ls /tmp/git-bandit27
README
```

Visualizo o conteúdo desse arquivo e encontro o seguinte:
```console
bandit27@bandit:~$ cat /tmp/git-bandit27/README
The password to the next level is: AVanL161y9rsbcJIsFHuw35rjaOM19nR
```

Dessa forma encontro o password do próximo level **bandit28**:

    AVanL161y9rsbcJIsFHuw35rjaOM19nR

Por fim saio do usuário atual por meio do comando exit.

```console
bandit27@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```