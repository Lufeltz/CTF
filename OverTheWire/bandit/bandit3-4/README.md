<h1><a href="https://overthewire.org/wargames/bandit/bandit4.html">Bandit Level 3-4</a></h1>

<h3>Descrição original</h3>
<p>The password for the next level is stored in a hidden file in the inhere directory.</p>

<h3>Introdução</h3>
<p>O objetivo desse level é encontrar o password que está em um arquivo oculto dentro do diretório inhere.</p>


<h3>Comandos utilizados:</h3>

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

<h3>Resolução</h3>

```bash
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit3@bandit.labs.overthewire.org -p 2220
```

<p>Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.</p>

```
bandit3@bandit.labs.overthewire.org's password: aBZ0W5EmUfAf7kHTQeOwd8bauFJ2lAiG
```

```
bandit3@bandit:~$ whoami
bandit3
```

<p>Realizado o login vejo quais arquivos estão no meu diretório atual.</p>

```
bandit3@bandit:~$ ls
inhere
```

<p>Mostrando o conteúdo desse diretório inhere com apenas o comando <strong>ls</strong> não exibe os arquivos ocultos que possam existir nesse diretório:</p>

```
bandit3@bandit:~$ ls inhere/
```
<p>Como não tem nenhum conteúdo nesse diretório além do arquivo oculto não tenho nenhuma reposta desse comando.</p>


<p>Agora ao utilizar a opção -a em conjunto com o ls obtenho o seguinte:</p>

```
bandit3@bandit:~$ ls -a inhere/
.  ..  .hidden
```

<p>Sabendo o nome do arquivo utilizo o cat nesse arquivo:</p>

```
bandit3@bandit:~$ cat inhere/.hidden 
2EW7BBsr6aMMoJ2HjW067dm8EgX26xNe
```

<p>Dessa forma obtenho o password para o próximo level:</p>

```
2EW7BBsr6aMMoJ2HjW067dm8EgX26xNe
```

<p>Por fim saio do usuário atual por meio do comando exit:</p>

```
bandit3@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
