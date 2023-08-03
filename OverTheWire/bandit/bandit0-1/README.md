<h1><a href="https://overthewire.org/wargames/bandit/bandit0.html">Bandit Level 0-1</a></h1>

<h3>Descrição original</h3>
<p>The goal of this level is for you to log into the game using SSH. The host to which you need to connect is bandit.labs.overthewire.org, on port 2220. The username is bandit0 and the password is bandit0. Once logged in, go to the Level 1 page to find out how to beat Level 1.</p>

<h3>Introdução</h3>
<p>O objetivo desse level é logar no jogo através do servidor bandit.labs.overthewire.org usando uma conexão SSH na porta 2220 com o usuário <strong>bandit0</strong>. Após realizado o login é necessário verificar o <a href="https://overthewire.org/wargames/bandit/bandit1.html">level 0-1</a> para maiores instruções de como passar para o pŕoximo level. O password também é informado sendo <strong>bandit0</strong>.</p>


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

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit0@bandit.labs.overthewire.org -p 2220
```
<p>O aviso abaixo aparece quando você está tentando estabelecer uma conexão SSH com um servidor remoto e a chave pública do servidor não está reconhecida ou armazenada no arquivo de chaves conhecidas do seu sistema.</p>


```
The authenticity of host '[bandit.labs.overthewire.org]:2220 ([16.16.8.216]:2220)' can't be established.
ED25519 key fingerprint is SHA256:C2ihUBV7ihnV1wUXRb4RrEcLfXC5CXlhmAAM/urerLY.
This key is not known by any other names.
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
```
<p>Basta escrever <strong>yes</strong> para adicionar essa chave pública ao seu sistema.</p>

```
Warning: Permanently added '[bandit.labs.overthewire.org]:2220' (ED25519) to the list of known hosts.
```

<p>Logo após essa adição insiro o password bandit0 fornecido no desafio e a autenticação com o usuário bandit0 é realizada(note que não será possível ver o password devido a uma medida de segurança).</p>

```
bandit0@bandit.labs.overthewire.org's password: bandit0
```

```
bandit0@bandit:~$ whoami
bandit0
```

<p>Feito login, verifico as instruções do <a href="https://overthewire.org/wargames/bandit/bandit1.html">level 0-1</a> onde é informado que o password para o próximo level está armazenado em um arquivo chamado readme no diretório home.</p>

<p>Usando o comando <strong>ls</strong> vejo que o arquivo mencionado está no diretório atual e ao utilizar o <strong>cat</strong> visualizo o password que será utilizado para fazer login no usuário <strong>bandit1</strong>.</p>

```
bandit0@bandit:~$ ls
readme
bandit0@bandit:~$ cat readme
NH2SXQwcBdpmTEzi3bvBHMM9H66vVXjL
```

<p>Por fim saio do usuário atual por meio do comando exit</p>

```
bandit0@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
