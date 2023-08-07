# [Bandit Level 13-14](https://overthewire.org/wargames/bandit/bandit14.html)

## Descrição original
The password for the next level is stored in /etc/bandit_pass/bandit14 and can only be read by user bandit14. For this level, you don’t get the next password, but you get a private SSH key that can be used to log into the next level. Note: localhost is a hostname that refers to the machine you are working on


## Introdução
O objetivo desse level é acessar o conteúdo do arquivo **etc/bandit_pass/bandit14**, porém ele só pode ser lido pelo usuário **bandit14**. Não tenho um password para fazer login nesse usuário, mas recebo no lugar disso uma chave SSH para acesso.


## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.

-i: especifica o caminho do arquivo que contém a chave privada que será usada na autenticação a um servidor remoto.
```

```
ls: lista o conteúdo do diretório atual.
```

```
cat: mostra o conteúdo de um ou mais arquivos de texto. A principal função do comando cat é concatenar, ou seja, combinar arquivos e exibir o resultado na saída padrão (geralmente a tela).
```


## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit13@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit13@bandit.labs.overthewire.org's password: wbWdlBxEir4CaE8LaPhauuOo6pwRmrDw
```

```console
bandit13@bandit:~$ whoami
bandit13
```

Realizado o login vejo quais arquivos estão no meu diretório atual e localizo uma chave **SSH:**

```console
bandit13@bandit:~$ ls
sshkey.private
```

Já que preciso me autenticar no usuário **bandit14** utilizando uma chave ssh procuro opções que me permitam utilizar um arquivo com a chave para realizar a autenticação:

```console
bandit14@bandit:~$ man ssh
-i identity_file: Selects a file from which the identity (private key) for public key authentication is read.
```

Encontro a opção **-i** que me permite utilizar o arquivo **sshkey.private** para me autenticar.

```console
bandit13@bandit:~$ ssh bandit14@localhost -p 2220 -i sshkey.private 
```
No comando acima eu utilizo **bandit14@localhost** devido a já estar conectado na máquina e **localhost** se referir ao servidor atual **bandit.labs.overthewire.org.**


Recebo a seguinte mensagem ao iniciar a conexão:
```
The authenticity of host '[localhost]:2220 ([127.0.0.1]:2220)' can't be established.
ED25519 key fingerprint is SHA256:C2ihUBV7ihnV1wUXRb4RrEcLfXC5CXlhmAAM/urerLY.
This key is not known by any other names
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
```
Ao digitar **yes** estou adicionando a chave pública do servidor (ED25519 key fingerprint) às chaves conhecidas do cliente (no caso, o meu computador). Isso permitirá que o meu computador reconheça o servidor como autêntico em futuras conexões e evite exibir a mensagem de autenticidade novamente para esse mesmo servidor. 


Vejo que estou no atualmente no usuário **bandit14**:

```console
bandit14@bandit:~$ whoami
bandit14
```

Acesso então o arquivo **/etc/bandit_pass/bandit14**:
```console
bandit14@bandit:~$ cat /etc/bandit_pass/bandit14
fGrHPx402xGC7U7rXKDaxiWFTOiF0ENq
```
Dessa forma obtenho o password do level **bandit14:**

    fGrHPx402xGC7U7rXKDaxiWFTOiF0ENq

Por fim saio do usuário **bandit14** e depois do usuário **bandit13** por meio do comando **exit**:

```console
bandit14@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```

```console
bandit13@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```