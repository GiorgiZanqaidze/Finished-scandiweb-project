

const selectElement = document.querySelector('#productType');
const itemContainer = document.querySelector('.description')


// product types data
const productTypes = [
    {
        type: "DVD",
        description: ["size"],
        measure: "MB",
        specialAttr: "size"
    },
    {
        type: "book",
        description: ['weight'],
        measure: "KG",
        specialAttr: "weight" 
    },
    {
        type: "furniture",
        description: ["height", "length", "width"],
        measure: "CM",
        specialAttr: "dimmension"
    }
]

// update select value if user refresh the page
addEventListener('DOMContentLoaded', () => {
    // select value
    const type = selectElement.value
    // is select type value is not null then execute code
    if (type !== "null") {
        // find product type which is selected
        const chosenType = productTypes.find(item => item.type === type)
        // hidden input field
        const selectHtml = chosenType.description.map((item, index) => {
            // make string first letter to uppercase
            const uppercaseName = item[0].toUpperCase() + item.slice(1)
            // return html template code
            return `<div class='item-type-container' name="showInput">
                    <label htmlFor=${item}>${uppercaseName} (${chosenType.measure})</label>
                    <input type='text' name=${item} id=${item} /><br/>
                    <span class="alert-danger">
                        <?php  echo $errors['${item}'] ?? '' ?>
                    </span>
                </div>
                `
        })
        // additional info about select item depended on its type
        const additionalInfo = `
            <div class="alert">
                    Please, provide ${chosenType.specialAttr} in ${chosenType.measure}.
            </div>
        `
        // push additional info to html array code
        selectHtml.push(additionalInfo)
        // turn array to real html code
        itemContainer.innerHTML = selectHtml.join('')
    } else {
        return;
    }
});


// add event listener when user change select value
selectElement.addEventListener('change', (event) => {
    const type = event.target.value
    // is select type value is not null then execute code
    if (type !== "null") {
        // find product type which is selected
        const chosenType = productTypes.find(item => item.type === type)
        // hidden input field
        const selectHtml = chosenType.description.map((item, index) => {
            // make string first letter to uppercase
            const uppercaseName = item[0].toUpperCase() + item.slice(1)
            // return html template code
            return `<div class='item-type-container' name="showInput">
                    <label htmlFor=${item}>${uppercaseName} (${chosenType.measure})</label>
                    <input type='text' name=${item} id=${item} /><br/>
                    <span class="alert-danger">
                        <?php  echo $errors['${item}'] ?? '' ?>
                    </span>
                </div>
                `
        })
        // additional info about select item depended on its type
        const additionalInfo = `
            <div class="alert">
                    Please, provide ${chosenType.specialAttr} in ${chosenType.measure}.
            </div>
        `
        // push additional info to html array code
        selectHtml.push(additionalInfo)
        // turn array to real html code
        itemContainer.innerHTML = selectHtml.join('')
    } else {
        return;
    }
});





