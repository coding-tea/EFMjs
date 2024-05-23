var table = document.querySelector('#data');
var tbody = "";

function getAll(){

    $.ajax({
        type: "GET",
        url: 'http://localhost/EFMJS/web.php',
        success: function (response) {
            response = JSON.parse(response);
            response.forEach(element => {
                tbody += `
                <tr>
                    <td> ${element.id} </td>
                    <td> ${element.civilite} </td>
                    <td> ${element.nom} </td>
                    <td> ${element.prenom} </td>
                    <td> ${element.email} </td>
                    <td> ${element.photo} </td>
                    <td> 
                        <button onclick="view(${element.id})">View</button>
                        <button onclick="edit(${element.id})">Edit</button>
                        <button onclick="delete(${element.id})">Delete</button>
                    </td>
                </tr>
                `;
            });
            table.innerHTML = tbody;
        }
    });
}

function get(id){
    $.ajax({
        type: "GET",
        url: 'http://localhost/EFMJS/web.php/',
        success: function (response) {
            response = JSON.parse(response);
            return response;
        }
    });
}

function add(){

}

function store($id){

}

function update(){

}

function edit(){

}

function destroy(){

}

getAll();