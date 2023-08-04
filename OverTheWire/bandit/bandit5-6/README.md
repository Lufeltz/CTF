# [Bandit Level 5-6](https://overthewire.org/wargames/bandit/bandit6.html)

## Descrição original
The password for the next level is stored in a file somewhere under the inhere directory and has all of the following properties:

    human-readable
    1033 bytes in size
    not executable


## Introdução
O objetivo desse level é identificar um arquivo dentro do diretório **inhere** que possui as seguintes características: human-readable(contém informações em um formato que pode ser lido e compreendido por humanos), tamanho de 1033 bytes e não tem permissão de execução.


## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório atual.

-l: exibe uma listagem detalhada dos arquivos e diretórios no diretório atual 

-F: adiciona indicadores aos nomes dos arquivos listados pelo ls.

    /: O caractere barra (/) é adicionado ao final do nome de diretórios.
    *: O caractere asterisco (*) é adicionado ao final do nome de arquivos executáveis.
    @: O caractere arroba (@) é adicionado ao final do nome de arquivos com atributos 
```

```
find inhere/: busca arquivos no diretório especificado.

-type f: indica que estamos buscando apenas arquivos regulares(files, ignorando diretórios ou links).

-size 1033c: O tamanho do arquivo deve ser de exatamente 1033 bytes (o sufixo "c" indica bytes).
    c: bytes.
    k: kilobytes.
    M: megabytes.
    G: gigabytes.

! -executable: O arquivo não deve ser executável. O operador ! nega a condição, ou seja, estamos procurando por arquivos que não sejam executáveis.

-readable: busca arquivos que sejam legíveis pelo usuário atual. Isso geralmente inclui arquivos de texto e outros formatos que podem ser abertos e lidos por humanos.
```

```
cat: mostra o conteúdo de um ou mais arquivos de texto. A principal função do comando cat é concatenar, ou seja, combinar arquivos e exibir o resultado na saída padrão (geralmente a tela).
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit5@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit5@bandit.labs.overthewire.org's password: lrIWWI6bB37kxfiCQZqUdOIYfr6eEeqR
```

```console
bandit5@bandit:~$ whoami
bandit5
```

Realizado o login vejo quais arquivos estão no meu diretório atual.

```console
bandit5@bandit:~$ ls
inhere
```

Mostrando o conteúdo desse diretório **inhere** com **ls** encontro o seguinte:

```console
bandit5@bandit:~$ ls -F inhere/
maybehere00/  maybehere04/  maybehere08/  maybehere12/  maybehere16/
maybehere01/  maybehere05/  maybehere09/  maybehere13/  maybehere17/
maybehere02/  maybehere06/  maybehere10/  maybehere14/  maybehere18/
maybehere03/  maybehere07/  maybehere11/  maybehere15/  maybehere19/
```

Com a ajuda do **ls -F** sei que são 20 diretórios e visualizando o conteúdo de um diretório qualquer, vejo que existem vários arquivos dentro dele:

```console
bandit5@bandit:~$ ls -F inhere/maybehere00
-file1*  -file2  -file3*  spaces file1*  spaces file2  spaces file3*
```
Como seria inviável procurar esse arquivo de forma manual, vou utilizar o comando **find** para me auxiliar nessa busca.

```console
bandit5@bandit:~$ find inhere/ -type f -size 1033c ! -executable -readable
inhere/maybehere07/.file2
```

Um único arquivo é encontrado e caso eu use **ls -l** para fazer uma listagem detalhada do arquivo eu vejo que todas as caracteristícas batem e posso visualizar o password armazenado:

```console
bandit5@bandit:~$ ls -l inhere/maybehere07/.file2
-rw-r----- 1 root bandit5 1033 Apr 23 18:04 inhere/maybehere07/.file2
```
O hífen na primeira posição indica que é um arquivo(file) e não um diretório(d).

As permissões nesse caso são somente de leitura(**read - r**) e escrita(**write - w**), já que não é mostrada nenhuma de execute(**execução - x**).

O tamanho pode ser claramente visto sendo **1033.**

Por fim como eu posso abrir esse arquivo com o **cat** no próximo passo confirmo que ele é **human-readable.**

```console
bandit5@bandit:~$ cat inhere/maybehere07/.file2
P4L4vucdmLnm8I7Vl7jG1ApGSfjYKqJU
```

Após utilizar o comando **cat** obtenho o password para o próximo level:

```
P4L4vucdmLnm8I7Vl7jG1ApGSfjYKqJU
```

Por fim saio do usuário atual por meio do comando **exit**:

```console
bandit5@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
