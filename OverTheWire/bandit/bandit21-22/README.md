# [Bandit Level 21-22](https://overthewire.org/wargames/bandit/bandit22.html)

## Descrição original
A program is running automatically at regular intervals from cron, the time-based job scheduler. Look in /etc/cron.d/ for the configuration and see what command is being executed.

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

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit21@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit21@bandit.labs.overthewire.org's password: NvEJF7oVjkddltPSrdKEFOllh9V1IBcq
```

```console
bandit21@bandit:~$ whoami
bandit21
```

Realizado o login vejo quais arquivos estão no diretório **/etc/cron.d/**:

```console
bandit21@bandit:~$ ls -l /etc/cron.d
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

Como o objetivo é encontrar o password do level **bandit22**, vou visualizar o conteúdo do arquivo **cronjob_bandit22:**

```console
bandit21@bandit:~$ cat /etc/cron.d/cronjob_bandit22
@reboot bandit22 /usr/bin/cronjob_bandit22.sh &> /dev/null
```

Dentro desse arquivo existe um código envolvendo o arquivo de script **cronjob_bandit22.sh**.

Vejo o conteúdo desse script:

```console
bandit21@bandit:~$ cat /usr/bin/cronjob_bandit22.sh
#!/bin/bash
chmod 644 /tmp/t7O6lds9S0RqQh9aMcz6ShpAoZKF7fgv
cat /etc/bandit_pass/bandit22 > /tmp/t7O6lds9S0RqQh9aMcz6ShpAoZKF7fgv
```

Esse script está fazendo basicamente o seguinte:

    chmod 644: especifica as permissões de escrita e leitura para o usuário atual e de somente leitura para outros usuários ou grupos.

    cat /etc/bandit_pass/bandit22 > /tmp/t7O6lds9S0RqQh9aMcz6ShpAoZKF7fgv: redireciona o conteúdo do arquivo bandit22 para outro arquivo.


Abro esse arquivo e encontro o password do level **bandit22**:

```console
bandit21@bandit:~$ cat /tmp/t7O6lds9S0RqQh9aMcz6ShpAoZKF7fgv
WdDozAdTM2z9DiFEQ2mGlwngMfj4EZff
```
    WdDozAdTM2z9DiFEQ2mGlwngMfj4EZff


Por fim saio do usuário atual por meio do comando exit.

```console
bandit21@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```