# apiLivebox
Script écrit en php pour automatiser les actions d'une livebox (renouveler ip pour pyload).

# Dépendence
Les packages : php5 (https://packages.debian.org/jessie/php5) et php5-curl (https://packages.debian.org/jessie/php5-curl)

sudo apt-get install php5 php5-curl

# Utilisation

./reconnection
Renouvelle l'ip (pour les ip dynamiques)

Donne la nouvelle ip.

./reboot
Redémmare la box.

./scanWifiCanal
Rescanne les wifis pour utiliser le canal le moins brouillé.
