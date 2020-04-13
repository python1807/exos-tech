# INFOMANIAK

INFOMANIAK est une application permettant de gérer une collection de campus ainsi que les étudiants et professeurs associés 

## Installation

- Utiliser Composer pour initialiser votre environnement

```bash
composer install
```
- Avoir PHP 7 CLI installé

## Usage (liste des commandes)
- Lister tous les campus

```bash
php index.php -a list_campus
```
- Afficher le détail d'un campus

```bash
php index.php -a get_campus -c Montpellier -r Occitanie 
```
- Ajouter un campus

```bash
php index.php -a add_campus -c Montpellier -r Occitanie -ca 3
```
- Supprimer un campus

```bash
php index.php -a delete_campus -c Montpellier -r Occitanie
```
- Ajouter un étudiant à un campus

```bash
php index.php -a add_student -c Montpellier -r Occitanie -id 4 -fn pierre -ln flipo
```
- Supprimer un étudiant d'un campus

```bash
php index.php -a remove_student -c Montpellier -r Occitanie -id 1 -fn pierre -ln flipo
```
- Ajouter un  professeur interne ou externe
```bash
php index.php -a add_teacher -c Montpellier -r Occitanie -id 4 -fn pierre -ln flipo -t interne 
php index.php -a add_teacher -c Montpellier -r Occitanie -id 5 -fn pierre -ln flipo -t externe -s 1200
```

- Supprimer un  professeur interne ou externe
```bash
php index.php -a remove_teacher -c Montpellier -r Occitanie -id 4 -fn pierre -ln flipo -t interne 
php index.php -a remove_teacher -c Montpellier -r Occitanie -id 5 -fn pierre -ln flipo -t externe -s 1200
```
- Mettre à jour le salaire de tous les professeurs internes

```bash
php index.php -a update_internal_salary -s 350
```

