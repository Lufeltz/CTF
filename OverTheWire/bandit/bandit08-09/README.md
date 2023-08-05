# [Bandit Level 8-9](https://overthewire.org/wargames/bandit/bandit9.html)

## Descrição original
The password for the next level is stored in the file data.txt and is the only line of text that occurs only once


## Introdução
O objetivo desse level é encontrar no arquivo **data.txt** o password que é a única linha do texto que ocorre somente uma vez.


## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório atual.
```

```
sort: classifica as linhas do arquivo em ordem alfabética 
```
```
uniq: remove linhas duplicadas consecutivas em um arquivo de texto. Ele mantém apenas a primeira ocorrência de linhas consecutivas repetidas e descarta as demais.

-u: exibe apenas as linhas que não têm duplicatas consecutivas antes ou depois delas.
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
└─$ ssh bandit8@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit8@bandit.labs.overthewire.org's password: TESKZC0XvTetK0S9xNwm25STk5iWrBvP
```

```console
bandit8@bandit:~$ whoami
bandit8
```

Realizado o login vejo quais arquivos estão no meu diretório atual e encontro o arquivo **data.txt** no qual vou procurar o password:

```console
bandit8@bandit:~$ ls
data.txt
```

Como é necessário encontrar somente a linha que ocorre uma vez, um comando interessante é o **uniq** que irá fazer uma checagem das linhas e encontrar linhas únicas, porém isso funciona apenas se as linhas duplicadas estiverem em sequência(adjacentes) e é nesse ponto que entra o comando **sort** que fará uma ordenação das linhas em ordem alfabética.

```console
bandit8@bandit:~$ cat data.txt | sort | uniq -u
EN632PlfYiZbn3PhVK3XOGSlNInNE00t
```

Como pode ser visto o conteúdo de **data.txt** foi obtido pelo **cat** depois redirecionado para o **sort** e feita uma ordenação, após isso o **uniq -u** exibiu somente a única linha que não tem nenhuma duplicata, ou seja, que é única no arquivo.

Dessa forma me fornecendo o password do próximo level:

    EN632PlfYiZbn3PhVK3XOGSlNInNE00t

Por fim saio do usuário atual por meio do comando **exit**:

```console
bandit8@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```