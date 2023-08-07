# [Bandit Level 12-13](https://overthewire.org/wargames/bandit/bandit13.html)

## Descrição original
The password for the next level is stored in the file data.txt, which is a hexdump of a file that has been repeatedly compressed. For this level it may be useful to create a directory under /tmp in which you can work using mkdir. For example: mkdir /tmp/myname123. Then copy the datafile using cp, and rename it using mv (read the manpages!)


## Introdução
O objetivo desse level é realizar diversas descompressões de um arquivo que foi comprimido várias vezes e que atualmente é um **hexdump**. O desafio inclusive fornece uma sugestão de criar um diretório dentro de **/tmp** para facilitar a resolução do exercício.

    hexdump: é uma representação hexadecimal dos dados armazenados em um arquivo ou na memória de um computador. 

## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório atual.
```

```
xxd: utilizada para trabalhar com hexdumps e dados em formato hexadecimal.

-r: Essa opção indica que o comando xxd será utilizado para reverter (reverse) um hexdump em um arquivo binário original.
```

```
gzip: é usado para descomprimir ou comprimir um arquivo que foi compactado com o utilitário gzip.

-d: usado para descomprimir o arquivo.

-k: mantem o arquivo original após a descompressão.
```
```
tar: é usado para extrair arquivos de um arquivo tarball que foi previamente criado usando o comando tar.

-x: extrair arquivos do arquivo tarball
-k: usada para manter arquivos existentes
-d: Esta opção é seguida pelo nome do arquivo tarball do qual os arquivos serão extraídos. É obrigatória quando você deseja extrair arquivos de um arquivo tarball.

Um arquivo tarball é um tipo de arquivo que combina vários arquivos em um único arquivo sem compressão. 
```

```
bzip2:ferramenta de compressão e descompressão de arquivos

-d: descomprimir o arquivo.
-k: usada para manter o arquivo original após a descompressão.
-c: instrui o bzip2 a escrever o resultado da descompressão para a saída padrão (stdout)
>: usado para redirecionar a saída do comando para um novo arquivo. 
```

```
file: usada para identificar o tipo de um arquivo
```

```
cat: mostra o conteúdo de um ou mais arquivos de texto. A principal função do comando cat é concatenar, ou seja, combinar arquivos e exibir o resultado na saída padrão (geralmente a tela).
```
```
|(pipe): redireciona a saída de um comando para a entrada de outro comando.
```

```
--help: exibe uma mensagem de ajuda que fornece informações sobre como usar determinado comando.
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit12@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit12@bandit.labs.overthewire.org's password: JVNBBFSmZwKKOP0XbFXOoW8chDz5yVRv
```

```console
bandit12@bandit:~$ whoami
bandit12
```

Realizado o login vejo quais arquivos estão no meu diretório atual e encontro o arquivo **data.txt** o qual vou descomprimir diversas vezes para encontrar o password:

```console
bandit12@bandit:~$ ls
data.txt
```

Começo seguindo a orientação do desafio e faço uma cópia do arquivo **data.txt** para o diretório recém criado **desafio12**:

```console
bandit12@bandit:~$ mkdir /tmp/desafio12
bandit12@bandit:~$ cp data.txt /tmp/desafio12
```

Altero o diretório para o **/tmp/desafio12/**:

```console
bandit12@bandit:~$ cd /tmp/desafio12
bandit12@bandit:/tmp/desafio12$ ls
data.txt
```

Já que o arquivo está em formato hexadecimal vou alterar o seu formato(reverter) para o formato binário original usando a opção **-r**

```console
bandit12@bandit:/tmp/desafio12$ xxd --help
Usage:
    xxd [options] [infile [outfile]]
-r: reverse operation: convert (or patch) hexdump into binary.
```

Realizando a reversão para formato binário com o comando **xxd -r data.txt data** faço com que o resultado dessa reversão crie um novo arquivo chamado **data**:

```console
bandit12@bandit:/tmp/desafio12$ xxd -r data.txt data
bandit12@bandit:/tmp/desafio12$ ls
data  data.txt
```

Visualizo que o arquivo **data** recém criado está comprimido no formato **gzip:**

```console
bandit12@bandit:/tmp/desafio12$ file data
data: gzip compressed data, was "data2.bin", last modified: Sun Apr 23 18:04:23 2023, max compression, from Unix, original size modulo 2^32 581
```
Busco maiores informações de como posso fazer a descompressão de arquivos com essa extensão.

```console
bandit12@bandit:/tmp/desafio12$ gzip --help
Usage: gzip [OPTION]... [FILE]...
-d, --decompress  decompress
-k, --keep        keep (don't delete) input files
```

Duas opções me parecem interessantes: **-d** para descomprimir e **-k** para manter o arquivo original.

Caso eu tente usar o comando sem especificar a extensão do arquivo recebo o seguinte:

```console
bandit12@bandit:/tmp/desafio12$ gzip -dk data
gzip: data: unknown suffix -- ignored
```

Para evitar isso vou renomear esse arquivo adicionando a extensão **gz** e por questões de organização vou alterar o nome para **data2.bin** descoberto anteriormente no comando **file data**:

```console
bandit12@bandit:/tmp/desafio12$ mv data data2.bin.gz
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz  data.txt
```

Tentando novamente a descompressão com a extensão adicionada:
```console
bandit12@bandit:/tmp/desafio12$ gzip -dk data2.bin.gz
bandit12@bandit:/tmp/desafio12$ ls
data2.bin  data2.bin.gz  data.txt
```

Utilizando o comando file vejo que agora o arquivo está comprimido no formato **bzip2:**
```console
bandit12@bandit:/tmp/desafio12$ file data2.bin
data2.bin: bzip2 compressed data, block size = 900k
```

Vejo algumas informações de como utilizar o bzip2:
```console
bandit12@bandit:/tmp/desafio12$ bzip2 --help
   usage: bzip2 [flags and input files in any order]

   -d --decompress     force decompression
   -k --keep           keep (don't delete) input files
   -c --stdout         output to standard out
```

Da mesma forma que fiz com o gzip vou utilizar as opções: **-d** para descomprimir e **-k** para manter o arquivo original, adicionando apenas a opção **-c** e **>** para direcionar a saída para um arquivo especifico.

Altero novamente o nome do arquivo para adicionar a extensão:
```console
bandit12@bandit:/tmp/desafio12$ mv data2.bin data3.bin.bzip2
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz  data3.bin.bzip2  data.txt
```

Realizo a descompressão e obtenho um arquivo data4 comprimido no formato **gzip.**

```console
bandit12@bandit:/tmp/desafio12$ bzip2 -dk data3.bin.bzip2 -c > data4
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz  data3.bin.bzip2  data4  data.txt
```
```console
bandit12@bandit:/tmp/desafio12$ file data4
data4: gzip compressed data, was "data4.bin", last modified: Sun Apr 23 18:04:23 2023, max compression, from Unix, original size modulo 2^32 20480
```
Modifico o nome do arquivo para se adequar ao formato correto:
```console
bandit12@bandit:/tmp/desafio12$ mv data4 data4.bin.gz
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz  data3.bin.bzip2  data4.bin.gz  data.txt
```

Utilizando a ferramenta **gzip** faço a descompressão e obtenho o arquivo **data4.bin** no formato **tar:**
```console
bandit12@bandit:/tmp/desafio12$ gzip -dk data4.bin.gz 
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz  data3.bin.bzip2  data4.bin  data4.bin.gz  data.txt
```

```console
bandit12@bandit:/tmp/desafio12$ file data4.bin
data4.bin: POSIX tar archive (GNU)
```

Altero o nome para me ajudar na organização:
```console
bandit12@bandit:/tmp/desafio12$ mv data4.bin data5.bin.tar
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz  data3.bin.bzip2  data4.bin.gz  data5.bin.tar  data.txt
```


Pesquiso por informações do formato **tar:**
```console
bandit12@bandit:/tmp/desafio12$ tar --help
Usage: tar [OPTION...] [FILE]...
-x, --extract, --get: extract files from an archive
-k, --keep-old-files: don't replace existing files when extracting, treat them as errors
-f, --file=ARCHIVE: use archive file or device ARCHIVE
```

Vou utilizar as opções **-x** para extrair o conteúdo do arquivo, **-k** para manter o arquivo original e **-f** para especificar o nome do arquivo de entrada:

```console
bandit12@bandit:/tmp/desafio12$ tar -xkf data5.bin.tar
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz     data4.bin.gz  data5.bin.tar
data3.bin.bzip2  data5.bin     data.txt
```

Obtenho o arquivo **data5.bin** que está novamente no formato **tar**:
```console
bandit12@bandit:/tmp/desafio12$ file data5.bin
data5.bin: POSIX tar archive (GNU)
```

Modifico o nome do arquivo para  **data6.bin.tar:**

```console
bandit12@bandit:/tmp/desafio12$ mv data5.bin data6.bin.tar
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz     data4.bin.gz   data6.bin.tar
data3.bin.bzip2  data5.bin.tar  data.txt
```

Faço a extração novamente e obtenho o arquivo **data6.bin** no formato bzip2:

```console
bandit12@bandit:/tmp/desafio12$ tar -xkf data6.bin.tar 
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz     data4.bin.gz   data6.bin      data.txt
data3.bin.bzip2  data5.bin.tar  data6.bin.tar
```

```console
bandit12@bandit:/tmp/desafio12$ file data6.bin
data6.bin: bzip2 compressed data, block size = 900k
```

Altero o nome do arquivo obtido para **data7.bin.bzip2:**

```console
bandit12@bandit:/tmp/desafio12$ mv data6.bin data7.bin.bzip2
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz     data4.bin.gz   data6.bin.tar    data.txt
data3.bin.bzip2  data5.bin.tar  data7.bin.bzip2
```

Faço a descompressão e obtenho um novo arquivo com o formato **tar**:
```console
bandit12@bandit:/tmp/desafio12$ bzip2 -dk data7.bin.bzip2 -c > data8
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz     data4.bin.gz   data6.bin.tar    data8
data3.bin.bzip2  data5.bin.tar  data7.bin.bzip2  data.txt
```

```console
bandit12@bandit:/tmp/desafio12$ file data8
data8: POSIX tar archive (GNU)
```

Modifico o nome para se adequar a essa extensão:

```console
bandit12@bandit:/tmp/desafio12$ mv data8 data8.tar
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz     data4.bin.gz   data6.bin.tar    data8.tar
data3.bin.bzip2  data5.bin.tar  data7.bin.bzip2  data.txt
```

Realizo a extração e obtenho o arquivo **data8.bin** no formato **gzip**
```console
bandit12@bandit:/tmp/desafio12$ tar -xkf data8.tar 
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz     data4.bin.gz   data6.bin.tar    data8.bin  data.txt
data3.bin.bzip2  data5.bin.tar  data7.bin.bzip2  data8.tar
```

```console
bandit12@bandit:/tmp/desafio12$ file data8.bin
data8.bin: gzip compressed data, was "data9.bin", last modified: Sun Apr 23 18:04:23 2023, max compression, from Unix, original size modulo 2^32 49
```

Altero o nome do arquivo **data8.bin** obtido para **data9.bin.gz:**
```console
bandit12@bandit:/tmp/desafio12$ mv data8.bin data9.bin.gz
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz     data4.bin.gz   data6.bin.tar    data8.tar     data.txt
data3.bin.bzip2  data5.bin.tar  data7.bin.bzip2  data9.bin.gz
```

Realizo mais uma descompressão e obtenho o arquivo **data9.bin** no formato de texto:
```console
bandit12@bandit:/tmp/desafio12$ gzip -dk data9.bin.gz 
bandit12@bandit:/tmp/desafio12$ ls
data2.bin.gz     data4.bin.gz   data6.bin.tar    data8.tar  data9.bin.gz
data3.bin.bzip2  data5.bin.tar  data7.bin.bzip2  data9.bin  data.txt
```
```console
bandit12@bandit:/tmp/desafio12$ file data9.bin
data9.bin: ASCII text
```

Utilizo o comando **cat** e visualizo o password para o próximo level:
```console
bandit12@bandit:/tmp/desafio12$ cat data9.bin
The password is wbWdlBxEir4CaE8LaPhauuOo6pwRmrDw
```

    wbWdlBxEir4CaE8LaPhauuOo6pwRmrDw

Por fim saio do usuário atual por meio do comando **exit**:

```console
bandit12@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```