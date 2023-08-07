# [Bandit Level 16-17](https://overthewire.org/wargames/bandit/bandit17.html)

## Descrição original
The credentials for the next level can be retrieved by submitting the password of the current level to a port on localhost in the range 31000 to 32000. First find out which of these ports have a server listening on them. Then find out which of those speak SSL and which don’t. There is only 1 server that will give the next credentials, the others will simply send back to you whatever you send to it.


## Introdução
O objetivo desse level é bem semelhante com o anterior, porém nesse desafio eu preciso primeiro descobrir quais portas no intervalo entre **31000** e **32000** estão "escutando" e depois quais delas estão se comunicando por meio de criptografia SSL para enviar o password atual e obter o password do próximo level.

O desafio inclui mais uma informação interessante de que existe somente um servidor que retornará as credenciais do próximo level enquanto os outros vão apenas retornar o que eu enviar para eles.


## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.

-i: especifica o caminho para um arquivo contendo uma chave privada.
```
```
echo: exibe uma mensagem no terminal.
```

```
ls: lista o conteúdo do diretório especificado.

-l: exibe o conteúdo de um arquivo em forma de lista, além disso mostra informações adicionais como permissões e proprietário.
```
```
openssl: biblioteca de criptografia que fornece uma série de utilitários de linha de comando para trabalhar com funções de criptografia.

s_client: usado para atuar como um cliente SSL/TLS, permitindo que você estabeleça conexões seguras com servidores que usam criptografia SSL/TLS. 

-connect: especifica o servidor e a porta que o cliente SSL deve conectar. 

-ign_eof: faz com que o cliente SSL não encerre a conexão quando atinge o final da entrada (EOF) e, em vez disso, continue em execução impedindo que as respostas sejam enviadas imcompletas.
```
```
nmap: ferramenta de mapeamento de redes usada para explorar portas e serviços em uma rede, o alvo é informado após o nome da ferramenta, ex: nmap localhost.

-p: especifica as portas que serão verificadas.

-sV: Realiza a detecção de serviços e suas versões.
```
```
mkdir: cria diretórios (pastas) no sistema de arquivos. 
```
```
touch é usado para criar arquivos vazios.
```
```
chmod: altera permissões de arquivos e diretórios.
```
```
|(pipe): redireciona a saída de um comando para a entrada de outro comando.
```
```
man: usado para exibir o manual(documentação) de algum utilitário.
```
```
whatis: exibe uma breve descrição de um comando ou de uma função do sistema. 
```
```
--help: fornece informações sobre um determinado comando ex: nmap --help
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit16@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit16@bandit.labs.overthewire.org's password: JQttfApK4SeyHwDlI9SXGR50qclOAil1
```

```console
bandit16@bandit:~$ whoami
bandit16
```

Realizo o login no usuário **bandit16** e procuro uma ferramenta para me ajudar nesse escaneamento(**scan**) de portas do servidor

```console
bandit16@bandit:~$ whatis nmap
nmap (1) - Network exploration tool and security / port scanner
```

O nmap parece ser a escolha perfeita para essa tarefa então executo o **scan** das portas do servidor(**localhost**):

```console
bandit16@bandit:~$ nmap localhost -p 31000-32000
Starting Nmap 7.80 ( https://nmap.org ) at 2023-08-07 20:07 UTC
Nmap scan report for localhost (127.0.0.1)
Host is up (0.00015s latency).
Not shown: 996 closed ports
PORT      STATE SERVICE
31046/tcp open  unknown
31518/tcp open  unknown
31691/tcp open  unknown
31790/tcp open  unknown
31960/tcp open  unknown

Nmap done: 1 IP address (1 host up) scanned in 0.06 seconds
```

Nesse código acima estou executando um scan somente nas portas do intervalo de **31000** a **32000** conforme informado no desafio e descubro as seguintes portas abertas(**open**):

    PORT      STATE SERVICE
    31046/tcp open  unknown
    31518/tcp open  unknown
    31691/tcp open  unknown
    31790/tcp open  unknown
    31960/tcp open  unknown


Encontrei as portas abertas, mas não possuo mais nenhuma informação sobre elas, para obter mais dados informações sobre os serviços dessas portas vou utilizar a opção **-sV** que envia uma sonda para determinar os serviços/versões de cada porta.

```console
bandit16@bandit:~$ nmap --help
SERVICE/VERSION DETECTION:
  -sV: Probe open ports to determine service/version info
```

Como já sei quais portas estão abertas vou especificá-las no comando para ser mais eficiente:
```console
bbandit16@bandit:~$ nmap -sV localhost -p 31046,31518,31691,31790,31960
Starting Nmap 7.80 ( https://nmap.org ) at 2023-08-07 20:14 UTC
Nmap scan report for localhost (127.0.0.1)
Host is up (0.00016s latency).

PORT      STATE SERVICE     VERSION
31046/tcp open  echo
31518/tcp open  ssl/echo
31691/tcp open  echo
31790/tcp open  ssl/unknown
31960/tcp open  echo
```

Vejo que somente as portas **31518** e **31790** estão utilizando a criptografia **ssl**. Além disso o próprio desafio informa que somente um servidor vai retornar as credenciais enquanto os outros vão retornar o que eu enviar para eles, ou seja, farão um **echo** e nas portas acima apenas a **31790** não possui um serviço de **echo**, me indicando que provavelmente seja a porta correta.


Agora basta enviar o password atual para a porta **31790** e ver o que acontece. Vou utilizar o mesmo comando que usei no desafio anterior já que o objetivo é o mesmo

```console
bandit16@bandit:~$ echo 'JQttfApK4SeyHwDlI9SXGR50qclOAil1' | openssl s_client -connect localhost:31790 -ign_eof 
```

Funcionou corretamente e dessa vez ao invés de um password recebi uma **chave privada RSA** para me autenticar no próximo desafio:
```
read R BLOCK
Correct!
-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAvmOkuifmMg6HL2YPIOjon6iWfbp7c3jx34YkYWqUH57SUdyJ
imZzeyGC0gtZPGujUSxiJSWI/oTqexh+cAMTSMlOJf7+BrJObArnxd9Y7YT2bRPQ
Ja6Lzb558YW3FZl87ORiO+rW4LCDCNd2lUvLE/GL2GWyuKN0K5iCd5TbtJzEkQTu
DSt2mcNn4rhAL+JFr56o4T6z8WWAW18BR6yGrMq7Q/kALHYW3OekePQAzL0VUYbW
JGTi65CxbCnzc/w4+mqQyvmzpWtMAzJTzAzQxNbkR2MBGySxDLrjg0LWN6sK7wNX
x0YVztz/zbIkPjfkU1jHS+9EbVNj+D1XFOJuaQIDAQABAoIBABagpxpM1aoLWfvD
KHcj10nqcoBc4oE11aFYQwik7xfW+24pRNuDE6SFthOar69jp5RlLwD1NhPx3iBl
J9nOM8OJ0VToum43UOS8YxF8WwhXriYGnc1sskbwpXOUDc9uX4+UESzH22P29ovd
d8WErY0gPxun8pbJLmxkAtWNhpMvfe0050vk9TL5wqbu9AlbssgTcCXkMQnPw9nC
YNN6DDP2lbcBrvgT9YCNL6C+ZKufD52yOQ9qOkwFTEQpjtF4uNtJom+asvlpmS8A
vLY9r60wYSvmZhNqBUrj7lyCtXMIu1kkd4w7F77k+DjHoAXyxcUp1DGL51sOmama
+TOWWgECgYEA8JtPxP0GRJ+IQkX262jM3dEIkza8ky5moIwUqYdsx0NxHgRRhORT
8c8hAuRBb2G82so8vUHk/fur85OEfc9TncnCY2crpoqsghifKLxrLgtT+qDpfZnx
SatLdt8GfQ85yA7hnWWJ2MxF3NaeSDm75Lsm+tBbAiyc9P2jGRNtMSkCgYEAypHd
HCctNi/FwjulhttFx/rHYKhLidZDFYeiE/v45bN4yFm8x7R/b0iE7KaszX+Exdvt
SghaTdcG0Knyw1bpJVyusavPzpaJMjdJ6tcFhVAbAjm7enCIvGCSx+X3l5SiWg0A
R57hJglezIiVjv3aGwHwvlZvtszK6zV6oXFAu0ECgYAbjo46T4hyP5tJi93V5HDi
Ttiek7xRVxUl+iU7rWkGAXFpMLFteQEsRr7PJ/lemmEY5eTDAFMLy9FL2m9oQWCg
R8VdwSk8r9FGLS+9aKcV5PI/WEKlwgXinB3OhYimtiG2Cg5JCqIZFHxD6MjEGOiu
L8ktHMPvodBwNsSBULpG0QKBgBAplTfC1HOnWiMGOU3KPwYWt0O6CdTkmJOmL8Ni
blh9elyZ9FsGxsgtRBXRsqXuz7wtsQAgLHxbdLq/ZJQ7YfzOKU4ZxEnabvXnvWkU
YOdjHdSOoKvDQNWu6ucyLRAWFuISeXw9a/9p7ftpxm0TSgyvmfLF2MIAEwyzRqaM
77pBAoGAMmjmIJdjp+Ez8duyn3ieo36yrttF5NSsJLAbxFpdlc1gvtGCWW+9Cq0b
dxviW8+TFVEBl1O4f7HVm6EpTscdDxU+bCXWkfjuRb7Dy9GOtt9JPsX8MBTakzh3
vBgsyi/sN3RqRBcGU40fOoZyfAMT8s1m/uYv52O6IgeuZ/ujbjY=
-----END RSA PRIVATE KEY-----

closed

```

Para facilitar a conexão no level **bandit17** salvo essa chave em um arquivo no diretório **/tmp** o qual tenho permissão para escrita:

```console
bandit16@bandit:~$ mkdir /tmp/desafio16
bandit16@bandit:~$ touch /tmp/desafio16/chaveRSA
bandit16@bandit:~$ vim /tmp/desafio16/chaveRSA
```
No último comando eu abro o arquivo com o editor **vim** colo a chave e uso o comando **:wq** depois de apertar **esc** para salvar os dados da chave no arquivo chaveRSA.

Ao tentar realizar uma conexão utilizando essa chave, recebo a mensagem de que minha chave privada está desprotegida, especificamente porque as permissões dela permitem que outros usuários a acessem ou modifiquem:

```console
bandit16@bandit:~$ ssh bandit17@bandit.labs.overthewire.org -p 2220 -i /tmp/desafio16/chaveRSA

@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@         WARNING: UNPROTECTED PRIVATE KEY FILE!          @
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
Permissions 0664 for '/tmp/desafio16/chaveRSA' are too open.
It is required that your private key files are NOT accessible by others.
This private key will be ignored.
Load key "/tmp/desafio16/chaveRSA": bad permissions
bandit17@bandit.labs.overthewire.org: Permission denied (publickey).
```

Vejo nas permissões que outros usuários além de mim podem ler esse arquivo e consequentemente usá-lo para realizar conexões sem meu conhecimento. 

Essas permissões estão representadas pelas letras **r** e **w** nas permissões do arquivo:
```console
bandit16@bandit:~$ ls -l /tmp/desafio16/chaveRSA
-rw-rw-r-- 1 bandit16 bandit16 1676 Aug  7 20:35 /tmp/desafio16/chaveRSA
```

Modifico as permissões para somente o meu usuário(**bandit16**) ter permissão de leitura(**r**) e removo a permissão de escrita(**w**):
```console
bandit16@bandit:~$ chmod 400 /tmp/desafio16/chaveRSA
```

```console
bandit16@bandit:~$ ls -l /tmp/desafio16/chaveRSA-r-------- 1 bandit16 bandit16 1676 Aug  7 20:35 /tmp/desafio16/chaveRSA
```

Faço mais uma tentativa de conexão no usuário **bandit17** que agora funciona e me concede acesso a esse usuário:

```console
bandit16@bandit:~$ ssh bandit17@bandit.labs.overthewire.org -p 2220 -i /tmp/desafio16/chaveRSA
```

```console
bandit17@bandit:~$ whoami
bandit17
```

Dessa vez como o minha forma de autenticação no usuário **bandit17** é por meio da chave armazenada no arquivo **/tmp/desafio16/chaveRSA** dentro do usuário **bandit16**, vou me manter autenticado no **bandit16** para realizar o próximo desafio.

