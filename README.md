# mealplanner

This is just a stupid little app I run at home to help my family do the meal planning.  Its not built for mass use, but if you have a linux box at home
it should be pretty easy to get up and running, as its deployable with podman-compose.

It just presents a web interface that lets you do the following thigs:

1.  Create Cookbooks
2.  Create meals, which contain a cookbook receipie and page number, along with the ingreedients needded for said meal.  It also allows the entry of urls
    which will be displayed as QR codes for easy phone/tablet lookup while cooking
3.  Create Weekly meal plans, which lets you set a set of recepies up for a week
4.  Print your meal plan, so you have a handy reference that you can stick on you fridge, with a table that lists the meail, cookbook, and page for
    the meal for every day of the week
5.  Print your grocery list based on meal plan.  You can print them on paper, or download the grocery list as a csv, suitable for importing to apps
    like [Our Groceries](https://www.ourgroceries.com/overview)
6.  Gather meal statistics, so you can see over time what your famiy likes to eat the most
7.  Search for meals based on ingreedients you have in the house
