# [Bandit Level 11-12](https://overthewire.org/wargames/bandit/bandit12.html)

## Descrição original
The password for the next level is stored in the file data.txt, where all lowercase (a-z) and uppercase (A-Z) letters have been rotated by 13 positions


## Introdução
O objetivo desse level é decifrar o password armazenado no arquivo **data.txt** que possui uma criptografia semelhante a cifra de César onde cada letra no texto é deslocada para um certo número de posições a frente, nesse caso 13 posições, ou seja a posição atual da letra **'a'** seria a posição da letra **'n'**.


## Comandos utilizados:

```
ssh: permite que você acesse e controle um computador remoto de forma segura, como se estivesse interagindo diretamente com a máquina.

-p: determina em qual porta a conexão com o servidor será realizada.
```

```
ls: lista o conteúdo do diretório atual.
```
```
tr: realiza transformações de caracteres em um fluxo de entrada
```
```
cat: mostra o conteúdo de um ou mais arquivos de texto. A principal função do comando cat é concatenar, ou seja, combinar arquivos e exibir o resultado na saída padrão (geralmente a tela).
```
```
|(pipe): redireciona a saída de um comando para a entrada de outro comando.
```



## Resolução

```
┌──(lufeltz㉿lufeltz)-[~]
└─$ ssh bandit11@bandit.labs.overthewire.org -p 2220
```

Logo após iniciar essa conexão com o ssh informo o password obtido no desafio anterior.

```
bandit11@bandit.labs.overthewire.org's password: 6zPeziLdR2RKNdNYFNb6nVCKzphlXHBM
```

```console
bandit11@bandit:~$ whoami
bandit11
```

Realizado o login vejo quais arquivos estão no meu diretório atual e encontro o arquivo **data.txt** o qual vou decodificar para encontrar o password:

```console
bandit11@bandit:~$ ls
data.txt
```

Mostrando o conteúdo do arquivo pode ser visto a codificação atual:
```console
bandit11@bandit:~$ cat data.txt
Gur cnffjbeq vf WIAOOSFzMjXXBC0KoSKBbJ8puQm5lIEi
```

Já que preciso fazer uma transformação dos caracteres mudando suas posições, uma ótima alternativa é utilizar o comando **tr** para modificar o fluxo de entrada:

```console
bandit11@bandit:~$ cat data.txt | tr 'a-zA-Z' 'n-za-mN-ZA-M'
The password is JVNBBFSmZwKKOP0XbFXOoW8chDz5yVRv
```

Acima ocorreu o seguinte: 

O comando **cat** lê o contéudo do arquivo **data.txt** e redireciona para o comando **tr** realizar a transformação.

O primeiro argumento do **tr** é o conjunto de caracteres **'a-zA-Z'** que terá a ordem modificada e que representa todas as letras minúsculas **a-z** e todas as maiúsculas **A-Z** na ordem alfabética comum. No segundo argumento **'n-za-mN-ZA-M'** a posição das letras da primeira string **'a-zA-Z'** é alterada para 13 posições a frente da seguinte forma:

    'a' será substituído por 'n'
    'b' será substituído por 'o'
    'c' será substituído por 'p'
    ...
    'z' será substituído por 'm'

    'A' será substituído por 'N'
    'B' será substituído por 'O'
    'C' será substituído por 'P'
    ...
    'Z' será substituído por 'M'

    
Após a decodificação com **tr** obtenho o password para o próximo level:

    JVNBBFSmZwKKOP0XbFXOoW8chDz5yVRv

Por fim saio do usuário atual por meio do comando **exit**:

```console
bandit11@bandit:~$ exit
logout
Connection to bandit.labs.overthewire.org closed.
```