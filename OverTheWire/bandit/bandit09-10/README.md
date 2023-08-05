# [Bandit Level 9-10](https://overthewire.org/wargames/bandit/bandit10.html)

## Descrição original
The password for the next level is stored in the file data.txt in one of the few human-readable strings, preceded by several ‘=’ characters.


## Introdução
O objetivo desse level é encontrar no arquivo **data.txt** o password que é uma das poucas **strings** human-readable(que podem ser compreendidas por humanos) que é precedida por diversos simbolos **'='**.


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
```
strings: extrai sequências de caracteres legíveis de um arquivo binário. Em outras palavras, ele filtra o conteúdo do arquivo em busca de sequências de caracteres ASCII que são consideradas legíveis.
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit9@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit9@bandit.labs.overthewire.org's password: EN632PlfYiZbn3PhVK3XOGSlNInNE00t
```

```console
bandit9@bandit:~$ whoami
bandit9
```

Realizado o login vejo quais arquivos estão no meu diretório atual e encontro o arquivo **data.txt** no qual vou procurar o password:

```console
bandit9@bandit:~$ ls
data.txt
```

O próprio desafio já nos informou que o password é uma das poucas strings human-readable no arquivo **data.txt** então uma ótima opção é utilizar o comando **strings** para extraí-las do arquivo e usar o **grep** para filtrar pelas que começarem por vários simbolos de **'='**.

```console
bandit9@bandit:~$ cat data.txt | strings | grep '=='
4========== the#
========== password
========== is
========== G7w8LIi6J3kTb8A7j9LgrywtEUlyyp6s
```

Veja que utilizei **'=='**, pois como foi dito no desafio, o password é precedido por vários simbolos de **'='**.

Dessa forma obtenho o password para o próximo level:

    G7w8LIi6J3kTb8A7j9LgrywtEUlyyp6s

Por fim saio do usuário atual por meio do comando **exit**:

```console
bandit9@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```