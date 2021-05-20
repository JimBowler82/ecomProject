// Slug Generation
const manufacturer = document.getElementById('manufacturer');
const model = document.getElementById('model');
const conditionSelect = document.getElementById('condition');


[manufacturer, model].forEach(element => element.addEventListener('keyup', generateSlug));
conditionSelect.addEventListener('change', generateSlug);



function generateSlug() {
    const manufacturerString = manufacturer.value.replace(/\s/g, '-');
    const modelString = model.value.replace(/\s/g, '-');
    const attributesString = Object.values(attributes).join('-');

    document.getElementById('slug').value = [manufacturerString,modelString,conditionSelect.value, attributesString].join('-');
}
