# [Bandit Level 0-1](https://overthewire.org/wargames/bandit/bandit0.html)

### Descrição original
The goal of this level is for you to log into the game using SSH. The host to which you need to connect is bandit.labs.overthewire.org, on port 2220. The username is bandit0 and the password is bandit0. Once logged in, go to the Level 1 page to find out how to beat Level 1.

### Introdução
<p>O objetivo desse level é logar no jogo através do servidor bandit.labs.overthewire.org usando uma conexão SSH na porta 2220 com o usuário <strong>bandit0</strong>. Após realizado o login é necessário verificar o <a href="https://overthewire.org/wargames/bandit/bandit1.html">level 0-1</a> para maiores instruções de como passar para o pŕoximo level. O password também é informado sendo <strong>bandit0</strong>.</p>


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
└─$ ssh bandit0@bandit.labs.overthewire.org -p 2220
```
O aviso abaixo aparece quando você está tentando estabelecer uma conexão SSH com um servidor remoto e a chave pública do servidor não está reconhecida ou armazenada no arquivo de chaves conhecidas do seu sistema.


```
The authenticity of host '[bandit.labs.overthewire.org]:2220 ([16.16.8.216]:2220)' can't be established.
ED25519 key fingerprint is SHA256:C2ihUBV7ihnV1wUXRb4RrEcLfXC5CXlhmAAM/urerLY.
This key is not known by any other names.
Are you sure you want to continue connecting (yes/no/[fingerprint])? yes
```
Basta escrever **yes** para adicionar essa chave pública ao seu sistema.

```
Warning: Permanently added '[bandit.labs.overthewire.org]:2220' (ED25519) to the list of known hosts.
```

Logo após essa adição insiro o password bandit0 fornecido no desafio e a autenticação com o usuário bandit0 é realizada(note que não será possível ver o password devido a uma medida de segurança).

```
bandit0@bandit.labs.overthewire.org's password: bandit0
```

```console
bandit0@bandit:~$ whoami
bandit0
```

Feito login, verifico as instruções do [level 0-1](https://overthewire.org/wargames/bandit/bandit1.html) onde é informado que o password para o próximo level está armazenado em um arquivo chamado readme no diretório home.

Usando o comando **ls** vejo que o arquivo mencionado está no diretório atual e ao utilizar o **cat** visualizo o password que será utilizado para fazer login no usuário **bandit1**.

```console
bandit0@bandit:~$ ls
readme
bandit0@bandit:~$ cat readme
NH2SXQwcBdpmTEzi3bvBHMM9H66vVXjL
```

Por fim saio do usuário atual por meio do comando **exit.**

```console
bandit0@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```
