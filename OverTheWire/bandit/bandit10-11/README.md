# [Bandit Level 10-11](https://overthewire.org/wargames/bandit/bandit11.html)

## Descrição original
The password for the next level is stored in the file data.txt, which contains base64 encoded data


## Introdução
O objetivo desse level é fazer uma decodificação do arquivo **data.txt** que no momento está codificado em **base64** e obter o password.


## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório atual.
```

```
cat: mostra o conteúdo de um ou mais arquivos de texto. A principal função do comando cat é concatenar, ou seja, combinar arquivos e exibir o resultado na saída padrão (geralmente a tela).
```
```
|(pipe): redireciona a saída de um comando para a entrada de outro comando.
```
```
base64: codifica e decodifica dados em base64. 

-d: -d (ou --decode) é usada para indicar que o comando deve decodificar o conteúdo do arquivo.
```
```
--help: quando usada com um comando, exibe informações de ajuda e uma breve descrição sobre como usar esse comando.
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit10@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit10@bandit.labs.overthewire.org's password: G7w8LIi6J3kTb8A7j9LgrywtEUlyyp6s
```

```console
bandit10@bandit:~$ whoami
bandit10
```

Realizado o login vejo quais arquivos estão no meu diretório atual e encontro o arquivo **data.txt** no qual vou procurar o password:

```console
bandit10@bandit:~$ ls
data.txt
```

Mostrando o conteúdo do arquivo pode ser visto a codificação atual:
```console
bandit10@bandit:~$ cat data.txt 
VGhlIHBhc3N3b3JkIGlzIDZ6UGV6aUxkUjJSS05kTllGTmI2blZDS3pwaGxYSEJNCg==
```

Já que o arquivo está codificado em **base64** uso o próprio comando para obter informações sobre como decodificar os dados do arquivo:

```console
bandit10@bandit:~$ base64 --help
Usage: base64 [OPTION]... [FILE]
Base64 encode or decode FILE, or standard input, to standard output.

With no FILE, or when FILE is -, read standard input.

Mandatory arguments to long options are mandatory for short options too.
  -d, --decode          decode data
```

Vejo que a opção **-d** me permite decodificar os dados em formato **base64**.

```console
bandit10@bandit:~$ base64 -d data.txt 
The password is 6zPeziLdR2RKNdNYFNb6nVCKzphlXHBM
```

Decodifico fácilmente o arquivo e obtenho o password para o próximo level:

    6zPeziLdR2RKNdNYFNb6nVCKzphlXHBM

Por fim saio do usuário atual por meio do comando **exit**:

```console
bandit10@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```