if(document.getElementById('attributes').value) {
    attributes = JSON.parse(document.getElementById('attributes').value);
    displayAttributes(attributes);
} else {
    let attributes = {};
}
    
const addBtn = document.getElementById('add');
addBtn.addEventListener('click', addAttribute);

function addAttribute(e) {
    e.preventDefault();
        
    const key = e.target.parentNode.childNodes[5].value.toLowerCase().trim();
    const value = e.target.parentElement.childNodes[7].value.toLowerCase().trim();

    if(key && value) {

        attributes = {...attributes, [key] : value};

        document.getElementById('attributes').value = JSON.stringify(attributes);

        e.target.parentNode.childNodes[5].value = '';
        e.target.parentNode.childNodes[5].focus();
        e.target.parentElement.childNodes[7].value = '';

        displayAttributes(attributes);
        generateSlug();
    }
}

function displayAttributes(obj) {

    const container = document.getElementById('container');
    container.innerHTML = '';
    attributesArray = Object.entries(obj);

    attributesArray.forEach(attribute => {
        
        const div = document.createElement('div');
        const p = document.createElement('p');
        const button = document.createElement('button');

        div.classList = "inline p-1 m-1 shadow bg-gray-100 flex text-sm";
        p.classList = "capitalize";
        button.classList = "text-red-500 ml-2 font-bold";

        p.innerHTML = `<strong>${attribute[0]}:</strong> ${attribute[1]}`;
        button.innerText = "X";
        
        button.setAttribute('onclick', `remove("${attribute[0]}")`);

        div.appendChild(p);
        div.appendChild(button);
        container.appendChild(div);
    });

}

function remove(key) {
    event.preventDefault();

    delete attributes[key];
    event.target.parentNode.remove();

    document.getElementById('attributes').value = JSON.stringify(attributes);
    generateSlug();     
}
// End of Attributes.js



const manufacturer = document.getElementById('manufacturer');
const model = document.getElementById('model');
const condition = document.getElementById('condition');


[manufacturer, model].forEach(element => element.addEventListener('keyup', generateSlug));
condition.addEventListener('change', generateSlug);



function generateSlug() {
    console.log(attributes);
    const manufacturerString = manufacturer.value.replace(/\s/g, '-');
    const modelString = model.value.replace(/\s/g, '-');
    const attributesString = Object.values(attributes).join('-');

    document.getElementById('slug').value = [manufacturerString,modelString,condition.value, attributesString].join('-');
}