// edit-product.js

// Pre-fill drop down options with database data
const productTypeOptions = document.querySelectorAll('#productType > option');
const conditionOptions = document.querySelectorAll('#condition > option');
const mainCategoryOptions = document.getElementById('mainCategory');

const { condition, productType, attributes } = window.data;

productTypeOptions.forEach(option => {
    if (option.value == productType) {
        option.selected = true;
    }
});

conditionOptions.forEach(option => {
    if (option.value === condition) {
        option.selected = true;
    }
});

mainCategoryOptions.value = window.data.categoryId;

document.getElementById('attributes').value = JSON.stringify(attributes);

// Render existing product attributes (displayAttributes: product-attributes.js)
displayAttributes(attributes);

// Render required attributes for current product type (showRequired: show-required-attributes.js)
const { properties } = window.data.productTypesArray.filter(type => type.id === Number(productType))[0];
showRequired(properties);
