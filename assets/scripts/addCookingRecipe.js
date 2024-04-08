document.getElementById('addIngredient').addEventListener('click', function() {
    var ingredientContainer = document.getElementById('ingredients');
    var index = ingredientContainer.children.length;

    var ingredientPrototype = ingredientContainer.getAttribute('data-prototype');
    var newIngredientForm = ingredientPrototype.replace(/__name__/g, index);
    
    var newIngredientDiv = document.createElement('div');
    newIngredientDiv.innerHTML = newIngredientForm;
    
    ingredientContainer.appendChild(newIngredientDiv);
});

    document.getElementById('removeIngredient').addEventListener('click', function() {
    var ingredientContainer = document.getElementById('ingredients');
    if(ingredientContainer.children.length>0)
    {
        ingredientContainer.removeChild(ingredientContainer.lastElementChild);
    }
});