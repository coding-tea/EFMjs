    function destroyetd(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'GET',
                    url: 'http://localhost/EFMJS/Router.php?action=delete&id=' + id,
                    success: function (response) {
                        swal("Poof! Etudiant has been deleted!", {
                            icon: "success",
                        });
                        var table = document.querySelector('#data');
                        var tbody = "";
                        $.ajax({
                            type: "GET",
                            url: 'http://localhost/EFMJS/Router.php?action=getAll',
                            success: function (response) {
                                response = JSON.parse(response);
                                response.forEach(element => {
                                    let pic = (element.photo != "null") ? "./img/" + element.photo : "./img/default.jpeg";
                                    tbody += `
                                    <tr>
                                        <td>${element.id}</td>
                                        <td>${element.civilite}</td>
                                        <td>${element.nom}</td>
                                        <td>${element.prenom}</td>
                                        <td>${element.email}</td>
                                        <td><img src="${pic}" /></td>
                                        <td class='text-end'>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaletd${element.id}">
                                                View
                                            </button>
                                            <button class='btn btn-success' onclick="editetd(${element.id})">Edit</button>
                                            <button class='btn btn-danger' onclick="destroyetd(${element.id})">Delete</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modaletd${element.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Etudiant ${element.id}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <b>civilite: ${element.civilite}</b><br>
                                                    <b>nom: ${element.nom}</b><br>
                                                    <b>prenom: ${element.prenom}</b><br>
                                                    <b>email: ${element.email}</b><br>
                                                    <b>photo:</b><br>
                                                    <img src="${pic}" />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `;
                                });
                                table.innerHTML = tbody;
                            }
                        });
                    }
                });
            }
        });
    }

    function editetd(id) {
        $.ajax({
            type: "GET",
            url: 'http://localhost/EFMJS/Router.php?action=get&id=' + id,
            success: function (response) {
                response = JSON.parse(response);
                console.log(response)
                $("#edit #civilite").val(response[0].civilite);
                $("#edit #nom").val(response[0].nom);
                $("#edit #prenom").val(response[0].prenom);
                $("#edit #email").val(response[0].email);
                $("#edit #id").val(response[0].id);
                $("#index").hide();
                $("#edit").show();
            }
        });
    }

    $(document).ready(function () {
        $("#add").hide();
        $("#edit").hide();

        function getAll() {
            var table = document.querySelector('#data');
            var tbody = "";
            $.ajax({
                type: "GET",
                url: 'http://localhost/EFMJS/Router.php?action=getAll',
                success: function (response) {
                    response = JSON.parse(response);
                    response.forEach(element => {
                        let pic = (element.photo != "null") ? "./img/" + element.photo : "./img/default.jpeg";
                        tbody += `
                        <tr>
                            <td>${element.id}</td>
                            <td>${element.civilite}</td>
                            <td>${element.nom}</td>
                            <td>${element.prenom}</td>
                            <td>${element.email}</td>
                            <td><img src="${pic}" /></td>
                            <td class='text-end'>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaletd${element.id}">
                                    View
                                </button>
                                <button class='btn btn-success' onclick="editetd(${element.id})">Edit</button>
                                <button class='btn btn-danger' onclick="destroyetd(${element.id})">Delete</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="modaletd${element.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Etudiant ${element.id}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <b>civilite: ${element.civilite}</b><br>
                                        <b>nom: ${element.nom}</b><br>
                                        <b>prenom: ${element.prenom}</b><br>
                                        <b>email: ${element.email}</b><br>
                                        <b>photo:</b><br>
                                        <img src="${pic}" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                    });
                    table.innerHTML = tbody;
                }
            });
        }

        $('#backedit').click(() => {
            $("#add").hide();
            $("#edit").hide();
            $("#index").show();
        });

        $('#backadd').click(() => {
            $("#add").hide();
            $("#edit").hide();
            $("#index").show();
        });

        $('#addetd').click(() => {
            $("#add").show();
            $("#index").hide();
        });

        $("#addbtn").click(function(){
            let civilite = $("#add #civilite").val();
            let nom = $("#add #nom").val();
            let prenom = $("#add #prenom").val();
            let email = $("#add #email").val();
            let photo = $("#add #photo").val();

            $.ajax({
                url: "http://localhost/EFMJS/Router.php?action=store",
                method: "POST",
                data:({
                    civilite: civilite,
                    nom: nom,
                    prenom: prenom,
                    email: email,
                    photo: photo
                }),
                success: function(response) {
                    console.log(response);
                    getAll();
                    $("#add").hide();
                    $("#index").show();
                    swal({
                        title: "Good job!",
                        text: "Etudiant Added successfuly",
                        icon: "success",
                      });

                },
                error: function(xhr, status, error) {
                    console.error("Error occurred: " + status + " " + error);
                    console.error(xhr.responseText);
                }
            });
        });

        getAll();


        $("#update").click(function(){
            let civilite = $("#edit #civilite").val();
            let nom = $("#edit #nom").val();
            let prenom = $("#edit #prenom").val();
            let email = $("#edit #email").val();
            let id = $("#edit #id").val();
            $.ajax({
                url: "http://localhost/EFMJS/Router.php?action=update",
                method: "POST",
                data: ({
                    civilite: civilite,
                    nom: nom,
                    prenom: prenom,
                    email: email,
                    id: id
                }),
                success: function(response) {
                    console.log(response);
                    getAll();
                    $("#edit").hide();
                    $("#index").show();
                    swal({
                        title: "Good job!",
                        text: "Etudiant Updated successfuly",
                        icon: "success",
                      });
                },
                error: function(xhr, status, error) {
                    console.error("Error occurred: " + status + " " + error);
                    console.error(xhr.responseText);
                }
            });
        })


    });
