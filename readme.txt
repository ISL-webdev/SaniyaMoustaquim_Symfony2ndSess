Mode opératoire

1. initialisation 
2. création du projet avec le website-skeleton
3.installation du maker-bundle
4. mise en route du serever avec symfony server:start et ça fonctionne
5. création de mon cocktail controller avec php bin/console make:controller
6. création de mes pages : routes, fonctions (show, create, ingredients, index) dans le controller et création des fichiers twig (show.html.twig, ingredients.html.twig...)
 	changement de ma base.html.twig pour y mettre le css, la nav
	à cette étape les liens fonctionnent, j'ai bien mes pages et ma nav qui marche et les adresses dans le navigateur affichent ce que je veux
7. création des entités avec doctrine, installation orm-pack
	a) modiv du .env
	b) creation de ma db cocktails avec php bin/console doctrine:database:create
	c) création de mon entité cocktail php bin/console make:entity 
		création de l'entité ingrédients avec un champ relationnel avec cocktail (type relation ManyToMany)
		création de l'entité catégorie avec une propriété relationnelle avec cocktail ManyToOne et une catégorie peut etre nulle pour un cocktail
	d) migration avec php bin/console make:migration et php bin/console doctrine:migrations:migrate
-> tout s'affiche bien dans ma db
8. Remplir ma db avec les fixtures et faker
	a) composer require orm-fixtures --dev et php bin/console make:fixtures et création de CocktailFixtures
	b) installation faker composer require fzaninotto/faker --dev
	c) création de mes fixtures avec une boucle dans CocktailFixtures et mettre des fausses données dedans avec faker (pour cocktails, catégories et ingrédients
	d) j'envoie les fixtures dans la db avec doctrine : php bin/console doctrine:fixtures:load
	
-> j'ai bien mes fausses données dans la db
9. Afficher tout ça dans mes fichiers twig
	a) modif du controller en ajoutant des variables pour afficher les éléments
	b) affichage dans twig {{ cocktail.name }} etc
10. formulaire :  php bin/console make:form
	a) modif dans le controller dans la fonction create
! erreur Object of class App\Entity\Ingredient could not be converted to string
__toString()	

