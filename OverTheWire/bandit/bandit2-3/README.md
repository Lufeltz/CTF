# [Bandit Level 2-3](https://overthewire.org/wargames/bandit/bandit3.html)

### Descrição original
The password for the next level is stored in a file called spaces in this filename located in the home directory

### Introdução
O objetivo desse level é abrir um arquivo no diretório home chamado spaces in this filename, o qual possui espaços no seu nome.


### Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo
diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório atual
```

```
cat: mostra o conteúdo de um ou mais arquivos de texto. A principal função do comando cat é concatenar,
ou seja, combinar arquivos e exibir o resultado na saída padrão (geralmente a tela).
```

### Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit2@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit2@bandit.labs.overthewire.org's password: rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```

```console
bandit2@bandit:~$ whoami
bandit2
```

Realizado o login vejo quais arquivos estão no meu diretório atual.

```console
bandit2@bandit:~$ ls
spaces in this filename
```

Caso eu tente abrir esse arquivo com o cat simplesmente escrevendo o nome do arquivo recebo a resposta a seguir:

```console
bandit2@bandit:~$ cat spaces in this filename
cat: spaces: No such file or directory
cat: in: No such file or directory
cat: this: No such file or directory
cat: filename: No such file or directory
```

Isso ocorre devido ao cat interpretar cada um dos argumentos depois dele separados por um espaço como arquivos diferentes e tenta abri-los de forma individual resultando no resultado acima.


Caso eu utilize cat e comece a escrever o nome do arquivo e depois pressionar tab ocorre o seguinte:

```console
bandit2@bandit:~$ cat spaces\ in\ this\ filename 
aBZ0W5EmUfAf7kHTQeOwd8bauFJ2lAiG
```
A abordagem acima utiliza a barra invertida para realizar um 'escape' dos espaços, indicando que eles fazem parte do nome do arquivo.

Outra forma seria colocar o nome do arquivo entre aspas dizendo para o cat que o conteúdo dentro das aspas faz parte do nome completo do arquivo.

```console
bandit2@bandit:~$ cat 'spaces in this filename' 
aBZ0W5EmUfAf7kHTQeOwd8bauFJ2lAiG
```

Ambas as formas funcionam porém acho a última mais interessante e simples de utilizar.


Dessa forma obtenho o password para o próximo level:

```
aBZ0W5EmUfAf7kHTQeOwd8bauFJ2lAiG
```

Por fim saio do usuário atual por meio do comando **exit.**

```console
bandit2@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
