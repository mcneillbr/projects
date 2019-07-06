#!/bin/bash

# create dir .ssh, home user
cd ~ && mkdir -p .ssh && chmod 700 .ssh
touch ~/.ssh/known_hosts
#
# > Generating public/private rsa key pair.
#linux no password
ssh-keygen -t rsa -b 4096
#git usa o email 
ssh-keygen -t rsa -b 4096 -C "your_email@example.com"
#> Enter a file in which to save the key (/c/Users/you/.ssh/id_rsa):[Press enter], padrão ssh -vvvvv
#> Enter passphrase (empty for no passphrase): [Type a passphrase]
#> Enter same passphrase again: [Type passphrase again]

#
cd ~ && mkdir -p .ssh && chmod 700 .ssh
#chmod 600 .ssh/id_rsa && chmod 640 .ssh/id_*.pub
chmod 600 ~/.ssh/*

# start the ssh-agent in the background
eval $(ssh-agent -s)
#> Agent pid 59566
ssh-add <(cat ~/.ssh/id_rsa)

#limpar chaves
 echo "" > ~/.ssh/authorized_keys

#
cat ~/.ssh/id_*rsa.pub | ssh root@srv-bkp01 'cat >> .ssh/authorized_keys'

#verificar login sem senha
ssh root@srv-bkp01
