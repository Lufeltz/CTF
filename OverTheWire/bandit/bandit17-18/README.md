

# [Bandit Level 17-18](https://overthewire.org/wargames/bandit/bandit18.html)

## Descrição original
There are 2 files in the homedirectory: passwords.old and passwords.new. The password for the next level is in passwords.new and is the only line that has been changed between passwords.old and passwords.new

NOTE: if you have solved this level and see ‘Byebye!’ when trying to log into bandit18, this is related to the next level, bandit19


## Introdução
O objetivo desse level é comparar os arquivos **passwords.old** e **passwords.new** para descobrir qual é a única linha que foi alterada entre eles e obter o password do próximo level.

O desafio inclui mais uma informação de que após resolver esse desafio se eu receber a mensagem ‘Byebye!’ ao tentar me conectar no **bandit18** isso tem relação com o próximo level [bandit19](https://overthewire.org/wargames/bandit/bandit19.html).


## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.

-i: especifica o caminho para um arquivo contendo uma chave privada.
```

```
ls: lista o conteúdo do diretório especificado.
```

```
whatis: exibe uma breve descrição de um comando ou de uma função do sistema. 
```

```
diff: compara cada uma das linhas dos arquivos especificados.
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

Assim como informado no desafio anterior vou realizar uma autenticação no usuário **bandit17** por meio da **chaveRSA** obtida no usuário **bandit16.**

```console
bandit16@bandit:~$ ssh bandit17@bandit.labs.overthewire.org -p 2220 -i /tmp/desafio16/chaveRSA
```

```console
bandit17@bandit:~$ whoami
bandit17
```

Depois de autenticado vejo o conteúdo do diretório atual e visualizo dois arquivos:
```console
bandit17@bandit:~$ ls
passwords.new  passwords.old
```

Como o objetivo desse level é encontrar o password dentro do arquivo **passwords.new** que é a única linha que foi alterada entre os arquivos **passwords.old** e **passwords.new** vou utilizar o comando **diff** o qual compara cada uma das linhas dos arquivos especificados.

```console
bandit17@bandit:~$ whatis diff
diff (1) - compare files line by line
```

```console
bandit17@bandit:~$ diff passwords.old passwords.new
42c42
< glZreTEH1V3cGKL6g4conYqZqaEj0mte
---
> hga5tuuCLF6fFzUpnagiMN8ssu9LFrdg
```

Na saída do comando **diff** posso observar que a única linha alterada ou changed(c) foi a 42 onde:

    A linha 42 do arquivo passwords.old
    glZreTEH1V3cGKL6g4conYqZqaEj0mte 
    mudou para:
    hga5tuuCLF6fFzUpnagiMN8ssu9LFrdg 
    no arquivo passwords.new que é o nosso password.


Porém ao tentar me conectar utilizando esse password no usuário **bandit18** tenho como resposta o seguinte:

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit18@bandit.labs.overthewire.org -p 2220
```

```
bandit18@bandit.labs.overthewire.org's password: hga5tuuCLF6fFzUpnagiMN8ssu9LFrdg
Byebye !
Connection to bandit.labs.overthewire.org closed.
```

Na nota desse desafio é informado que essa mensagem tem relação com o desafio [bandit19](https://overthewire.org/wargames/bandit/bandit19.html).

A descrição do **bandit19** é:

O password para o próximo level está armazenada em um arquivo **readme** no diretório **home**. Infelizmente, alguém modificou o **.bashrc** para desconectar você assim que a conexão **SSH** for estabelecida.

Como a sugestão do desafio de comandos que eu talvez precise utilizar contém apenas **ssh, ls** e **cat** é bem provável que exista alguma forma de visualizar o conteúdo de algum arquivo enquanto estou realizando a conexão **ssh**.

Sabendo disso vou encerrar a conexão no usuário **bandit17** e **bandit16** e continuar no próximo desafio **bandit18** para obter o password do **bandit19**.

Password do próximo desafio **bandit18**.
```
hga5tuuCLF6fFzUpnagiMN8ssu9LFrdg
```

```console
bandit17@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
```console
bandit16@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```