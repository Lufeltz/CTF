# [Bandit Level 6-7](https://overthewire.org/wargames/bandit/bandit7.html)

## Descrição original
The password for the next level is stored somewhere on the server and has all of the following properties:

    owned by user bandit7
    owned by group bandit6
    33 bytes in size


## Introdução
O objetivo desse level é identificar um arquivo em algum lugar dentro do **servidor** que possui as seguintes propriedades: é de propriedade do usuário **bandit7** e do grupo **bandit6**, além disso possui um tamanho de **33 bytes.**


## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório atual.
```

```
find /: busca arquivos começando do diretório raiz do sistema.

-type f: indica que estamos buscando apenas arquivos regulares(files, ignorando diretórios ou links).

-group bandit6: busca arquivos pertencentes ao grupo "bandit6".

-user bandit7: busca arquivos que pertencem ao usuário "bandit7".

2> /dev/null: Redireciona a saída de erro (stderr) para /dev/null, descartando qualquer mensagem de erro que possa ser gerada durante a execução do comando find.
```

```
cat: mostra o conteúdo de um ou mais arquivos de texto. A principal função do comando cat é concatenar, ou seja, combinar arquivos e exibir o resultado na saída padrão (geralmente a tela).
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit6@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit6@bandit.labs.overthewire.org's password: P4L4vucdmLnm8I7Vl7jG1ApGSfjYKqJU
```

```console
bandit6@bandit:~$ whoami
bandit6
```

Realizado o login vejo quais arquivos estão no meu diretório atual no qual não obtenho nenhuma resposta indicando que nenhum diretório ou arquivo visível está presente aqui.

```console
bandit6@bandit:~$ ls
```

Como será necessário procurar por todo o servidor, o comando **find** parece ser uma abordagem excelente.

```console
bandit6@bandit:~$ find / -type f -group bandit6 -user bandit7 -size 33c
find: ‘/var/log’: Permission denied
find: ‘/var/crash’: Permission denied
find: ‘/var/spool/rsyslog’: Permission denied
find: ‘/var/spool/bandit24’: Permission denied
...
```
Contudo ao fazer essa pesquisa recebo diversas mensagens que não tenho permissão para acessar determinados diretórios. Além disso mesmo que eu encontre o arquivo qual a utilidade se está no meio de centenas de mensagens de permissões de acesso negadas?

Uma opção muito interessante seria direcionar as mensagens de erro para para outro local deixando somente as mensagens de sucesso e informações.

    0 (stdin - Standard Input): está associada ao teclado, permitindo que os comandos interajam com o usuário através da digitação.

    1 (stdout - Standard Output): É a saída padrão para mensagens de sucesso e informações, fazendo com que as mensagens sejam exibidas na tela.

    2 (stderr - Standard Error): É a saída padrão para mensagens de erro e informações de diagnóstico.


Como pode ser visto acima a saida 2 se refere as mensagens de erro, logo vou redirecionar a saída dela para algum outro local sendo nesse caso  **/dev/null** .

    /dev/null: é usado para descartar qualquer dado que seja escrito nele. Ao redirecionar a saída para /dev/null, os dados enviados para lá simplesmente desaparecem, ou seja, são descartados silenciosamente, sem ocupar espaço em disco ou ter qualquer efeito.


```console
bandit6@bandit:~$ find / -type f -group bandit6 -user bandit7 2> /dev/null
/var/lib/dpkg/info/bandit7.password
```

Após executar o comando redirecionando as saídas de erros para outro local recebo como resposta o arquivo **bandit7.password**.

```console
bandit6@bandit:~$ cat /var/lib/dpkg/info/bandit7.password
z7WtoNQU2XfjmMtWA8u5rN4vzqu4v99S
```

Com o comando **cat** obtenho o password para o próximo desafio.

```
z7WtoNQU2XfjmMtWA8u5rN4vzqu4v99S
```

Por fim saio do usuário atual por meio do comando **exit**:

```console
bandit6@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
