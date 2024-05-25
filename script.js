$(document).ready(function(){
// var index = document.querySelector("#index");
// var edit = document.querySelector("#edit");
// var add = document.querySelector("#add");

$("#add").hide();
$("#edit").hide();

function getAll(){
    var table = document.querySelector('#data');
    var tbody = "";
    $.ajax({
        type: "GET",
        url: 'http://localhost/EFMJS/Router.php?action=getAll',
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
        url: 'http://localhost/EFMJS/Router.php?action=get&id=' + id,
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

function edit($id){
    let etudinat = get(id);

}

function update(){

}

function destroy(){

}

getAll();


});
