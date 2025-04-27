const searchBar = document.getElementById('searchBar');
const scrollBox = document.getElementById('scrollBox');
let debounceTimeout;

searchBar.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500);
});



function loadData(){
    const searchTerms = searchBar.value;

    fetch(LINKROOT + "/manufacturer/getDisReq?search=" + searchTerms)
    .then(response => response.json())
    .then(data => {
        renderCards(data);
    })
}

function renderCards(data) {
    scrollBox.innerHTML = '';
    data.forEach(element => {
        scrollBox.insertAdjacentHTML("beforeend", discard(element));
        scrollBox.lastElementChild.addEventListener('click', () => setPop(element));
    });
}

function setPop(request)  {
    const {dis_busines_name, date, time, dis_phone, pic_format, first_name, last_name, id } = request;
        document.getElementById('req_dis_name').innerText = first_name + " " + last_name;
        document.getElementById('req_buis_name').innerText = dis_busines_name;
        document.getElementById('req_date').innerText = date;
        document.getElementById('req_time').innerText = time;
        document.getElementById('req_pic').src = `${ROOT}/images/Profile/SA/${dis_phone}.${pic_format}`;
        document.getElementById('req_pic').onerror = function() {
            this.src = `${ROOT}/images/Profile/PhoneNumber.jpg`;
        document.getElementById('submitButton').onclick = () => updateStatus(id);
        document.getElementById('submitButton2').onclick = () => deleteStatus(id);
        
        viewPopUp('requestDetails');
    }
}

function updateStatus(id) {
    fetch(LINKROOT + '/Manufacturer/accept/' + id )
    .then(response => response.json())
    .then(data => {
        if (data.success) location.reload();
        else alert("An error ocured");
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error ocured");
    });
};

function deleteStatus(id) {
    fetch(LINKROOT + '/Manufacturer/delete/' + id )
    .then(response => response.json())
    .then(data => {
        if (data.success) location.reload();
        else alert("An error ocured");
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error ocured");
    });
};

function discard(request) {
    const {dis_busines_name, date, time, dis_phone, pic_format, first_name, last_name } = request;

    var imagePath = `${ROOT}/images/Profile/SA/${dis_phone}.${pic_format}`;

    return `
        <a class="card btn-card colomn asp-rtio"  >
            <img class="product-img" 
                src="${imagePath}" 
                onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg';"
                alt="">
            <div class="details h-50">
                <h4>${first_name} ${last_name}</h4>
                <h4>${dis_busines_name}</h4>
                <h4>${date}</h4>
                <h4>${time}</h4>
                
            </div>
        </a>
    `;
}

loadData();