<h1><a href="https://overthewire.org/wargames/bandit/bandit3.html">Bandit Level 2-3</a></h1>

<h3>Descrição original</h3>
<p>The password for the next level is stored in a file called spaces in this filename located in the home directory</p>

<h3>Introdução</h3>
<p>O objetivo desse level é abrir um arquivo no diretório home chamado spaces in this filename, o qual possui espaços no seu nome. </p>


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

<h3>Resolução</h3>

```bash
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit2@bandit.labs.overthewire.org -p 2220
```

<p>Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.</p>

```
bandit2@bandit.labs.overthewire.org's password: rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```

```
bandit2@bandit:~$ whoami
bandit2
```

<p>Realizado o login vejo quais arquivos estão no meu diretório atual.</p>

```
bandit2@bandit:~$ ls
spaces in this filename
```

<p>Caso eu tente abrir esse arquivo com o cat simplesmente escrevendo o nome do arquivo recebo a resposta a seguir:</p>

```
bandit2@bandit:~$ cat spaces in this filename
cat: spaces: No such file or directory
cat: in: No such file or directory
cat: this: No such file or directory
cat: filename: No such file or directory
```

<p>Isso ocorre devido ao cat interpretar cada um dos argumentos depois dele separados por um espaço como arquivos diferentes e tenta abri-los de forma individual resultando no resultado acima.</p>


<p>Caso eu utilize cat e comece a escrever o nome do arquivo e depois pressionar tab ocorre o seguinte:</p>

```
bandit2@bandit:~$ cat spaces\ in\ this\ filename 
aBZ0W5EmUfAf7kHTQeOwd8bauFJ2lAiG
```
<p>A abordagem acima utiliza a barra invertida para realizar um 'escape' dos espaços, indicando que eles fazem parte do nome do arquivo.</p>

<p>Outra forma seria colocar o nome do arquivo entre aspas dizendo para o cat que o conteúdo dentro das aspas faz parte do nome completo do arquivo. </p>

```
bandit2@bandit:~$ cat 'spaces in this filename' 
aBZ0W5EmUfAf7kHTQeOwd8bauFJ2lAiG
```

<p>Ambas as formas funcionam porém acho a última mais interessante e simples de utilizar.</p>


<p>Dessa forma obtenho o password para o próximo level</p>

```
aBZ0W5EmUfAf7kHTQeOwd8bauFJ2lAiG
```

<p>Por fim saio do usuário atual por meio do comando exit</p>

```
bandit2@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
