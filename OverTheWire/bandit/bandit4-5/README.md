# [Bandit Level 4-5](https://overthewire.org/wargames/bandit/bandit5.html)

### Descrição original
The password for the next level is stored in the only human-readable file in the inhere directory. Tip: if your terminal is messed up, try the “reset” command..

### Introdução
O objetivo desse level é identificar o único arquivo no diretório <strong>inhere</strong> que pode ser lido e interpretado por seres humanos(human-readable).

### Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório atual.
```

```
file: analisa o conteúdo do arquivo e tenta determinar o tipo do arquivo com base em suas características internas. 
```

```
find inhere/: busca arquivos no diretório especificado.

-type f: indica que estamos buscando apenas arquivos regulares(files, ignorando diretórios ou links).

-exec file {} \;: Executa o comando file para cada arquivo encontrado. O {} é um espaço reservado que será substituído pelo nome de cada arquivo encontrado. O \; é necessário para encerrar o comando -exec e evitar erros.
```

```
cat: mostra o conteúdo de um ou mais arquivos de texto. A principal função do comando cat é concatenar, ou seja, combinar arquivos e exibir o resultado na saída padrão (geralmente a tela).
```

### Resolução

```bash
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit4@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit4@bandit.labs.overthewire.org's password: 2EW7BBsr6aMMoJ2HjW067dm8EgX26xNe
```

```console
bandit4@bandit:~$ whoami
bandit4
```

Realizado o login vejo quais arquivos estão no meu diretório atual.

```console
bandit4@bandit:~$ ls
inhere
```

Mostrando o conteúdo desse diretório **inhere** com **ls** encontro o seguinte:

```console
bandit4@bandit:~$ ls inhere/
-file00  -file02  -file04  -file06  -file08
-file01  -file03  -file05  -file07  -file09
```
Para descobrir o tipo de um arquivo posso utilizar o comando **file** para analisar o seu conteúdo:

```console
bandit4@bandit:~$ file inhere/-file00
inhere/-file00: data
```

Obtenho que o tipo do arquivo -file00 é **data** que geralmente indica que o arquivo é considerado um arquivo de dados genérico, ou seja, um arquivo cujo tipo específico não pode ser determinado pelo file.

Eu poderia usar o file para todos os arquivos nesse caso já que existem somente 10 arquivos, mas e se fossem 1000?

Para resolver isso vou utilizar o comando **find** que vai localizar ou filtrar arquivos, mas o que realmente vai me interessar é a possibilidade de realizar uma ação em cada um desses arquivos encontrados, nesse caso usar o comando **file** em cada um deles.

```console
bandit4@bandit:~$ find inhere/ -type f -exec file {} \;
inhere/-file03: data
inhere/-file06: data
inhere/-file08: data
inhere/-file07: ASCII text
inhere/-file04: data
inhere/-file00: data
inhere/-file01: data
inhere/-file02: data
inhere/-file09: Non-ISO extended-ASCII text, with no line terminators
inhere/-file05: data
```
Variós tipos são retornados porém vejo que o **-file07** possui o tipo ASCII text que indica que o arquivo é um arquivo de texto ASCII e pode ser aberto e lido como texto legível por humanos.

```console
bandit4@bandit:~$ cat inhere/-file07 
lrIWWI6bB37kxfiCQZqUdOIYfr6eEeqR
```

Utilizando o comando **cat** obtenho o password para o próximo level:

```
lrIWWI6bB37kxfiCQZqUdOIYfr6eEeqR
```

Por fim saio do usuário atual por meio do comando **exit.**

```
bandit4@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
