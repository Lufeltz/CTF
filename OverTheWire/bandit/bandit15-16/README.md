
# [Bandit Level 15-16](https://overthewire.org/wargames/bandit/bandit16.html)

## Descrição original
The password for the next level can be retrieved by submitting the password of the current level to port 30001 on localhost using SSL encryption.

Helpful note: Getting “HEARTBEATING” and “Read R BLOCK”? Use -ign_eof and read the “CONNECTED COMMANDS” section in the manpage. Next to ‘R’ and ‘Q’, the ‘B’ command also works in this version of that command…


## Introdução
O objetivo desse level é enviar o password desse level para a porta 30001 do localhost(servidor atual) a qual responderá com o password do próximo level, porém diferente do level anterior é necessário fazer isso utilizando a criptografia SSL.

## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```
```
echo: exibe uma mensagem no terminal.
```
```
openssl: biblioteca de criptografia que fornece uma série de utilitários de linha de comando para trabalhar com funções de criptografia.

s_client: usado para atuar como um cliente SSL/TLS, permitindo que você estabeleça conexões seguras com servidores que usam criptografia SSL/TLS. 

-connect: especifica o servidor e a porta que o cliente SSL deve conectar. 

-ign_eof: faz com que o cliente SSL não encerre a conexão quando atinge o final da entrada (EOF) e, em vez disso, continue em execução impedindo que as respostas sejam enviadas imcompletas.
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
└─$ ssh bandit15@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit15@bandit.labs.overthewire.org's password: jN2kgmIXJ6fShzhT2avhotn4Zcka6tnt
```

```console
bandit15@bandit:~$ whoami
bandit15
```

Feito o login procuro formas de enviar mensagens para portas especificas utilizando a criptografia SSL:

```console
bandit15@bandit:~$ man openssl
OpenSSL is a cryptography toolkit implementing the Secure SocketsLayer (SSL v2/v3) and Transport Layer Security (TLS v1) network protocols.
```

Encontro o utilitário OpenSSL e faço um teste implementando a criptografia SSL:

```console
bandit15@bandit:~$ echo 'teste' | openssl s_client -connect localhost:30001 -ign_eof
```

Recebo essa mensagem, indicando que minha conexão está funcionando, porém o password foi enviado incorretamente:

```
read R BLOCK
Wrong! Please enter the correct current password
closed
```

Faço mais uma vez a conexão dessa vez passando o password atual:
```console
bandit15@bandit:~$ echo 'jN2kgmIXJ6fShzhT2avhotn4Zcka6tnt' | openssl s_client -connect localhost:30001 -ign_eof 
```

Recebo a mensagem de que o password está correto:
```
read R BLOCK
Correct!
JQttfApK4SeyHwDlI9SXGR50qclOAil1

closed
```

Dessa vez obtenho o password do próximo level:

    JQttfApK4SeyHwDlI9SXGR50qclOAil1

Por fim saio do usuário atual por meio do comando **exit**:

```console
bandit15@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```