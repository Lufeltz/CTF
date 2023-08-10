# [Bandit Level 19-20](https://overthewire.org/wargames/bandit/bandit20.html)

## Descrição original
To gain access to the next level, you should use the setuid binary in the homedirectory. Execute it without arguments to find out how to use it. The password for this level can be found in the usual place (/etc/bandit_pass), after you have used the setuid binary.


## Introdução
O objetivo desse level é utilizar um arquivo **setuid binary** no diretório home para acessar o password do **bandit20** localizado em **/etc/bandit_pass.**

    Um setuid binary é um tipo especial de arquivo binário em sistemas linux que possui a permissão "setuid" ativada. O termo "setuid" é uma abreviação de "Set User ID upon execution", o que significa que o processo que executa o binário assume temporariamente os privilégios do proprietário do arquivo, em vez dos privilégios do usuário que está executando o processo.


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

```
whoami: exibe o nome do usuário que está atualmente logado no terminal ou no sistema operacional.
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit19@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit19@bandit.labs.overthewire.org's password: awhqfNnAbc1naukrpqDYcF95h7HoMTrC
```
```console
bandit19@bandit:~$ whoami
bandit19
```

Realizado o login vejo quais arquivos estão no meu diretório atual:

```console
bandit19@bandit:~$ ls
bandit20-do
```

Encontro o **setuid binary**, vou seguir a recomendação do exercício e usá-lo sem argumentos para ver como utilizá-lo.

```console
bandit19@bandit:~$ ./bandit20-do 
Run a command as another user.
  Example: ./bandit20-do id
```

Esse arquivo permite que eu execute um comando como outro usuário(bandit20 nesse caso). Faço um teste simples com o comando **whoami**:
```console
bandit19@bandit:~$ ./bandit20-do whoami
bandit20
```
Tenho como resultado **bandit20**, isso confirma que posso realizar ações em nome desse usuário com o auxílio desse arquivo **bandit20-do.**

Sabendo disso faço uma tentativa para obter o password do usuário **bandit20**:

```console
bandit19@bandit:~$ ./bandit20-do cat /etc/bandit_pass/bandit20
VxCazJaVykI6W36BkBU0mJTCM8rR95XT
```

Dessa forma obtenho o password para o próximo level **bandit20**:

    VxCazJaVykI6W36BkBU0mJTCM8rR95XT


Por fim saio do usuário atual por meio do comando exit.

```console
bandit19@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```