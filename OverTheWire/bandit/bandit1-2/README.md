# [Bandit Level 1-2](https://overthewire.org/wargames/bandit/bandit2.html)

### Descrição original
The password for the next level is stored in a file called - located in the home directory

### Introdução
O objetivo desse level é abrir um arquivo no diretório home que tem como nome -, ou seja, um hífen


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

```
pwd: exibe o diretório atual em que o usuário se encontra. 
```

### Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit1@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit1@bandit.labs.overthewire.org's password: NH2SXQwcBdpmTEzi3bvBHMM9H66vVXjL
```

```console
bandit1@bandit:~$ whoami
bandit1
```

Realizado o login vejo quais arquivos estão no meu diretório atual.

```console
bandit1@bandit:~$ ls
-
```

Somente o arquivo chamado - se encontra no diretório atual, porém caso eu tenho usar **cat -** o prompt ficará aguardando que eu digite, isso ocorre devido ao prompt nesse caso interpretar o nome do arquivo - como uma opção do próprio comando **cat**, em vez de um nome de arquivo válido.

```console
bandit1@bandit:~$ cat -
_
```

Para contornar isso algumas opções são:

Redirecionar o arquivo - para o comando cat usando o operador **<**

```console
bandit1@bandit:~$ cat < -
rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```

Ou também utilizando os caminhos relativo e absoluto.

Caminho relativo(o caractere . indica o diretório atual):

```console
bandit1@bandit:~$ cat ./-
rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```

Caminho absoluto:

```console
bandit1@bandit:~$ cat /home/bandit1/-
rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```
Dica: o caminho atual pode ser obtido com o comando **pwd**.

```console
bandit1@bandit:~$ pwd
/home/bandit1
bandit1@bandit:~$ cat /home/bandit1/-
rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```

Com o password obtido posso utilizá-lo para me autenticar no próximo desafio.

```
rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```

Por fim saio do usuário atual por meio do comando **exit.**

```console
bandit1@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
