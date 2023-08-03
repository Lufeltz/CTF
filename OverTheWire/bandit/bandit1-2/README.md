<h1><a href="https://overthewire.org/wargames/bandit/bandit2.html">Bandit Level 1-2</a></h1>

<h3>Descrição original</h3>
<p>The password for the next level is stored in a file called - located in the home directory</p>

<h3>Introdução</h3>
<p>O objetivo desse level é abrir um arquivo no diretório home que tem como nome -, ou seja, um hífen</p>


<h3>Comandos utilizados:</h3>

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

<h3>Resolução</h3>

```bash
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit1@bandit.labs.overthewire.org -p 2220
```

<p>Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.</p>

```
bandit1@bandit.labs.overthewire.org's password: NH2SXQwcBdpmTEzi3bvBHMM9H66vVXjL
```

```
bandit1@bandit:~$ whoami
bandit1
```

<p>Realizado o login vejo quais arquivos estão no meu diretório atual.</p>

```
bandit1@bandit:~$ ls
-
```

<p>Somente o arquivo chamado - se encontra no diretório atual, porém caso eu tenho usar cat - o prompt ficará aguardando que eu digite, isso ocorre devido ao prompt nesse caso interpretar o nome do arquivo - como uma opção do próprio comando cat, em vez de um nome de arquivo válido.</p>

```
bandit1@bandit:~$ cat -
_
```

<p>Para contornar isso algumas opções são:</p>

<p>Redirecionar o arquivo - para o comando cat usando o operador <</p>

```
bandit1@bandit:~$ cat < -
rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```

<p>Ou também utilizando os caminhos relativo e absoluto.</p>

<p>Caminho relativo(o caractere . indica o diretório atual):</p>

```
bandit1@bandit:~$ cat ./-
rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```

<p>Caminho absoluto:</p>

```
bandit1@bandit:~$ cat /home/bandit1/-
rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```
<p>Dica: o caminho atual pode ser obtido com o comando <strong>pwd</strong>.</p>

```
bandit1@bandit:~$ pwd
/home/bandit1
bandit1@bandit:~$ cat /home/bandit1/-
rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```

<p>Com o password obtido posso utilizá-lo para me autenticar no próximo desafio.</p>

```
rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```

<p>Por fim saio do usuário atual por meio do comando exit</p>

```
bandit1@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
