# [Bandit Level 3-4](https://overthewire.org/wargames/bandit/bandit4.html)

### Descrição original
The password for the next level is stored in a hidden file in the inhere directory.

### Introdução
O objetivo desse level é encontrar o password que está em um arquivo oculto dentro do diretório inhere.

### Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório atual.
-a: não ignora entradas que comecem com ., ou seja, também mostra os diretórios ocultos.
```

```
cat: mostra o conteúdo de um ou mais arquivos de texto. A principal função do comando cat é concatenar, ou seja, combinar arquivos e exibir o resultado na saída padrão (geralmente a tela).
```

### Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit3@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit3@bandit.labs.overthewire.org's password: aBZ0W5EmUfAf7kHTQeOwd8bauFJ2lAiG
```

```console
bandit3@bandit:~$ whoami
bandit3
```

Realizado o login vejo quais arquivos estão no meu diretório atual.

```console
bandit3@bandit:~$ ls
inhere
```

Mostrando o conteúdo desse diretório inhere com apenas o comando **ls** não exibe os arquivos ocultos que possam existir nesse diretório:

```console
bandit3@bandit:~$ ls inhere/
```
Como não tem nenhum conteúdo nesse diretório além do arquivo oculto não tenho nenhuma reposta desse comando.

Agora ao utilizar a opção **-a** em conjunto com o **ls** obtenho o seguinte:

```console
bandit3@bandit:~$ ls -a inhere/
.  ..  .hidden
```

Sabendo o nome do arquivo utilizo o **cat** nesse arquivo:

```console
bandit3@bandit:~$ cat inhere/.hidden 
2EW7BBsr6aMMoJ2HjW067dm8EgX26xNe
```

Dessa forma obtenho o password para o próximo level:

```
2EW7BBsr6aMMoJ2HjW067dm8EgX26xNe
```

Por fim saio do usuário atual por meio do comando **exit.**

```
bandit3@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
