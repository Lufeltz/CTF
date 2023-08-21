# [Bandit Level 33-34](https://overthewire.org/wargames/bandit/bandit34.html)

## Descrição original
At this moment, level 34 does not exist yet.

## Introdução
O objetivo desse level ainda não foi criado, então o level anterior(bandit33) é o último desafio realizado.

## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório especificado.
```

```
whoami: exibe o nome do usuário que está atualmente logado no terminal ou no sistema operacional.
```

```
cat: exibe o conteúdo de um ou mais arquivos de texto diretamente no terminal.
```


## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit33@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit33@bandit.labs.overthewire.org's password: odHo63fHiFqcWWJG9rLiLDtPm45KzUKy
```

Confirmo que estou atualmente no usuário **bandit33:**
```console
bandit33@bandit:~$ whoami
bandit33
```

Faço uma listagem dos arquivos no diretório **home** e encontro o seguinte:

```console
bandit33@bandit:~$ ls
README.txt
```

Abro esse arquivo e encontro uma mensagem de parabenização por finalizar o último level desse jogo, também sou informado que nesse momento é o último level, porém em breve serão disponibilizados outros desafios.
```console
bandit33@bandit:~$ cat README.txt 
Congratulations on solving the last level of this game!

At this moment, there are no more levels to play in this game. However, we are constantly working
on new levels and will most likely expand this game with more levels soon.
Keep an eye out for an announcement on our usual communication channels!
In the meantime, you could play some of our other wargames.

If you have an idea for an awesome new level, please let us know!

```

Dessa forma finalizo todos os desafios atuais do wargame **bandit** da comunidade **OverTheWire.**

Por fim saio do usuário atual por meio do comando exit.

```console
bandit33@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```