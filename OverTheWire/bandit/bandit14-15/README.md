
# [Bandit Level 14-15](https://overthewire.org/wargames/bandit/bandit15.html)

## Descrição original
The password for the next level can be retrieved by submitting the password of the current level to port 30000 on localhost.


## Introdução
O objetivo desse level é enviar o password desse level para a porta 30000 do localhost(servidor atual) a qual responderá com o password do próximo level.

## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```
```
echo: utilizado para exibir uma mensagem no terminal.
```
```
nc: conhecido como netcat, é uma ferramenta de rede que permite a criação de conexões TCP ou UDP.
```
```
|(pipe): redireciona a saída de um comando para a entrada de outro comando.
```
```
man: usado para exibir o manual (documentação) de algum utilitário.
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit14@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit14@bandit.labs.overthewire.org's password: fGrHPx402xGC7U7rXKDaxiWFTOiF0ENq
```

```console
bandit14@bandit:~$ whoami
bandit14
```

Realizado o login procuro formas de enviar mensagens para portas especificas:

```console
bandit14@bandit:~$ man nc

netcat is a simple unix utility which reads and writes data across network connections, using TCP or UDP protocol.
```
Encontro o **netcat(nc)** o qual me permite enviar ou ler mensagens atráves de conexões e me permite inclusive especificar as portas dessas conexões.

Realizo um teste usando ocomando **echo** para exibir uma mensagem e redirecionar ela para o comando **nc** que por sua vez enviará para o servidor atual(**localhost**) na porta **30000** e vejo que a mensagem foi enviada corretamente, porém o password informado está incorreto:

```console
bandit14@bandit:~$ echo "teste" | nc localhost 30000 
Wrong! Please enter the correct current password
```

Envio novamente a mensagem, mas agora com o password atual:
```console
bandit14@bandit:~$ echo "fGrHPx402xGC7U7rXKDaxiWFTOiF0ENq" | nc localhost 30000 
Correct!
jN2kgmIXJ6fShzhT2avhotn4Zcka6tnt
```

Dessa forma obtenho o password do próximo level:

    jN2kgmIXJ6fShzhT2avhotn4Zcka6tnt


Por fim saio do usuário atual por meio do comando **exit**:

```console
bandit14@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```