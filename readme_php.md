@Frédérique Perrin Pour installer / activer Xdebug sur Laragon, tu peux regarder : https://carlofontanos.com/how-to-install-xdebug-in-laragon/#:~:text=%20Installation%20in%20Laragon%3A%20%201%20Create%20a,icon%20of%20laragon%20in%20your%20task...%20More%20
Carlo Fontanos
How to install Xdebug in Laragon - Carlo Fontanos
Setup Xdebug PHP profiling tool in your laragon server in less than 3 minutes.


Moi tout en bas de mon fichier php.ini (fichier de configuration de PHP) j'ai : 
[XDebug]
; Enrichir l'affichage obtenu lors des appels à la fonction var_dump
; Activée par défaut
xdebug.overload_var_dump = 1

; Configure les quantités de données affichées par la fonction var_dump
xdebug.var_display_max_children = 128
xdebug.var_display_max_data = 1024
xdebug.var_display_max_depth = 8

; Configure les données affichées dans les stack traces
xdebug.collect_includes = 1     ; Noms de fichiers
xdebug.collect_params = 2       ; Paramètres de fonctions / méthodes

; Si activée, affiche une stack trace à chaque fois qu'une exception est levée
; (Même si elle est catchée)
; => Je désactive généralement cette directive,
; mais la conserve présente pour pouvoir la réactiver "si besoin"
xdebug.show_exception_trace = 0

; Le nombre maximal de profondeur d'appels de fonctions
; (Sécurité contre les récursions infinies)
xdebug.max_nesting_level = 64