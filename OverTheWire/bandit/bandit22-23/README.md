# [Bandit Level 22-23](https://overthewire.org/wargames/bandit/bandit23.html)

## Descrição original
A program is running automatically at regular intervals from cron, the time-based job scheduler. Look in /etc/cron.d/ for the configuration and see what command is being executed.

NOTE: Looking at shell scripts written by other people is a very useful skill. The script for this level is intentionally made easy to read. If you are having problems understanding what it does, try executing it to see the debug information it prints.

## Introdução
O objetivo desse level é analisar um programa que está sendo executado em intervalos regulares em **/etc/cron.d/**. Nesse diretório posso verificar as configurações e quais comandos estão sendo utilizados.

## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório especificado.

-l: lista os arquivos e diretórios de um determinado diretório em formato de lista incluindo detalhes como permissões, grupo e tamanho.
```

```
whoami: exibe o nome do usuário que está atualmente logado no terminal ou no sistema operacional.
```

```
cat: exibe o conteúdo de um ou mais arquivos de texto diretamente no terminal.
```

```
md5sum: calcula o hash MD5 de um arquivo ou entrada de texto. 
```

```
cut: extrai seções específicas de linhas de texto.

-d ' ': define o espaço (' ') como o delimitador. Ou seja, o cut irá dividir cada linha em campos separados por espaços.

-f 1: especifica que queremos extrair o primeiro campo da linha, após a divisão feita pelo delimitador. No caso do md5sum, a saída é uma linha contendo o hash MD5 e o nome do arquivo (ou a mensagem, no nosso caso). Usando -f 1, o cut extrai apenas o primeiro campo, que é o hash MD5.
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit22@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit22@bandit.labs.overthewire.org's password: WdDozAdTM2z9DiFEQ2mGlwngMfj4EZff
```

```console
bandit22@bandit:~$ whoami
bandit22
```

Realizado o login vejo quais arquivos estão no diretório **/etc/cron.d/**:

```console
bandit22@bandit:~$ ls -l /etc/cron.d
total 36
-rw-r--r-- 1 root root  62 Apr 23 18:04 cronjob_bandit15_root
-rw-r--r-- 1 root root  62 Apr 23 18:04 cronjob_bandit17_root
-rw-r--r-- 1 root root 120 Apr 23 18:04 cronjob_bandit22
-rw-r--r-- 1 root root 122 Apr 23 18:04 cronjob_bandit23
-rw-r--r-- 1 root root 120 Apr 23 18:04 cronjob_bandit24
-rw-r--r-- 1 root root  62 Apr 23 18:04 cronjob_bandit25_root
-rw-r--r-- 1 root root 201 Jan  8  2022 e2scrub_all
-rwx------ 1 root root  52 Apr 23 18:05 otw-tmp-dir
-rw-r--r-- 1 root root 396 Feb  2  2021 sysstat
```

Como o objetivo é encontrar o password do level **bandit23**, vou visualizar o conteúdo do arquivo **cronjob_bandit23:**

```console
bandit22@bandit:~$ cat /etc/cron.d/cronjob_bandit23
@reboot bandit23 /usr/bin/cronjob_bandit23.sh  &> /dev/null
* * * * * bandit23 /usr/bin/cronjob_bandit23.sh  &> /dev/null
```

Dentro desse arquivo existe um código envolvendo o arquivo de script **cronjob_bandit23.sh**. Note também que o script está sendo executado como o usuário **bandit23.**

Vejo o conteúdo desse script:

```console
bandit22@bandit:~$ cat /usr/bin/cronjob_bandit23.sh
#!/bin/bash

myname=$(whoami)
mytarget=$(echo I am user $myname | md5sum | cut -d ' ' -f 1)

echo "Copying passwordfile /etc/bandit_pass/$myname to /tmp/$mytarget"

cat /etc/bandit_pass/$myname > /tmp/$mytarget
```

Esse script está fazendo basicamente o seguinte:

```
myname=$(whoami): 
atribui a saída do comando whoami(bandit23) a variável $myname.

mytarget=$(echo I am user $myname | md5sum | cut -d ' ' -f 1): 
Nesse código, o comando 'echo' imprime a mensagem 'I am user bandit23', e em seguida, essa saída é redirecionada para ser transformada em um hash MD5 pelo comando 'md5sum'. Após isso a saída desse comando é redirecionada para o comando cut que vai separar o resultado tendo como delimitador(-d) o espaço (' ') e vai retornar somente a primeira string(-f 1).

echo "Copying passwordfile /etc/bandit_pass/$myname to /tmp/$mytarget": 
informa que o password do usuário(bandit23) está sendo copiado para o arquivo de nome $mytarget dentro do diretório /tmp.

cat /etc/bandit_pass/$myname > /tmp/$mytarget: 
faz a cópia do password para o arquivo /tmp/$mytarget recém criado.
```

Exemplo:
```console
bandit22@bandit:~$ echo "I am user bandit23" | md5sum
8ca319486bfbbc3663ea0fbe81326349  -

bandit22@bandit:~$ echo "I am user bandit23" | md5sum | cut -d ' ' -f 1
8ca319486bfbbc3663ea0fbe81326349

bandit22@bandit:~$ cat /tmp/8ca319486bfbbc3663ea0fbe81326349
QYw0Y2aiA672PsMmh9puTQuhoz8SyR2G
```

Como pode ser visto acima ao abrir o arquivo com nome em hash md5 encontro o password do level **bandit23**:

```console
bandit22@bandit:~$ cat /tmp/8ca319486bfbbc3663ea0fbe81326349
QYw0Y2aiA672PsMmh9puTQuhoz8SyR2G
```

Por fim saio do usuário atual por meio do comando exit.

```console
bandit22@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```