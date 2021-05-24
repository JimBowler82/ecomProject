// show-required-attributes.js
const typeSelect = document.getElementById('productType');
const requiredList = document.getElementById('requiredList');

const typesArray = window.data.productTypesArray;

typeSelect.addEventListener('change', () => {
    requiredList.innerHTML = '';
    const { properties } = typesArray.filter(type => type.id === Number(typeSelect.value))[0];
    showRequired(properties);
});

function showRequired(properties) {
    properties.forEach(property => {
        const li = document.createElement('li');
        li.innerText = property;
        li.classList.add("text-xs");
        requiredList.appendChild(li);
    });
}
