# [Bandit Level 18-19](https://overthewire.org/wargames/bandit/bandit19.html)

## Descrição original
The password for the next level is stored in a file readme in the homedirectory. Unfortunately, someone has modified .bashrc to log you out when you log in with SSH.


## Introdução
O objetivo desse level é ler o conteudo do arquivo **readme** no diretório **home**, porém alguém modificou o arquivo **.bashrc** fazendo com que eu seja desconectado toda vez que estabelecer uma conexão **SSH.**


## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório especificado.
```

```
cat: usado para concatenar e exibir o conteúdo de arquivos de texto no terminal.
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit18@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit18@bandit.labs.overthewire.org's password: hga5tuuCLF6fFzUpnagiMN8ssu9LFrdg
```

Assim que a conexão é estabelecida a seguinte mensagem é exibida:
```
Byebye !
Connection to bandit.labs.overthewire.org closed.
```

Nesse momento penso que pode ser possível visualizar o conteúdo do arquivo **readme** durante a tentativa de conexão SSH já que a conexão é aberta, porém fechada instantaneamente.

Encontrei a seguinte forma de executar comandos no servidor remoto por meio da conexão ssh:

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit18@bandit.labs.overthewire.org -p 2220 "ls ~"  
```
```
bandit18@bandit.labs.overthewire.org's password: hga5tuuCLF6fFzUpnagiMN8ssu9LFrdg
```

Logo em seguida obtenho o seguinte:

```
readme
```

O que aconteceu aqui é que após a conexão SSH ser estabelecida com sucesso, o comando entre as aspas **"ls ~"** é passado para o shell no servidor remoto como um comando a ser executado. Dessa forma mostrando os arquivos no diretório home(**~**), ou seja o **readme.**

Como o objetivo é obter o conteúdo do arquivo **readme** e eu sei onde ele está vou utilizar o comando **cat** em vez do **ls.**
```console
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit18@bandit.labs.overthewire.org -p 2220 "cat readme"
```

```
awhqfNnAbc1naukrpqDYcF95h7HoMTrC
```

Dessa forma obtenho o password para o próximo level **bandit19**:

    awhqfNnAbc1naukrpqDYcF95h7HoMTrC


Por fim saio do usuário atual por meio do comando exit.

```console
bandit18@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```

### Extra

#### Alternativas adicionais:

Caso fosse necessário passar vários comandos de uma vez pode ser feito dentro das aspas duplas apenas sendo necessário separar cada comando com um **;**:

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit18@bandit.labs.overthewire.org -p 2220 "ls ~; pwd; whoami; cat readme"
```

Resultado:
```
readme
/home/bandit18
bandit18
awhqfNnAbc1naukrpqDYcF95h7HoMTrC
```

Outra opção pode ser a criação de um script para ser executado na conexão ssh:

**script.sh:**
```console
#!/bin/bash

ls ~
pwd
whoami
cat readme
```

Concedo permissão de execução no meu script:
```
chmod +x script.sh
```

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit18@bandit.labs.overthewire.org -p 2220 "bash -s" < script.sh
```

```
readme
/home/bandit18
bandit18
awhqfNnAbc1naukrpqDYcF95h7HoMTrC
```

O SSH está enviando o conteúdo do arquivo **script.sh** para o servidor remoto(**bandit18**) e o Bash executará os comandos contidos no script. A saída dos comandos será mostrada no meu terminal local.

    bash é usado para criar um novo shell Bash interativo no servidor remoto. Isso permite que você forneça comandos interativamente no ambiente desse novo shell.

    A opção -s permite que você insira comandos no terminal remoto após a conexão SSH.

