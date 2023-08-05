# [Bandit Level 7-8](https://overthewire.org/wargames/bandit/bandit8.html)

## Descrição original
The password for the next level is stored in the file data.txt next to the word millionth


## Introdução
O objetivo desse level é encontrar no arquivo **data.txt** o password que está próximo a palavra **millionth.**


## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório atual.
```

```
grep: busca por padrões em arquivos de texto ou em uma saída de outros comandos.
```

```
cat: mostra o conteúdo de um ou mais arquivos de texto. A principal função do comando cat é concatenar, ou seja, combinar arquivos e exibir o resultado na saída padrão (geralmente a tela).
```

```
|(pipe): redireciona a saída de um comando para a entrada de outro comando.
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit7@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit7@bandit.labs.overthewire.org's password: z7WtoNQU2XfjmMtWA8u5rN4vzqu4v99S
```

```console
bandit7@bandit:~$ whoami
bandit7
```

Realizado o login vejo quais arquivos estão no meu diretório atual e encontro o arquivo **data.txt** no qual vou procurar o password:

```console
bandit7@bandit:~$ ls
data.txt
```

Duas opções para realizar essa busca são variações do uso do comando **grep**. Na primeira redireciono a saída do **cat** para o **grep** usando o **|(pipe)** para buscar pela palavra **"millionth"**, já na segunda eu procuro diretamente pela palavra no arquivo.

```console
bandit7@bandit:~$ cat data.txt | grep "millionth"
millionth       TESKZC0XvTetK0S9xNwm25STk5iWrBvP
```
```console
bandit7@bandit:~$ grep "millionth" data.txt 
millionth       TESKZC0XvTetK0S9xNwm25STk5iWrBvP
```

Feito isso descubro o password para o próximo level:

    TESKZC0XvTetK0S9xNwm25STk5iWrBvP

Por fim saio do usuário atual por meio do comando **exit**:

```console
bandit7@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
