# apiLivebox
script écrit en php pour automatiser les actions d'une livebox (renouveler ip pour pyload)

# dépandence
les packet : php5 (https://packages.debian.org/jessie/php5) et php5-curl (https://packages.debian.org/jessie/php5-curl)

sudo apt-get install php5 php5-curl

# usage

./reconnection
renouvelle l'ip (pour les ip dynamique)

donne la nouvelle  ip

./reboot
redémare la box

./scanWifiCanal
rescanne les wifis pour utiliser le canal le moins brouillé


