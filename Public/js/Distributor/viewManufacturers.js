const search = document.getElementById('search');
const elements = document.getElementById('elements');
let debounceTimeout;

search.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500)
})


function loadData() {
    const searchTerm = search.value;

    // console.log(`${LINKROOT}/Distributor/searchManufacturers?searchTerm=${encodeURIComponent(searchTerm)}`);
    fetch(`${LINKROOT}/DistributorNoMan/searchManufacturers?searchTerm=${encodeURIComponent(searchTerm)}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // console.log(data);
        elements.innerHTML = '';
        
        data.forEach(man => {
            elements.insertAdjacentHTML('beforeend', cardTemplate(man));
            elements.lastElementChild.addEventListener('click', () => popUpModel(man));
        });

    })
    .catch(error => console.error('Error:', error));
    
}

function cardTemplate(man) {
    const {company_name, man_phone, pic_format, company_address } = man;
    // console.log(man);
    return (
        `<a href="#" class="card btn-card colomn asp-rtio">
        <img class="product-img" 
            src="${ROOT}/images/Profile/SA/${man_phone}.${pic_format}" 
            alt={name}
            onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'" />
        <div class="details h-50">
            <h4>${company_name}</h4>
            <h4>${company_address}</h4>
        </div>
        </a>`
        );
}

function popUpModel(man){
    console.log(man);
    const {company_name, man_phone, pic_format,company_address,first_name,last_name} = man;

    document.getElementById('popUpManImage').src = `${ROOT}/images/Profile/SA/${man_phone}.${pic_format}`;
    document.getElementById('popUpManCompanyName').innerText = company_name;
    document.getElementById('popUpManPhone').innerText = man_phone;
    document.getElementById('man_phonehidden').value = man_phone;
    document.getElementById('popUpCompanyAddress').innerText = company_address;
    document.getElementById('popUpManName').innerText = `${first_name} ${last_name}`;


    viewPopUp('manPopUp');
}

loadData();

