// product-types.js

let attributesArray = window.data || [];
let attributesString = '';
const collectionArea = document.getElementById('collection');
const attributesInput = document.getElementById('attributes');
console.log(window.data);
attributesInput.addEventListener('keyup', (e) => {
    e.preventDefault();
    add();
});

function add() {
    attributesString = attributesInput.value.toLowerCase().trim().replace(/,\s*/g, '-');
    attributesArray = attributesString.split('-');
    document.getElementById('properties').value = JSON.stringify(attributesArray);
    display();
}

function display() {
    collectionArea.innerText = `["${attributesArray.join('", "')}"]`;
}

function loadPreviousData() {
    if (attributesArray) {
        document.getElementById('properties').value = JSON.stringify(attributesArray);
        attributesInput.value = attributesArray.join(', ');
        display();
    }
}

loadPreviousData();
