# apiLivebox
script écri en php pour automatisé les action d'une livebox ( renouveler ip pour pyload)

# dépandence
les packet : php5 (https://packages.debian.org/jessie/php5) et php5-curl (https://packages.debian.org/jessie/php5-curl)
sudo apt-get install php5 php5-curl

# usage

./reconnection
renouvel l'ip (pour les ip dynamique)
donne la nouvel ip

./reboot
redémmare la box

./scanWifiCanal
rescan les wifi pour utiliser le canal le moin brouillé
